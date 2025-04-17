<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Redirect;

class CopyRightClients extends FormRequest
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
            'attorney_id' => 'required',
            'category_id' => 'required',
            'application_no' => 'required',
            'deal_ammount' => 'nullable',
            'file_name' => 'required|string',
            'copyright_name' => 'required|string',
            'copyright_class' => 'required',
            'filling_date' => 'required|date',
            'phone_no' => 'required',
            'email_id' => 'nullable',
            'date_of_application' => 'nullable|date',
            'objected_hearing_date' => 'nullable|date',
            // dynamic fileds rules 
            'applicant_name' => 'nullable|string',
            'applicant_code' => 'nullable|string',
            'opponent_name' => 'nullable|string',
            'opponent_code' => 'nullable|string',
            'opponent_applicant' => 'nullable|string',
            'hearing_date' => 'nullable|date',
            'examination_report_submitted' => 'nullable|string',
            'opposed_no' => 'nullable|string',
            'rectification_no' => 'nullable|string',
            // dynamic fileds rules 
            'opposition_hearing_date' => 'nullable|date',
            'status' => 'nullable',
            'consultant' => 'nullable|string',
            'deal_with' => 'nullable|string',
            'filed_by' => 'nullable',
            'client_remarks' => 'nullable',
            'remarks' => 'nullable',
            'sub_status' => 'nullable',
            'office_id' => 'nullable',
            'sub_category' => 'nullable',
            'ip_field' => 'required|string',
            'email_remarks' => 'nullable|string',
            'evidence_last_date' => 'nullable|date',
            'client_communication' => 'nullable|string',
            'mail_recived_date' => 'nullable|date',
            'mail_recived_date_2' => 'nullable|date',
            'valid_up_to' => 'nullable|date'
        ];
    }
}
