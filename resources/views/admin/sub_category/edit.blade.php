@extends('admin.layouts.layout')
@section('admin_page_title')
  Edit Sub Category - Admin Panel
@endsection
@section('admin_layout')
   <div class="row">
      <div class="col-12 ">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title mb-0">Edit Sub Category</h5>
            </div>
            <div class="card-body">
               @if ($errors->any())
                  <div class="alert alert-danger d-flex align-items-center">
                     <ul>
                           @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                     </ul>
                  </div>
               @endif
               @if (@session('message'))
                  <div class="alert alert-success">
                     {{session('message')}}
                  </div>
               @endif

               <form action="{{route('update.subcat',$subcategory_info->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <label for="subcategory_name" class="fw-bold mb-2">Give New Name of Your Category</label>
                  <input type="text" class="form-control" placeholder="Computer" name="subcategory_name" value="{{$subcategory_info->subcategory_name}}">
                  <label for="category_id" class="fw-bold mb-2">Select New Category</label>
                  <select name="category_id" class="form-control" id="category_id" aria-label="Select Category">
                     <option value="" disabled>Select a category</option>
                     @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                              {{ $category->id == $subcategory_info->category_id ? 'selected' : '' }}>
                              {{ $category->category_name }}
                        </option>
                     @endforeach
                  </select>
                  <button type="submit" class="btn btn-primary w-100 mt-2">Update Sub Category</button>
                  <a href="{{ route('sub_category.manage') }}" class="btn btn-secondary w-100 mt-2">Back</a>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection
