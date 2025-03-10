<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Record;

class DeallerModel extends Record
{
    use HasFactory;
    use SoftDeletes;
    protected $table="deal_with";
    protected $fillable=[
        'dealler_name',
        'status'
    ];
}
