<?php
declare(strict_types=1);

$baseUri = get_template_directory_uri();

get_header();
?>

<div>
    <div class="container">
        <?php if( have_posts() ): ?>
            <?php while( have_posts() ): the_post(); global $post; ?>

                <div>
                    <?php var_dump(is_single()) ?>
                    <?php if (is_single()): ?>
                        <h1><?php echo $post->post_title ?></h1>
                        <?php echo $post->post_content ?>
                    <?php else: ?>
                        <h3><a href="<?php echo get_post_permalink($post) ?>"><?php echo $post->post_title ?></a></h3>
                        <p><?php echo get_the_excerpt($post) ?></p>
                    <?php endif; ?>


                </div>
            <?php endwhile;?>
        <?php endif;?>

    </div>
</div>

<?php get_footer() ?>