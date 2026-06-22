<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class StoreAttendanceCorrectionRequest extends FormRequest
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
          'attendance_id' =>['required','exists:attendances,id'],
          'requested_work_date' =>['required','date'],
          'requested_clock_in' =>['nullable','date_format:H:i'],
          'requested_break_in' =>['nullable','date_format:H:i'],
          'requested_break_out' =>['nullable','date_format:H:i'],
          'requested_clock_out' =>['nullable','date_format:H:i'],
          'reason' =>['nullable'],
        ];
    }
}
