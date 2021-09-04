@extends('dashboard.layouts.app')
@section('title', 'Criteria Create')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('failed'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('failed') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <h5 class="card-title">@yield('title')</h5>
                        <form method="POST" action="{{ route('admin.criteria.update', $criteria->id) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="criteria"><code>*</code> Criteria</label>
                                        <input type="text" class="form-control @error('criteria') is-invalid @enderror"  name="criteria" value="{{ $criteria->criteria }}">
                                        @error('criteria')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="integrity_id"><code>*</code> Integrity</label>
                                        <select class="select2 form-control  @error('integrity_id') is-invalid @enderror" name="integrity_id" id="integrity_id">
                                            <option value="{{$criteria->integrity_id}}" selected> {{$criteria->integrity->alias}} </option>
                                        </select>
                                        @error('integrity_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('#integrity_id').select2({
                placeholder: 'Select Integrity',
                ajax: {
                    url: "{{ route('admin.select.integrity') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.alias,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection
