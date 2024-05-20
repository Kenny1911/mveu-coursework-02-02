<?php

declare(strict_types=1);

namespace Kenny1911\Mveu\VacancyPlugin;

class SingleVacancyWidget extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct('widget_single-vacancy', 'Отдельная вакансия');
    }

    public function form( $instance ): void
    {
        $id = $instance['vacancyId'] ?? null;
        ?>
        <p>
            <label>ID вакансии*</label>
            <input type="text" name="<?php echo $this->get_field_name('vacancyId') ?>" value="<?php echo $id ?>" required>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance): array
    {
        return [
            'vacancyId' => $new_instance['vacancyId'] ?? null,
        ];
    }

    public function widget($args, $instance): void
    {
        $id = $instance['vacancyId'] ?? null;

        if (!$id) {
            return;
        }

        $vacancy = get_post($id);

        if (!$vacancy || 'vacancy' !== $vacancy->post_type) {
            return;
        }

        $href = get_post_permalink($vacancy);
        $salary = vacancy_plugin_format_salary(get_post_meta($vacancy->ID, 'salary', true));

        ?>
            <div class="widget">
                <h4><?php echo $vacancy->post_title ?></h4>
                <p><?php echo get_the_excerpt($vacancy) ?></p>
                <p><b><?php echo $salary ?></b></p>
                <p><a href="<?php echo $href ?>" class="boxed-btn3">Подробнее</a></p>
            </div>
        <?php
    }
}

add_action('widgets_init', function () {
    register_widget(SingleVacancyWidget::class);
});

add_shortcode('single-vacancy', function ($atts) {
    ob_start();
    (new SingleVacancyWidget())->widget([], ['vacancyId' => $atts['id'] ?? null]);

    return ob_get_clean();
});