<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use Database\Factories\CourseFactory;
use Database\Factories\CourseTypeFactory;
use Database\Factories\GroupFactory;
use Database\Factories\HomeworkFactory;
use Database\Factories\LessonFactory;
use Database\Factories\UserFactory;

uses(
    Tests\TestCase::class,
     Illuminate\Foundation\Testing\LazilyRefreshDatabase::class,
)->in('Feature');

//uses()
//    ->beforeEach(fn() => \Pest\Laravel\actingAs(user()->adminRole()->create()))
//    ->in('Feature/Admins');
//
//uses()
//    ->beforeEach(fn() => \Pest\Laravel\actingAs(user()->managerRole()->create()))
//    ->in('Feature/Managers');
//
//uses()
//    ->beforeEach(fn() => \Pest\Laravel\actingAs(user()->staffRole()->create()))
//    ->in('Feature/Staff');
//
//uses()
//    ->beforeEach(fn() => \Pest\Laravel\actingAs(user()->studentRole()->create()))
//    ->in('Feature/Students');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function user(array $attributes = []): UserFactory
{
    return UserFactory::new($attributes);
}

function courseType(array $attributes = []): CourseTypeFactory
{
    return CourseTypeFactory::new($attributes);
}

function course(array $attributes = []): CourseFactory
{
    return CourseFactory::new($attributes);
}

function group(array $attributes = []): GroupFactory
{
    return GroupFactory::new($attributes);
}

function lesson(array $attributes = []): LessonFactory
{
    return LessonFactory::new($attributes);
}

function homework(array $attributes = []): HomeworkFactory
{
    return HomeworkFactory::new($attributes);
}
