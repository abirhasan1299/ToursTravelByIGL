<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class FaqController extends Controller
{
    public function index()
    {
        $data = Faq::orderBy('id', 'desc')->get();

        return view('admin.faq.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:40',
            'detail' => 'required',
            'status' => 'nullable|in:active,pending',
        ]);

       try{
           Faq::create($validate);

           return redirect()->route('admin.faqs')->with('success','Faq created successfully');

       }catch(\Exception $e){

           Log::error($e->getMessage());

           return redirect()->route('admin.faqs')->with('error','Something went wrong');

       }
    }

    public function destroy($id)
    {
        try{
            $data = Faq::findOrFail($id);
            $data->delete();
            return redirect()->route('admin.faqs')->with('success','Faq deleted successfully');
        }catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('admin.faqs')->with('error','Something went wrong');
        }
    }

    public function edit($id)
    {
        $data = Faq::findOrFail($id);

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:40',
            'detail' => 'required',
            'status' => 'nullable|in:active,pending',
        ]);
        $data = Faq::findOrFail($id);
        $data->update($validate);
        return redirect()->route('admin.faqs')->with('success','Faq updated successfully');
    }

    public function ContactList()
    {
        $data = Contact::orderBy('id', 'desc')->get();
        return view('admin.about.contact', compact('data'));
    }

}
