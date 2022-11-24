<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateConfigurationRequest extends FormRequest
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
            "facebook_fanspage" => 'nullable',
            "advertiser_id" => 'nullable',
            "cse_id" => 'nullable',
            "gtm_id" => 'nullable',
            "robot_txt" => 'nullable',
            "ads_txt" => 'nullable',
            "embed_code_data_studio" => 'nullable',
        ];
    }
}
