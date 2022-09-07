<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Exception;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Phone::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        Phone::create($request->all());

        return response('Details Add Successfully', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        //
        return $phone;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(int $id,Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        $data = $request->only(['name', 'phone']);
        $loc = Phone::where('id', $id)->first();
        if (is_null($loc)) abort(404, 'Not Found');

        try {
            if (array_key_exists('name', $data))
                $loc->name = $data['name'];
            if (array_key_exists('phone', $data))
                $loc->phone = $data['phone'];
            $loc->save();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return response('Updated Successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {

        Phone::where('id', $id)->first()->delete();
        return response('data deleted successfully', 202);
    }
}
