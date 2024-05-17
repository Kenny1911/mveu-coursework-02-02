<?php

declare(strict_types=1);

namespace Kenny1911\Mveu\CompanyPlugin;

class CompaniesWidget extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct('widget_companies', 'Новые компании');
    }

    public function widget($args, $instance)
    {
        $companies = get_posts([
            'post_type' => 'company',
            'hide_empty' => false,
            'numberposts' => $args['numberposts'] ?? 5,
        ]);

        echo '<div class="widget">';
        echo '<h4>Новые компании</h4>';

        if ($companies) {
            echo '<div class="widget-list-wrapper">';
            echo '<ul>';

            foreach ($companies as $company) {
                $href = get_post_permalink($company);
                echo "<li><a href=\"{$href}\">{$company->post_title}</a></li>";
            }

            echo '</ul>';
            echo '</div>';
        } else {
            echo '<p>Компаний нет</p>';
        }

        echo '</div>';
    }
}

add_action('widgets_init', function () {
    register_widget(CompaniesWidget::class);
});
