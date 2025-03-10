<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialYearModel extends Record
{
    use HasFactory;
use SoftDeletes;

    protected $table="financial_year";
    protected $fillable=[
        'financial_session',
        'start_date',
        'end_date',
        'is_active',
        'crated_at',
        'updated_at'
    ];
}
