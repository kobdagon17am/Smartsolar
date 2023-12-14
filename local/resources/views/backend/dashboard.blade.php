@extends('layouts.backend.app')
@section('css')
    <link href="{{ asset('backend/assets/css/dashboard/dashboard_1.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboards</a></li> --}}
            <li class="breadcrumb-item active" aria-current="page"><span>หน้าหลัก</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row layout-top-spacing">
        <div class="col-lg-12 layout-spacing">

            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="row">

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 mb-2">
                                <div class="widget">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="mr-3">
                                            <span class="quick-category-icon qc-primary rounded-circle">
                                                <i class="las la-user"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">จำนวนสมาชิกทั้งหมด</h5>
                                    </div>
                                    <?php
                                      $customers = DB::table('customers')
                                      ->count();

                                    ?>
                                    <div class="text-muted mt-3">
                                        <h5 class="mb-2">{{ $customers }} คน
                                            <i class="las la-angle-up text-success-teal"></i>
                                        </h5>
                                        <div class="d-flex">
                                            {{-- <span class="badge badge-success-teal font-size-12"> + 25% </span> --}}
                                            <span class="ml-2 text-truncate">{{date('Y/m/d')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>




                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
@endsection
@section('js')
@endsection
