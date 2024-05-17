<?php
declare(strict_types=1);

get_header();
?>

<div>
    <div class="container">
        <div class="job_listing_area">
            <div class="section_title">
                <h1>Вакансии</h1>
            </div>

            <div>

                    <div class="job_lists">
                        <div class="row">
                            <div class="col-lg-9">
                                <?php if ( have_posts() ): ?>
                                    <?php while (have_posts()): ?>
                                        <?php
                                            the_post();
                                            global $post;
                                        ?>
                                            <?php get_template_part('template/vacancy-card', null, ['vacancy' => $post])?>
                                    <?php endwhile; ?>

                                    <div class="text-center">
                                        <?php the_posts_pagination_mvue_theme(); ?>
                                    </div>
                                <?php else: ?>
                                    <h3>Вакансий нет</h3>
                                <?php endif; ?>
                            </div>

                            <div class="col-lg-3">
                                <?php dynamic_sidebar( 'archive-vacancy' ); ?>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>