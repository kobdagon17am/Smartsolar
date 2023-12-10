@extends('layouts.backend.app')
@section('css')

@endsection
@section('page-header')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"> ออกบิล </a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>สร้างบิล</span></li>
    </ol>
</nav>
@endsection
@section('content')
<div class="row layout-top-spacing">
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow mb-4">
            {{-- <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Picker</h4>
                    </div>
                </div>
            </div> --}}
            <div class="widget-content widget-content-area">

                <div class="row mb-4 ml-2">


                    <div class="col-lg-2 mt-2">
                        <input type="text" class="form-control" name="username" id="s_username" placeholder="รหัสสมาชิก">
                    </div>
                    <div class="col-lg-2 mt-2">
                        <input type="text" class="form-control" name="first_name" id="s_first_name" placeholder="ชื่อสมาชิก">
                    </div>
                    <div class="col-lg-2 mt-2">
                        <input type="text" class="form-control" name="id_card" id="s_id_card" placeholder="หมายเลขบัตรประชาชน">
                    </div>

                    <div class="col-lg-4 mb-2">


                        <div class="button-list mt-2">
                            <button type="button" class="btn btn-outline-success btn-rounded" id="search-form"><i class="las la-search font-15"></i>
                                ค้นหา</button>

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

            <div class="row">
                <div class="modal fade bd-example-modal-lg" id="modal_cretate" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header ml-4">
                                <h5 class="modal-title" id="myLargeModalLabel"><b>สร้างบิล</b>  </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="las la-times"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-text">
                                <div class="widget-content widget-content-area">
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <form method="post" action="{{ route('admin/bill/modal_bill_create') }}">
                                                @csrf
                                                <div class="row" class="text-center">
                                                    <div class="col-md-12 text-center">
                                                       <p> <h3 id="customer_name"> </h3></p>
                                                    </div>

                                                    <input type="hidden" name="customer_id" id="customer_id">
                                                    {{-- <div class="col-lg-6 mt-2">

                                                        <input type="hidden" name="customer_id" id="customer_id">

                                                    </div> --}}
{{--
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="card_amphur">เลือกประเภทบิล
                                                                <span class="text-danger">*</span></label>
                                                            <select name="bill_type" class="form-control"
                                                                id="bill_type" required>

                                                                <option value="1">Bill: 00001</option>
                                                                <option value="2">Bill: 00002</option>

                                                            </select>
                                                        </div>
                                                    </div> --}}



                                                    <div class="info-area col-md-12 text-center mt-4 ">
                                                        <button type="submit" class="btn btn-info btn-rounded"
                                                        value="confirm">
                                                            <i class="las la-save"></i>
                                                            สร้างบิล</button>
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
                    url: '{{ route('admin/bill/bill_create_datatable') }}',
                    data: function(d) {
                        d.s_username = $('#s_username').val();

                        d.s_first_name = $('#s_first_name').val();
                        d.s_id_card = $('#s_id_card').val();

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
                        title: "หมายเลขบัตรประชาชน",
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






        function modal_bill_create(id,name) {
            $("#modal_cretate").modal();
            $("#customer_id").val(id);
            $("#customer_name").html(name);


        }
    </script>
@endsection
