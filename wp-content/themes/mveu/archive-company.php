<?php
declare(strict_types=1);

get_header();
?>

<div class="top_companies_area">
    <div class="container">
        <div class="align-items-center mb-40">
            <div class="section_title">
                <h1>Компании</h1>
            </div>
        </div>
            <div class="row">
                <div class="col-lg-9">
                    <?php if ( have_posts() ): ?>
                        <div class="row">
                            <?php while (have_posts()): ?>
                                <?php
                                    the_post();
                                    global $post;
                                ?>
                                <div class="col-lg-4 col-xl-4 col-md-6">
                                    <?php get_template_part('template/company-card', null, ['company' => $post]) ?>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <div class="text-center">
                            <?php the_posts_pagination_mvue_theme(); ?>
                        </div>
                    <?php else: ?>
                        <h3>Компаний нет</h3>
                    <?php endif; ?>
                </div>

                <div class="col-lg-3">
                    <?php dynamic_sidebar( 'archive-company' ); ?>
                </div>
            </div>
    </div>
</div>

<?php get_footer() ?>