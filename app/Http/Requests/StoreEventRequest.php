<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:event_categories,id'],
            'venue_id' => ['required', 'exists:venues,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'start_time' => ['nullable'],
            'end_time' => ['nullable'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'ticket_price' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft,published,completed,cancelled'],
            'is_featured' => ['nullable', 'boolean'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
            'speakers' => ['nullable', 'array'],
            'speakers.*' => ['exists:speakers,id'],
        ];
    }
}