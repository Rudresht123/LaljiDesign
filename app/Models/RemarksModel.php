<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
USE App\Models\Record;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemarksModel extends Record
{
    use HasFactory;
    use SoftDeletes;
    protected $table="remarks";
    protected $fillable=[
        'remarks',
        'is_active'
    ];
}
