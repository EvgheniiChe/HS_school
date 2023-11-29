<?php

use Illuminate\Support\Facades\Date;
use function Pest\Laravel\postJson;
use function Pest\Laravel\travelTo;

it('returns a list of courses', function () {
//    travelTo(Date::parse('2023-11-21'));

    $typeID = courseType()->create()->id;
    $staffID = user()->create()->id;

    postJson(route('courses.store'), [
        'typeID' => $typeID,
        'staffID' => $staffID,
        'startDate' => now()->addDay()->format('Y-m-d'),
        'endDate' => now()->addMonths(2)->format('Y-m-d'),
    ])->assertOk();


});
