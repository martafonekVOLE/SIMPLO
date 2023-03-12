<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(){
        $customers=Customers::all();
        return[
            'status' => 1,
            'data' => $customers
        ];
    }
}
