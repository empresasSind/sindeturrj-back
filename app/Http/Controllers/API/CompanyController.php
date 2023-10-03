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
    public function index(Request $request)
    {
        $cnpj = $request->query('cnpj');

        if ($cnpj) {
            $companies = Company::where('cnpj', 'like', '%' . $cnpj . '%')->get();
        } else {
            $companies = Company::all();
        }
        return response()->json($companies);
    }

    public function search(Request $request) {
       

        $all = Company::where('cnpj', $request->cnpj);
        return response()->json($all);
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
        Company::create($request->all());
        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::find($id);
        if (!empty($company)) {
            return response()->json($company);
        } else {
            return response()-json([
                "message" => "not found"
            ], 404);
        }
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
        // Company::destroy($id);

        if(Company::where('id',$id)->exists()) {
            $company = Company::find($id);
            $company->delete();

            return response()->json([
                "message" => " records deleted."
            ], 202);
        } else {
            return response()->json([
                "message" => "not found."
            ], 404);
        }
    }
}
