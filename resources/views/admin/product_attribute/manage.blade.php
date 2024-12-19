@extends('admin.layouts.layout')
@section('admin_page_title')
   Manage Attributes - Admin Panel
@endsection
@section('admin_layout')
<div class="row">
   <div class="col-12 ">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title mb-0">All Attributes</h5>
         </div>
         <div class="card-body">
            
            <div class="table-responsive">
               @if (@session('message'))
                  <div class="alert alert-danger">
                     {{ session('message') }}
                  </div>
               @endif
               <table class="table">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Attribute</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($attributes as $attr)
                     <tr>
                        <td>{{ $attr->id }}</td>
                        <td>{{ $attr->attribute_value }}</td>
                        <td>
                           <div style="display: flex; gap: 8px; align-items: center;">
                             <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $attr->id }})">Delete</button>
                             <a href="{{ route('show.attr', $attr->id) }}" class="btn btn-primary">Edit</a>
                           </div>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   function confirmDelete(attrId) {
       Swal.fire({
           title: "Are you sure?",
           text: "This action cannot be undone!",
           icon: "warning",
           showCancelButton: true,
           confirmButtonColor: "#d33",
           cancelButtonColor: "#3085d6",
           confirmButtonText: "Yes, delete it!"
       }).then((result) => {
           if (result.isConfirmed) {
               // Create a hidden form and submit it for deletion
               const form = document.createElement("form");
               form.action = `{{route("delete.attr", $attr->id)}}`;
               form.method = "POST";

               const csrfInput = document.createElement("input");
               csrfInput.type = "hidden";
               csrfInput.name = "_token";
               csrfInput.value = "{{ csrf_token() }}";
               form.appendChild(csrfInput);

               const methodInput = document.createElement("input");
               methodInput.type = "hidden";
               methodInput.name = "_method";
               methodInput.value = "DELETE";
               form.appendChild(methodInput);

               document.body.appendChild(form);
               form.submit();
           }
       });
   }
</script>
@endsection
