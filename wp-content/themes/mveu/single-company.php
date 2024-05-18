<?php
declare(strict_types=1);

$baseUri = get_template_directory_uri();

get_header();
the_post();
global $post;
$rating = (int) get_post_meta($post->ID, 'rating', true);
$phone = get_post_meta($post->ID, 'phone', true);
$inn = get_post_meta($post->ID, 'inn', true);
$cities = get_the_terms($post, 'city');
?>

<div class="main">
    <div class="container">
        <h1><?php echo $post->post_title ?></h1>
        <?php foreach ($cities as $city): ?>
            <a href="<?php company_plugin_city_archive_url($city) ?>"><?php echo $city->name ?></a>
        <?php endforeach; ?>
        <p><img src="<?php echo get_the_post_thumbnail_url($post) ?: $baseUri.'/img/placeholder.svg' ?>" alt=""></p>
        <div class="show-phone">
            <button class="boxed-btn3">Показать телефон</button>
            <div class="show-phone__phone"><?php echo $phone?></div>
        </div>
        <p>Рейтинг:
            <b>
                <?php
                    for ($i = 1; $i <= 5; ++$i) {
                        echo ($i <= $rating) ? '★' : '☆';
                    }
                ?>
            </b>
        </p>
        <p>ИНН: <?php echo $inn ?></p>
        <?php the_content() ?>
    </div>
</div>

<?php get_footer() ?>