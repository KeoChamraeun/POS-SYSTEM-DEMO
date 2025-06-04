<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];

    public function head()
    {
        return $this->belongsTo(ExpenseHead::class, 'head_id', 'id');
    }
}
