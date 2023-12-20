<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class Dataset_solaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

  public function index()
  {
    // dd('111');

    $dataset_sola = DB::table('dataset_sola')
      // ->where('username','=',Auth::guard('c_user')->user()->username)
      // ->where('password','=',md5($req->password))
      // ->first();
      ->get();
    return view('backend/sola_set', compact('dataset_sola'));
  }


  public function edit_sola(Request $rs)
  {


    $dataPrepare = [
      'text' => $rs->text,
      'unit' => $rs->unit,

    ];

    try {
      DB::BeginTransaction();
      $dataset_sola = DB::table('dataset_sola')
      ->where('id','=',$rs->id)
        ->update($dataPrepare);
      DB::commit();
      return redirect('admin/solaset')->withSuccess('สำเร็จ');
    } catch (Exception $e) {
      DB::rollback();
      return redirect('admin/solaset')->withError('ไม่สำเร็จ');

    }



  }

  public function view_sola(Request $rs)
  {

     $dataset_sola = DB::table('dataset_sola')
     ->where('id','=',$rs->id)
     ->first();

     $data = ['status' => 'success', 'data' => $dataset_sola];


     return $data;

  }
}
