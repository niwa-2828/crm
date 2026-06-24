<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
          // projectsテーブルの対象データを更新する 
          'title' => 'required',
          'company_id' => 'required',
          'detail' => 'nullable',
    
          // チェックボックスで選ばれたlanguage.idたち
          'language_ids' => 'nullable|array',
          'language_ids.*' => 'exists:languages,id',
        ];
    }
}
