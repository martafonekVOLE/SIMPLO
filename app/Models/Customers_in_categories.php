<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customers_in_categories extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'firstname', 'surname', 'age'];

}
