@extends('kr.layouts.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">관리 대시 보드</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">집</li>
                </ol>
            </div>
        </div>
    </div>
    <dashboard-management-component></dashboard-management-component>
@endsection
