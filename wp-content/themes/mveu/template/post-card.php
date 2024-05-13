<?php

declare(strict_types=1);

$post = $args['post'] ?? null;

if (!(isset($post) && $post instanceof WP_Post)) {
    throw new \LogicException('Expected argument post of type WP_Post.');
}
?>

<a href="<?php echo get_post_permalink($post) ?>" class="card mb-40">
    <div class="card-body">
        <div class="card-title"><?php echo $post->post_title;?></div>
        <div class="card-text">
            <p><?php echo get_the_excerpt($post) ?></p>
        </div>
    </div>
</a>
