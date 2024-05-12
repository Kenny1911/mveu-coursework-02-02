<?php
declare(strict_types=1);

$baseUri = get_template_directory_uri();

get_header();
?>

<!-- job_listing_area_start  -->
<?php
    $vacancies = get_posts([
        'numberposts' => 10,
        'post_type' => 'vacancy',
    ]);
?>
<div class="job_listing_area">
    <div class="container">
        <div class="align-items-center">
            <div class="section_title">
                <h3>Вакансии</h3>
            </div>
        </div>
        <div class="job_lists">
            <div class="row">
                <?php foreach ($vacancies as $i => $vacancy): ?>
                <div class="col-lg-12 col-md-12">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="jobs_conetent">
                                <a href="<?php echo get_post_permalink($vacancy->ID) ?>"><h4><?php echo $vacancy->post_title ?></h4></a>
                                <div class="links_locat d-flex align-items-center">
                                    <?php $salary = (int) get_post_meta($vacancy->ID, 'salary', true) ?>
                                    <div class="location">
                                        <p>
                                            Оплата:
                                            <?php echo ($salary > 0) ? number_format($salary, 0, '.', ' ').' руб.' : 'Не указана' ?>
                                        </p>
                                    </div>

                                    <?php $experience = get_post_meta($vacancy->ID, 'experience', true)?>
                                    <div class="location">
                                        <p>
                                            Опыт:
                                            <?php
                                                echo match ($experience) {
                                                    'no' => 'Без опыта',
                                                    'from_1_to_3' => 'От 1 до 3 лет',
                                                    'from_3_to_6' => 'От 3 до 6 лет',
                                                    'more_6' => 'Больше 6 лет',
                                                    default => 'Не указан',
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jobs_right">
                            <div class="apply_now">
                                <a href="<?php echo get_post_permalink($vacancy) ?>" class="boxed-btn3">Посмотреть</a>
                            </div>
                            <div class="date">
                                <p>Дата: <?php echo (new DateTimeImmutable($vacancy->post_date))->format('Y-m-d')?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <div class="text-center">
            <a href="<?php echo get_post_type_archive_link('vacancy') ?>" class="boxed-btn4">Смотреть все</a>
        </div>
    </div>
</div>
<!-- job_listing_area_end  -->

<?php
    $companies = get_posts([
        'numberposts' => 6,
        'post_type' => 'company',
    ]);
?>
<div class="top_companies_area">
    <div class="container">
        <div class="align-items-center mb-40">
            <div class="section_title">
                <h3>Компании</h3>
            </div>
        </div>
        <div class="row">
            <?php foreach ($companies as $i => $company): ?>
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_company">
                    <div class="thumb">
                        <img src="<?php echo get_the_post_thumbnail_url($company) ?: $baseUri.'/img/placeholder.svg' ?>" alt="">
                    </div>
                    <a href="<?php echo get_post_permalink($company) ?>"><h3><?php echo $company->post_title ?></h3></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center">
            <a href="<?php echo get_post_type_archive_link('company') ?>" class="boxed-btn4">Смотреть все</a>
        </div>
    </div>
</div>

<!-- last news start -->
<?php
    $posts = get_posts([
        'numberposts' => 6,
        'post_type' => 'post',
    ]);
?>
<div class="last_news">
    <div class="container">
        <div class="align-items-center mb-40">
            <div class="section_title">
                <h3>Новости</h3>
            </div>
        </div>
        <div class="row">
            <?php foreach ($posts as $post): ?>
            <div class="col-sm-6 col-md-3">
                <a href="<?php echo get_post_permalink($post) ?>" class="card mb-40">
                    <div class="card-body">
                        <div class="card-title"><?php echo $post->post_title;?></div>
                        <div class="card-text">
                            <p><?php echo get_the_excerpt($post) ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach;?>
        </div>

        <div class="text-center">
            <a href="<?php echo get_post_type_archive_link('post') ?>" class="boxed-btn4">Смотреть все</a>
        </div>
    </div>
</div>
<!--/ last news end -->

<?php get_footer() ?>