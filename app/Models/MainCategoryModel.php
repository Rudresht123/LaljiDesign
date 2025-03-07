<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;
class MainCategoryModel extends Record
{
    use HasFactory;
    protected $table="main_category";
    protected $fillable=[
        'id',
        'category_name',
        'remark',
        'status',
        'category_slug',
        'category_icon'
    ];
    public function trademarkUsers()
    {
        return $this->hasMany(TrademarkUserModel::class, 'category_id');
    }

}
