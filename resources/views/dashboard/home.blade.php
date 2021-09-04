@extends('dashboard.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="dashboard-info row">
                            <div class="info-text col-md-6">
                                <h5 class="card-title">Welcome back {{ Auth::user()->name }}!</h5>
                                <p>Get familiar with dashboard, here are some ways to get started.</p>
                                <ul>
                                    <li>Check some stats for your website bellow</li>
                                    <li>Sync content to other devices</li>
                                    <li>You now have access to File Manager app.</li>
                                </ul>
                                <a href="#" class="btn btn-warning m-t-xs">Learn More</a>
                            </div>
                            <div class="info-image col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
