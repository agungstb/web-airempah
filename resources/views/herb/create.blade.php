@extends('dashboard.layouts.app')
@section('title', 'Herb Create')
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
                        <form method="POST" action="{{ route('admin.herb.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"><code>*</code> Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="diseases"><code>*</code>Cureable Diseases</label>
                                        <select id="diseases" name="diseases[]" value="{{ old('diseases[]') }}" class="form-control @error('diseases') is-invalid @enderror select2" multiple></select>
                                        @error('diseases')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price"><code>*</code>Price <small>(100gr)</small></label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"  name="price" value="{{ old('price') }}">
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="difficulty"><code>*</code> Difficulty </label>
                                        <input type="number" step="0.1" class="form-control @error('difficulty') is-invalid @enderror"  name="difficulty" value="{{ old('difficulty') }}">
                                        @error('difficulty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nutrient"><code>*</code>Nutrient Content</label>
                                        <select id="nutrient" name="nutrient[]" value="{{ old('nutrient[]') }}" class="form-control @error('nutrient') is-invalid @enderror select2" multiple></select>
                                        @error('nutrient')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="side_effects"><code>*</code> Side Effects </label>
                                        <input type="number" class="form-control @error('side_effects') is-invalid @enderror"  name="side_effects" value="{{ old('side_effects') }}">
                                        @error('side_effects')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row mt-3">

                            </div> --}}
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
<script type="text/javascript">
    $(function(){
        $('#diseases').select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '{{ route('admin.select.disease') }}',
                data: function (params) {
                    var query = {
                        search: params.term,
                    };
                    return query;
                }
            }
        });
        $('#nutrient').select2({
            tags: true,
            minimumInputLength: 2,
            ajax: {
                url: '{{ route('admin.select.nutrient') }}',
                data: function (params) {
                    var query = {
                        search: params.term,
                    };
                    return query;
                }
            }
        });
    });
</script>
@endsection
