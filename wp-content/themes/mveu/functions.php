<?php

declare(strict_types=1);

// Change arcyive url for posts
add_filter(
    'register_post_type_args',
    function($args, $post_type){
        if ('post' !== $post_type) {
            return $args;
        }

        $args['has_archive'] = 'posts';
        $args['rewrite'] = true;

        return $args;
    },
    10,
    2,
);

add_filter(
    'post_type_archive_link',
    function ( $link, $post_type ) {
    	global $wp_rewrite;

    	if ( $post_type === 'post' ) {
    		$post_type_obj = get_post_type_object( $post_type );

    		/** start @see get_post_type_archive_link() */
    		if ( ! $post_type_obj->has_archive ) {
    			return false;
    		}

    		if ( get_option( 'permalink_structure' ) && is_array( $post_type_obj->rewrite ) ) {
    			$struct = ( true === $post_type_obj->has_archive ) ? $post_type_obj->rewrite['slug'] : $post_type_obj->has_archive;
    			if ( $post_type_obj->rewrite['with_front'] ) {
    				$struct = $wp_rewrite->front . $struct;
    			} else {
    				$struct = $wp_rewrite->root . $struct;
    			}
    			$link = home_url( user_trailingslashit( $struct, 'post_type_archive' ) );
    		} else {
    			$link = home_url( '?post_type=' . $post_type );
    		}
    		/* end */
    	}

    	return $link;
    },
    10,
    2,
);

// Set posts per page for posts
add_filter('pre_get_posts', function(WP_Query $query){
    if ( $query->is_post_type_archive( 'post' ) && ! is_admin() && $query->is_main_query() ) {
          $query->set( 'posts_per_page', 12 );
    }

    return $query;
});

// Set posts per page for vacancies
add_filter('pre_get_posts', function(WP_Query $query){
    if ( $query->is_post_type_archive( 'vacancy' ) && ! is_admin() && $query->is_main_query() ) {
          $query->set( 'posts_per_page', 10 );
    }

    return $query;
});

// Set posts per page for companies
add_filter('pre_get_posts', function(WP_Query $query){
    if ( $query->is_post_type_archive( 'company' ) && ! is_admin() && $query->is_main_query() ) {
          $query->set( 'posts_per_page', 12 );
    }

    return $query;
});

function the_posts_pagination_mvue_theme(): void
{
    echo get_posts_pagination_mvue_theme();
}

function get_posts_pagination_mvue_theme(): string
{
    $pagination = '<div class="pagination_wrap">';
    $pagination .= paginate_links([
        'type' => 'list',
        'prev_text' => '<i class="ti-angle-left"></i>',
        'next_text' => '<i class="ti-angle-right"></i>',
    ]);
    $pagination .=  '</div>';

    return $pagination;
}


add_theme_support( 'post-thumbnails');

add_action( 'widgets_init', function(){
    register_sidebar([
        'id' => 'archive-vacancy',
        'name' => 'Сайдбар на странице с вакансиями',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
    ]);

    register_sidebar([
        'id' => 'archive-company',
        'name' => 'Сайдбар на странице с компаниями',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
    ]);
} );


// Header menu settings
add_action('after_setup_theme', function(){
    register_nav_menu('header-menu', 'Меню в шапке');
});


add_filter('nav_menu_submenu_css_class', function ($classes, $args, $depth) {
    if ('header-menu' !== $args->theme_location) {
        return $classes;
    }

    return ['submenu'];
}, 10, 3);

add_filter('walker_nav_menu_start_el', function($item_output, $menu_item, $depth, $args){
    if (
        'header-menu' === $args->theme_location &&
        in_array('menu-item-has-children', $menu_item->classes, true)
    ) {
        $item_output = str_replace('</a>', ' <i class="ti-angle-down"></i></a>', $item_output);
    }

    return $item_output;
}, 10, 4);
