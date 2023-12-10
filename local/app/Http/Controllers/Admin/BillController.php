<?php

namespace App\Http\Controllers\Admin;

use App\Customers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\OrderExport;
use App\Imports\OrderImport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Filesystem\Filesystem;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use DataTables;
use DB;
use Illuminate\Support\Facades\Auth;

use PDF;
use  Maatwebsite\Excel\Facades\Excel;

class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {

        return view('backend/bill_list');
    }

    public function create()
    {

        return view('backend/bill_create');
    }

    public function bill_create_datatable(Request $rs)
    {

      $customers = DB::table('customers')


        ->whereRaw(("case WHEN  '{$rs->s_username}' != ''  THEN  customers.user_name = '{$rs->s_username}' else 1 END"))
        ->whereRaw(("case WHEN  '{$rs->s_first_name}' != ''  THEN  customers.name LIKE '{$rs->s_first_name}%' else 1 END"))
        ->whereRaw(("case WHEN  '{$rs->s_id_card}' != ''  THEN  customers.id_card = '{$rs->s_id_card}' else 1 END"))
        ->orderByDesc('id');

        // ->whereRaw(("case WHEN '{$request['s_date']}' != '' and '{$request['e_date']}' = ''  THEN  date(ewallet.created_at) = '{$request['s_date']}' else 1 END"))
        // ->whereRaw(("case WHEN '{$request['s_date']}' != '' and '{$request['e_date']}' != ''  THEN  date(ewallet.created_at) >= '{$request['s_date']}' and date(ewallet.created_at) <= '{$request['e_date']}'else 1 END"))
        // ->whereRaw(("case WHEN '{$request['s_date']}' = '' and '{$request['e_date']}' != ''  THEN  date(ewallet.created_at) = '{$request['e_date']}' else 1 END"))
        // ->whereRaw(("case WHEN  '{$rs->regis_date_doc}' != ''  THEN  customers.regis_date_doc = '{$rs->regis_date_doc}' else 1 END"))

      // ->get();


      // dd($get_history_doc);

      $sQuery = Datatables::of($customers);
      return $sQuery


        ->addColumn('username', function ($row) {
          return $row->user_name;
        })

        ->addColumn('first_name', function ($row) {
          return $row->name;
        })

        ->addColumn('last_name', function ($row) {
          return $row->last_name;
        })

        ->addColumn('id_card', function ($row) {
          return $row->id_card;
        })


        ->addColumn('customer_status', function ($row) {
          if ($row->status_customer == 'normal') {
            $html = '<span class="badge badge-pill badge-success light">ใช้งาน</span>';
          } elseif ($row->status_customer == 'cancel') {
            $html = '<span class="badge badge-pill badge-danger light">ยกเลิกรหัส</span>';
          } else {
            $html = '';
          }

          return  $html;
        })

        ->addColumn('action', function ($row) {
           $name = $row->name.' '.$row->last_name;

           $html = '<a href="#!" onclick="modal_bill_create(' . $row->id . ',\'' . $name . '\')" class="p-2">
           <i class="las la-plus font-25 text-success"></i></a>';
          return $html; // รวมค่า $html และ $html1 ด้วยเครื่องหมาย .

        })


        ->rawColumns(['customer_status', 'action'])

        ->make(true);
    }



    public function modal_bill_create(Request $rs)
    {


        try {
            DB::BeginTransaction();
            $customers = DB::table('customers')
            ->where('id','=',$rs->customer_id)
            ->first();

            $code_order = \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_order();
            $dataPrepare = [
                'customers_id_fk' => $rs->customer_id,
                'customers_user_name' =>  $customers->user_name,
                'code_order' => $code_order,
                'order_status_id_fk' => 1,

                // 'regis_doc4_status' => 3
            ];



            $get_category = DB::table('bills')
              ->insert($dataPrepare);
            DB::commit();
            return redirect('admin/bill/bill_create_detail/'.$code_order)->withSuccess('สร้างบิลสำเร็จ');
          } catch (Exception $e) {
            DB::rollback();
            return redirect('/admin/bill/create')->withError('เพิ่มหมวดสินค้าไม่สำเร็จ');

          }


    }

    public function bill_create_detail($code)
    {
        $bills = DB::table('bills')
        ->where('code_order','=',$code)
        ->count();
        if($bills>1){
            return redirect('/admin/bill/create')->withError('เลขบิลซ้ำกรุณาลบรายการและทำไหม่');
        }else{
            return view('backend/bill_create_detail')->withSuccess('สร้างบิลสำเร็จ');
        }




    }





}
