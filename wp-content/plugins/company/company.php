<?php
/*
Plugin Name: Компании
Description: Добавляет тип материала "Компания" для сайта "Ярмарка вакансий"
Author: Kenny1911 <o-muzyka@mail.ru>
Version: 1.0.0
*/
// Защита от прямого доступа к файлу
defined('ABSPATH') or die('No script kiddies please!');

require_once __DIR__.'/widget/companies.php';
require_once __DIR__.'/widget/single-company.php';
require_once __DIR__.'/widget/cities.php';

function company_plugin_init(): void
{
    add_action('init', 'company_plugin_init_vacancy_post_type');
    add_action('init', 'company_plugin_init_specialization_taxonomy');
}

function company_plugin_init_vacancy_post_type(): void
{
    register_post_type('company', [
        'label' => 'Компания',
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => 'companies',
    ]);

    add_action('add_meta_boxes', function () {
        add_meta_box(
            'custom-fields',
            'Дополнительные поля',
            function (WP_Post $post) {
                $phone = sanitize_text_field(get_post_meta($post->ID, 'phone', true));
                $rating = sanitize_text_field(get_post_meta($post->ID, 'rating', true));
                $inn = sanitize_text_field(get_post_meta($post->ID, 'inn', true));

                ?>

                <table class="form-table">
                    <tr>
                        <th><label>Номер телефона*</label></th>
                        <td><input type="tel" name="phone" value="<?php echo $phone ?>" required></td>
                    </tr>
                    <tr>
                        <th><label for="">Рейтинг*</label></th>
                        <td>
                            <select name="rating">
                                <option value="1" <?php selected($rating, '1')?>>1</option>
                                <option value="2" <?php selected($rating, '2')?>>2</option>
                                <option value="3" <?php selected($rating, '3')?>>3</option>
                                <option value="4" <?php selected($rating, '4')?>>4</option>
                                <option value="5" <?php selected($rating, '5')?>>5</option>
                            </select>
                    </tr>
                    <tr>
                        <th><label for="">ИНН</label></th>
                        <td>
                            <input type="text" name="inn" value="<?php echo $inn ?>" pattern="^(\d{10}|\d{12})$">
                        </td>
                    </tr>
                </table>

                <?php
            },
            'company',
        );
    });

    add_action('save_post_company', function ($postId): void {
        update_post_meta($postId, 'phone', sanitize_text_field($_POST['phone'] ?? ''));
        update_post_meta($postId, 'rating', sanitize_text_field($_POST['rating'] ?? ''));
        update_post_meta($postId, 'inn', sanitize_text_field($_POST['inn'] ?? ''));
    });
}

function company_plugin_init_specialization_taxonomy(): void
{
    register_taxonomy('city', 'company', [
        'label' => 'Город',
        'public' => true,
        'hierarchical' => false,
    ]);
}


company_plugin_init();

function company_plugin_city_archive_url(WP_Term $term): string
{
    $url = get_post_type_archive_link('company');

    return add_query_arg(['taxonomy' => 'city', 'term' => $term->slug], $url);
}
