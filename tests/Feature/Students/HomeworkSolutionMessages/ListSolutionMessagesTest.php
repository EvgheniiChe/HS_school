<?php

use Illuminate\Support\Facades\Date;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\travelTo;

it('returns a list of homework solution messages', function () {
    travelTo((Date::parse('2024-01-11 12:01:00')));

    $student = user()->studentRole()->create([
        'id' => 1,
        'name' => 'Женя',
        'email' => 'email1@gmail.com'
    ]);

    $course = course()
        ->staff(user()->staffRole()->create(['id' => 2, 'name' => 'Света', 'email' => 'email2@gmail.com']))
        ->type(courseType()->create())
        ->startDate('2023-10-21')
        ->endDate(now()->addMonth()->format('Y-m-d'))
        ->create();

    $homework = homework()
        ->lesson($lesson = lesson()->theme('Порождающие шаблоны проектирования')->course($course)->create())
        ->theme($lesson->theme)
        ->expiredAt(now()->addWeek())
        ->info('Лучшее домашнее задание ever')
        ->create(['id' => 1]);

    $solution = homeworkSolution()
        ->homework($homework)
        ->student($student)
        ->opened()
        ->create(['id' => 1]);

    homeworkSolutionMessage()
        ->solution($solution)
        ->author($student)
        ->message('Первое сообщение')
        ->create(['id' => 1]);

    homeworkSolutionMessage()
        ->solution($solution)
        ->author($course->staff)
        ->message('Второе сообщение')
        ->create(['id' => 2]);

    homeworkSolutionMessage()
        ->solution($solution)
        ->author($course->staff)
        ->message('Третье сообщение')
        ->create(['id' => 3]);

    $response = actingAs($student)
        ->getJson(route('students.message.index', $solution))
        ->assertOk();

    expect($response)->toMatchSnapshot();
});
