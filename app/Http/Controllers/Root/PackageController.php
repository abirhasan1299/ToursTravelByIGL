<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\CompanyPackage;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $data = CompanyPackage::orderBy('id', 'desc')->get();
        return view('admin.package.index',compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'p_name'=>'required|string|max:100',
            'p_price'=>'required|numeric',
            'p_detail'=>'required|string',
            'p_benefit'=>'required|string',
            'p_date_range'=>'required',
            'p_post_limit'=>'required|numeric',
            'p_credit'=>'required|numeric',
        ]);

        CompanyPackage::create([
           'p_name'=>$request->p_name,
           'p_price'=>$request->p_price,
           'p_detail'=>$request->p_detail,
           'p_benefit'=>$request->p_benefit,
           'p_date_range'=>$request->p_date_range,
           'p_post_limit'=>$request->p_post_limit,
            'p_status'=>$request->p_status,
            'p_credit'=>$request->p_credit,
        ]);

        return redirect()->back()->with('success','Package created successfully');
    }

    public function updatePackage(Request $request,$id)
    {

        $data = CompanyPackage::findOrFail($id);

        $data->p_name = $request->p_name;
        $data->p_price = $request->p_price;
        $data->p_detail = $request->p_detail;
        $data->p_benefit = $request->p_benefit;
        $data->p_date_range = $request->p_date_range;
        $data->p_post_limit = $request->p_post_limit;
        $data->p_status = $request->p_status;
        $data->p_credit = $request->p_credit;
        $data->save();

        return redirect()->back()->with('success','Package updated successfully');
    }

    public function destory($id)
    {
        $data = CompanyPackage::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success','Package deleted successfully');
    }

    public function getData($id)
    {
        $data = CompanyPackage::find($id);
        return response()->json($data);
    }


}
