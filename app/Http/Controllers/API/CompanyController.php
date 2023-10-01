<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $object = Company::all();

        // $object = [
        //     (object) [
        //         'id' => 546,
        //         'username' => 'John',
        //     ],
        //     (object) [
        //         'id' => 894,
        //         'username' => 'Mary',
        //     ]
        // ];

        return response()->json($object);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'cnpj' => 'required',
        ]);

        // $arr = [
        //     'name' => $request->name,
        //     'cnpj' => $request->cnpj
        // ]
        Company::create($request->all());
        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
