<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::all();
        return view('admin.sub_category.edit', compact('subcategory_info', 'categories'));
    }
    
    public function updatesubcat(Request $request,$id){
        $subcategory =SubCategory::findOrFail($id);
        $validate_data=$request->validate([
            'subcategory_name'=>'unique:sub_categories|max:100|min:5',
            'category_id' => 'required|exists:categories,id'
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
