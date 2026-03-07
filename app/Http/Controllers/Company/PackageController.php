<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.package.company_package');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response = Http::withHeaders([
            'X-CSCAPI-KEY' => 'fd6394ac8fc2d21c0a473ee0be18f033fefa1ea0c07b92e598c7cebe983d1c51'
        ])->get('https://api.countrystatecity.in/v1/countries');

        $data = $response->json();

        return view('admin.package.create_company_package',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
