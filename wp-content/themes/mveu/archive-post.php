<?php
declare(strict_types=1);

$baseUri = get_template_directory_uri();

get_header();
?>

<div class="last_news">
    <div class="container">
        <div class="align-items-center mb-40">
            <div class="section_title">
                <h1>Новости</h1>
            </div>
        </div>

        <?php if ( have_posts() ): ?>
            <div class="row">
                <?php while (have_posts()): ?>
                    <?php
                        the_post();
                        global $post;
                    ?>
                    <div class="col-sm-6 col-md-3">
                        <?php get_template_part('template/post-card', null, ['post' => $post]) ?>
                    </div>
                <?php endwhile;?>
            </div>

            <div class="text-center">
                <?php the_posts_pagination_mvue_theme(); ?>
            </div>
        <?php else:?>
            <h3>Новостей нет</h3>
        <?php endif;?>
    </div>
</div>

<?php get_footer() ?>