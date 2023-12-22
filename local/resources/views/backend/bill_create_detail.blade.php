@extends('layouts.backend.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/dt-global_style.css') }}">
    <link href="{{ asset('backend/assets/css/ui-elements/pagination.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
    <link href="{{ asset('backend/assets/css/pages/profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/forms/form-widgets.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <style>
        p {
            color: #000000;
        }

        .table>tbody>tr>td {
            color: #000000;
        }
    </style>
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
        @if ($bills_data->date_start)
            <form method="post" action="{{ route('admin/bill/edit_bill') }}">
                @csrf
            @else
            <form method="post" action="{{ route('admin/bill/update_bill') }}">
                @csrf
        @endif



        <input type="hidden" name="code_order" value="{{ $bills_data->code_order }}">
        <input type="hidden" name="customers_id_fk" value="{{ $bills_data->customers_id_fk }}">
        <input type="hidden" name="customers_user_name" value="{{ $bills_data->customers_user_name }}">
        <div class="statbox widget box box-shadow mt-4">


            <div class="row mb-4 ml-2">
                <div class="col-lg-2 mt-2">
                    <label>วันที่เริ่มต้น</label>
                    <?php
                    if (empty($bills_data->date_start) || $bills_data->date_start == '0000-00-00') {
                        $date_start = date('Y-m-d');
                    } else {
                        $date_start = $bills_data->date_start;
                    }

                    ?>
                    <input type="date" class="form-control" name="date_start" placeholder="วันที่เริ่มต้น"
                        value="{{ $date_start }}">
                </div>

                <div class="col-lg-2 mt-2">
                    <label>วันที่สิ้นสุด</label>
                    <?php
                    if (empty($bills_data->date_end) || $bills_data->date_end == '0000-00-00') {
                        $date_end = date('Y-m-t');
                    } else {
                        $date_end = $bills_data->date_end;
                    }

                    ?>
                    <input type="date" class="form-control" name="date_end" placeholder="วันที่สิ้นสุด"
                        value="{{ $date_end }}">
                </div>

                <div class="col-lg-2 mt-2">
                    <label>วันที่อ่านหน่วย</label>
                    <?php
                    if (empty($bills_data->date_read) || $bills_data->date_read == '0000-00-00') {
                        $date_read = date('Y-m-d');
                    } else {
                        $date_read = $bills_data->date_read;
                    }

                    ?>
                    <input type="date" class="form-control" name="date_read" placeholder="วันที่อ่านหน่วย"
                        value="{{ $date_read }}">
                </div>


                <div class="col-lg-2 mt-2">
                    <label>วันครบกำหนดชำระ</label>
                    <?php
                    if (empty($bills_data->date_expri_pay) || $bills_data->date_expri_pay == '0000-00-00') {
                        $date_expri_pay = date('Y-m-t');
                    } else {
                        $date_expri_pay = date('Y-m-d', strtotime($bills_data->date_expri_pay)) ;
                    }

                    ?>
                    <input type="date" class="form-control" name="date_expri_pay" placeholder="วันครบกำหนดชำระ"
                        value="{{ $date_expri_pay }}">
                </div>


                <div class="col-lg-2 mt-2">
                    <label>รอบเดือน</label>
                    <?php
                    $months = [
                        '01' => 'มกราคม',
                        '02' => 'กุมภาพันธ์',
                        '03' => 'มีนาคม',
                        '04' => 'เมษายน',
                        '05' => 'พฤษภาคม',
                        '06' => 'มิถุนายน',
                        '07' => 'กรกฎาคม',
                        '08' => 'สิงหาคม',
                        '09' => 'กันยายน',
                        '10' => 'ตุลาคม',
                        '11' => 'พฤศจิกายน',
                        '12' => 'ธันวาคม',
                    ];

                    if (empty($bills_data->m)) {
                        $m = date('m');
                    } else {
                        $m = $bills_data->m;
                    }

                    ?>
                    @if ($bills_data->date_start)
                        <select class="form-control" name="m" id="m">
                            @foreach ($months as $key => $item)

                                @if ($key == $m)
                                    <option value="{{ $key }}" @if ($key == $m) selected @endif>
                                        {{ $item }}</option>
                                        <?php
                                        $m_text = $item;
                                        ?>
                                @endif
                            @endforeach

                        </select>
                    @else
                        <select class="form-control" name="m" id="m">
                            @foreach ($months as $key => $item)
                                <option value="{{ $key }}" @if ($key == $m) selected @endif>
                                    {{ $item }}</option>
                                    <?php
                                    $m_text = $item;
                                    ?>
                            @endforeach

                        </select>
                    @endif


                </div>
                <div class="col-lg-2 mt-2">
                    <label>ปี</label>
                    <?php
                    if (empty($bills_data->y)) {
                        $y = date('Y');
                    } else {
                        $y = $bills_data->y;
                    }
                    ?>


                    @if ($bills_data->date_start)
                        <input type="text" class="form-control" name="y" placeholder="ปี"
                            value="{{ $y }}" disabled>
                            <input type="hidden" class="form-control" name="y" placeholder="ปี"
                            value="{{ $y }}" >
                    @else
                        <input type="text" class="form-control" name="y" placeholder="ปี"
                            value="{{ $y }}">
                    @endif



                </div>


                <div class="col-lg-2 mt-2">
                    <label> Peak Deman </label>
                    <?php
                    if (empty($bills_data->peak_deman)) {
                        $peak_deman = 0.0;
                    } else {
                        $peak_deman = $bills_data->peak_deman;
                    }
                    ?>
                    <input type="number" name="peak_deman" step="any" class="form-control" placeholder="Peak Deman"
                        value="{{ $peak_deman }}">

                </div>


                <div class="col-lg-2 mt-2">
                    <label> On-Peak </label>
                    <?php
                    if (empty($bills_data->on_peak)) {
                        $on_peak = 0.0;
                    } else {
                        $on_peak = $bills_data->on_peak;
                    }
                    ?>
                    <input type="number" name="on_peak" step="any" class="form-control" placeholder="Peak Deman"
                        value="{{ $on_peak }}">

                </div>

                <div class="col-lg-2 mt-2">
                    <label> Off-Peak </label>
                    <?php
                    if (empty($bills_data->off_peak)) {
                        $off_peak = 0.0;
                    } else {
                        $off_peak = $bills_data->off_peak;
                    }
                    ?>
                    <input type="number" name="off_peak" step="any" class="form-control" placeholder="Peak Deman"
                        value="{{ $off_peak }}">

                </div>
                <div class="col-lg-2 mt-2">
                    <label> Off-Peak [วันหยุด] </label>
                    <?php
                    if (empty($bills_data->off_peak_day_off)) {
                        $off_peak_day_off = 0.0;
                    } else {
                        $off_peak_day_off = $bills_data->off_peak_day_off;
                    }
                    ?>
                    <input type="number" name="off_peak_day_off" step="any" class="form-control"
                        placeholder="Peak Deman" value="{{ $off_peak_day_off }}">

                </div>



                <div class="col-lg-2 mt-2">
                    <label>Status</label>
                    <?php
                    if (empty($bills_data->order_status_id_fk)) {
                        $order_status_id_fk = 1;
                    } else {
                        $order_status_id_fk = $bills_data->order_status_id_fk;
                    }
                    ?>

                @if ($bills_data->date_start)
                <select class="form-control status" name="status" id="status">
                    <option value="{{$order_status_id_fk}}">{{$bills_data->detail}}</option>
                   </select>
                @else
                <select class="form-control status" name="status" id="status">
                    <option value="1">จัดเตรียมเอกสาร</option>
                   </select>
                @endif




                </div>


                <div class="col-lg-2 mb-2" style="margin-top: 42px">

                    <div class="button-list">
                        {{-- <button type="button" class="btn btn-outline-success btn-rounded" id="search-form"><i
                                class="las la-search font-15"></i>
                            ค้นหา</button> --}}
                        @if ($bills_data->date_start)
                            @if ($order_status_id_fk == 1)
                                <button class="btn  btn-sm btn-primary btn-rounded" type="submit"
                                    onclick="return confirm('หากบันทึกเป็น จัดส่งเอกสาร  จะไม่สามารถแก้ไขบิลได้ ยืนยัน?')"><i
                                        class="las la-save font-20"></i>แก้ไข</button>
                            @endif
                        @else
                            <button class="btn  btn-sm btn-primary btn-rounded" type="submit"
                                onclick="return confirm('หากบันทึกเป็น จัดส่งเอกสาร  จะไม่สามารถแก้ไขบิลได้ ยืนยัน?')"><i
                                    class="las la-save font-20"></i>
                                บันทึก</button>
                        @endif


                    </div>
                </div>

            </div>

        </div>
        </form>
    </div>

    @if ($bills_data->date_start)
        <div class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="invoice-container">
                    <div class="content-section  animated animatedFadeInUp fadeInUp">

                        <div class="row inv--head-section">
                            <div class="col-md-9 col-lg-9 col-sm-6 col-12 align-self-center align-self-center">
                                <div class="company-info">
                                    @if ($bills_data->bill_type == 'STC')
                                        <img src="{{ asset('frontend/images/stc.png') }}" width="200">
                                    @endif
                                    @if ($bills_data->bill_type == 'SPP')
                                        <img src="{{ asset('frontend/images/spp.png') }}" width="200">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-6 col-12">
                                <h3 class="in-heading">ใบแจ้งค่าไฟฟ้า</h3>
                            </div>
                        </div>
                        <div class="row inv--detail-section">
                            @if ($bills_data->bill_type == 'STC')
                                <div class="col-md-6 col-lg-6 col-sm-6 align-self-center">
                                    <p class="inv-to">กิจการร่วมค้า สมาร์ท ไทคอน <br>40/13 หมู่1 ถนนลพบุรีราเมศวร์
                                        ตาบลคลองแห จังหวัดสงขลา 90110
                                    </p>
                                    <p class="inv-customer-name">ผู้ติดต่อ : นายธนพล จันทร์คล้าย</p>
                                    <p class="inv-street-addr">โทร : 088-7849613</p>
                                    <br>
                                    <p class="inv-email-address"><b>สถานที่ผู้ประกอบการ</b> <br>
                                        {{ $bills_data->customers_name_bu }}<br>

                                        @if ($bills_address->house_no)
                                            {{ $bills_address->house_no }}
                                        @endif
                                        @if ($bills_address->moo != '-' and $bills_address->moo != '')
                                            หมู่.{{ $bills_address->moo }}
                                        @endif
                                        @if ($bills_address->house_name != '-' and $bills_address->house_name != '')
                                            บ.{{ $bills_address->house_name }}
                                        @endif
                                        @if ($bills_address->soi != '-' and $bills_address->soi != '')
                                            ซอย.{{ $bills_address->soi }}
                                        @endif
                                        @if ($bills_address->road != '-' and $bills_address->road != '')
                                            ถนน.{{ $bills_address->road }}
                                        @endif
                                        @if ($bills_address->district != '-' and $bills_address->district != '')
                                            อำเภอ{{ $bills_address->district }}
                                        @endif
                                        @if ($bills_address->tambon != '-' and $bills_address->tambon != '')
                                            ตำบล{{ $bills_address->tambon }}
                                        @endif
                                        @if ($bills_address->province != '-' and $bills_address->province != '')
                                            จังหวัด{{ $bills_address->province }}
                                        @endif
                                        @if ($bills_address->zipcode)
                                            {{ $bills_address->zipcode }}
                                        @endif

                                    </p>
                                </div>
                            @endif

                            @if ($bills_data->bill_type == 'SPP')
                                <div class="col-md-6 col-lg-6 col-sm-6 align-self-center">
                                    <p class="inv-to">กิจการร่วมค้า สมาร์ท เพาเวอร์ แพลนท์ <br>40/13 หมู่1
                                        ถนนลพบุรีราเมศวร์ ตำบลคลองแห จังหวัดสงขลา 90110</p>
                                    <p class="inv-customer-name">ผู้ติดต่อ : นายธนพล จันทร์คล้าย</p>
                                    <p class="inv-street-addr">โทร : 088-7849613</p>
                                    <br>
                                    <p class="inv-email-address"><b>สถานที่ผู้ประกอบการ</b> <br>
                                        {{ $bills_data->customers_name_bu }}<br>

                                        @if ($bills_address->house_no)
                                            {{ $bills_address->house_no }}
                                        @endif
                                        @if ($bills_address->moo != '-' and $bills_address->moo != '')
                                            หมู่.{{ $bills_address->moo }}
                                        @endif
                                        @if ($bills_address->house_name != '-' and $bills_address->house_name != '')
                                            บ.{{ $bills_address->house_name }}
                                        @endif
                                        @if ($bills_address->soi != '-' and $bills_address->soi != '')
                                            ซอย.{{ $bills_address->soi }}
                                        @endif
                                        @if ($bills_address->road != '-' and $bills_address->road != '')
                                            ถนน.{{ $bills_address->road }}
                                        @endif
                                        @if ($bills_address->district != '-' and $bills_address->district != '')
                                            อำเภอ{{ $bills_address->district }}
                                        @endif
                                        @if ($bills_address->tambon != '-' and $bills_address->tambon != '')
                                            ตำบล{{ $bills_address->tambon }}
                                        @endif
                                        @if ($bills_address->province != '-' and $bills_address->province != '')
                                            จังหวัด{{ $bills_address->province }}
                                        @endif
                                        @if ($bills_address->zipcode)
                                            {{ $bills_address->zipcode }}
                                        @endif

                                    </p>
                                </div>
                            @endif
                            <div class="col-md-3 col-lg-3 col-sm-0 align-self-center">
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-6 ">
                                <p class="inv-detail-title">เลขประจำตัวผู้เสียภาษี: {{ $bills_data->id_card }}</p>
                                <p class="inv-list-number"><span class="inv-title">เลขที่ใบแจ้ง : </span> <span
                                        class="inv-number">{{ $bills_data->code_order }}</span></p>
                                <p class="inv-created-date"><span class="inv-title">วันที่อ่านหน่วย : </span> <span
                                        class="inv-date">{{ date('d/m/Y', strtotime($date_read)) }}</span></p>
                                <p class="inv-created-date"><span class="inv-title">หมายเลขผู้ใช้ไฟ : </span> <span
                                        class="inv-number">{{ $bills_data->sola_no }}</span></p>
                                <p class="inv-created-date"><span class="inv-title">ชื่อผู้ประกอบการ : </span> <span
                                        class="inv-customer-name">{{ $bills_data->customers_name_bu }}</span></p>
                                <p class="inv-created-date"><span class="inv-title">วันครบกำหนดชำระ : </span> <span
                                        class="inv-date">{{ date('d/m/Y', strtotime($bills_data->date_expri_pay)) }}</span></p>

                            </div>



                        </div>
                        <form method="post" action="{{ route('admin/bill/edit_bill_discoute') }}">
                            @csrf
                            <input type="hidden" name="code_order" value="{{ $bills_data->code_order }}">
                        <div class="row inv--product-table-section">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="">
                                            <tr>
                                                <th>รายละเอียดค่าไฟฟ้า</th>
                                                <th class="w-5">ค่าไฟฟ้าเดือนที่แล้ว(กิโลวัตต์)</th>
                                                <th class="w-5">ค่าไฟฟ้าปัจจุบัน(กิโลวัตต์)</th>
                                                <th class="w-5">ค่าไฟฟ้าหักลบ(กิโลวัตต์)</th>
                                                <th class="w-5">ส่วนลด(%)</th>

                                                <th class="text-right" class="w-5">หน่วย/บาท</th>
                                                <th class="text-right" class="w-5">จำนวนเงิน (บาท)</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>ค่าไฟฟ้าเดือนที่แล้ว</td>
                                                @if ($bills_history_old)
                                                    <td>วันที่
                                                        :{{ date('d/m/Y', strtotime($bills_history_old->date_start)) }}-{{ date('d/m/Y', strtotime($bills_history_old->date_end)) }}
                                                    </td>
                                                @else
                                                    <td>ไม่พบข้อมูลบิลเดือนก่อนหน้า</td>
                                                @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>

                                                <td></td>
                                                <td></td>
                                                <td></td>

                                            </tr>
                                            <tr>
                                                <td>ค่าความต้องการพลังงานไฟฟ้า Peak Deman</td>
                                                @if ($bills_history_old)
                                                    <td>{{ number_format($bills_history_old->peak_deman,3, '.', '') }}</td>
                                                @else
                                                    <td></td>
                                                @endif

                                                <td class="">{{ number_format($bills_data->peak_deman,3, '.', '') }}</td>
                                                <td class=""> </td>
                                                <td class="text-right">
                                                    <input type="number" name="peak_deman_discount" style="width: 150px"
                                                        class="form-control" value="{{$bills_data->peak_deman_discount}}">
                                                </td>

                                                <td class="text-right">
                                                    {{ number_format($bills_data->peak_deman_per_unit, 6) }}</td>
                                                <td class="text-right">
                                                    {{ number_format($bills_data->peak_deman_total, 6) }}</td>

                                            </tr>
                                            <tr>
                                                <td>พลังงานไฟฟ้าในช่วงเวลา (หน่วย) On-Peak</td>
                                                @if ($bills_history_old)
                                                    <td>{{ number_format($bills_history_old->on_peak_deman_balance,3, '.', '') }}
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif

                                                <td class=" ">{{ number_format($bills_data->on_peak,3, '.', '') }}</td>
                                                <td class="">{{ number_format($bills_data->on_peak_balance,3, '.', '') }}</td>
                                                <td class="text-right">
                                                    <input type="number" name="on_peak_discount" style="width: 150px"
                                                        class="form-control" value="{{$bills_data->on_peak_discount}}">
                                                </td>

                                                <td class="text-right">
                                                    {{ number_format($bills_data->on_peak_per_unit, 6) }}</td>
                                                <td class="text-right">{{ number_format($bills_data->on_peak_total, 6) }}
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>พลังงานไฟฟ้าในช่วงเวลา (หน่วย) off-Peak</td>
                                                @if ($bills_history_old)
                                                    <td>{{ number_format($bills_history_old->off_peak_total,3, '.', '') }}
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td class=" ">
                                                    {{ number_format($bills_data->off_peak,3, '.', '') }}
                                                </td>
                                                <td class="">{{ number_format($bills_data->off_peak_balance,3, '.', '') }}</td>
                                                <td class="text-right">
                                                    <input type="number" name="off_peak_discount" style="width: 150px"
                                                        class="form-control" value="{{$bills_data->off_peak_discount}}">
                                                </td>

                                                <td class="text-right">
                                                    {{ number_format($bills_data->off_peak_per_unit, 6) }}</td>
                                                <td class="text-right">{{ number_format($bills_data->off_peak_total, 6) }}
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>ค่า FT </td>
                                                @if ($bills_history_old)
                                                    <td>{{ number_format($bills_history_old->ft,3, '.', '') }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>
                                                    {{ number_format($bills_data->on_peak_balance + $bills_data->off_peak_balance,3, '.', '') }}
                                                </td>
                                                <td class="">{{ number_format($bills_data->on_peak + ($bills_data->off_peak + $bills_data->off_peak_day_off),3, '.', '') }}</td>
                                                <td class="text-right">
                                                    <input type="number" name="ft_discount" style="width: 150px"
                                                        class="form-control" value="{{$bills_data->ft_discount}}">
                                                </td>

                                                <td class="text-right">{{ number_format($bills_data->ft_per_unit, 6) }}
                                                </td>
                                                <td class="text-right">{{ number_format($bills_data->ft_total, 6) }}</td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row mt-2">
                            <div class="col-md-4 col-lg-4 col-sm-4 col-12 order-sm-0 order-1">

                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8 col-12 order-sm-1 order-0">
                                <div class="inv--total-amounts text-sm-right">
                                    <div class="row">
                                        <div class="col-sm-6 col-7">
                                            <p class="">รวมเงินค่าไฟฟ้า: </p>
                                        </div>
                                        <div class="col-sm-6 col-5">

                                            <p class="">{{ number_format($bills_data->sum_price, 2) }}</p>
                                        </div>
                                        <div class="col-sm-6 col-7">
                                            <p class="">ภาษีมูลค่าเพิ่ม 7%: </p>
                                        </div>
                                        <div class="col-sm-6 col-5">

                                            <p class="">{{ number_format($bills_data->tax_total, 2) }}</p>
                                        </div>

                                        <div class="col-sm-6 col-7 grand-total-title">
                                            <h4 class="">รวมเงินค่าไฟฟ้าทั้งสิ้น : </h4>
                                        </div>
                                        <div class="col-sm-6 col-5 grand-total-amount">
                                            <h4 class="">{{ number_format($bills_data->total_price, 2) }}</h4>
                                        </div>


                                        <div class="col-sm-6 col-7 grand-total-title">
                                            <h4 class="">รวมเงินค่าไฟฟ้าทั้งสิ้น (ตัวอักษร) : </h4>
                                        </div>
                                        <div class="col-sm-6 col-5 grand-total-amount">
                                            <?php
                                                   $text = \App\Http\Controllers\Admin\BillController::convertNumberToThaiWords($bills_data->total_price);
                                                ?>
                                            <b class="">{{$text}}</b>
                                        </div>



                                        <div class="col-sm-6 col-7 grand-total-title">
                                            <h4 class="">รวมเงินค่าไฟฟ้าทั้งสิ้น (ตัวอักษร): </h4>
                                        </div>
                                        <div class="col-sm-6 col-5 grand-total-amount">


                                                <input type="taxt" name="total_price_text" class="form-control"
                                                placeholder="รวมเงินค่าไฟฟ้าทั้งสิ้น (ตัวอักษร)" value="{{$bills_data->total_price_text}}">
                                        </div>

                                        <div class="col-sm-6 col-7 grand-total-title">
                                            <h4 class=""></h4>
                                        </div>
                                        <div class="col-sm-6 col-5 grand-total-amount">
                                            <br>
                                            <select class="form-control status" name="status" id="status">
                                                <option value="1" @if ($order_status_id_fk == 1) selected @endif>จัดเตรียมเอกสาร</option>
                                                <option value="2" @if ($order_status_id_fk == 2) selected @endif>จัดส่งเอกสาร</option>
                                                <option value="3" @if ($order_status_id_fk == 3) selected @endif>ชำระเรียบร้อย</option>
                                                <option value="4" @if ($order_status_id_fk == 4) selected @endif>ยกเลิก(Cancel)</option>

                                            </select>

                                            @if ($order_status_id_fk == 1)
                                                <button type="submit" class="btn  btn-sm btn-primary btn-rounded mt-4" onclick="return confirm('หากบันทึกเป็น จัดส่งเอกสาร  จะไม่สามารถแก้ไขบิลได้ ยืนยัน?')"><i class="las la-redo-alt font-20"></i>
                                                    คำนวน | บันทึก</button>
                                            @endif



                                            <a href="javascript:void(0);" onclick="print_pdf({{$bills_data->id}})" class="btn  btn-sm btn-warning btn-rounded mt-4"><i class="las la-file-pdf font-20"></i>
                                                Print </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <hr />
                        <div class="row mt-2">
                            <div class="col-sm-6 col-12 order-sm-0 order-1">
                                <p>
                                    <b>เกี่ยวกับบิลค่าไฟฟ้า</b><br>
                                    อ้างอิงอัตราค่าไฟฟ้าดังต่อไปนี้ อัตราตามช่วงเวลาของการใช้ (TOU) สำหรับแรงดัน 22-33 kv
                                    สำหรับแรงดัน 22-33 kv <br>
                                    <b>กำหนดช่วงเวลา On-Peak</b><br>
                                    วันจันทร์-วันศุกร์ และวันพืชมงคล เวลา 09.00 น. จนถึง 22.00 น.<br>
                                    <b> กำหนดช่วงเวลา Off-Peak</b><br>
                                    วันจันทร์-วันศุกร์ เวลา 22.00 น. จนถึง 09.00 น.<br>
                                    วันเสาร์-วันอาทิตย์ , วันแรงงาน และวันหยุดราชการตามปกติ <br>
                                    เวลา 00:00 น. - 24:00 น.<br>
                                    (ไม่รวมวันหยุดชดเชยและวันพืชมงคล)


                                </p>

                            </div>
                            <div class="col-sm-6 col-12 order-sm-0 order-0">
                                <p>
                                    <b>อัตราค่าไฟของการไฟฟ้าส่วนภูมิภาค (กฟภ.) ในปัจจุบัน</b><br>
                                    ช่วงเวลา On-Peak (บาท/kWh) = {{$bills_data->on_peak_per_unit}}<br>
                                    ช่วงเวลา Off-Peak (บาท/kWh) = {{$bills_data->off_peak_per_unit}}<br>
                                    <b> {{$bills_data->ft_text}}</b><br>
                                    Ft (บาท/kWh.) = {{$bills_data->ft_per_unit}} <br>

                                @if ($bills_data->bill_type == 'STC')
                                    <b>อัตราค่าไฟฟ้าของ กิจการร่วมค้า สมาร์ท ไทคอน</b><br>
                                @endif
                                @if ($bills_data->bill_type == 'SPP')
                                <b>อัตราค่าไฟฟ้าของ กิจการร่วมค้า สมาร์ท เพาเวอร์ แพลนท์</b><br>
                                @endif
                                @if($bills_data->on_peak_discount <= 0)
                                ช่วงเวลา On-Peak (บาท/kWh) = {{number_format($bills_data->on_peak_per_unit,3, '.', '')}}<br>

                                @else
                                ช่วงเวลา On-Peak (บาท/kWh) = {{number_format($bills_data->on_peak_per_unit*($bills_data->on_peak_discount/100),3, '.', '')}}  (ส่วนลดอัตราค่าไฟ {{$bills_data->on_peak_discount}}% จาก กฟภ.)<br>

                                @endif


                                @if($bills_data->off_peak_discount <= 0)
                                ช่วงเวลา Off-Peak (บาท/kWh) = {{number_format($bills_data->off_peak_per_unit,3, '.', '')}}<br>

                                @else
                                ช่วงเวลา Off-Peak (บาท/kWh) = {{number_format($bills_data->off_peak_per_unit*($bills_data->off_peak_discount/100),3, '.', '')}}  (ส่วนลดอัตราค่าไฟ {{$bills_data->off_peak_discount}}% จาก กฟภ.)<br>

                                @endif


                                @if($bills_data->ft_discount <= 0)
                                Ft (บาท/kWh.) = {{number_format($bills_data->ft_per_unit,3, '.', '')}}<br>

                                @else
                                Ft (บาท/kWh.) = {{number_format($bills_data->ft_per_unit*($bills_data->ft_discount/100),3, '.', '')}} (ส่วนลดอัตราค่าไฟ {{$bills_data->ft_discount}}% จาก กฟภ.)<br>

                                @endif

                                <b>ผลประหยัดที่ได้ ในเดือน {{$m_text}}</b><br>
                                {{number_format($bills_data->discout_price_total,2)}} <br>

                                </p>

                            </div>
                        </div>
                        <div class="footer-contact">
                            <div class="row">
                                @if ($bills_data->bill_type == 'STC')
                                    <div class="col-sm-12 col-12">

                                        <p class="">ช่องทางการชำระเงิน : ธนาคารกรุงเทพ สาขาตลาดพงศ์เจริญ หาดใหญ่ <br>
                                            ชื่อบัญชี : กิจการร่วมค้า สมาร์ท ไทคอน <br>เลขที่ : 764-0-18148-8</p>
                                    </div>
                                @endif
                                @if ($bills_data->bill_type == 'SPP')
                                    <div class="col-sm-12 col-12">
                                        <p class="">ช่องทางการชำระเงิน : ธนาคารกรุงเทพ สาขาตลาดพงศ์เจริญ หาดใหญ่ <br>
                                            ชื่อบัญชี : กิจการร่วมค้า สมาร์ท เพาเวอร์ แพลนท์ <br>เลขที่ : 764-0-18379-9</p>
                                    </div>
                                @endif



                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif
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

    <script>

        function print_pdf(bill_id){
                Swal.fire({
                                title: 'รอสักครู่...',
                                html: 'ระบบกำลังเตรียมไฟล์ PDF...',
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                            }),

            $.ajax({
                            url: "{{route('admin/print_bill')}}",
                            type: 'get',
                            data: {
                                '_token': '{{ csrf_token()}}',
                                'bill_id': bill_id,

                            },
                            success: function(data){
                                //console.log(data['url']);
                                Swal.close();
                                 const path = data['url'];
                                 window.open(path,"_blank");


                            }
                        });
        }
    </script>
@endsection
