<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Redirect;

class UserRolesRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_no' => 'nullable|string|max:12',
            'user_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'ip_address' => 'required|ip',
            'password' => [
                'required',
                'string',
                'min:8',
            ],
            'role' => 'required|string', 
            'permissions' => 'required|array',
            'status' => 'required',
            'permissions.*' => 'exists:cms_group_permissions,id',
        ];
    }
}
