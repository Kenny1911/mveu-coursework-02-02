<?php

declare(strict_types=1);

namespace Kenny1911\Mveu\VacancyPlugin;

class VacanciesWidget extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct('widget_vacancies', 'Новые вакансии');
    }

    public function widget($args, $instance)
    {
        $vacancies = get_posts([
            'post_type' => 'vacancy',
            'hide_empty' => false,
            'numberposts' => $args['numberposts'] ?? 5,
        ]);

        echo '<div class="widget">';
        echo '<h4>Новые вакансии</h4>';

        if ($vacancies) {
            echo '<div class="widget-list-wrapper">';
            echo '<ul>';

            foreach ($vacancies as $vacancy) {
                $href = get_post_permalink($vacancy);
                echo "<li><a href=\"{$href}\">{$vacancy->post_title}</a></li>";
            }

            echo '</ul>';
            echo '</div>';
        } else {
            echo '<p>Вакансий нет</p>';
        }

        echo '</div>';
    }
}

add_action('widgets_init', function () {
    register_widget(VacanciesWidget::class);
});

add_shortcode('vacancies', function () {
    ob_start();
    (new VacanciesWidget())->widget([], []);

    return ob_get_clean();
});
