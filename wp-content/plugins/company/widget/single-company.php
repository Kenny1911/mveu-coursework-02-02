<?php

declare(strict_types=1);

namespace Kenny1911\Mveu\CompanyPlugin;

class SingleCompanyWidget extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct('widget_single_company', 'Отдельная компания');
    }

    public function form( $instance ): void
    {
        $id = $instance['companyId'] ?? null;
        ?>
        <p>
            <label>ID компании*</label>
            <input type="text" name="<?php echo $this->get_field_name('companyId') ?>" value="<?php echo $id ?>" required>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance): array
    {
        return [
            'companyId' => $new_instance['companyId'] ?? null,
        ];
    }

    public function widget($args, $instance): void
    {
        $id = $instance['companyId'] ?? null;

        if (!$id) {
            return;
        }

        $company = get_post($id);

        if (!$company || 'company' !== $company->post_type) {
            return;
        }

        $href = get_post_permalink($company);
        $thumbnail = get_the_post_thumbnail_url($company);

        ?>
            <div class="widget widget_single_company">
                <?php if ($thumbnail): ?>
                    <img src="<?php echo $thumbnail ?>" alt="">
                <?php endif;?>

                <h4><a href="<?php echo $href ?>"><?php echo $company->post_title ?></a></h4>
            </div>
        <?php
    }
}

add_action('widgets_init', function () {
    register_widget(SingleCompanyWidget::class);
});

add_shortcode('single-company', function ($atts) {
    ob_start();
    (new SingleCompanyWidget())->widget([], ['companyId' => $atts['id'] ?? null]);

    return ob_get_clean();
});
