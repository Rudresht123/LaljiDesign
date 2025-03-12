<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficesModel extends Record
{
    use HasFactory;
    use SoftDeletes;
    protected $table="offices";
    protected $fillable=[
        'office_name',
        'status'
    ];
}
