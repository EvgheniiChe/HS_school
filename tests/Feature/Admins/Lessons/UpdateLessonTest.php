<?php

use Illuminate\Support\Facades\Date;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\travelTo;

it('can update lesson data', function () {
    travelTo(Date::parse('2023-11-10 19:00'));

    $lesson = lesson()
        ->course(
            $course = course()
                ->withStaffAndType()
                ->create()
        )
        ->create([
            'theme' => 'Шаблоны разработки API',
            'start_time' => '2023-11-13 19:00:00',
            'info' => 'https://miro.com/app/board/ashdfdjshs',
        ]);

    actingAs(user()->adminRole()->create())
        ->patchJson(route('admins.lessons.update', [$course, $lesson]), [
            'theme' => 'Основы классов и инструменты',
            'startTime' => '2023-11-13 19:00:00',
            'info' => 'https://miro.com/app/board/jfdnadsw',
        ]);

    expect($lesson->refresh())
        ->theme->toBe('Основы классов и инструменты')
        ->start_time->toBe('2023-11-13 19:00:00')
        ->info->toBe('https://miro.com/app/board/jfdnadsw');
});
