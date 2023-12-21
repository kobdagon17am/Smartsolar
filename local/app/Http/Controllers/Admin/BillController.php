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


    public function bill_lis_datatable(Request $rs)
    {

      $customers = DB::table('bills')
        ->select('bills.*','dataset_order_status.detail','dataset_order_status.css_class')
        ->leftJoin('dataset_order_status', 'bills.order_status_id_fk', '=', 'dataset_order_status.orderstatus_id')
        ->whereRaw(("case WHEN  '{$rs->code_order}' != ''  THEN  bills.code_order = '{$rs->code_order}' else 1 END"))
        ->whereRaw(("case WHEN  '{$rs->y}' != ''  THEN  bills.y = '{$rs->y}' else 1 END"))
        ->whereRaw(("case WHEN  '{$rs->m}' != ''  THEN  bills.m = '{$rs->m}' else 1 END"))
        ->orderByDesc('id');

        // ->whereRaw(("case WHEN '{$request['s_date']}' != '' and '{$request['e_date']}' = ''  THEN  date(ewallet.created_at) = '{$request['s_date']}' else 1 END"))
        // ->whereRaw(("case WHEN '{$request['s_date']}' != '' and '{$request['e_date']}' != ''  THEN  date(ewallet.created_at) >= '{$request['s_date']}' and date(ewallet.created_at) <= '{$request['e_date']}'else 1 END"))
        // ->whereRaw(("case WHEN '{$request['s_date']}' = '' and '{$request['e_date']}' != ''  THEN  date(ewallet.created_at) = '{$request['e_date']}' else 1 END"))
        // ->whereRaw(("case WHEN  '{$rs->regis_date_doc}' != ''  THEN  customers.regis_date_doc = '{$rs->regis_date_doc}' else 1 END"))

      // ->get();


      // dd($get_history_doc);

      $sQuery = Datatables::of($customers);
      return $sQuery

      ->addColumn('date', function ($row) {
        return $row->m.'/'.$row->y;
      })

        // ->addColumn('customer_status', function ($row) {
        //   if ($row->status_customer == 'normal') {
        //     $html = '<span class="badge badge-pill badge-success light">ใช้งาน</span>';
        //   } elseif ($row->status_customer == 'cancel') {
        //     $html = '<span class="badge badge-pill badge-danger light">ยกเลิกรหัส</span>';
        //   } else {
        //     $html = '';
        //   }

        //   return  $html;
        // })

        ->addColumn('action', function ($row) {

            $html = '<i class="lab la-whmcs font-25 text-warning" id="btnGroupDrop1" data-toggle="dropdown" aria-expanded="false"></i>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="will-change: transform;">

            <a class="dropdown-item" href="'.route('admin/bill/bill_create_detail',['code'=>$row->code_order]).'"  >ดูรายละเอียด</a>
            <a class="dropdown-item" href="#!" onclick="print_pdf('.$row->id.')" >PDF</a>
            <a class="dropdown-item" href="#!"  onclick="print_pdf(' . $row->id . ',\'' .$row->code_order. '\')">ลบรายการ</a>
          </div>';

          return $html; // รวมค่า $html และ $html1 ด้วยเครื่องหมาย .

        })

        ->addColumn('status', function ($row) {

            $html = '<span class="badge badge-pill badge-'.$row->css_class.' light">'.$row->detail.'</span>';
           return $html; // รวมค่า $html และ $html1 ด้วยเครื่องหมาย .

         })


        ->rawColumns(['status', 'action'])

        ->make(true);
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
           $name = $row->name_bu;


           $html = '<a href="#!" onclick="modal_bill_create(' . $row->id . ',\'' . $name . '\')" class="p-2">
           <i class="las la-plus font-25 text-success"></i></a> ';
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
            ->select('bills.*','dataset_order_status.detail','dataset_order_status.css_class')
            ->leftJoin('dataset_order_status', 'bills.order_status_id_fk', '=', 'dataset_order_status.orderstatus_id')
            ->where('bills.code_order','=',$code)
            ->first();



            $his_m =  $bills_data->m-1;
            $his_y =  $bills_data->y;
            if($his_m == 0 ){
                $his_m = '12';
                $his_y =  $bills_data->y - 1;
            }




            $bills_history_old = DB::table('bills_history')
            ->where('m','=',$his_m)
            ->where('y','=',$his_y)
            ->where('customers_id_fk','=',$bills_data->customers_id_fk)
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

            return view('backend/bill_create_detail',compact('bills_data','bills_address','bills_history_old'))->withSuccess('สร้างบิลสำเร็จ');
        }


    }




    public function delete_bill(Request $rs)
    {

        try {
            DB::BeginTransaction();


            $bills = DB::table('bills')
            ->where('id','=',$rs->id_bill)
            ->delete();

            $bills_history = DB::table('bills_history')
            ->where('code_order','=',$rs->d_code_order)
            ->delete();



            if($bills){
                DB::commit();
                return redirect('admin/bill/list')->withSuccess('Success');
            }else{
                DB::rollback();
                return redirect('admin/bill/list')->withError('Fail');
            }

          } catch (Exception $e) {
            DB::rollback();
            return redirect('admin/bill/list')->withError('Fail');

          }
    }

    public function update_bill(Request $rs)
    {

        $bill_data_count = DB::table('bills')
        ->where('code_order','=',$rs->code_order)
        ->count();

        if($bill_data_count>1){
            return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withError('มีเลขบิลนี้ซ้ำกรุณาลบออก 1 รายการ '.$rs->code_order);
        }

        $bill_data = DB::table('bills')
        ->where('code_order','=',$rs->code_order)
        ->first();


        $bills_history = DB::table('bills_history')
        ->where('customers_id_fk','=', $bill_data->customers_id_fk)
        ->where('m','=',$rs->m)
        ->where('y','=',$rs->y)
        ->first();

        if($bills_history){
            return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withError('มีบิลที่ถูกสร้างในเดือนนี้แล้ว หากต้องการสร้างไหม่กรุณาลบบิล '.$bills_history->code_order);
        }else{



            $his_m = $rs->m-1;
            $his_y = $rs->y;
            if($his_m == 0 ){
                $his_m = '12';
                $his_y = $rs->y - 1;
            }

            $bills_history_old = DB::table('bills_history')
            ->where('customers_id_fk','=', $bill_data->customers_id_fk)
            ->where('m','=',$his_m)
            ->where('y','=',$his_y)
            ->first();

            if($bills_history_old){
                $on_peak_deman_balance = $rs->on_peak -  $bills_history_old->on_peak;

                $off_peak_total = $rs->off_peak+$rs->off_peak_day_off;
                $off_peak_total_balance = $off_peak_total - $bills_history_old->off_peak_total;

                $dataPrepare_bills_history = [
                    'customers_id_fk' =>  $rs->customers_id_fk,
                    'customers_user_name' => $rs->customers_user_name,
                    'code_order' =>  $rs->code_order,
                    'peak_deman' =>$rs->peak_deman,
                    'on_peak' =>  $rs->on_peak,
                    'on_peak_deman_old' => $bills_history_old->on_peak,
                    'on_peak_deman_balance' => $on_peak_deman_balance,
                    'off_peak' =>$rs->off_peak,
                    'off_peak_day_off' =>$rs->off_peak_day_off,
                    'off_peak_total' =>$off_peak_total,
                    'off_peak_total_old' =>$bills_history_old->off_peak_total,
                    'off_peak_total_balance' =>$off_peak_total_balance,
                    'ft' =>$on_peak_deman_balance+$off_peak_total_balance,
                    'date_start' => $rs->date_start,
                    'date_end' => $rs->date_end,
                    'm' =>$rs->m,
                    'y' =>$rs->y,

                ];


            }else{
                $on_peak_deman_balance = $rs->on_peak;
                $off_peak_total_balance = $rs->off_peak + $rs->off_peak_day_off;

                $off_peak_total = $off_peak_total_balance;
                $dataPrepare_bills_history = [
                    'customers_id_fk' =>  $rs->customers_id_fk,
                    'customers_user_name' => $rs->customers_user_name,
                    'code_order' =>  $rs->code_order,
                    'peak_deman' =>$rs->peak_deman,
                    'on_peak' =>  $rs->on_peak,
                    'on_peak_deman_old' =>0,
                    'on_peak_deman_balance' =>$on_peak_deman_balance,
                    'off_peak' =>$rs->off_peak,
                    'off_peak_day_off' =>$rs->off_peak_day_off,
                    'off_peak_total' =>$off_peak_total,
                    'off_peak_total_old' =>0,
                    'off_peak_total_balance' => $off_peak_total_balance,
                    'ft' =>$on_peak_deman_balance + $off_peak_total_balance,
                    'date_start' =>  $rs->date_start,
                    'date_end' => $rs->date_end,
                    'm' =>$rs->m,
                    'y' =>$rs->y,

                ];



            }


        $peak_deman_unit = DB::table('dataset_sola')
        ->where('code','=',1)
        ->first();

        $on_peak_unit = DB::table('dataset_sola')
        ->where('code','=',2)
        ->first();

        $off_peak_unit = DB::table('dataset_sola')
        ->where('code','=',3)
        ->first();

        $ft_unit = DB::table('dataset_sola')
        ->where('code','=',4)
        ->first();

        $peak_deman_total = $rs->peak_deman * $peak_deman_unit->unit;

        $on_peak_total =$on_peak_deman_balance * $on_peak_unit->unit;


        $off_peak_total = $off_peak_total_balance * $off_peak_unit->unit;
        $ft_total = ($on_peak_deman_balance + $off_peak_total_balance)*$ft_unit->unit;
        $sum_price = $peak_deman_total+$on_peak_total+$off_peak_total+$ft_total;
        $tax_total = $sum_price*7/100;
        $dataPrepare = [
            'date_start' =>  $rs->date_start,
            'date_end' => $rs->date_end,
            'date_read' =>  $rs->date_read,
            'date_expri_pay' =>  $rs->date_expri_pay,
            'm' =>$rs->m,
            'y' =>$rs->y,
            'order_status_id_fk' =>$rs->status,

            'peak_deman' =>$rs->peak_deman,
            'peak_deman_discount' =>0,
            'peak_deman_per_unit' =>$peak_deman_unit->unit,
            'peak_deman_total' =>$peak_deman_total,

            'on_peak' =>$rs->on_peak,
            'on_peak_balance' =>$on_peak_deman_balance,

            'on_peak_per_unit' =>$on_peak_unit->unit,
            'on_peak_discount' =>0,
            'on_peak_total' =>$on_peak_total,

            'off_peak' =>$rs->off_peak,
            'off_peak_day_off' =>$rs->off_peak_day_off,
            'off_peak_per_unit' =>$off_peak_unit->unit,
            'off_peak_discount' =>0,
            'off_peak_total' =>$off_peak_total,
            'off_peak_balance' =>$off_peak_total_balance,

            'ft' =>$on_peak_deman_balance + $off_peak_total_balance,
            'ft_per_unit' =>$ft_unit->unit,
            'ft_discount' =>0,
            'ft_text' =>$ft_unit->text,
            'ft_total' =>$ft_total,
            'sum_price'=> $sum_price,
            'tax_total'=>  $tax_total,
            'total_price'=> $sum_price+$tax_total,


        ];


        try {
            DB::BeginTransaction();
            $bills_history = DB::table('bills_history')
            ->insert($dataPrepare_bills_history);

            $bills = DB::table('bills')
            ->where('code_order','=',$rs->code_order)
            ->update($dataPrepare);



            if($bills){
                DB::commit();
                return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withSuccess('Success');
            }else{
                DB::rollback();
                return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withError('Fail');
            }

          } catch (Exception $e) {
            DB::rollback();
            return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withError('Fail');

          }


        }



    }


    public function edit_bill(Request $rs)
    {

        $bill_data_count = DB::table('bills')
        ->where('code_order','=',$rs->code_order)
        ->count();

        if($bill_data_count>1){
            return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withError('มีเลขบิลนี้ซ้ำกรุณาลบออก 1 รายการ '.$rs->code_order);
        }

            $bill_data = DB::table('bills')
            ->where('code_order','=',$rs->code_order)
            ->first();

            $his_m = $rs->m-1;
            $his_y = $rs->y;
            if($his_m == 0 ){
                $his_m = '12';
                $his_y = $rs->y - 1;
            }

            $bills_history_old = DB::table('bills_history')
            ->where('customers_id_fk','=', $bill_data->customers_id_fk)
            ->where('m','=',$his_m)
            ->where('y','=',$his_y)
            ->first();

            if($bills_history_old){

                $on_peak_deman_balance = $rs->on_peak -  $bills_history_old->on_peak;

                $off_peak_total = $rs->off_peak+$rs->off_peak_day_off;
                $off_peak_total_balance = $off_peak_total - $bills_history_old->off_peak_total;


                $dataPrepare_bills_history = [
                    'customers_id_fk' =>  $rs->customers_id_fk,
                    'customers_user_name' => $rs->customers_user_name,
                    'code_order' =>  $rs->code_order,
                    'peak_deman' =>$rs->peak_deman,
                    'on_peak' =>  $rs->on_peak,
                    'on_peak_deman_old' => $bills_history_old->on_peak,
                    'on_peak_deman_balance' => $on_peak_deman_balance,
                    'off_peak' =>$rs->off_peak,
                    'off_peak_day_off' =>$rs->off_peak_day_off,
                    'off_peak_total' =>$off_peak_total,
                    'off_peak_total_old' =>$bills_history_old->off_peak_total,
                    'off_peak_total_balance' =>$off_peak_total_balance,
                    'ft' =>$on_peak_deman_balance+$off_peak_total_balance,
                    'date_start' => $rs->date_start,
                    'date_end' => $rs->date_end,

                ];

            }else{

                $on_peak_deman_balance = $rs->on_peak;
                $off_peak_total_balance = $rs->off_peak+$rs->off_peak_day_off;

                $off_peak_total = $off_peak_total_balance;
                $dataPrepare_bills_history = [
                    'customers_id_fk' =>  $rs->customers_id_fk,
                    'customers_user_name' => $rs->customers_user_name,
                    'code_order' =>  $rs->code_order,
                    'peak_deman' =>$rs->peak_deman,
                    'on_peak' =>  $rs->on_peak,
                    'on_peak_deman_old' =>0,
                    'on_peak_deman_balance' =>$on_peak_deman_balance,
                    'off_peak' =>$rs->off_peak,
                    'off_peak_day_off' =>$rs->off_peak_day_off,
                    'off_peak_total' =>$off_peak_total,
                    'off_peak_total_old' =>0,
                    'off_peak_total_balance' => $off_peak_total_balance,
                    'ft' =>$on_peak_deman_balance + $off_peak_total_balance,
                    'date_start' =>  $rs->date_start,
                    'date_end' => $rs->date_end,


                ];



            }

        $peak_deman_unit = DB::table('dataset_sola')
        ->where('code','=',1)
        ->first();

        $on_peak_unit = DB::table('dataset_sola')
        ->where('code','=',2)
        ->first();

        $off_peak_unit = DB::table('dataset_sola')
        ->where('code','=',3)
        ->first();

        $ft_unit = DB::table('dataset_sola')
        ->where('code','=',4)
        ->first();

        $peak_deman_total = $rs->peak_deman * $peak_deman_unit->unit;

        $on_peak_total =$on_peak_deman_balance * $on_peak_unit->unit;


        $off_peak_total = $off_peak_total_balance * $off_peak_unit->unit;
        $ft_total = ($on_peak_deman_balance + $off_peak_total_balance) *$ft_unit->unit;
        $sum_price = $peak_deman_total+$on_peak_total+ $ft_total + $off_peak_total;
        $tax_total = $sum_price*7/100;
        $dataPrepare = [
            'date_start' =>  $rs->date_start,
            'date_end' => $rs->date_end,
            'date_read' =>  $rs->date_read,
            'date_expri_pay' =>  $rs->date_expri_pay,
            'order_status_id_fk' =>$rs->status,

            'peak_deman' =>$rs->peak_deman,
            'peak_deman_discount' =>0,
            'peak_deman_per_unit' =>$peak_deman_unit->unit,
            'peak_deman_total' =>$peak_deman_total,

            'on_peak' =>$rs->on_peak,
            'on_peak_balance' =>$on_peak_deman_balance,

            'on_peak_per_unit' =>$on_peak_unit->unit,
            'on_peak_discount' =>0,
            'on_peak_total' =>$on_peak_total,

            'off_peak' =>$rs->off_peak,
            'off_peak_day_off' =>$rs->off_peak_day_off,
            'off_peak_per_unit' =>$off_peak_unit->unit,
            'off_peak_discount' =>0,
            'off_peak_total' =>$off_peak_total,
            'off_peak_balance' =>$off_peak_total_balance,

            'ft' =>$on_peak_deman_balance + $off_peak_total_balance,
            'ft_per_unit' =>$ft_unit->unit,
            'ft_discount' =>0,
            'ft_text' =>$ft_unit->text,
            'ft_total' =>$ft_total,
            'sum_price'=> $sum_price,
            'tax_total'=>  $tax_total,
            'total_price'=> $sum_price+$tax_total,


        ];



        try {
            DB::BeginTransaction();
            $bills_history = DB::table('bills_history')
            ->where('code_order','=',$rs->code_order)
            ->update($dataPrepare_bills_history);

            $bills = DB::table('bills')
            ->where('code_order','=',$rs->code_order)
            ->update($dataPrepare);



            if($bills){
                DB::commit();
                return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withSuccess('Success');
            }else{
                DB::rollback();
                return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withError('Fail');
            }

          } catch (Exception $e) {
            DB::rollback();
            return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withError('Fail');

          }



    }

    public function edit_bill_discoute(Request $rs)
    {


        $bill_data_count = DB::table('bills')
        ->where('code_order','=',$rs->code_order)
        ->count();

        if($bill_data_count>1){
            return redirect('admin/bill/bill_create_detail/'.$rs->code_order)->withError('มีเลขบิลนี้ซ้ำกรุณาลบออก 1 รายการ '.$rs->code_order);
        }

            $bill_data = DB::table('bills')
            ->where('code_order','=',$rs->code_order)
            ->first();

            $peak_deman_total_old = $bill_data->peak_deman * $bill_data->peak_deman_per_unit;

            if($rs->peak_deman_discount > 0){
                $peak_deman_total =$peak_deman_total_old-($peak_deman_total_old*($rs->peak_deman_discount/100));
                $discout_price_peak = $peak_deman_total_old*($rs->peak_deman_discount/100);
            }else{
                $peak_deman_total = $peak_deman_total_old;
                $discout_price_peak = 0;
            }

            $on_peak_total_old = $bill_data->on_peak_balance * $bill_data->on_peak_per_unit;

            if($rs->on_peak_discount > 0){
                $on_peak_total =$on_peak_total_old -($on_peak_total_old *($rs->on_peak_discount/100));
                $discout_price_on = $on_peak_total_old *($rs->on_peak_discount/100);
            }else{
                $on_peak_total = $on_peak_total_old;
                $discout_price_on = 0;
            }

            $of_peak_total_old = $bill_data->off_peak_balance * $bill_data->off_peak_per_unit;

            if($rs->off_peak_discount > 0){
                $off_peak_total =$of_peak_total_old-($of_peak_total_old*($rs->off_peak_discount/100));
                $discout_price_of =$of_peak_total_old*($rs->off_peak_discount/100);
            }else{
                $off_peak_total =$of_peak_total_old;
                $discout_price_of = 0;
            }

            $ft_total_old =  ($bill_data->on_peak_balance + $bill_data->off_peak_balance )*$bill_data->ft_per_unit;

            if($rs->ft_discount > 0){
                $ft_total =$ft_total_old-($ft_total_old*($rs->ft_discount/100));

                $discout_price_ft = $ft_total_old*($rs->ft_discount/100);
            }else{
                $ft_total =$ft_total_old;
                $discout_price_ft = 0;
            }

            $discout_price_total = $discout_price_peak+$discout_price_on+ $discout_price_of;

            $sum_price =$peak_deman_total+ $on_peak_total+$off_peak_total+$ft_total;
            // dd($peak_deman_total,$on_peak_total,$off_peak_total,$ft_total,$sum_price);
            $tax_total =  $sum_price*7/100;
            $total_price =  $sum_price+$tax_total;



        $dataPrepare = [

            'peak_deman_discount' =>$rs->peak_deman_discount,
            'peak_deman_total' =>$peak_deman_total,

            'on_peak_discount' =>$rs->on_peak_discount,
            'on_peak_total' =>$on_peak_total,

            'off_peak_discount' =>$rs->off_peak_discount,
            'off_peak_total' =>$off_peak_total,

            'ft_discount' =>$rs->ft_discount,
            'ft_total' =>$ft_total,

            'discout_price_total' =>$discout_price_total,
            'order_status_id_fk' =>$rs->status,
            'sum_price'=> $sum_price,
            'tax_total'=>  $tax_total,
            'total_price'=> $total_price,
            'total_price'=> $total_price,
            'total_price_text' =>$rs->total_price_text,
        ];

        try {
            DB::BeginTransaction();
            $bills = DB::table('bills')
            ->where('code_order','=',$rs->code_order)
            ->update($dataPrepare);


            if($bills){
                DB::commit();
                return redirect('admin/bill/bill_create_detail/'.$bill_data->code_order)->withSuccess('Success');
            }else{
                DB::rollback();
                return redirect('admin/bill/bill_create_detail/'.$bill_data->code_order)->withError('Fail');
            }

          } catch (Exception $e) {
            DB::rollback();
            return redirect('admin/bill/bill_create_detail/'.$bill_data->code_order)->withError('Fail');

          }



    }


    public static function convertNumberToThaiWords($number)
    {
        //App\Http\Controllers\Admin\BillController::convertNumberToThaiWords();
        $thaiNumbers = [
            0 => 'ศูนย์',
            1 => 'หนึ่ง',
            2 => 'สอง',
            3 => 'สาม',
            4 => 'สี่',
            5 => 'ห้า',
            6 => 'หก',
            7 => 'เจ็ด',
            8 => 'แปด',
            9 => 'เก้า'
        ];

        $unitPositions = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน'];

        $splitNumber = explode('.', $number);
        $integerPart = $splitNumber[0];
        $decimalPart = isset($splitNumber[1]) ? $splitNumber[1] : '00';

        $integerWords = '';
        $decimalWords = '';

        // แปลงส่วนจำนวนเต็ม
        for ($i = 0; $i < strlen($integerPart); $i++) {
            $digit = (int)$integerPart[$i];
            $position = strlen($integerPart) - $i - 1;

            if ($digit > 0) {
                $integerWords .= $thaiNumbers[$digit] . $unitPositions[$position];
            } elseif ($position == 0 && strlen($integerPart) == 1) {
                $integerWords .= $thaiNumbers[$digit];
            }
        }

        // แปลงส่วนทศนิยม
        if ($decimalPart != '00') {
            $decimalWords .= $thaiNumbers[(int)$decimalPart[0]] . 'สิบ';
            $decimalWords .= $thaiNumbers[(int)$decimalPart[1]];
        }

        // รวมตัวหนังสือทั้งสองส่วน
        $result = $integerWords . 'บาท' . $decimalWords . 'สตางค์';

        return $result;
    }




    public function print_bill(Request $rs)
    {
        $file = new Filesystem;
        $file->cleanDirectory(public_path('pdf/bill'));

        $bill_id = $rs->bill_id;



        $bills = DB::table('bills')
        ->select(
            'bills.*',
            'dataset_districts.name_th as district',
            'dataset_provinces.name_th as province',
            'dataset_amphures.name_th as tambon',
            'bills.zipcode',
            'tel',
        )
        ->leftjoin('dataset_provinces', 'dataset_provinces.id', '=', 'bills.province_id')
        ->leftjoin('dataset_amphures', 'dataset_amphures.id', '=', 'bills.district_id')
        ->leftjoin('dataset_districts', 'dataset_districts.id', '=', 'bills.tambon_id')
        ->where('bills.id',$bill_id)
        ->first();




        $his_m =  $bills->m-1;
        $his_y =  $bills->y;
        if($his_m == 0 ){
            $his_m = '12';
            $his_y =  $bills->y - 1;
        }



        $bills_history_old = DB::table('bills_history')
        ->where('m','=',$his_m)
        ->where('y','=',$his_y)
        ->where('customers_id_fk','=',$bills->customers_id_fk)
        ->first();

        // return view('backend/PDF/report_bill_pdf', compact('data'));

        // Create a PDF instance using the PDF facade
        $data = ['bills_data' => $bills,'bills_history_old'=>$bills_history_old];
        $pdf = PDF::loadView('backend/PDF/report_bill_pdf', compact('data'));


        $pathfile = public_path('pdf/bill/'.$bills->code_order.'.pdf');


        $pdf->save($pathfile);
        $url =  asset('local/public/pdf/bill/'.$bills->code_order.'.pdf');

        $rs = ['url'=>$url];
         return $rs;
    }







}
