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
                <?php foreach ($vacancies as $vacancy): ?>
                    <div class="col-lg-12 col-md-12">
                        <?php get_template_part('template/vacancy-card', null, ['vacancy' => $vacancy]) ?>
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
                <?php get_template_part('template/company-card', null, ['company' => $company]) ?>
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
                <?php get_template_part('template/post-card', null, ['post' => $post]) ?>
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