<?php

declare(strict_types=1);

namespace Kenny1911\Mveu\CompanyPlugin;

use WP_Widget;

class CitiesWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('plugin-company-cities-widget', 'Список городов');
    }

    public function widget($args, $instance): void
    {
        $terms = get_terms([
            'taxonomy' => 'city',
            'hide_empty' => false,
        ]);

        if ($terms) {
            echo '<div class="widget">';
            echo '<h4>Города</h4>';
            echo '<div class="widget-list-wrapper">';

            foreach ($terms as $term) {
                $href = company_plugin_city_archive_url($term);
                echo '<li>';
                echo "<a href=\"{$href}\">{$term->name}</a>";
                echo '</li>';
            }

            echo '</div>';
            echo '</div>';
        }
    }
}

add_action('widgets_init', function () {
    register_widget(CitiesWidget::class);
});
