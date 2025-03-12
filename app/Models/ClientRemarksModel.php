<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientRemarksModel extends Record
{
    use HasFactory;
    use SoftDeletes;
    protected $table="client_remarks";
    protected $fillable=[
        'client_remarks',
        'status'
    ];
}
