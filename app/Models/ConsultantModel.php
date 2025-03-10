<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Record;

class ConsultantModel extends Record
{
    use HasFactory;
    use SoftDeletes;
    protected $table="consultant";
    protected $fillable=[
        'consultant_name',
        'status'
    ];
}
