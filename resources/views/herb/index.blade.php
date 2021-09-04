@extends('dashboard.layouts.app')
@section('title', 'Herb')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin.herb.create') }}" class="btn btn-primary btn-xs float-right">Create Herb</a>
                        <h5 class="card-title">@yield('title')</h5>
                        <table id="datatable" class="table table-hover w-100 display pb-30">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Cureable Disease</th>
                                <th>Price</th>
                                <th>Nutrient</th>
                                <th>Side Effects</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#datatable').DataTable( {
                "ajax": "{{ route('admin.herb.data') }}",
                "searching": true,
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "fixedHeader": true,
                "columns": [
                    {   "data"  :   'DT_RowIndex', orderable: false, searchable: false},
                    {	"data"	:	"name"},
                    {	"data"	:	"cureable_disease", orderable: false,},
                    {	"data"	:	"price"},
                    {	"data"	:	"total_nutrient"},
                    {	"data"	:	"side_effects"},
                    {	"data"	:	"action"},

                ],
                "order": [[1, 'asc']]
            } );
        } );
        function remove(t) {
            var id = $(t).data("id");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.herb.index') }}/"+id,
                type: 'delete',
                dataType: "JSON",
                data: { "id": id },
                success: function (data) {
                    $('#datatable').DataTable().ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        text: data.message,
                        showConfirmButton: false
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        icon: 'error',
                        text: xhr.responseJSON.message,
                        showConfirmButton: false
                    });
                }
            });
        }
        $(document).on('click', '.delete', function(e) {
            var t = $(this);
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Data will be sent to the trash",
                type: 'warning',
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    remove(t);
                }
            });
        });
    </script>
@endsection
