<?php

declare(strict_types=1);

$baseUri = get_template_directory_uri();

$company = $args['company'] ?? null;

if (!(isset($company) && $company instanceof WP_Post)) {
    throw new \LogicException('Expected argument company of type WP_Post.');
}
?>

<div class="single_company">
    <div class="thumb">
        <img src="<?php echo get_the_post_thumbnail_url($company) ?: $baseUri.'/img/placeholder.svg' ?>" alt="">
    </div>
    <a href="<?php echo get_post_permalink($company) ?>"><h3><?php echo $company->post_title ?></h3></a>
</div>
