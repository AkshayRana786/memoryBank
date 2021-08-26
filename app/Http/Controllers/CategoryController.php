<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = array(
            'categoryName' => 'required',
            'price' => 'required'
        );
        $validator = Validator::make($request->all(),$rule);
        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else
        {
            $category = new Category;
            $category->clientMasterId = 1;
            $category->categoryName = $request->categoryName;
            $category->price = $request->price;
            $category->remarks = $request->remarks;
            $category->inactiveDate = $request->inactiveDate;
            $category->inactiveReason = $request->inactiveReason;
            $result = $category->save();
            if($result)
            {
                return ['result'=>$category];
            }
            else
            {
                return ['result'=>'Operation Fails'];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->clientMasterId = 1;
        $category->categoryName = $request->categoryName;
        $category->price = $request->price;
        $category->remarks = $request->remarks;
        $category->inactiveDate = $request->inactiveDate;
        $category->inactiveReason = $request->inactiveReason;
        $result = $category->save();
        if($result)
        {
            return ['result'=>"Data has been updated"];
        }
        else
        {
            return ['result'=>'Update Operation Fails'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}