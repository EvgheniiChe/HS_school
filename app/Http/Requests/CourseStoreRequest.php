<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CourseStoreRequest extends FormRequest
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
            'staffID' => ['required', 'integer', 'exists:users,id'],
            'startDate' => ['required', 'date', 'before:endDate'],
            'endDate' => ['required', 'date', 'after:startDate'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function (Validator $validator) {
            if (! $validator->errors()->any() && $this->input('startDate') < now()) {
                $validator->errors()->add('startDate', 'Course cant start in the past!');
            }
        });
    }
}
