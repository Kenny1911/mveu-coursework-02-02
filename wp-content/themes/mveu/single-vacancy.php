<?php
declare(strict_types=1);

$baseUri = get_template_directory_uri();

get_header();

the_post();
global $post;
$salary = vacancy_plugin_format_salary((int) get_post_meta($post->ID, 'salary', true));
$experience = vacancy_plugin_experience_title((string) get_post_meta($post->ID, 'experience', true));
$phone = get_post_meta($post->ID, 'phone', true);

$specializations = get_the_terms($post, 'speciality') ?: [];
?>

<div class="main">
    <div class="container">
        <h1><?php echo $post->post_title ?></h1>
        <p>
            <?php foreach ($specializations as $specialization): ?>
                <a href="<?php echo vacancy_plugin_specialization_archive_url($specialization) ?>"><?php echo $specialization->name ?></a>
            <?php endforeach; ?>
        </p>
        <p>Оплата: <b><?php echo $salary ?></b></p>
        <p>Опыт работы: <i><?php echo $experience ?></i></p>
        <div class="show-phone">
            <button class="boxed-btn3">Показать телефон</button>
            <div class="show-phone__phone"><?php echo $phone?></div>
        </div>

        <?php the_content() ?>

        <p><i>Дата: <?php echo (new DateTimeImmutable($post->post_date))->format('Y-m-d')?></i></p>
    </div>
</div>

<?php get_footer() ?>