<?php

namespace App\Models;

use App\Models\CopyRight\CopyRightUserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserPermissionModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Record;

class AttorneysModel extends Record
{
    use HasFactory;
    use SoftDeletes;
    protected $table="attorneys";
    protected $fillable=[
        'attorneys_name',
        'gender',
        'email',
        'phone_number',
        'specialization',
        'license_number', 
        'bar_admission_date', 
        'profile_picture',
        'bio',
        'created_at',
        'updated_at',
        'status'
    ];
    public function trademarkUsers()
{
    return $this->hasMany(TrademarkUserModel::class, 'attorney_id'); 
}

public function copyRightUsers()
{
    return $this->hasMany(CopyRightUserModel::class, 'attorney_id'); 
}
public function permissions()
{
    return $this->belongsToMany(UserPermissionModel::class);
}
}
