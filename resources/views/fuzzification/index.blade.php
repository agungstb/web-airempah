    @extends('dashboard.layouts.app')
@section('title', 'Fuzzification')
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
                                    <th scope="col" rowspan="2" class="align-middle"> No </th>
                                    <th scope="col" rowspan="2" class="align-middle"> Name </th>
                                    <th scope="col" colspan="3" class="text-center"> Cureable Disease</th>
                                    <th scope="col" colspan="3" class="text-center"> Price</th>
                                    <th scope="col" colspan="3" class="text-center"> Nutrient</th>
                                    <th scope="col" colspan="3" class="text-center"> Side Effects</th>
                                </tr>
                                <tr>
                                    <th class="text-center assessment" scope="col">L</th>
                                    <th class="text-center assessment" scope="col">M</th>
                                    <th class="text-center assessment" scope="col">G</th>
                                    <th class="text-center assessment" scope="col">L</th>
                                    <th class="text-center assessment" scope="col">M</th>
                                    <th class="text-center assessment" scope="col">G</th>
                                    <th class="text-center assessment" scope="col">L</th>
                                    <th class="text-center assessment" scope="col">M</th>
                                    <th class="text-center assessment" scope="col">G</th>
                                    <th class="text-center assessment" scope="col">L</th>
                                    <th class="text-center assessment" scope="col">M</th>
                                    <th class="text-center assessment" scope="col">G</th>
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
                "ajax": "{{ route('admin.fuzzification.data') }}",
                "searching": true,
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "fixedHeader": true,
                "columns": [
                    {   "data"  :   'DT_RowIndex', orderable: false, searchable: false},
                    {	"data"	:	"name"},
                    {	"data"	:	"penyakit_yang_dapat_disembuhkan.less", orderable: false,},
                    {	"data"	:	"penyakit_yang_dapat_disembuhkan.medium", orderable: false,},
                    {	"data"	:	"penyakit_yang_dapat_disembuhkan.good", orderable: false,},
                    {	"data"	:	"harga_rempah.less", orderable: false,},
                    {	"data"	:	"harga_rempah.medium", orderable: false,},
                    {	"data"	:	"harga_rempah.good", orderable: false,},
                    {	"data"	:	"kandungan.less", orderable: false,},
                    {	"data"	:	"kandungan.medium", orderable: false,},
                    {	"data"	:	"kandungan.good", orderable: false,},
                    {	"data"	:	"efek_samping.less", orderable: false,},
                    {	"data"	:	"efek_samping.medium", orderable: false,},
                    {	"data"	:	"efek_samping.good", orderable: false,},

                ],
                "order": [[1, 'asc']]
            } );
        } );
    </script>
@endsection
