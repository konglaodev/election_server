<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TestCrud;

use DB;

use App\Http\Requests\StoreTestCrudRequest;

use App\Http\Requests\UpdateTestCrudRequest;

use Illuminate\Subport\Facades\File;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

class TestCrudController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTestCrudRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
          
        ]);
        $path = $request->file('image')->store('public/images');
        $test = new TestCrud;
        $test->name= $request->name;
        $test->image = $path;
        $test->save();
        return response()->json(['massage' => 'get succesefully', $test]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TestCrud  $testCrud
     * @return \Illuminate\Http\Response
     */
    public function show(TestCrud $testCrud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TestCrud  $testCrud
     * @return \Illuminate\Http\Response
     */
    public function edit(TestCrud $testCrud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestCrudRequest  $request
     * @param  \App\Models\TestCrud  $testCrud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            
        ]);
        $test = new TestCrud;
        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $test->image = $path;
        }

        $test->id = $request->id;
        $test->name = $request->name;
       
        $test->save();
        return response()->json(['massage' => 'update image succesfully', $test]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TestCrud  $testCrud
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestCrud $testCrud)
    {
        //
    }
}
