<?php

namespace App\Models;

use App\Models\CopyRight\CopyRightUserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusModel extends Record
{
    use HasFactory;
    use SoftDeletes;
    protected $table="status";
    protected $fillable=[
        'status_name',
        'slug',
        'remark',
        'status'
    ];
    public function trademarkUsers()
    {
        return $this->hasMany(TrademarkUserModel::class, 'status');
    }
    public function copyrightusers()
    {
        return $this->hasMany(CopyRightUserModel::class, 'status');
    }

}
