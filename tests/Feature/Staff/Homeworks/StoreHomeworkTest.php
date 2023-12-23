<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\postJson;

it('can create and return new homework', function () {
    $staff = user()->staffRole()->create();

    $lesson = lesson()
        ->theme('Порождающие шаблоны проектирования')
        ->course(
            $course = course()
                ->type(courseType()->create())
                ->staff($staff)
                ->create()
        )
        ->create();

    actingAs($staff)
        ->postJson(route('staff.homeworks.store', [$course, $lesson]), [
            'expirationDate' => now()->addWeeks(),
            'info' => <<<EOL
                Задачи по паттерну 'Наблюдатель':
                1. Разработайте систему учета акций в интернет-магазине. Реализуйте механизм наблюдения, чтобы уведомлять клиентов об изменениях в ценах на продукты.
                2. Создайте приложение для мессенджера с функциональностью отправки сообщений. Примените паттерн наблюдатель, чтобы обеспечить оповещение пользователей о новых входящих сообщениях.
                3. Реализуйте систему управления задачами. При изменении статуса задачи все заинтересованные стороны (назначенные исполнители, менеджеры) должны получать уведомления.
            EOL
        ])
        ->assertCreated()
        ->assertJsonStructure([
            'data' => [
                'id',
                'lessonID',
                'theme',
                'info',
                'expirationDate',
            ]
        ]);

});
