<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Categories;
use App\Models\Customers;
use App\Models\Customers_in_categories;
use Illuminate\Http\Request;

class CustomerCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $customer = Customers::all();
        $customer = $customer->find($id);
        $categories = $customer::with('categories')->get();
        $categories = $categories->find($id);
        return response()->json([
            'status' => true,
            'data' => new CategoryResource($categories)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Customers $customer, $id)
    {
        $request->validate([
            'categories_id' => 'required'
        ]);

        $customer = $customer::find($id);
        $customerAlreadyInGroup = $customer->categories()->where('categories_id', $request->input('categories_id'))->exists();

        if($customerAlreadyInGroup){
            return response()->json([
                'status' => true,
                'message' => "Customer is already in this category.",
            ], 200);
        }
        else{
            $customer->categories()->attach($request->input('categories_id'));
            return response()->json([
                'status' => true,
                'message' => "Customer has been added into a category.",
                'data' => $customer
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customers_in_categories $customerInCategories, Categories $categories, $id, Request $request){
        $customerInCategories = $customerInCategories::where('customers_id', $id)->where('categories_id', $this->getCustomerId($request))->get();
        return response()->json([
            'status' => true,
            'data' => $categories::findOrFail($customerInCategories->firstOrFail()->categories_id)
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customers_in_categories $customers_in_categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customers_in_categories $customers_in_categories, $id, Customers $customer)
    {
        $customer = $customer::find($id);
        $customerAlreadyInGroup = $customer->categories()->where('categories_id', $request->input('categories_id'))->exists();
        if($customerAlreadyInGroup){
            return response()->json([
                'status' => true,
                'message' => "Update failed, customer is already in this category.",
            ], 400);
        }

        $customer->categories()->sync($request->input('categories_id'));
        return response()->json([
            'status' => true,
            'message' => 'Customer has been updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customers_in_categories $customerInCategories, $id, Request $request, Categories $categories)
    {
        $customerInCategories = $customerInCategories::where('customers_id', $id)->where('categories_id', $this->getCustomerId($request))->get();
        foreach ($customerInCategories as $c){
            $c->delete();
        }
        return response()->json([
            'status' => true,
            'data' => "Customer " . $id . " has been removed from category."
        ], 400);
    }

    public function getCustomerId(Request $request){
        return ($request->segment(count(request()->segments())));
    }
}
