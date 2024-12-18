<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class MasterSubCategoryController extends Controller
{
    public function storesubcat(Request $request){
        $validate_data=$request->validate([
            'subcategory_name'=>'unique:sub_categories|max:100|min:5',
            'category_id' => 'required|exists:categories,id'
        ]);
        SubCategory::create($validate_data);

        return redirect()->back()->with('message','Sub Category Added Successfully');
    }

    public function showsubcat($id){
        $subcategory_info = SubCategory::find($id);
        return view('admin.subcategory.edit', compact('subcategory_info'));
    }
    
    public function updatecat(Request $request,$id){
        $subcategory =SubCategory::findOrFail($id);
        $validate_data=$request->validate([
            'subcategory_name'=>'unique:categories|max:100|min:5',
        ]);
        $subcategory->update($validate_data);
        return redirect()->back()->with('message','Sub Category Updated Successfully');

    }

    public function deletesubcat($id){
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        return redirect()->back()->with('message','Sub Category Deleted Successfully');

    }
}
