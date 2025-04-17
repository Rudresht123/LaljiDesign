<?php

namespace App\Http\Controllers\user\CopyRight;

use App\Http\Controllers\Controller;
use App\Http\Requests\Registration\CopyRightClients;
use App\Models\CopyRight\CopyRightUserModel;
use App\Models\StatusHistory;
use App\Models\StatusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CopyRightController extends Controller
{

    public function addCopyRightUser(Request $request)
    {
        if ($request->phone_no) {
            $phone_no = is_array($request->phone_no)
                ? implode(',', $request->phone_no)
                : $request->phone_no;
        }

        if ($request->email_id) {
            $email = is_array($request->email_id)
                ? implode(',', $request->email_id)
                : $request->email_id;
        }

        $data = $request->all();

        $data['phone_no'] = $phone_no ?? '';
        $data['email_id'] = $email ?? '';

        // Dynamic field logic
        if ($request->filled('opponent_applicant')) {
            $data['opponent_applicant'] = $request->input('opponent_applicant');

            if ($data['opponent_applicant'] === 'Applicant') {
                $data['opponenet_applicant_name'] = $request->input('opponent_name');
                $data['opponent_applicant_code'] = $request->input('opponent_code');
            } elseif ($data['opponent_applicant'] === 'Opponent') {
                $data['opponenet_applicant_name'] = $request->input('applicant_name');
                $data['opponent_applicant_code'] = $request->input('applicant_code');
            }
        }

        // Create the record
        $CopyRightUser = CopyRightUserModel::create($data);

        if ($CopyRightUser) {
            StatusHistory::create([
                'category_id' => $request->category_id,
                'client_id' => $CopyRightUser->id,
                'file_name' => $request->input('file_name'),
                'status_history' => json_encode([
                    [
                        'status' => $request->input('status'),
                        'sub_status' => $request->input('sub_status'),
                        'date' => now()->toDateTimeString(),
                    ]
                ]),
            ]);

            return redirect()->back()->with(['success' => 'User Registered Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'User Not Registered']);
        }
    }
}
