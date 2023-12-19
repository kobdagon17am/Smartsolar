<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Arr;
use DataTables;
use App\Customers;
use App\CustomersAddressCard;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class MemberRigisterController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin');
  }


  public function index()
  {


    $province = DB::table('dataset_provinces')
    ->select('*')
    //->where('business_location_id',$business_location_id)
    ->get();
    // dd($get_member_data);

    return view('backend/member_regis',compact('province'));
  }

  public function MemberRegister_datatable(Request $rs)
  {

    $customers = DB::table('customers')


      ->whereRaw(("case WHEN  '{$rs->s_username}' != ''  THEN  customers.user_name = '{$rs->s_username}' else 1 END"))
      ->whereRaw(("case WHEN  '{$rs->s_first_name}' != ''  THEN  customers.name LIKE '{$rs->s_first_name}%' else 1 END"))
      ->whereRaw(("case WHEN  '{$rs->s_id_card}' != ''  THEN  customers.id_card = '{$rs->s_id_card}' else 1 END"))
      ->whereRaw(("case WHEN  '{$rs->s_sola_no}' != ''  THEN  customers.sola_no = '{$rs->s_sola_no}' else 1 END"))
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

        // $html = '<a href="#!" onclick="edit(' . $row->id . ')" class="p-2">
        //       <i class="las la-sign-in-alt font-25 text-success"></i></a>';
        // $html1 = "<a href='" . route('admin/EditProfile') . "' onclick='edit(" . $row->id . ")' class='p-2'>
        //       <i class='las la-user-edit font-25 text-info'></i></a>";
        $html = '';
        $html1 ='';
        // $html2 = '<a href="#!" onclick="edit(' . $row->id . ')" class="p-2">
        //       <i class="lab la-whmcs font-25 text-warning"></i></a>';
        $html2 = '<i class="lab la-whmcs font-25 text-warning" id="btnGroupDrop1" data-toggle="dropdown"></i>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" >
              <a class="dropdown-item" href="#!" onclick="edit_customer(' . $row->id . ')" class="p-2">แก้ไขรายละเอียด</a>

                <a class="dropdown-item" href="#!" onclick="cancel_member(' . $row->id . ')" class="p-2">ยกเลิกรหัส</a>
              </div>';

        return $html . $html1 . $html2; // รวมค่า $html และ $html1 ด้วยเครื่องหมาย .

      })


      ->rawColumns(['customer_status', 'action'])

      ->make(true);
  }

  public function edit_password(Request $rs)
  {
    // dd($rs->all());

    if ($rs->password_new == $rs->password_new_confirm) {

      // dd($rs->password_new,$rs->password_new_confirm);

      $dataPrepare = [
        'password' => md5($rs->password_new),
      ];

      $get_customer = DB::table('customers')
      ->where('id', '=', $rs->id)
      ->update($dataPrepare);

    DB::commit();
    return redirect('admin/MemberRegister')->withSuccess('แก้ไขรหัสผ่านสำเร็จ');
    } else {
      return redirect('admin/MemberRegister')->withError('แก้ไขรหัสไม่สำเร็จ');
    }
  }

  public function view_member_data(Request $rs)
  {

    $get_customer = DB::table('customers')
      ->where('id', '=', $rs->id)
      ->first();

    $data = ['status' => 'success', 'data' => $get_customer];


    return $data;
  }

  public function cancel_member(Request $rs)
  {
    // dd($rs->all());

    if ($rs->cencel_member == 'confirm') {
      $dataPrepare = [
        'status_customer' => 'cancel',
      ];

      $get_customer = DB::table('customers')
      ->where('id', '=', $rs->id)
      ->update($dataPrepare);

    DB::commit();
    return redirect('admin/MemberRegister')->withSuccess('ยกเลิกรหัสสำเร็จ');
    } else {
      return redirect('admin/MemberRegister')->withError('ยกเลิกรหัสไม่สำเร็จ');
    }
  }

  public function view_password(Request $rs)
  {

    $get_customer = DB::table('customers')
       ->select('customers.*','dataset_qualification.business_qualifications')
       ->leftjoin('dataset_qualification', 'customers.qualification_id', '=', 'dataset_qualification.id')
      ->where('customers.id', '=', $rs->id)
      ->first();

    $data = ['status' => 'success', 'data' => $get_customer];


    return $data;
  }

  public function edit_position(Request $request)
  {


    $user_action = DB::table('customers')
    ->select( 'id', 'user_name','name', 'last_name','qualification_id','introduce_id')
    ->where('id','=',$request->id_customer)
    ->first();
    if(empty($user_action)){
        return redirect('admin/MemberRegister')->withError('ไม่พบผู้ใช้งาน กรุณาทำรายการไหม่');
    }

    if($user_action->qualification_id == $request->new_position){
        return redirect('admin/MemberRegister')->withError('สมาชิกเป็น '.$request->new_position.' อยู่แล้วไม่สามารถปรับตำแหน่งได้');
    }

    try {

        DB::BeginTransaction();

        DB::table('log_up_vl')->insert([
            'user_name' => $user_action->user_name,'introduce_id' => $user_action->introduce_id,
            'old_lavel' => $user_action->qualification_id, 'new_lavel' =>$request->new_position,'pv_upgrad'=>0, 'status' => 'success', 'type' => 'jangpv','note'=>'ปรับตำแหน่งโดย Admin'
        ]);

        DB::table('customers')
        ->where('user_name', $user_action->user_name)
        ->update(['qualification_id' => $request->new_position, 'pv_upgrad' => 0]);
        DB::commit();

        return redirect('admin/MemberRegister')->withSuccess('ปรับตำแหน่งสำเร็จ');

} catch (Exception $e) {
     DB::rollback();
     return redirect('admin/MemberRegister')->withError('ผิดพลาดกรุณาทำรายการไหม่อีกครั้ง');
}



  }



  public function register(Request $request)
  {

     $user_name = self::gencode_customer();

     $id_card_check = Customers::where('id_card', $request->id_card)->first();
     if($id_card_check){
        redirect('admin/MemberRegister')->withError('มีรหัสบัตรประชาชนนี้เเล้ว ไม่สามารถสมัครซ้ำได้');
     }

     $sola_no_check = Customers::where('id_card', $request->sola_no)->first();
     if($sola_no_check){
        redirect('admin/MemberRegister')->withError('มีหมายเลขผู้ใช้ไฟนี้เเล้ว ไม่สามารถสมัครซ้ำได้');
     }



     $c_code = $user_name;

     $customer_insert = new Customers;

     $customer_insert->user_name = $c_code;
     $user_name_success[] = $c_code;

     $id_card = (trim($request->input('id_card')) == '') ? null : $request->input('id_card');
     $pass = substr($id_card, -4);
     $pass_db = md5($pass);



     $customer_insert->password = $pass_db;

     // $customer_insert->number_of_member=$request->number_of_member;
     // $customer_insert->business_location=$request->business_location;

     $customer_insert->prefix_name = trim($request->prefix);
     $customer_insert->name = trim($request->firstname);
     $customer_insert->last_name = trim($request->lastname);

     $customer_insert->name_bu = trim($request->businessname);
    //  $customer_insert->birth_day = trim($request->birthdate);
     $customer_insert->id_card = trim($request->id_card);
     $customer_insert->sola_no = trim($request->sola_no);

    //  $customer_insert->country = trim($request->country);
    //  $customer_insert->national = trim($request->national);
     $customer_insert->phone = trim($request->phone);
     $customer_insert->email = trim($request->email);

     //INSERT CUSTOMER ADDRESS CARD
     $customers_address_card_insert = new CustomersAddressCard;
     $customers_address_card_insert->card_house_no = trim($request->card_no);
     $customers_address_card_insert->card_moo = trim($request->card_moo);
     $customers_address_card_insert->card_home_name = trim($request->card_home_name);
     $customers_address_card_insert->card_soi = trim($request->card_soi);
     $customers_address_card_insert->card_road = trim($request->card_road);
     $customers_address_card_insert->card_tambon_id_fk =trim($request->card_tambon);
     $customers_address_card_insert->card_tambon = '';
     $customers_address_card_insert->card_district_id_fk =trim($request->card_amphur);
     $customers_address_card_insert->card_amphur = '';
     $customers_address_card_insert->card_province_id_fk = trim($request->card_changwat);
     $customers_address_card_insert->card_changwat ='';
     $customers_address_card_insert->card_zipcode = trim($request->card_zipcode);


     try {

            DB::BeginTransaction();
            $customer_insert->save();
            $customers_address_card_insert->customer_id = $customer_insert->id;
            $customers_address_card_insert->username = $customer_insert->user_name;
            $customers_address_card_insert->save();
            DB::commit();

        return redirect('admin/MemberRegister')->withSuccess('สมัครสมาชิกสำเร็จ');
    } catch (Exception $e) {
        //code
        DB::rollback();
        redirect('admin/MemberRegister')->withError('Error' .$e);
    }


  }

  public static function gencode_customer()
  {
      $y = date('Y');
      $y = substr($y, -2);

      $code =  IdGenerator::generate([
          'table' => 'customer_code',
          'field' => 'code',
          'length' => 8,
          'prefix' => 'A',
          'reset_on_prefix_change' => true
      ]);

        $ck_code = DB::table('customer_code')
        ->where('code','=',$code)
        ->first();

        if(empty($ck_code)){

            $rs_code_order = DB::table('customer_code')
            ->Insert(['code' => $code]);

            if ($rs_code_order == true) {
                return  $code;
              } else {
                \App\Controllers\Admin\MemberRigisterController::gencode_customer();
              }

        }else{
            \App\Controllers\Admin\MemberRigisterController::gencode_customer();
        }

  }




}
