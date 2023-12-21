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
                    <label>เดือน</label>


                        <select class="form-control type" name="type" id="m">
                            <option value="01" @if(date('m') == '01') selected @endif>มกราคม</option>
                            <option value="02" @if(date('m') == '02') selected @endif>กุมภาพันธ์</option>
                            <option value="03" @if(date('m') == '03') selected @endif>มีนาคม</option>
                            <option value="04" @if(date('m') == '04') selected @endif>เมษายน</option>
                            <option value="05" @if(date('m') == '05') selected @endif>พฤษภาคม</option>
                            <option value="06" @if(date('m') == '06') selected @endif>มิถุนายน</option>
                            <option value="07" @if(date('m') == '07') selected @endif>กรกฎาคม</option>
                            <option value="08" @if(date('m') == '08') selected @endif>สิงหาคม</option>
                            <option value="09" @if(date('m') == '09') selected @endif>กันยายน</option>
                            <option value="10" @if(date('m') == '10') selected @endif>ตุลาคม</option>
                            <option value="11" @if(date('m') == '11') selected @endif>พฤศจิกายน</option>
                            <option value="12" @if(date('m') == '12') selected @endif>ธันวาคม</option>


                        </select>
                </div>


                <div class="col-lg-2 mt-2">
                    <label>ปี</label>
                    <input type="taxt" class="form-control" name="y" placeholder=""
                        value="{{ date('Y') }}">
                </div>

                <div class="col-lg-2 mt-2">
                    <label>Code</label>
                    <input type="taxt" class="form-control myCustom code_order" name="code_order"
                        placeholder="Code Bill">
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


            <div class="row">
                <div class="modal fade bd-example-modal-lg" id="modal_bill_delete" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header ml-4">
                                <h5 class="modal-title" id="myLargeModalLabel"><b>ยืนยันการลบรายการ</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="las la-times"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-text">
                                <div class="widget-content widget-content-area">
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <form method="post" action="{{ route('admin/delete_bill') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12 mt-2 text-center">
                                                        <input type="hidden" name="id_bill" id="id_bill">
                                                        <input type="hidden" name="d_code_order" id="d_code_order">
                                                        <h4> ยืนยันการลบรายการ </h4>
                                                        <h4 id="code_order"> </h4>
                                                    </div>

                                                    <div class="info-area col-md-12 text-center mt-4 ">
                                                        <button type="submit" class="btn btn-primary btn-md btn-rounded">
                                                            <i class="las la-save"></i> ลบรายการ </button>
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


            <div class="table-responsive mt-2 mb-2">
                <h6>รายการ Bill ทั้งหมด</h6>
                <table id="basic-dt" class="table table-hover" style="width:100%">

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
                    url: '{{ route('admin/bill/bill_lis_datatable') }}',
                    data: function(d) {
                        // d.s_username = $('#s_username').val();
                        d.code_order = $('#code_order').val();
                        d.y = $('#y').val();
                        d.m = $('#m').val();

                    },
                },


                columns: [
                    {
                        data: "date",
                        title: "รอบเดือน",
                        className: "w-10 text-center",
                    },

                    {
                        data: "code_order",
                        title: "COD",
                        className: "w-10",
                    },

                    {
                        data: "customers_name_bu",
                        title: "ชื่อผู้ประกอบการ",
                        className: "w-10",
                    },


                    {
                        data: "tel",
                        title: "เบอร์โทร",
                        className: "w-10",
                    },

                    {
                        data: "id_card",
                        title: "หมายเลขบัตรประชาชน",
                        className: "w-10",
                    },

                    {
                        data: "sola_no",
                        title: "หมายเลขผู้ใช้ไฟ",
                        className: "w-10",
                    },

                    {
                        data: "bill_type",
                        title: "Type",
                        className: "w-10",
                    },

                    {
                        data: "status",
                        title: "Status",
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






        function modal_bill_delete(id,code_order) {
            $("#modal_bill_delete").modal();
            $("#code_order").html(code_order);
            $("#id_bill").val(id);
            $("#d_code_order").val(code_order);



        }
    </script>


@endsection
