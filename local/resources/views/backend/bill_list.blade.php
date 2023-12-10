@extends('layouts.backend.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/assets/css/ui-elements/pagination.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
    <link href="{{ asset('backend/assets/css/pages/profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/forms/form-widgets.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Bill</li>
            <li class="breadcrumb-item active" aria-current="page"><span>รายการ </span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow mb-4 mt-4">

            <div class="row mb-4 ml-2">
                <div class="col-lg-2 mt-2">
                    <label>วันที่เริ่มต้น</label>
                    <input type="date" class="form-control  myCustom date_start" name="date_start"
                        placeholder="วันที่เริ่มต้น" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-lg-2 mt-2">
                    <label>วันที่สิ้นสุด</label>
                    <input type="date" class="form-control  myCustom date_end" name="date_end"
                        placeholder="วันที่สิ้นสุด" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-lg-2 mt-2">
                    <label>Code</label>
                    <input type="taxt" class="form-control myCustom code_order" name="code_order"
                        placeholder="Code Order">
                </div>
{{--
                <div class="col-lg-2 mt-2">
                    <label>ประเภทการสั่งซื้อ</label>
                    <select class="form-control myWhere type" name="type" id="type">
                        <option selected="" value=""> ทั้งหมด </option>
                        <option value="other">ทั่วไป</option>
                        <option value="promotion">โปรโมชั่น</option>
                        <option value="send_stock">StockMember</option>

                    </select>
                </div> --}}

                <div class="col-lg-4 mb-2" style="margin-top: 42px">

                    <div class="button-list">
                        <button type="button" class="btn btn-outline-success btn-rounded" id="search-form"><i
                                class="las la-search font-15"></i>
                            ค้นหา</button>

                        <a href="{{route('admin/bill/create')}}" class="btn  btn-sm btn-primary btn-rounded" ><i
                                class="las la-plus-circle font-20"></i>
                            สร้างบิล</a>
                    </div>
                </div>



                {{-- <div class="col-lg-2 mb-2 mt-2" style="margin-top:15px">
                    <select class="form-control myWhere" name="status">
                        <option value="0">ทั้งหมด</option>
                        <option selected value="1">รออนุมัติ</option>
                        <option value="2">อนุมัติ</option>
                        <option value="3">ไม่อนุมัติ</option>
                    </select>


                </div> --}}
            </div>


            <div class="table-responsive mt-2 mb-2">
                <h6>รายการคำสั่งซื้อ</h6>
                <table id="table_orders" class="table table-hover" style="width:100%">

                </table>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('backend/plugins/table/datatable/datatables.js') }}"></script>
    <!--  The following JS library files are loaded to use Copy CSV Excel Print Options-->
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <!-- The following JS library files are loaded to use PDF Options-->
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/vfs_fonts.js') }}"></script>


@endsection
