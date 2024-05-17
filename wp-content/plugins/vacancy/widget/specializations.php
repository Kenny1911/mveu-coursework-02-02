<?php

declare(strict_types=1);

namespace Kenny1911\Mveu\VacancyPlugin;

use WP_Widget;

class SpecializationsWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('plugin-vacancy-specializations-widget', 'Список специализаций');
    }

    public function widget($args, $instance): void
    {
        $count = (int) wp_count_terms([
            'taxonomy' => 'speciality',
            'hide_empty' => false,
            'parent' => 0,
        ]);

        if ($count > 0) {
            echo '<div class="widget">';
            echo '<h4>Специализации</h4>';
            echo '<div class="widget-list-wrapper">';
            $this->renderTermsList();
            echo '</div>';
            echo '</div>';
        }
    }

    private function renderTermsList(int $parentId = 0): void
    {
        $terms = get_terms([
            'taxonomy' => 'speciality',
            'hide_empty' => false,
            'parent' => $parentId,
        ]);

        if ($terms) {

            echo 0 === $parentId ? '' : '<li>'; // Wrap in list, if not root level

            echo '<ul>';

            foreach ($terms as $term) {
                $href = get_post_type_archive_link('vacancy');
                $href = add_query_arg(['taxonomy' => 'speciality', 'term' => $term->slug], $href);
                echo '<li>';
                echo "<a href=\"{$href}\">{$term->name}</a>";

                $this->renderTermsList($term->term_id);

                echo '</li>';
            }

            echo '</ul>';

            echo 0 === $parentId ? '' : '</li>'; // Wrap in list, if not root level
        }
    }
}

add_action('widgets_init', function () {
    register_widget(SpecializationsWidget::class);
});
