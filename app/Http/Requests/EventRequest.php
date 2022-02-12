<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:8|max:60',
            'description' => 'required|string|min:8|max:300',
            'room_id' => 'required|integer',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}
