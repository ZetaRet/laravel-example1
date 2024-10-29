<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDataRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:15',
            'name_parent' => 'required|string|min:2|max:15',
            'name_family' => 'required|string|min:2|max:15',
            'email' => 'required|email|unique:users|min:8|max:50',
            'identity_number' => 'required|string|min:14|max:14',
            'civil_id' => 'required|string|min:11|max:11',
            'phone_ext_public' => 'nullable|string|min:3|max:3',
            'phone_number_public' => 'nullable|string|min:11|max:11',
            'phone_ext_private' => 'nullable|string|min:3|max:3',
            'phone_number_private' => 'nullable|string|min:11|max:11',
            'phone_ext_home' => 'nullable|string|min:3|max:3',
            'phone_number_home' => 'nullable|string|min:11|max:11',
            'phone_ext_office' => 'nullable|string|min:3|max:3',
            'phone_number_office' => 'nullable|string|min:11|max:11',
            'phone_ext_work' => 'nullable|string|min:3|max:3',
            'phone_number_work' => 'nullable|string|min:11|max:11',
        ];
    }
}
?>