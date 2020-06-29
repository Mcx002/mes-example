@extends('layouts.app')

@section('content')
    {{-- <div class="row page-titles">
        <div class="col-md-5 align-self-center">
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('management_home') }}">Home</a></li>
                    <li class="breadcrumb-item">Transaction</li>
                    <li class="breadcrumb-item active">Transaction</li>
                </ol>
            </div>
        </div>
    </div> --}}
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-0">
                    <div class="row  page-titles">
                        <div class="col-md-5 align-self-center">
                            Transaction Info
                        </div>
                        <div class="col-md-7 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('management_home') }}">Home</a></li>
                                    <li class="breadcrumb-item">Info Transaction</li>
                                    <li class="breadcrumb-item active">Info</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <transaction-info-component></transaction-info-component> 
            </div>
        </div>
    </div>
@endsection
