<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function prepareForValidation()
    {
        $dueDate = $this->input('due_date');
        $deadline = $this->input('deadline');

        $this->merge([
            'due_date' => $dueDate ? Carbon::parse($dueDate)->format('Y-m-d') : null, // السماح بأن تكون due_date فارغة
            'deadline' => $deadline ? Carbon::parse($deadline)->format('Y-m-d') : null,
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'priority' => 'required|string|in:height,low,medium',
            'due_date' => 'nullable|date|arter:now',
            'status' => 'required|string|in:pending,done,in-progress',
            'assigned_to' => 'required|integer|exists:users,id',
            'deadline' => 'required|date|after:now',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'please make sure for the inputs  ',
            'errors' => $validator->errors(),

        ]));
    }


    public function attributes()
    {
        return [
            'title' => 'title',
            'description' => 'description',
            'priority' => 'priority',
            'due_date' => 'due_date',
            'status' => 'status',
            'assigned_to' => 'assigned_to',
            'deadline' => 'deadline',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'date' => 'The :attribute must be a valid date',
            'due_date.after' => 'The due date must be a date after today.',
            'deadline.after' => 'The deadline must be a date after now.',
            'assigned_to.exists' => 'The selected user does not exist.',
            'priority.in' => 'The priority must be one of the following values: low,medium, height',
            'status.in' => 'The status must be one of the following values: pending, in-progress, done.',
        ];
    }
}
