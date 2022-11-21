<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontEndSettingsRequest extends FormRequest
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
            "site_title" => "required",
            "site_description" => 'required',
            "site_logo" => 'nullable',
            "favicon" => 'nullable',
            "address" => 'required',
            "facebook" => 'required',
            "facebook_app_id" => 'required',
            "instagram" => 'required',
            "youtube" => 'required',
            "twitter" => 'required',
            "twitter_username" => 'required',
            "accent_color" => 'required',
        ];
    }
}
