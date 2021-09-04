@extends('dashboard.layouts.app')
@section('title', 'Zadeh')
@section('style')
    <style>
        thead th  {
            font-size: 12px;
        }
        thead th.assessment  {
            font-size: 10px;
        }
        tbody tr {
            font-size: 12px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@yield('title')</h5>
                        <table id="datatable" class="table table-hover table-bordered display pb-30 w-100">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2" class="align-middle text-center"> No </th>
                                    <th scope="col" rowspan="2" class="align-middle text-center" width="15%"> Name </th>
                                    <th scope="col" colspan="1" class="text-center" width="13%"> Cureable Disease</th>
                                    <th scope="col" colspan="1" class="text-center" width="13%"> Price</th>
                                    <th scope="col" colspan="1" class="text-center" width="13%"> Nutrient</th>
                                    <th scope="col" colspan="1" class="text-center" width="13%"> Side Effects</th>
                                    <th scope="col" rowspan="2" class="align-middle text-center" width="15%"> Fire Strength / Z </th>
                                    <th scope="col" rowspan="2" class="align-middle text-center"> Ket </th>
                                </tr>
                                <tr>

                                    <th class="text-center assessment" scope="col">G</th>
                                    <th class="text-center assessment" scope="col">G</th>
                                    <th class="text-center assessment" scope="col">G</th>
                                    <th class="text-center assessment" scope="col" style="border-right:1px solid #000000">G</th>
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
                "ajax": "{{ route('admin.zadeh.data') }}",
                "searching": true,
                // "serverSide": true,
                // "processing": true,
                "responsive": true,
                "fixedHeader": true,
                "columns": [
                    {   "data"  :   'DT_RowIndex'},
                    {	"data"	:	"name"},
                    {	"data"	:	"penyakit_yang_dapat_disembuhkan.good",orderable: false,},
                    {	"data"	:	"harga_rempah.good", orderable: false,},
                    {	"data"	:	"kandungan.good", orderable: false,},
                    {	"data"	:	"efek_samping.good", orderable: false,},
                    {	"data"	:	"fire_strength", orderable: false,},
                    {	"data"	:	"ket"},

                ],
                "order": [[1, 'asc']]
            } );
        } );
    </script>
@endsection
