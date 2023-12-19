@extends('layouts.backend.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/assets/css/ui-elements/pagination.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
    <link href="{{ asset('backend/assets/css/forms/form-widgets.css') }}" rel="stylesheet" type="text/css">




    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/dropify/dropify.min.css') }}">
    <link href="{{ asset('backend/assets/css/pages/profile_edit.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">ระบบสมาชิก</li>
            <li class="breadcrumb-item active" aria-current="page"><span>ระบบสมาชิก</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow mb-4 mt-4">
            <div class="row mb-4 ml-2">


                <div class="col-lg-2 mt-2">
                    <input type="text" class="form-control" name="username" id="s_username" placeholder="รหัสสมาชิก">
                </div>
                <div class="col-lg-2 mt-2">
                    <input type="text" class="form-control" name="first_name" id="s_first_name" placeholder="ชื่อสมาชิก">
                </div>
                <div class="col-lg-2 mt-2">
                    <input type="text" class="form-control" name="id_card" id="s_id_card"
                        placeholder="หมายเลขผู้เสียภาษี">
                </div>
                <div class="col-lg-2 mt-2">
                    <input type="text" class="form-control" name="s_sola_no" id="s_sola_no"
                        placeholder="หมายเลขผู้ใช้ไฟ">
                </div>

                <div class="col-lg-4 mb-2">


                    <div class="button-list mt-2">
                        <button type="button" class="btn btn-outline-success btn-rounded" id="search-form"><i
                                class="las la-search font-15"></i>
                            ค้นหา</button>

                        <button class="btn  btn-sm btn-primary btn-rounded" data-toggle="modal" data-target="#add"><i
                                class="las la-plus-circle font-20"></i>
                            เพิ่มสมาชิก</button>
                    </div>
                </div>




            </div>




            <div class="row">
                <div class="modal fade bd-example-modal-lg" id="add" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header ml-4">
                                <h5 class="modal-title" id="myLargeModalLabel"><b>เพิ่มรหัสสมาชิก</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="las la-times"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-text">
                                <div class="widget-content widget-content-area">
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <form method="post" action="{{ route('admin/register') }}">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="prefix">คำนำหน้าชื่อ
                                                                <span class="text-danger"> </span></label>
                                                            <select name="prefix" class="form-control"  >
                                                                <option value="นาย">นาย</option>
                                                                <option value="นาง">นาง</option>
                                                                <option value="นางสาว">นางสาว</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="firstname">ชื่อ
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('firstname') is-invalid @enderror"
                                                                name="firstname" placeholder="ชื่อ"
                                                                value="{{ old('firstname') }}" required>
                                                            @error('firstname')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="lastname">นามสุกล
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('lastname') is-invalid @enderror"
                                                                name="lastname" placeholder="นามสุกล"
                                                                value="{{ old('lastname') }}" required>
                                                            @error('lastname')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="businessname">ชื่อในทางธุรกิจ
                                                                <span class="text-danger">*
                                                                    กรณีที่ไม่มีให้ใส่
                                                                    (-)</span></label>
                                                            <input type="text"
                                                                class="form-control @error('businessname') is-invalid @enderror"
                                                                name="businessname" placeholder="ชื่อในทางธุรกิจ"
                                                                value="{{ old('businessname') }}" required>
                                                            @error('businessname')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_card">หมายเลขผู้เสียภาษี <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" maxlength="20"
                                                                class="form-control @error('id_card') is-invalid @enderror"
                                                                name="id_card"
                                                                placeholder="หมายเลขผู้เสียภาษี"
                                                                value="{{ old('id_card') }}" require>
                                                            @error('id_card')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            <span class="error text-danger"></span>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_card">หมายเลขผู้ใช้ไฟ <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" maxlength="20"
                                                                class="form-control @error('sola_no') is-invalid @enderror"
                                                                name="sola_no"
                                                                placeholder="หมายเลขผู้ใช้ไฟ"
                                                                value="{{ old('sola_no') }}" require>
                                                            @error('id_card')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            <span class="error text-danger"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="phone">หมายเลขโทรศัพท์
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                name="phone" placeholder="หมายเลขโทรศัพท์"
                                                                value="{{ old('phone') }}" maxlength="10"
                                                                minlength="10" required>
                                                            @error('phone')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Email Address
                                                            </label>

                                                            <input type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" placeholder="email@example.com"
                                                                value="{{ old('email') }}">
                                                            @error('email')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="info-area col-md-12 text-right">
                                                        {{-- <button type="submit" class="btn btn-info mr-2">
                                                        <i class="las la-save"></i> ยืนยันข้อมูลการสมัคร</button> --}}
                                                    </div>
                                                </div>
                                                <h6 class="font-16 mb-3"><b>ที่อยู่ตามบัตรประชาชน (ADDRESS)</b></h6>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="card_no">บ้านเลขที่
                                                                <span class="text-danger">*
                                                                </span></label>
                                                            <input type="text"
                                                                class="form-control @error('card_no') is-invalid @enderror"
                                                                name="card_no" placeholder="บ้านเลขที่"
                                                                value="{{ old('card_no') }}" required>
                                                            @error('card_no')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="card_moo">หมู่ที่
                                                                <span class="text-danger">*
                                                                </span></label>
                                                            <input type="text"
                                                                class="form-control @error('card_moo') is-invalid @enderror"
                                                                name="card_moo"   placeholder="หมู่ที่"
                                                                value="{{ old('card_moo') }}" required>
                                                            @error('card_moo')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="card_home_name">หมู่บ้าน/อาคาร
                                                                <span class="text-danger">*
                                                                </span></label>
                                                            <input type="text"
                                                                class="form-control @error('card_home_name') is-invalid @enderror"
                                                                name="card_home_name"
                                                                placeholder="หมู่บ้าน/อาคาร"
                                                                value="{{ old('card_home_name') }}" required>
                                                            @error('card_home_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_soi">ตรอก/ซอย
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('card_soi') is-invalid @enderror"
                                                                name="card_soi"   placeholder="ตรอก/ซอย"
                                                                value="{{ old('card_soi') }}">
                                                            @error('card_soi')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_road">ถนน
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('card_road') is-invalid @enderror"
                                                                name="card_road"   placeholder="ถนน"
                                                                value="{{ old('card_road') }}">
                                                            @error('card_road')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_changwat">จังหวัด
                                                                <span class="text-danger">*</span></label>

                                                            <select name="card_changwat" class="form-control basic"
                                                                id="card_changwat" required>
                                                                <option value="">เลือกจังหวัด</option>
                                                                @foreach ($province as $value_provinces)
                                                                    <option value="{{ $value_provinces->id }}"
                                                                        @if ($value_provinces->id == old('card_province')) selected @endif>
                                                                        {{ $value_provinces->name_th }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_amphur">เขต/อำเภอ
                                                                <span class="text-danger">*</span></label>
                                                            <select name="card_amphur" class="form-control"
                                                                id="card_amphur" disabled required>
                                                                <option value="">เลือกเขต/อำเภอ</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_tambon">แขวง/ตำบล
                                                                <span class="text-danger">*</span></label>
                                                            <select name="card_tambon" class="form-control"
                                                                id="card_tambon" disabled required>
                                                                <option value="">เลือกแขวง/ตำบล</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_zipcode">รหัสไปรษณีย์
                                                                <span class="text-danger card_zipcode_err _err">*
                                                                </span></label>
                                                            <input type="text"
                                                                class="form-control @error('card_zipcode') is-invalid @enderror"
                                                                name="card_zipcode" placeholder="รหัสไปรษณีย์"
                                                                id="card_zipcode" value="{{ old('card_zipcode') }}"
                                                                required disabled>
                                                            @error('card_zipcode')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="info-area col-md-12 text-right">
                                                        <button type="submit" class="btn btn-info mr-2">
                                                            <i class="las la-save"></i></i> ยืนยันข้อมูลการสมัคร</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="modal fade bd-example-modal-lg" id="edit_customer" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header ml-4">
                                <h5 class="modal-title" id="myLargeModalLabel"><b>เพิ่มรหัสสมาชิก</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="las la-times"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-text">
                                <div class="widget-content widget-content-area">
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <form method="post" action="{{ route('admin/register') }}">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="prefix">คำนำหน้าชื่อ
                                                                <span class="text-danger"> </span></label>
                                                            <select name="prefix" class="form-control"  id="prefix">
                                                                <option value="นาย">นาย</option>
                                                                <option value="นาง">นาง</option>
                                                                <option value="นางสาว">นางสาว</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="firstname">ชื่อ
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('firstname') is-invalid @enderror"
                                                                name="firstname" placeholder="ชื่อ" id="firstname" required>
                                                            @error('firstname')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="lastname">นามสุกล
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('lastname') is-invalid @enderror"
                                                                name="lastname" placeholder="นามสุกล"  id="lastname" required>
                                                            @error('lastname')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="businessname">ชื่อในทางธุรกิจ
                                                                <span class="text-danger">*
                                                                    กรณีที่ไม่มีให้ใส่
                                                                    (-)</span></label>
                                                            <input type="text"
                                                                class="form-control @error('businessname') is-invalid @enderror"
                                                                name="businessname" placeholder="ชื่อในทางธุรกิจ" id="businessname" required>
                                                            @error('businessname')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_card">หมายเลขผู้เสียภาษี <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" maxlength="20"
                                                                class="form-control @error('id_card') is-invalid @enderror"
                                                                name="id_card"
                                                                placeholder="หมายเลขผู้เสียภาษี" id="id_card" require>
                                                            @error('id_card')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            <span class="error text-danger"></span>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_card">หมายเลขผู้ใช้ไฟ <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" maxlength="20"
                                                                class="form-control @error('sola_no') is-invalid @enderror"
                                                                name="sola_no"
                                                                placeholder="หมายเลขผู้ใช้ไฟ" id="sola_no" require>
                                                            @error('id_card')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            <span class="error text-danger"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="phone">หมายเลขโทรศัพท์
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                name="phone" placeholder="หมายเลขโทรศัพท์" id="phone" maxlength="10"
                                                                minlength="10" required>
                                                            @error('phone')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Email Address
                                                            </label>

                                                            <input type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" placeholder="email@example.com" id="email">
                                                            @error('email')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="info-area col-md-12 text-right">
                                                        {{-- <button type="submit" class="btn btn-info mr-2">
                                                        <i class="las la-save"></i> ยืนยันข้อมูลการสมัคร</button> --}}
                                                    </div>
                                                </div>
                                                <h6 class="font-16 mb-3"><b>ที่อยู่ตามบัตรประชาชน (ADDRESS)</b></h6>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="card_no">บ้านเลขที่
                                                                <span class="text-danger">*
                                                                </span></label>
                                                            <input type="text"
                                                                class="form-control @error('card_no') is-invalid @enderror"
                                                                name="card_no" placeholder="บ้านเลขที่" id="card_no" required>
                                                            @error('card_no')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="card_moo">หมู่ที่
                                                                <span class="text-danger">*
                                                                </span></label>
                                                            <input type="text"
                                                                class="form-control @error('card_moo') is-invalid @enderror"
                                                                name="card_moo"   placeholder="หมู่ที่" id="card_moo" required>
                                                            @error('card_moo')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="card_home_name">หมู่บ้าน/อาคาร
                                                                <span class="text-danger">*
                                                                </span></label>
                                                            <input type="text"
                                                                class="form-control @error('card_home_name') is-invalid @enderror"
                                                                name="card_home_name"
                                                                placeholder="หมู่บ้าน/อาคาร" id="card_home_name"  required>
                                                            @error('card_home_name')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_soi">ตรอก/ซอย
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('card_soi') is-invalid @enderror"
                                                                name="card_soi"   placeholder="ตรอก/ซอย" id="card_soi" >
                                                            @error('card_soi')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_road">ถนน
                                                            </label>
                                                            <input type="text"
                                                                class="form-control @error('card_road') is-invalid @enderror"
                                                                name="card_road"   placeholder="ถนน" id="card_road">
                                                            @error('card_road')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_changwat">จังหวัด
                                                                <span class="text-danger">*</span></label>

                                                            <select name="card_changwat" class="form-control basic"
                                                                id="e_card_changwat" required>

                                                                @foreach ($province as $value_provinces)
                                                                    <option value="{{ $value_provinces->id }}"
                                                                        @if ($value_provinces->id == old('card_province')) selected @endif>
                                                                        {{ $value_provinces->name_th }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_amphur">เขต/อำเภอ
                                                                <span class="text-danger">*</span></label>
                                                            <select name="card_amphur"  class="form-control"
                                                                id="e_card_amphur" disabled required>
                                                                <option value="">เลือกเขต/อำเภอ</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_tambon">แขวง/ตำบล
                                                                <span class="text-danger">*</span></label>
                                                            <select name="card_tambon" class="form-control"
                                                                id="e_card_tambon" disabled required>
                                                                <option value="">เลือกแขวง/ตำบล</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="card_zipcode">รหัสไปรษณีย์
                                                                <span class="text-danger card_zipcode_err _err">*
                                                                </span></label>
                                                            <input type="text"
                                                                class="form-control @error('card_zipcode') is-invalid @enderror"
                                                                name="card_zipcode" placeholder="รหัสไปรษณีย์"
                                                                id="e_card_zipcode" value="{{ old('card_zipcode') }}"
                                                                required disabled>
                                                            @error('card_zipcode')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="info-area col-md-12 text-right">
                                                        <button type="submit" class="btn btn-info mr-2">
                                                            <i class="las la-save"></i></i> ยืนยันการแก้ไขข้อมูล</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="table-responsive mt-2 mb-2">
                    <table id="basic-dt" class="table table-hover" style="width:100%">
                    </table>
                </div>
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

    <script src="{{ asset('frontend/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/forms/custom-select2.js') }}"></script>


    <script src="{{ asset('backend/assets/js/forms/multiple-step.js') }}"></script>
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/profile_edit.js') }}"></script>
    <script>
        $(function() {
            table_order = $('#basic-dt').DataTable({
                // dom: 'Bfrtip',
                // buttons: ['excel'],
                searching: false,
                ordering: true,
                lengthChange: false,
                responsive: true,
                // paging: true,
                pageLength: 20,
                processing: true,
                serverSide: true,
                "language": {
                    "lengthMenu": "Show _MENU_ Raw",
                    "zeroRecords": "No information",
                    "info": "Show page _PAGE_ From _PAGES_ Page",
                    "search": "ค้นหา",
                    "infoEmpty": "",
                    "infoFiltered": "",
                    "paginate": {
                        "first": "หน้าแรก",
                        "previous": "ย้อนกลับ",
                        "next": "ถัดไป",
                        "last": "หน้าสุดท้าย"
                    },
                    'processing': "กำลังโหลดข้อมูล",
                },
                ajax: {
                    url: '{{ route('admin/MemberRegister_datatable') }}',
                    data: function(d) {
                        d.s_username = $('#s_username').val();

                        d.s_first_name = $('#s_first_name').val();
                        d.s_id_card = $('#s_id_card').val();
                        d.s_sola_no = $('#s_sola_no').val();


                    },
                },


                columns: [
                    // {
                    //     data: "id",
                    //     title: "ลำดับ",
                    //     className: "w-10 text-center",
                    // },

                    {
                        data: "username",
                        title: "รหัสสมาชิก",
                        className: "w-10 ",
                    },


                    {
                        data: "name_bu",
                        title: "ชื่อผู้ประกอบการ",
                        className: "w-10",
                    },

                    {
                        data: "first_name",
                        title: "ชื่อ",
                        className: "w-10",
                    },

                    {
                        data: "last_name",
                        title: "นามสกุล",
                        className: "w-10",
                    },
                    {
                        data: "phone",
                        title: "เบอร์โทร",
                        className: "w-10",
                    },

                    {
                        data: "id_card",
                        title: "หมายเลขผู้เสียภาษี",
                        className: "w-10",
                    },

                    {
                        data: "sola_no",
                        title: "หมายเลขผู้ใช้ไฟ",
                        className: "w-10",
                    },

                    {
                        data: "customer_status",
                        title: "สถานะ",
                        className: "w-10",
                    },


                    {
                        data: "action",
                        title: "Action",
                        className: "w-1",
                    },



                ],



            });
            $('#search-form').on('click', function(e) {
                table_order.draw();
                e.preventDefault();
            });

        });

        function edit(id) {

            $.ajax({
                    url: '{{ route('admin/view_password') }}',
                    type: 'GET',
                    data: {
                        id
                    }
                })
                .done(function(data) {
                    console.log(data);
                    $("#edit").modal();
                    $("#id").val(data['data']['id']);
                    $("#username").val(data['data']['username']);
                    $("#first_name").val(data['data']['first_name']);
                    $("#last_name").val(data['data']['last_name']);
                    $("#id_card").val(data['data']['id_card']);

                })
                .fail(function() {
                    console.log("error");
                })
        }

        function edit_customer(id) {



            $.ajax({
                    url: '{{ route('admin/view_member_data') }}',
                    type: 'GET',
                    data: {
                        id
                    }
                })
                .done(function(data) {
                    console.log(data);



                    $("#prefix_name").val(data['data']['prefix_name']);
                    $("#name").val(data['data']['name']);
                    $("#last_name").val(data['data']['last_name']);
                    $("#name_bu").val(data['data']['name_bu']);
                    $("#id_card").val(data['data']['id_card']);
                    $("#sola_no").val(data['data']['sola_no']);
                    $("#email").val(data['data']['phone']);
                    $("#sola_no").val(data['data']['email']);

                    $("#edit_customer").modal();


                })
                .fail(function() {
                    console.log("error");
                })
        }




    </script>


    <script>
        $("#card_changwat").change(function() {
            let province_id = $(this).val();
            $.ajax({
                url: '{{ route('getDistrict') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    province_id: province_id,
                },
                success: function(data) {
                    $("#card_amphur").children().remove();
                    $("#card_tambon").children().remove();
                    $("#card_amphur").append(` <option value=""> เลือกอำเภอ </option>`);
                    $("#card_tambon").append(` <option value=""> เลือกตำบล </option>`);
                    $("#card_zipcode").val("");
                    data.forEach((item) => {
                        $("#card_amphur").append(
                            `<option value="${item.id}">${item.name_th}</option>`
                        );

                    });
                    $("#card_amphur").attr('disabled', false);
                    $("#card_tambon").attr('disabled', true);
                },
                error: function() {}
            })
        });


        $("#card_amphur").change(function() {
            let district_id = $(this).val();
            $.ajax({
                url: '{{ route('getTambon') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    district_id: district_id,
                },
                success: function(data) {
                    $("#card_tambon").children().remove();
                    $("#card_tambon").append(` <option value=""> เลือกตำบล </option>`);
                    $("#card_zipcode").val("");
                    data.forEach((item) => {
                        $("#card_tambon").append(
                            `<option value="${item.id}">${item.name_th}</option>`
                        );
                    });
                    $("#card_tambon").attr('disabled', false);
                },
                error: function() {}
            })
        });
        // BEGIN district

        $("#card_tambon").change(function() {
            let tambon_id = $('#card_tambon').val();
            console.log(tambon_id);
            $.ajax({
                url: '{{ route('getZipcode') }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    tambon_id: tambon_id,
                },
                success: function(data) {
                    // console.log(data);
                    $("#card_zipcode").attr('disabled', false);
                    $("#card_zipcode").val(data.zip_code);
                },
                error: function() {}
            })
        });
    </script>
@endsection
