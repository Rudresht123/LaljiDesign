<?php

namespace App\Http\Requests\Imports;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Redirect;

class ClientImportRequest extends FormRequest
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
            'attorney_id' => ['required', 'array'],
            'category_id' => ['required', 'array'],
            'application_no' => ['required', 'array'],
            'file_name' => ['required', 'array'],
            'trademark_name' => ['nullable', 'array'],
            'trademark_class' => ['nullable', 'array'],
            
            // Validate each date inside the array
            'filling_date' => ['nullable', 'array'],
            'filling_date.*' => ['nullable', 'date', 'date_format:Y-m-d'],
            
            'phone_no' => ['nullable', 'array'],
            'email_id' => ['nullable', 'array'],
            
            'objected_hearing_date' => ['nullable', 'array'],
            'objected_hearing_date.*' => ['nullable', 'date', 'date_format:Y-m-d'],
            
            'opposition_no' => ['nullable', 'array'],
            'opponenet_applicant_name' => ['nullable', 'array'],
            'opponent_applicant_code' => ['nullable', 'array'],
            'opponent_applicant' => ['nullable', 'array'],
            
            'hearing_date' => ['nullable', 'array'],
            'hearing_date.*' => ['nullable', 'date', 'date_format:Y-m-d'],
            
            'examination_report' => ['nullable', 'array'],
            'opposed_no' => ['nullable', 'array'],
            'rectification_no' => ['nullable', 'array'],
            
            'opposition_hearing_date' => ['nullable', 'array'],
            'opposition_hearing_date.*' => ['nullable', 'date', 'date_format:Y-m-d'],
            
            'status' => ['required', 'array'],
            'consultant' => ['nullable', 'array'],
            'deal_with' => ['nullable', 'array'],
            'filed_by' => ['nullable', 'array'],
            'client_remarks' => ['nullable', 'array'],
            'remarks' => ['nullable', 'array'],
            'sub_status' => ['nullable', 'array'],
            'office_id' => ['nullable', 'array'],
            'sub_category' => ['nullable', 'array'],
            'ip_field' => ['nullable', 'array'],
            'email_remarks' => ['nullable', 'array'],
            
            'evidence_last_date' => ['nullable', 'array'],
            'evidence_last_date.*' => ['nullable', 'date', 'date_format:Y-m-d'],
            
            'client_communication' => ['nullable', 'array'],
            
            'mail_recived_date' => ['nullable', 'array'],
            'mail_recived_date.*' => ['nullable', 'date', 'date_format:Y-m-d'],
            
            'mail_recived_date_2' => ['nullable', 'array'],
            'mail_recived_date_2.*' => ['nullable', 'date', 'date_format:Y-m-d'],
            
            'valid_up_to' => ['nullable', 'array'],
            'valid_up_to.*' => ['nullable', 'date', 'date_format:Y-m-d'],
        ];
        
        
    }
    protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(
        Redirect::route('admin.reports.clients-reports')
            ->withErrors($validator) 
            ->withInput() 
    );
}
}
