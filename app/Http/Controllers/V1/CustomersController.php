<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Categories;
use App\Models\Customers;
use App\Models\CustomersInCategories;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(Request $request){
        $includeGroup = $request->query('includeGroup');
        $includeCategory = $request->query('includeCategory');

        $customer = Customers::all();

        if($includeGroup||$includeCategory){
             $customer = new CustomerCollection($customer->first()->with('categories')->get());
        }
        else{
            $customer = new CustomerCollection($customer);
        }

        return response()->json([
            'status' => true,
            'data' => $customer
        ], 200);
    }
    public function store(Request $request){
        $validationTest = $request->validate([
            'email'=>'required|email',
            'firstname'=>'required|string',
            'surname'=>'required|string',
            'age'=>'nullable|integer'
        ]);

        $customer = Customers::create($request->all());
        return response()->json([
            'status' => true,
            'message' => "New customer successfully created.",
            'data' => new CustomerResource($customer)
        ], 200);
    }
    public function show(Customers $customer){
        return response()->json([
           'status' => true,
           'data' => new CustomerResource($customer)
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
