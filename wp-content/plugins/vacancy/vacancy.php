<?php
/*
Plugin Name: Вакансии
Description: Добавляет тип материала "Вакансии" для сайта "Ярмарка вакансий"
Author: Kenny1911 <o-muzyka@mail.ru>
Version: 1.0.0
*/
// Защита от прямого доступа к файлу
defined('ABSPATH') or die('No script kiddies please!');

require_once __DIR__.'/widget/specializations.php';
require_once __DIR__.'/widget/vacancies.php';
require_once __DIR__.'/widget/single-vacancy.php';

function vacancy_plugin_init(): void
{
    add_action('init', 'vacancy_plugin_init_vacancy_post_type');
    add_action('init', 'vacancy_plugin_init_specialization_taxonomy');
}

function vacancy_plugin_init_vacancy_post_type(): void
{
    register_post_type('vacancy', [
        'label' => 'Вакансия',
        'public' => true,
        'supports' => ['title', 'editor'],
        'has_archive' => 'vacancies',
        'show_in_nav_menus' => true,
    ]);

    add_action('add_meta_boxes', function () {
        add_meta_box(
            'custom-fields',
            'Дополнительные поля',
            function (WP_Post $post) {
                $phone = sanitize_text_field(get_post_meta($post->ID, 'phone', true));
                $salary = sanitize_text_field(get_post_meta($post->ID, 'salary', true));
                $experience = sanitize_text_field(get_post_meta($post->ID, 'experience', true));

                ?>

                <table class="form-table">
                    <tr>
                        <th><label>Номер телефона*</label></th>
                        <td><input type="tel" name="phone" value="<?php echo $phone ?>" required></td>
                    </tr>
                    <tr>
                        <th><label for="">Оплата</label></th>
                        <td><input type="number" name="salary" value="<?php echo $salary ?>" min="0" step="1" pattern="^[\d]+$"></td>
                    </tr>
                    <tr>
                        <th><label for="">Опыт</label></th>
                        <td>
                            <select name="experience" id="">
                                <option>Не указан</option>
                                <?php foreach (vacancy_plugin_experience_options() as $key => $value): ?>
                                    <option value="<?php echo $key ?>" <?php selected($experience, $key)?>><?php echo $value ?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                </table>

                <?php
            },
            'vacancy',
        );
    });

    add_action('save_post_vacancy', function ($postId): void {
        update_post_meta($postId, 'phone', sanitize_text_field($_POST['phone'] ?? ''));
        update_post_meta($postId, 'salary', sanitize_text_field($_POST['salary'] ?? ''));
        update_post_meta($postId, 'experience', sanitize_text_field($_POST['experience'] ?? ''));
    });
}

function vacancy_plugin_init_specialization_taxonomy(): void
{
    register_taxonomy('speciality', 'vacancy', [
        'label' => 'Специальность',
        'public' => true,
        'hierarchical' => true,
        'show_in_nav_menus' => true,
    ]);
}


vacancy_plugin_init();

function vacancy_plugin_format_salary(float|int|string $salary): string
{
    $salary = (int) $salary;

    return ($salary > 0) ? number_format($salary, 0, '.', ' ').' руб.' : 'Не указана';
}

function vacancy_plugin_experience_options(): array
{
    return [
        'no' => 'Без опыта',
        'from_1_to_3' => 'От 1 до 3 лет',
        'from_3_to_6' => 'От 3 до 6 лет',
        'more_6' => 'Больше 6 лет',
    ];
}

function vacancy_plugin_experience_title(string $experience): string
{
    return vacancy_plugin_experience_options()[$experience] ?? 'Не указан';
}

function vacancy_plugin_specialization_archive_url(WP_Term $term): string
{
    $url = get_post_type_archive_link('vacancy');

    return add_query_arg(['taxonomy' => 'speciality', 'term' => $term->slug], $url);
}
