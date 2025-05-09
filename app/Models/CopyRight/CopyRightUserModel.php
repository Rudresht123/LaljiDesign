<?php

namespace App\Models\CopyRight;

use App\Models\AttorneysModel;
use App\Models\ClientRemarksModel;
use App\Models\CmsGroupPermissionModel;
use App\Models\ConsultantModel;
use App\Models\DeallerModel;
use App\Models\FinancialYearModel;
use App\Models\MainCategoryModel;
use App\Models\OfficesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;
use App\Models\RemarksModel;
use App\Models\StatusHistory;
use App\Models\StatusModel;
use App\Models\SubcategoryModel;
use App\Models\SubStatusModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class CopyRightUserModel extends Record
{
    use HasFactory;
    use SoftDeletes;

    protected $table="copyright_users";
    protected $fillable=[
        'attorney_id',
        'category_id',
        'application_no',
        'file_name',
        'copyright_name',
        'copright_class',
        'opposition_no',
        'filling_date',
        'phone_no',
        'email_id',
        'objected_hearing_date',
        'opponenet_applicant_name',
        'opponent_applicant',
        'opponent_applicant_code',
        'hearing_date',
        'rectification_no',
        'opposed_no',
        'examination_report',
        'opposition_hearing_date',
        'valid_up_to',
        'status',
        'opp_status',
        'sub_status',
        'client_remarks',
        'remarks',
        'consultant',
        'deal_with',
        'filed_by',
        'client_remarks',
        'remarks',
        'financial_year',
        'created_at',
        'updated_at',
        'office_id',
        'sub_category',
        'ip_field',
        'email_remarks',
        'evidence_last_date',
        'client_communication',
        'mail_recived_date',
        'mail_recived_date_2',
        'post_hearing_remarks'	
    ];

    public function attorney()
    {
        return $this->belongsTo(AttorneysModel::class, 'attorney_id');
    }
    
    public function mainCategory()
    {
        return $this->belongsTo(MainCategoryModel::class, 'category_id');
    }
    
    public function statusMain()
    {
        return $this->belongsTo(StatusModel::class, 'status','id');
    }
    
    public function subStatus()
    {
        return $this->belongsTo(SubStatusModel::class, 'sub_status');
    }
    
    public function remarksMain()
    {
        return $this->belongsTo(RemarksModel::class, 'remarks','id');
    }
    public function clientRemark()
    {
        return $this->belongsTo(ClientRemarksModel::class, 'client_remarks');
    }
    
    public function financialYear()
    {
        return $this->belongsTo(FinancialYearModel::class, 'financial_year');
    }
    
    public function Clientonsultant()
    {
        return $this->belongsTo(ConsultantModel::class, 'consultant','id');
    }
    
    public function office()
    {
        return $this->belongsTo(OfficesModel::class, 'office_id');
    }
    
    public function subCategory()
    {
        return $this->belongsTo(SubcategoryModel::class, 'sub_category');
    }
        public function dealWith()
    {
        return $this->belongsTo(DeallerModel::class, 'deal_with','id');
    }
    public function statusHistories()
{
    return $this->hasOne(StatusHistory::class,'client_id','id');
}
public function cmsPermissionGroups()
{
    return $this->hasMany(CmsGroupPermissionModel::class, 'permission_group', 'id');
}

}
