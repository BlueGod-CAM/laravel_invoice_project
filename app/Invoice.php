<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function user(){
        return $this->belongsTo(Customer::class,"customer_id");
    }
}
