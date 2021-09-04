@extends('dashboard.layouts.app')
@section('title', 'Search')
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

        .dataTables_wrapper .dataTables_filter {
            visibility: hidden;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@yield('title')</h5>
                        <form class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="penyakit">Penyakit</label>
                                        <input type="text" class="form-control @error('penyakit') is-invalid @enderror" id="penyakit"  name="penyakit" value="{{ old('penyakit') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary" id="cari">Cari</button>
                                </div>
                            </div>
                        </form>
                        <table id="datatable" class="table table-hover table-bordered display pb-30 w-100">
                            <thead>
                                <tr>
                                    <th width="8%"></th>
                                    <th scope="col" class="align-middle text-center" width="5%"> No </th>
                                    <th scope="col" class="align-middle text-center"> Name </th>
                                    <th scope="col" class="align-middle text-center"> Ket </th>
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
            var table = $('#datatable').DataTable({
                ajax: {
                    url: "{{ route('search') }}",
                    type: 'GET',
                    data: function(d) {
                        d.search = $('#penyakit').val()
                    }
                },
                processing: true,
                serverSide: true,
                searching: true,
                responsive: true,
                fixedHeader: true,
                columns: [
                    {
                        className: 'details-control',
                        orderable: false,
                        data: null,
                        defaultContent:'',
                        searchable: false,
                    },
                    {   data  :   'DT_RowIndex', orderable: false, searchable: false},
                    {	data	:	"name"},
                    {	data	:	"ket"},

                ],
                order: [[2, 'asc']]
            });

            $('#datatable tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });

            function format ( d ) {
                console.log(d)
                var disease = d.diseases
                var d = [];
                disease.forEach((item, index) => {
                    d.push(' '+item.name)
                })
                return '<table cellpadding="5" cellspacing="0" border="0" style="border: 1px solid #000000;">'+
                    '<tr>'+
                        '<td>Penyakit yang dapat disembuhkan :</td>'+
                        '<td>'+d+'</td>'+
                    '</tr>'+
                '</table>';
            }
        });

        $(document).on('click','#cari', function(e){
            e.preventDefault();
            $("#datatable").DataTable().draw(true);
        })
    </script>
@endsection
