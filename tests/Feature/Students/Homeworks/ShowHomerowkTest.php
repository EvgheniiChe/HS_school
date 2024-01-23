<?php

use Illuminate\Support\Facades\Date;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\travelTo;

it('returns homework data', function () {
    travelTo(Date::parse('2023-11-21'));

    $student = user()->studentRole()->create();

    $course = course()
        ->withStaffAndType()
        ->startDate('2023-10-21')
        ->endDate(now()->addMonth()->format('Y-m-d'))
        ->create();

    group()->course($course)->student($student)->create();

    $homework = homework()
        ->lesson($lesson1 = lesson()->theme('Порождающие шаблоны проектирования')->course($course)->create(['id' => 1]))
        ->theme($lesson1->theme)
        ->expiredAt(now()->addWeek())
        ->info(<<<'EOL'
            Задачи по паттерну 'Шаблонный метод':
            1. Напишите программу для загрузки данных из различных источников (файл, база данных, веб-сервис). Используйте шаблонный метод для определения общего алгоритма загрузки с возможностью переопределения шагов для каждого типа источника.
            2. Разработайте систему для создания отчетов. Примените шаблонный метод для определения общего процесса создания отчета с возможностью переопределения шагов для разных типов отчетов.
            3. Создайте приложение для генерации графиков. Используйте шаблонный метод для определения общего процесса создания графика с возможностью переопределения шагов для различных типов графиков.
            EOL)
        ->create(['id' => 1]);

    $response = actingAs($student)
        ->getJson(route('students.homeworks.show', $homework))
        ->assertOk();

    expect($response)->toMatchSnapshot();
});

it('returns error when student try to open foreign homework', function () {
    $student = user()->studentRole()->create();

    $course = course()
        ->withStaffAndType()
        ->startDate('2023-10-21')
        ->endDate(now()->addMonth()->format('Y-m-d'))
        ->create();

    group()->course($course)->student($student)->create();

    $homework = homework()
        ->lesson($lesson1 = lesson()->theme('Порождающие шаблоны проектирования')->course($course)->create())
        ->theme($lesson1->theme)
        ->expiredAt(now()->addWeek())
        ->info(<<<'EOL'
            Задачи по паттерну 'Шаблонный метод':
            1. Напишите программу для загрузки данных из различных источников (файл, база данных, веб-сервис). Используйте шаблонный метод для определения общего алгоритма загрузки с возможностью переопределения шагов для каждого типа источника.
            2. Разработайте систему для создания отчетов. Примените шаблонный метод для определения общего процесса создания отчета с возможностью переопределения шагов для разных типов отчетов.
            3. Создайте приложение для генерации графиков. Используйте шаблонный метод для определения общего процесса создания графика с возможностью переопределения шагов для различных типов графиков.
            EOL)
        ->create();

    actingAs(user()->studentRole()->create())
        ->getJson(route('students.homeworks.show', $homework))
        ->assertNotFound();
});
