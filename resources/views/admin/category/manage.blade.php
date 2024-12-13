@extends('admin.layouts.layout')
@section('admin_page_title')
   Manage Category - Admin Panel
@endsection
@section('admin_layout')
<div class="row">
   <div class="col-12 ">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title mb-0">All Categories</h5>
         </div>
         <div class="card-body">
            
            <div class="table-responsive">
               @if (@session('message'))
                  <div class="alert alert-danger">
                     {{session('message')}}
                  </div>
               @endif
               <table class="table">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($categories as $category )
                     <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->category_name}}</td>
                        <td>
                           <form action="{{ route('delete.cat' , $category->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">Delete</button>
                           </form>
                           <a href="{{route('show.cat', $category->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                     </tr>
                        
                     @endforeach
                  </tbody>
               </table>
            </div>
            
         </div>
      </div>
   </div>
</div>
@endsection