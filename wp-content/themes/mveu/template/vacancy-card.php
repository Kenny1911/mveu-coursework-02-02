<?php

declare(strict_types=1);

$vacancy = $args['vacancy'] ?? null;

if (!(isset($vacancy) && $vacancy instanceof WP_Post)) {
    throw new \LogicException('Expected argument vacancy of type WP_Post.');
}
?>

<div class="single_jobs white-bg d-flex justify-content-between">
    <div class="jobs_left d-flex align-items-center">
        <div class="jobs_conetent">
            <a href="<?php echo get_post_permalink($vacancy->ID) ?>"><h4><?php echo $vacancy->post_title ?></h4></a>
            <div class="links_locat d-flex align-items-center">
                <?php $salary = (int) get_post_meta($vacancy->ID, 'salary', true) ?>
                <div class="location">
                    <p>
                        Оплата:
                        <?php echo ($salary > 0) ? number_format($salary, 0, '.', ' ').' руб.' : 'Не указана' ?>
                    </p>
                </div>

                <?php $experience = get_post_meta($vacancy->ID, 'experience', true)?>
                <div class="location">
                    <p>
                        Опыт:
                        <?php
                            echo match ($experience) {
                                'no' => 'Без опыта',
                                'from_1_to_3' => 'От 1 до 3 лет',
                                'from_3_to_6' => 'От 3 до 6 лет',
                                'more_6' => 'Больше 6 лет',
                                default => 'Не указан',
                            }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="jobs_right">
        <div class="apply_now">
            <a href="<?php echo get_post_permalink($vacancy) ?>" class="boxed-btn3">Посмотреть</a>
        </div>
        <div class="date">
            <p>Дата: <?php echo (new DateTimeImmutable($vacancy->post_date))->format('Y-m-d')?></p>
        </div>
    </div>
</div>
