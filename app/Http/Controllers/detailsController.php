<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\details;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class detailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $find = $request->input('email');
         return details::where('email',$find)->get();

}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return details::create([
            'heading' => $request->input('heading'),
            'description' => $request->input('description'),
            'email'=>$request->input('email'),
            
        ]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $em)
    {
        $detail = details::find($id);
        if ($em == $detail['email']){
        $detail->update($request->all());
        return $detail;
    }
    else {
        return response([
            'message'=> 'Unauthorized to update'
        ]);
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
       return details::destroy($id);
    }
}
