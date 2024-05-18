<?php
declare(strict_types=1);

$baseUri = get_template_directory_uri();

get_header();

the_post();
global $post;
?>

<div class="main">
    <div class="container">
        <h1><?php echo $post->post_title ?></h1>
        <?php the_content() ?>
    </div>
</div>

<?php get_footer() ?>