<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;



class Record extends Model
{
    protected static function booted()
    {
        parent::boot();
        static::creating(function ($model) {

            if (in_array('user_id', $model->fillable)) {
                $model->user_id = auth()->user()->id;
            }
            if (in_array('financial_year', $model->fillable)) {
                $model->financial_year = session('id') ?? 1;
            }

            if (in_array('start_date', $model->fillable)) {
                $model->start_date = Carbon::createFromDate($model->start_date)->format('Y-m-d');
            }

            if (in_array('end_date', $model->fillable)) {
                $model->end_date = Carbon::createFromDate($model->end_date)->format('Y-m-d');
            }

            if (in_array('dob', $model->fillable)) {
                $model->dob = Carbon::createFromDate($model->dob)->format('Y-m-d');
            }
        });

        static::updating(function ($student) {});
    }

    public function scopeRecord($query)
    {
        $table = $this->getTable();
        /**
         * table get school_id,branch_id,academic_id,finance_id
         */
        if (in_array('financial_id', $this->fillable))
            $query = $query->where($table . '.financial_id', auth()->user()->financial_id);
        if (in_array('user_id', $this->fillable))
            $query = $query->where($table . '.user_id', auth()->user()->user_id);
        return $query;
    }
}
