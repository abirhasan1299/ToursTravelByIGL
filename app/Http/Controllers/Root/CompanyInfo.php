<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyInfo extends Controller
{
    public function index()
    {
        $data = About::where('id',1)->first();
        return view('admin.about.about',compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hero_header'=>'required',
            'hero_detail'=>'required',
            'company_title'=>'required',
            'mv'=>'required',
            'exp_years'=>'required|numeric',
            'author_name'=>'required',
            'author_designation'=>'required',
            'author_img'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tour_success'=>'required|numeric',
            'happy_traveler'=>'required|numeric',
            'award'=>'required|numeric',
        ]);

       try{

           if ($request->hasFile('author_img')) {
               $file = $request->file('author_img');
               $filename = time() . '_' . $file->getClientOriginalName();
               $file->storeAs('author_img', $filename,'public');
               $validated['author_img'] = $filename;
           }

           About::updateOrCreate(['id'=>1], $validated);

           return redirect()->route('admin.about')->with('success','About updated successfully');

       }catch (\Exception $e){

           Log::error($e->getMessage());

           return redirect()->route('admin.about')->with('error','Something went wrong');

       }

    }

    public function setting()
    {
        $data = Setting::where('id',1)->first();
        return view('admin.about.setting',compact('data'));
    }

    public function StoreSetting(Request $request)
    {
        try{
            Setting::updateOrCreate(['id'=>1],$request->all());
            return redirect()->route('admin.setting')->with('success','App Information updated successfully');
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('admin.setting')->with('error','Something went wrong');
        }


    }
}
