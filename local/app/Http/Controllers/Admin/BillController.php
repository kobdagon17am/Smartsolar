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


            $address_card = DB::table('customers_address_card')
            ->select('customers_address_card.*', 'dataset_districts.name_th as tambon_name','dataset_provinces.name_th as changwat','dataset_amphures.name_th as amphure_name')
            ->leftJoin('dataset_districts', 'customers_address_card.card_tambon_id_fk', '=', 'dataset_districts.id')
            ->leftJoin('dataset_amphures', 'customers_address_card.card_district_id_fk', '=', 'dataset_amphures.id')
            ->leftJoin('dataset_provinces', 'customers_address_card.card_province_id_fk', '=', 'dataset_provinces.id')
            ->where('customers_address_card.customer_id', $rs->customer_id)
            ->first();

            $code_order = \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_order($rs->bill_type);
            if( $customers->name_bu && $customers->name_bu != '-' ){
                $customers_name_bu = $customers->name_bu;
            }else{
                $customers_name_bu = $customers->name.' '.$customers->last_name;

            }

            if($rs->bill_type == 1){
                $prefix = 'STC';
            }else{
                $prefix = 'SPP';
            }


            $dataPrepare = [
                'customers_id_fk' => $rs->customer_id,
                'customers_user_name' =>  $customers->user_name,
                'code_order' => $code_order,
                'order_status_id_fk' => 1,
                'id_card'=>$customers->id_card,
                'sola_no'=>$customers->sola_no,
                'customers_name_bu'=>$customers_name_bu,
                'house_no'=>$address_card->card_house_no,
                'house_name'=>$address_card->card_home_name,
                'moo'=> $address_card->card_moo,
                'soi'=> $address_card->card_soi,
                'road'=> $address_card->card_road,
                'tambon_id'=> $address_card->card_tambon_id_fk,
                'district_id'=> $address_card->card_district_id_fk,
                'province_id'=> $address_card->card_province_id_fk,
                'zipcode'=> $address_card->card_zipcode,
                'tel'=> $customers->phone,
                'name'=> $customers_name_bu,
                'bill_type'=> $prefix,

                // 'regis_doc4_status' => 3
            ];

            $get_category = DB::table('bills')
              ->insert($dataPrepare);
            DB::commit();
            return redirect('admin/bill/bill_create_detail/'.$code_order)->withSuccess('สร้างบิลสำเร็จ');
          } catch (Exception $e) {
            DB::rollback();
            return redirect('/admin/bill/create')->withError('สร้างบิลไม่สำเร็จ');

          }


    }

    public function bill_create_detail($code)
    {
        $bills = DB::table('bills')
        ->where('code_order','=',$code)
        ->count();

        if($bills>1){
            return redirect('/admin/bill/create')->withError('สร้างบิลไม่สำเร็จ');
        }else{
            $bills_data = DB::table('bills')

            ->where('bills.code_order','=',$code)
            ->first();

            $bills_history = DB::table('bills_history')
            ->orderbyDesc('id')
            ->first();

            $bills_address = DB::table('bills')
            ->select(
                'house_no',
                'house_name',
                'moo',
                'soi',
                'road',
                'dataset_districts.name_th as district',
                'dataset_provinces.name_th as province',
                'dataset_amphures.name_th as tambon',
                'bills.zipcode',
                'tel',
            )
            ->leftjoin('dataset_provinces', 'dataset_provinces.id', '=', 'bills.province_id')
            ->leftjoin('dataset_amphures', 'dataset_amphures.id', '=', 'bills.district_id')
            ->leftjoin('dataset_districts', 'dataset_districts.id', '=', 'bills.tambon_id')
            ->where('code_order', $code)
            ->first();

            return view('backend/bill_create_detail',compact('bills_data','bills_history','bills_address'))->withSuccess('สร้างบิลสำเร็จ');
        }


    }


    public function update_bill(Request $rs)
    {

        $dataPrepare = [
            'date_start' =>  $rs->date_start,
            'date_end' => $rs->date_end,
            'date_read' =>  $rs->date_read,
            'date_expri_pay' =>  $rs->date_expri_pay,
            'm' =>$rs->m,
            'y' =>$rs->y,
            'order_status_id_fk' =>$rs->status,
            'peak_deman' =>$rs->peak_deman,
            'on_peak' =>$rs->on_peak,
            'off_peak' =>$rs->off_peak,
            'off_peak_day_off' =>$rs->off_peak_day_off,

        ];

        $bills = DB::table('bills')
        ->where('code_order','=',$rs->code_order)
        ->update($dataPrepare);

        if($bills){
            return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withSuccess('Success');
        }else{
            return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withError('Fail');
        }


    }









}
