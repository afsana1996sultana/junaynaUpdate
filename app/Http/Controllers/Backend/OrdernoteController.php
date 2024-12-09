<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ordernote;

class OrdernoteController extends Controller
{
    public function index()
    {
        $ordernotes = Ordernote::latest()->get();
        return view('backend.ordernote.index',compact('ordernotes'));
    }


    public function create()
    {
        return view('backend.ordernote.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required|max:150',
        ]);

        Ordernote::create([
            'name'              => $request->name,
            'status'            => $request->status,

        ]);

        $notification = array(
            'message' => 'Order Note Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('order-note.index')->with($notification);

    }


    public function edit($id)
    {
        $ordernotes = Ordernote::findOrFail($id);
        return view('backend.ordernote.edit', compact('ordernotes'));
    }



    public function update(Request $request, $id)
    {
        $ordernotes = Ordernote::findOrFail($id);

        $this->validate($request,[
            'name'  => 'required|max:150',
        ]);

        $ordernotes->name             = $request->name;
        $ordernotes->status           = $request->status;
        $ordernotes->save();

        $notification = array(
            'message' => 'Order Note Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('order-note.index')->with($notification);
    }


    public function destroy($id)
    {
        $ordernotes = Ordernote::findOrFail($id);
        $ordernotes->delete();
        $notification = array(
            'message' => 'Order Note Deleted Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }


    public function active($id){
        $ordernotes = Ordernote::find($id);
        $ordernotes->status = 1;
        $ordernotes->save();

        $notification = array(
            'message' => 'Order Note Active Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function inactive($id){
        $ordernotes = Ordernote::find($id);
        $ordernotes->status = 0;
        $ordernotes->save();

        $notification = array(
            'message' => 'Order Note Disable Successfully.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

}
