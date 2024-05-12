<?php

declare(strict_types=1);

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
