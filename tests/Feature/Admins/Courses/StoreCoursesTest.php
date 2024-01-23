<?php

use function Pest\Laravel\actingAs;

it('creates a new course', function () {

    $typeID = courseType()->create()->id;
    $staffID = user()->create()->id;

    actingAs(user()->adminRole()->create())
        ->postJson(route('admins.courses.store'), [
            'typeID' => $typeID,
            'staffID' => $staffID,
            'startDate' => now()->addDay()->format('Y-m-d'),
            'endDate' => now()->addMonths(2)->format('Y-m-d'),
        ])->assertOk();
});
