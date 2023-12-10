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

        .table > tbody > tr > td {
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
        <div class="statbox widget box box-shadow mt-4">

            <div class="row mb-4 ml-2">
                <div class="col-lg-2 mt-2">
                    <label>วันที่เริ่มต้น</label>
                    <input type="date" class="form-control date_start" name="date_start"
                        placeholder="วันที่เริ่มต้น" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-lg-2 mt-2">
                    <label>วันที่สิ้นสุด</label>
                    <input type="date" class="form-control" name="
                        placeholder="วันที่สิ้นสุด" value="{{ date('Y-m-t') }}">
                </div>

                <div class="col-lg-2 mt-2">
                    <label>วันที่อ่านหน่วย</label>
                    <input type="date" class="form-control" name="date_read"
                        placeholder="วันที่อ่านหน่วย" value="{{ date('Y-m-d') }}">
                </div>


                <div class="col-lg-2 mt-2">
                    <label>วันครบกำหนดชำระ</label>
                    <input type="date" class="form-control" name="date_expri_pay"
                        placeholder="วันครบกำหนดชำระ" value="{{ date('Y-m-t') }}">
                </div>
                <div class="col-lg-2 mt-2">
                    <label>รอบเดือน</label>
                    <input type="text" class="form-control" name="m"
                        placeholder="รอบเดือน" value="{{ date('m') }}">
                </div>
                <div class="col-lg-2 mt-2">
                    <label>ปี</label>
                    <input type="text" class="form-control" name="y"
                        placeholder="วันครบกำหนดชำระ" value="{{ date('Y') }}">
                </div>

                <div class="col-lg-2 mt-2">
                    <label>Status</label>
                    <select class="form-control status" name="type" id="type">
                        <option value="1">จัดเตรียมเอกสาร</option>
                        <option value="2">จัดส่งเอกสาร</option>
                        <option value="3">ชำระเรียบร้อย</option>
                        <option value="4"> ยกเลิก(Cancel)</option>


                    </select>
                </div>

                <div class="col-lg-2 mb-2" style="margin-top: 42px">

                    <div class="button-list">
                        {{-- <button type="button" class="btn btn-outline-success btn-rounded" id="search-form"><i
                                class="las la-search font-15"></i>
                            ค้นหา</button> --}}

                        <button class="btn  btn-sm btn-primary btn-rounded" data-toggle="modal" data-target="#add"><i
                                class="las la-save font-20"></i>
                            บันทึก</button>
                    </div>
                </div>



            </div>




        </div>
    </div>

    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="invoice-container">
                <div class="content-section  animated animatedFadeInUp fadeInUp">

                    <div class="row inv--head-section">
                        <div class="col-md-9 col-lg-9 col-sm-6 col-12 align-self-center align-self-center">
                            <div class="company-info">
                               <img src="{{ asset('frontend/images/logo.png') }}" width="200">
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 col-12">
                            <h3 class="in-heading">ใบแจ้งค่าไฟฟ้า</h3>
                        </div>
                    </div>
                    <div class="row inv--detail-section">
                        <div class="col-md-6 col-lg-6 col-sm-6 align-self-center">
                            <p class="inv-to">กิจการร่วมค้า สมาร์ท เพาเวอร์ แพลนท์ <br>40/13 หมู่1 ถนนลพบุรีราเมศวร์ ตำบลคลองแห จังหวัดสงขลา 90110</p>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-0 align-self-center">
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 ">
                            <p class="inv-detail-title">เลขประจำตัวผู้เสียภาษี 0 9030 00465 73 3</p>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 align-self-center">
                            <p class="inv-customer-name">ผู้ติดต่อ : นายธนพล จันทร์คล้าย</p>
                            <p class="inv-street-addr">โทร : 088-7849613</p>
                            <p class="inv-email-address"><b>สถานที่ผู้ประกอบการ</b> <br>
                                บริษัท ที.เอส.พี.วู้ด จำกัด
                                61/2 หมู่ที่ 5 ตำบลน้ำพุ อำเภอบ้านนาสาร จังหวัดสุราษฎร์ธานี 84140
                            </p>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-0 align-self-center">
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 ">
                            <p class="inv-list-number"><span class="inv-title">เลขที่ใบแจ้ง : </span> <span class="inv-number">SPP2023.10.661031</span></p>
                            <p class="inv-created-date"><span class="inv-title">วันที่อ่านหน่วย : </span> <span class="inv-date">1/11/2023</span></p>
                            <p class="inv-created-date"><span class="inv-title">หมายเลขผู้ใช้ไฟ : </span> <span class="inv-number">2023064232001514</span></p>
                            <p class="inv-created-date"><span class="inv-title">ชื่อผู้ประกอบการ : </span> <span class="inv-customer-name">บริษัท ที.เอส.พี.วู้ด จำกัด</span></p>
                            <p class="inv-created-date"><span class="inv-title">วันครบกำหนดชำระ : </span> <span class="inv-date">1/11/2023</span></p>


                        </div>
                    </div>
                    <div class="row inv--product-table-section">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="">
                                        <tr>
                                            <th >รายละเอียดค่าไฟฟ้า</th>
                                            <th class="w-5">กิโลวัตต์/หน่วย</th>
                                            <th class="text-right" class="w-5">หน่วย/บาท</th>
                                            <th class="text-right" class="w-5">จำนวนเงิน (บาท)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>วันที่ : 01/11/2566-31/11/2566</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <td>ค่าความต้องการพลีงงานไฟฟ้า Peak Deman</td>
                                            <td class="text-right">


                                                        <input type="number" name="peak" style="width: 200px" class="form-control" value="0.00">


                                            <td class="text-right">99.6975</td>
                                            <td class="text-right">0</td>

                                        </tr>
                                        <tr>
                                            <td>พลังงานไฟฟ้าในช่วงเวลา (หน่วย) On-Peak ส่วนลด 25%</td>
                                            <td class="text-right">
                                                <input type="number" name="peak" style="width: 200px" class="form-control" value="0.00">
                                            </td>
                                            <td class="text-right">99.6975</td>
                                            <td class="text-right">0</td>

                                        </tr>

                                        <tr>
                                            <td>พลังงานไฟฟ้าในช่วงเวลา (หน่วย) off-Peak ส่วนลด 25%</td>
                                            <td class="text-right">
                                                <input type="number" name="peak" style="width: 200px" class="form-control" value="0.00">
                                            </td>
                                            <td class="text-right">99.6975</td>
                                            <td class="text-right">0</td>

                                        </tr>

                                        <tr>
                                            <td>ค่า FT - ส่วนลด 25%</td>
                                            <td >123</td>
                                            <td class="text-right">99.6975</td>
                                            <td class="text-right">0</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row mt-2">
                        <div class="col-md-5 col-lg-5 col-sm-5 col-12 order-sm-0 order-1">

                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-7 col-12 order-sm-1 order-0">
                            <div class="inv--total-amounts text-sm-right">
                                <div class="row">
                                    <div class="col-sm-6 col-7">
                                        <p class="">รวมเงินค่าไฟฟ้า: </p>
                                    </div>
                                    <div class="col-sm-6 col-5">
                                        <p class="">$51500</p>
                                    </div>
                                    <div class="col-sm-6 col-7">
                                        <p class="">ภาษีมูลค่าเพิ่ม 7%: </p>
                                    </div>
                                    <div class="col-sm-6 col-5">
                                        <p class="">$200</p>
                                    </div>

                                    <div class="col-sm-6 col-7 grand-total-title">
                                        <h4 class="">รวมเงินค่าไฟฟ้าทั้งสิ้น : </h4>
                                    </div>
                                    <div class="col-sm-6 col-5 grand-total-amount">
                                        <h4 class="">$51200</h4>
                                    </div>
                                    <div class="col-sm-6 col-7 grand-total-title">
                                        <h4 class="">รวมเงินค่าไฟฟ้าทั้งสิ้น (ตัวอักษร): </h4>
                                    </div>
                                    <div class="col-sm-6 col-5 grand-total-amount">
                                        <input type="taxt" class="form-control" name="total_taxt"
                        placeholder="รวมเงินค่าไฟฟ้าทั้งสิ้น (ตัวอักษร)">
                                    </div>

                                    <div class="col-sm-6 col-7 grand-total-title">
                                        <h4 class=""></h4>
                                    </div>
                                    <div class="col-sm-6 col-5 grand-total-amount">
                                        <button class="btn  btn-sm btn-primary btn-rounded mt-4" data-toggle="modal" data-target="#add"><i
                                            class="las la-redo-alt font-20"></i>
                                        คำนวน</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row mt-2">
                        <div class="col-sm-6 col-12 order-sm-0 order-1">
                            <p>
                                <b>เกี่ยวกับบิลค่าไฟฟ้า</b><br>
                                อ้างอิงอัตราค่าไฟฟ้าดังต่อไปนี้ อัตราตามช่วงเวลาของการใช้ (TOU) สำหรับแรงดัน 22-33 kv สำหรับแรงดัน 22-33 kv <br>
                                <b>กำหนดช่วงเวลา On-Peak</b><br>
                                วันจันทร์-วันศุกร์ และวันพืชมงคล เวลา 09.00 น. จนถึง 22.00 น.<br>
                                <b> กำหนดช่วงเวลา Off-Peak</b><br>
                                วันจันทร์-วันศุกร์ เวลา 22.00 น. จนถึง 09.00 น.<br>
                                วันเสาร์-วันอาทิตย์ , วันแรงงาน และวันหยุดราชการตามปกติ <br>
                                เวลา 00:00 น. -24:00 น.<br>
                                (ไม่รวมวันหยุดชดเชยและวันพืชมงคล)


                            </p>

                        </div>
                        <div class="col-sm-6 col-12 order-sm-0 order-0">
                            <p>
                                <b>อัตราค่าไฟของการไฟฟ้าส่วนภูมิภาค (กฟภ.) ในปัจจุบัน</b><br>
                                ช่วงเวลา On-Peak (บาท/kWh) = 4.1839<br>
                                ช่วงเวลา Off-Peak (บาท/kWh) = 2.6037<br>
                                <b>ค่า FT กันยายน 2566 - ธันวาคม 2566</b><br>
                                Ft (บาท/kWh.) = 0.2048 <br>
                                <b>อัตราค่าไฟฟ้าของ กิจการร่วมค้า สมาร์ท เพาเวอร์ แพลนท์</b><br>
                                ช่วงเวลา On-Peak (บาท/kWh) = 3.137925 (ส่วนลดอัตราค่าไฟ 25% จาก กฟภ.)<br>
                                ช่วงเวลา Off-Peak (บาท/kWh) = 1.952775 (ส่วนลดอัตราค่าไฟ 25% จาก กฟภ.)<br>
                                Ft (บาท/kWh.) = 0.153600 (ส่วนลดอัตราค่าไฟ 25% จาก กฟภ.)<br>
                                <b>ผลประหยัดที่ได้ ในเดือน ตุลาคม</b><br>
                                  0.2048 <br>


                            </p>

                        </div>
                    </div>
                    <div class="footer-contact">
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <p class="">ช่องทางการชำระเงิน : ธนาคารกรุงเทพ สาขาตลาดพงศ์เจริญ หาดใหญ่ <br> ชื่อบัญชี : กิจการร่วมค้า สมาร์ท เพาเวอร์ แพลนท์ <br>เลขที่ : 764-0-18379-9</p>
                            </div>
                        </div>
                    </div>
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


@endsection
