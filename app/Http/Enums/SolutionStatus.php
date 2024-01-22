<?php

namespace App\Http\Enums;

enum SolutionStatus: string
{
    case OPENED = 'opened';
    case CLOSED = 'closed';

    const statuses = [
        SolutionStatus::OPENED,
        SolutionStatus::CLOSED,
    ];

    public function label(): string
    {
        return match ($this) {
            SolutionStatus::OPENED => 'Открыт',
            SolutionStatus::CLOSED => 'Закрыт',
        };
    }
}
