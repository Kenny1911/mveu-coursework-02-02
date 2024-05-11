<?php
/*
Plugin Name: Вакансии
Description: Добавляет тип материала "Вакансии" для сайта "Ярмарка вакансий"
Author: Kenny1911 <o-muzyka@mail.ru>
Version: 1.0.0
*/
// Защита от прямого доступа к файлу
defined('ABSPATH') or die('No script kiddies please!');

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
                                <option value="no" <?php selected($experience, 'no')?>>Без опыта</option>
                                <option value="from_1_to_3" <?php selected($experience, 'from_1_to_3')?>>от 1 до 3 лет</option>
                                <option value="from_3_to_6" <?php selected($experience, 'from_3_to_6')?>>От 3 до 6 лет</option>
                                <option value="more_6" <?php selected($experience, 'more_6')?>>Больше 6 лет</option>
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
    ]);
}


vacancy_plugin_init();