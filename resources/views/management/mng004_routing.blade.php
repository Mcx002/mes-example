@extends('layouts.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Management Dashboard</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('management_home') }}">Home</a></li>
                    <li class="breadcrumb-item">Basic Information</li>
                    <li class="breadcrumb-item active">Routing</li>
                </ol>
            </div>
        </div>
    </div>
    <routing-component></routing-component>
@endsection
