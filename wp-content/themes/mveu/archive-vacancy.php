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
                <?php if ( have_posts() ): ?>
                    <div class="job_lists">
                        <div class="row">
                            <?php while (have_posts()): ?>
                                <?php
                                    the_post();
                                    global $post;
                                ?>

                                <div class="col-lg-12 col-md-12">
                                    <?php get_template_part('template/vacancy-card', null, ['vacancy' => $post])?>
                                </div>

                            <?php endwhile; ?>
                        </div>

                        <div class="text-center">
                            <?php the_posts_pagination_mvue_theme(); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <h3>Вакансий нет</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>