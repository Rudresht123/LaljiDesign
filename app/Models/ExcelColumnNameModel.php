<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Record;
class ExcelColumnNameModel extends Record
{
    use SoftDeletes;
    protected $table = "excelcolumn_name";
    protected $fillable = ["column_name","excelcolumn_name","status"];
}
