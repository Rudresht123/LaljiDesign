<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\Registration\TrademarkClients;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Session;
use App\Models\AttorneysModel;
use App\Models\ClientRemarksModel;
use App\Models\FormFieldModel;
use App\Models\MainCategoryModel;
use App\Models\OfficesModel;
use App\Models\ConsultantModel;
use App\Models\CopyRight\CopyRightUserModel;
use App\Models\RemarksModel;
use App\Models\StatusModel;
use App\Models\SubcategoryModel;
use App\Models\TradeMarkClassModel;
use App\Models\TrademarkUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\DeallerModel;
use App\Models\StatusHistory;
use App\Repository\MasterAdmin\GlobalSetting\GlobalSettingRepo;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function showAttorneyCatgory($id)
    {
        $attorney = AttorneysModel::find($id);
        $mainCategory = MainCategoryModel::where('status', 'yes')->get();


        //Status wise count chart 
        $statuswisecount = StatusModel::withCount([
            'trademarkUsers as usercount' => function ($query) use ($id) {
                $query->where('attorney_id', $id);
            }
        ])->where('category_id', MainCategoryModel::where('category_slug', 'trademark')->first()->id)->get();

        $copyrightstatuswisecount = StatusModel::withCount([
            'copyrightusers as usercount' => function ($query) use ($id) {
                $query->where('attorney_id', $id);
            }
        ])->where('category_id', MainCategoryModel::where('category_slug', 'copyright')->first()->id)->get();


        $totalCount = TrademarkUserModel::where('attorney_id', $id)->count();
        $copyRighttotalCount = CopyRightUserModel::where('attorney_id', $id)->count();
        return view('admin_panel.users.category', compact('attorney', 'mainCategory', 'statuswisecount', 'copyrightstatuswisecount', 'totalCount', 'copyRighttotalCount'));
    }
    public function registrationForm($attorneyId, $categorySlug)
    {
        $attorney = (new GlobalSettingRepo())->attorneys(['id' => $attorneyId])->first();
        $category = (new GlobalSettingRepo())->maincategory(['category_slug' => $categorySlug])->first();
        $classes = TradeMarkClassModel::get();
        $offices = (new GlobalSettingRepo())->offices();
        $remarks = (new GlobalSettingRepo())->remarks();
        $clientRemarks = (new GlobalSettingRepo())->whatsappremarks();
        $consultant = (new GlobalSettingRepo())->consultants();
        $dealWith = (new GlobalSettingRepo())->deallers();
        $statuss = (new GlobalSettingRepo())->status(['category_id' => $category->id]);
        $subcategory = (new GlobalSettingRepo())->subcategory();
        return view('admin_panel.users.registrationform', compact('attorney', 'category', 'classes', 'statuss', 'remarks', 'offices', 'clientRemarks', 'consultant', 'subcategory', 'dealWith'));
    }

    // Rgistration code for trademarkk users
    public function addTrademarkUserForm(TrademarkClients $request)
    {
        $phone_no = implode(',', $request->phone_no);
        $email = implode(',', $request->email_id);

        $application_no = $request->input('application_no');
        $TrademarkUser = new TrademarkUserModel();
        $TrademarkUser->fill($request->all());
        $clientEmail = $request->email_id;
        $TrademarkUser['financial_year'] = Session::get('id');
        $TrademarkUser['phone_no'] = $phone_no ?? '';
        $TrademarkUser['email_id'] = $email ?? '';

        // dynamic fields code here
        if ($request->filled('opponent_applicant')) {
            $TrademarkUser['opponent_applicant'] = $request->input('opponent_applicant');
            if ($TrademarkUser['opponent_applicant'] === 'Applicant') {
                $TrademarkUser['opponenet_applicant_name'] = $request->input('opponent_name');
                $TrademarkUser['opponent_applicant_code'] = $request->input('opponent_code');
            } elseif ($TrademarkUser['opponent_applicant'] === 'Opponent') {
                $TrademarkUser['opponenet_applicant_name'] = $request->input('applicant_name');
                $TrademarkUser['opponent_applicant_code'] = $request->input('applicant_code');
            }
        }

        // dynamic fileds code end here
        if ($TrademarkUser->save()) {

            StatusHistory::create([
                'category_id' => $request->category_id,
                'client_id' => $TrademarkUser->id,
                'file_name' => $request->input('file_name'),
                'status_history' => json_encode([
                    [
                        'status' => $request->input('status'),
                        'sub_status' => $request->input('sub_status'),
                        'date' => now()->toDateTimeString(),
                    ]
                ]),
            ]);
            return redirect()->back()->with(['success' => 'User Registered Successfully Done']);
        } else {
            return redirect()->back()->with(['error' => 'User not Registerd Successfully Done']);
        }
    }



    public function clientsDetails($category_slug, $id)
    {
        if ($category_slug === 'trademark') {
            $clientdetail = TrademarkUserModel::with([
                'attorney:id,attorneys_name',
                'mainCategory:id,category_name,category_slug',
                'office:id,office_name',
                'statusMain:id,status_name',
                'subStatus:id,substatus_name',
                'remarksMain:id,remarks as remarks_name',
                'clientRemark:id,client_remarks',
                'Clientonsultant:id,consultant_name',
                'dealWith:id,dealler_name',
                'financialYear:id,financial_session',
                'subCategory:id,subcategory'
            ])
                ->where('id', $id)
                ->first();
        } elseif ($category_slug === 'copyright') {

            $clientdetail = CopyRightUserModel::with([
                'attorney:id,attorneys_name',
                'mainCategory:id,category_name,category_slug',
                'office:id,office_name',
                'statusMain:id,status_name',
                'subStatus:id,substatus_name',
                'remarksMain:id,remarks as remarks_name',
                'clientRemark:id,client_remarks',
                'Clientonsultant:id,consultant_name',
                'dealWith:id,dealler_name',
                'financialYear:id,financial_session',
                'subCategory:id,subcategory'
            ])
                ->where('id', $id)
                ->first();
        } else {
        }
        return view('admin_panel.users.clientdetails', compact('clientdetail'));
    }


    public function editClientDetails($attorneyId, $categorySlug, $id)
    {
        $attorney = AttorneysModel::find($attorneyId);
        $category=MainCategoryModel::where('category_slug',$categorySlug)->first();
        $statuss = StatusModel::where('status', 'yes')->where('category_id',$category->id)->get();
        if($categorySlug=='trademark'){
            $client = TrademarkUserModel::where('id', $id)->first();
        }
        elseif($categorySlug=='copyright'){
            $client = CopyRightUserModel::where('id', $id)->first();
        }
       
        $category = MainCategoryModel::where('category_slug', $categorySlug)->where('status', 'yes')->first();
        $classes = TradeMarkClassModel::get();
        $offices = OfficesModel::where('status', 'yes')->get();
        $remarks = RemarksModel::where('is_active', 'yes')->get();
        $clientRemarks = ClientRemarksModel::where('status', 'yes')->get();
        $consultant = ConsultantModel::where('status', 'yes')->get();
        $dealWith = DeallerModel::where('status', 'yes')->get();
        $subcategory = SubcategoryModel::where('status', 'yes')->get();

        return view('admin_panel.users.editClientdetails', compact('client', 'attorney', 'category', 'classes', 'statuss', 'remarks', 'offices', 'clientRemarks', 'consultant', 'subcategory', 'dealWith'));
    }

    public function updateClientDetails($id, TrademarkClients $request)
    {
        // Retrieve the record
        $TrademarkUser = TrademarkUserModel::where('id', $id)->first();

        if (!$TrademarkUser) {
            return redirect()->back()->with(['error' => 'User not found']);
        }

        $phone_no = implode(',', $request->phone_no);
        $email = implode(',', $request->email_id);

        $TrademarkUser->fill($request->all());
        $status = $request->input('status');
        $TrademarkUser['phone_no'] = $phone_no ?? '';
        $TrademarkUser['email_id'] = $email ?? '';
        handleStatusLogic($TrademarkUser, $status, $request);

        // Set financial year from session
        $financialYearId = Session::get('id', null);
        if (!$financialYearId) {
            return redirect()->back()->with(['error' => 'Financial year session is not set.']);
        }


        $TrademarkUser->financial_year = 1;

        // Update and handle response
        if ($TrademarkUser->update()) {
            updateStatusHistory([
                'id' => $id,
                'status' => $request->input('status'),
                'sub_status' => $request->input('sub_status'),
                'file_name' => $request->input('file_name')
            ]);
            return redirect()->back()->with(['success' => 'User updated successfully']);
        } else {
            Log::error('Failed to update TrademarkUser', ['data' => $TrademarkUser->toArray()]);
            return redirect()->back()->with(['error' => 'User update failed']);
        }
    }
}
