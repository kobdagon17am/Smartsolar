<?php

namespace App\Http\Controllers\Frontend\FC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class RunCodeController extends Controller
{

    public static function db_code_order($type)
    {
        $y = date('Y');

        if($type == 1){
            $prefix = 'STC';
        }else{
            $prefix = 'SPP';
        }
        $code =  IdGenerator::generate([
            'table' => 'db_code_order',
            'field' => 'code',
            'length' => 17,
            'prefix' => $prefix . $y . '.' . date("m") . '.',
            'reset_on_prefix_change' => true
        ]);
          $ck_code = DB::table('db_code_order')
          ->where('code','=',$code)
          ->first();

          if(empty($ck_code)){
              $rs_code_order = DB::table('db_code_order')
              ->Insert(['code' => $code]);
              if ($rs_code_order == true) {
                  return  $code;
                } else {
                  \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_order($type);
                }

          }else{
               \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_order($type);
          }

    }

    public static function db_code_bonus($type_id_fk)
    {
        $y = date('Y') + 543;
        $y = substr($y, -2);
        $code =  IdGenerator::generate([
            'table' => 'db_code_bonus',
            'field' => 'code',
            'length' => 15,
            'prefix' => 'S'.''.$type_id_fk.''.$y. '' . date("m") . '-',
            'reset_on_prefix_change' => true
        ]);

        $ck_code = DB::table('db_code_bonus')
        ->where('code','=',$code)
        ->first();

        if(empty($ck_code)){
            $rs_code_order = DB::table('db_code_bonus')
            ->Insert(['code' => $code]);
            if ($rs_code_order == true) {
                return  $code;
              } else {
                \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_bonus();
              }

        }else{
             \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_bonus();
        }



    }



    public static function db_code_stock()
    {
        $y = date('Y') + 543;
        $y = substr($y, -2);
        $code =  IdGenerator::generate([
            'table' => 'db_code_stock',
            'field' => 'code',
            'length' => 15,
            'prefix' => 'ST' . $y . '' . date("m") . '-',
            'reset_on_prefix_change' => true
        ]);

        $ck_code = DB::table('db_code_stock')
        ->where('code','=',$code)
        ->first();

        if(empty($ck_code)){

            $rs_code_order = DB::table('db_code_stock')
            ->Insert(['code' => $code]);
            if ($rs_code_order == true) {
                return  $code;
              } else {
                \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_stock();
              }

        }else{
             \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_stock();
        }

    }

    public static function db_code_wallet()
    {
        $y = date('Y') + 543;
        $y = substr($y, -2);
        $code =  IdGenerator::generate([
            'table' => 'db_code_wallet',
            'field' => 'code',
            'length' => 15,
            'prefix' => 'WL' . $y . '' . date("m") . '-',
            'reset_on_prefix_change' => true
        ]);
        $ck_code = DB::table('db_code_wallet')
        ->where('code','=',$code)
        ->first();

        if(empty($ck_code)){
            $rs_code_order = DB::table('db_code_wallet')
            ->Insert(['code' => $code]);
            if ($rs_code_order == true) {
                return  $code;
              } else {
                \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_wallet();
              }

        }else{
             \App\Http\Controllers\Frontend\FC\RunCodeController::db_code_wallet();
        }


    }





}
