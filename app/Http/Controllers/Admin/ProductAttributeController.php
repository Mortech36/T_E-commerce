<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index(){
        return view('admin.product_attribute.create');
    }
    public function manage(){
        $attributes = DefaultAttribute::all();
        return view('admin.product_attribute.manage', compact('attributes'));
    }

    public function attribute_create(Request $request){
        $validate_data=$request->validate([
            'attribute_value'=>'unique:default_attributes|max:100',
        ]);
        DefaultAttribute::create($validate_data);

        return redirect()->back()->with('message','Attribute Added Successfully');
    }

    public function showattr($id){
        $attribute_info = DefaultAttribute::find($id);
        return view('admin.product_attribute.edit', compact('attribute_info'));
    }
    
    public function updateattr(Request $request,$id){
        $attribute =DefaultAttribute::findOrFail($id);
        $validate_data=$request->validate([
            'attribute_value'=>'unique:default_attributes|max:100',
        ]);
        $attribute->update($validate_data);
        return redirect()->back()->with('message','Attribute Updated Successfully');

    }

    public function delete_attr($id){
        $attribute = DefaultAttribute::find($id);
        $attribute->delete();
        return redirect()->back()->with('message','Attribute Deleted Successfully');

    }
}
