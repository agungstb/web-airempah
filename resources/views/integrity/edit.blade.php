@extends('dashboard.layouts.app')
@section('title', 'Integrity Create')
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
                        <form method="POST" action="{{ route('admin.integrity.update', $int->id) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alias"><code>*</code> Alias</label>
                                        <input type="text" class="form-control @error('alias') is-invalid @enderror"  name="alias" value="{{ $int->alias }}">
                                        @error('alias')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="value"><code>*</code> Value</label>
                                        <input type="text" class="form-control @error('value') is-invalid @enderror"  name="value" value="{{ $int->value }}">
                                        @error('value')
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
