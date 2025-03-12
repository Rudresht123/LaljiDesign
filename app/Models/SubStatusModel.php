<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubStatusModel extends Record
{
    use HasFactory;
    use SoftDeletes;
    protected $table="sub_status";
    protected $fillable = [
        'main_status_id',
        'substatus_name',
        'slug',
        'substatus_remarks',
        'status'
    ]; 
}
