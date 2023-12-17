<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
{
    const DateFormat = 'Y-m-d';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $data = $this->all();

        if ($this->has('startDate')) {
            $data['startDate'] = Carbon::parse($this->startDate)->format(static::DateFormat);
        }

        if ($this->has('endDate')) {
            $data['endDate'] = Carbon::parse($this->endDate)->format(static::DateFormat);
        }

        $this->merge($data);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'typeID' => ['required', 'integer', 'exists:course_types,id'],
            #@todo Проверка, что у юзера роль - учитель
            'staffID' => ['required', 'integer', 'exists:users,id'],
            'startDate' => ['required', 'date', 'before:endDate'],
            'endDate' => ['required', 'date', 'after:startDate'],
        ];
    }
}
