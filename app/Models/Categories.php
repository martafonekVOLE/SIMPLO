<?php

namespace App\Models;

use Cassandra\Custom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;


    public function customers(){
        return $this->belongsToMany(Customers::class, 'customers_in_categories');
    }
}
