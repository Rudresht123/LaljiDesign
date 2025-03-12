<?php

namespace App\Models;

use App\Http\Controllers\gloalsetting\MainCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubcategoryModel extends Record
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'sub_category';
    protected $fillable = [
        'subcategory',
        'subcategory_remark',
        'main_category_id',
        'status',
        'created_at',
        'updated_at'
    ];


    public function subCategory()
    {
        return $this->belongsTo(MainCategory::class,'main_category_id');
    }
}
