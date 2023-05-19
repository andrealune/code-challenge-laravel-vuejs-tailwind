<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name" => "required|string",
            "last_name" => "required|string",
            "phone" => "numeric",
            "email" => "email"
        ];
    }
    public function attributes()
    {
        return [
            "first_name" => "nombres",
            "last_name" => "apellidos",
            "phone" => "teléfono",
            "email" => "correo"
        ];
    }
}
