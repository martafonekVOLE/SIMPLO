<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'firstname', 'surname', 'age'];

    public function categories(){
        return $this->belongsToMany(Categories::class, 'customers_in_categories');
    }
}
