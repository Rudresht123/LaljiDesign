<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Auth;
use Illuminate\Support\Facades\Schema;


class Record extends Model
{
    public function scopeRecorddata($query)
    {
        $table=$this->getTable();
        /**
         * table get school_id,branch_id,academic_id,finance_id
         */
        if (in_array('financial_id', $this->fillable))
            $query = $query->where($table.'.financial_id', auth()->user()->financial_id);
        if (in_array('user_id', $this->fillable))
            $query = $query->where($table.'.user_id', auth()->user()->user_id);
        return $query;
    }

}
