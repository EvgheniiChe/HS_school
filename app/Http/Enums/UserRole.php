<?php

namespace App\Http\Enums;

enum UserRole: string
{
    case STUDENT = 'student';
    case STAFF = 'staff';
    case MANAGER = 'manager';
    case ADMIN = 'admin';

    const roles = [
        UserRole::STUDENT,
        UserRole::STAFF,
        UserRole::MANAGER,
        UserRole::ADMIN,
    ];

    public function label(): string
    {
        return match ($this) {
            UserRole::STUDENT => 'Ученик',
            UserRole::STAFF => 'Преподаватель',
            UserRole::MANAGER => 'Менеджер',
            UserRole::ADMIN => 'Админ',
        };
    }
}
