<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //

            "marca" => "required",
            "submarca" => "required",
            "modelo" => "required",
            "NoSerie" => "required|min:10 |max:16|unique:autos",
            "Nomotor" => "required|min:10 |max:16|unique:autos",
            "combustible" => "required",
            "kilometraje" => "required",
            "placas" => "required|min:4|max:6|unique:autos",
            "NSI" => "required|min:12|max:16|unique:autos",
            "uso" => "required",
            "responsable" => "required",
            "observaciones" => "required"



        ];
    }
}
