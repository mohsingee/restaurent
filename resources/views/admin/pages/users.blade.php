@extends('admin.layouts.master')
@section('page_title','Restaurent - Users')
@section('content')
<div class="container-fluid p-0">
   <h1 class="h3 mb-3 section-main-heding">All Users</h1>
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title section-sub-heding">Users</h5>
            </div>
            <div class="card-body">
               <div class="overflow_scroll2 table-responsive">
                  <table id="datatables-column-search-text-inputs" class="table table-striped">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Created at</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php $i =1; @endphp
                        @foreach ($users as $user)
                        <tr>
                           <td>{{ $i++ }}</td>
                           <td>{{ $user->first_name.' '.$user->last_name }}</td>
                           <td>{{ $user->email }}</td>
                           <td>{{ date('m-d-Y', strtotime($user->created_at))}}</td>
                           <td><span class='badge bg-secondary bg-success'>Active</span> <span class='badge bg-secondary bg-danger'>Inactive</span></td>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>#</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Created at</th>
                           <th>Action</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
               <div class="table-responsive"></div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
   // DataTables with Column Search by Text Inputs
   document.addEventListener("DOMContentLoaded", function() {
       // Setup - add a text input to each footer cell
       $('#datatables-column-search-text-inputs tfoot th').each(function() {
           var title = $(this).text();
           if (title !== 'Action') {
               $(this).html('<input type="text" class="form-control" placeholder="Search ' + title +
                   '" />');
           }
       });
       // DataTables
       var table = $('#datatables-column-search-text-inputs').DataTable({
           responsive: true
       });
       // Apply the search
       table.columns().every(function() {
           var that = this;
           $('input', this.footer()).on('keyup change clear', function() {
               if (that.search() !== this.value) {
                   that
                       .search(this.value)
                       .draw();
               }
           });
       });
   });
</script>
@endsection