<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(){
        $customers=Customers::all();
        return response()->json([
            'status' => true,
            'data' => $customers
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'email'=>'required',
            'firstname'=>'required',
            'surname'=>'required',
            'age'=>'nullable'
        ]);

        $customer = Customers::create($request->all());
        return response()->json([
            'status' => true,
            'message' => "New customer successfully created.",
            'data' => $customer
        ], 200);
    }
    public function show(Customers $customer){
        return response()->json([
           'status' => true,
           'data' => $customer
        ], 200);
    }
    public function destroy(Request $request, Customers $customer){
        $customer->delete();
        return response()->json([
           'status' => true,
           'message' => "Customer ". $this->getCustomerId($request) ." has been deleted."
        ], 200);
    }
    public function update(Request $request, Customers $customer){
        $customer->update($request->all());
        return response()->json([
           'status' => true,
           'message' => 'Customer '. $this->getCustomerId($request) .' has been updated.'
        ]);
    }
    public function getCustomerId(Request $request){
        return ($request->segment(count(request()->segments())));
    }
}
