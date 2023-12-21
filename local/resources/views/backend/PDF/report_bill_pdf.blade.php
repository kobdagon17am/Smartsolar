<!DOCTYPE html>
<html>
<?php
// dd(asset('frontend/dist/fonts/THSarabunNew.ttf'));
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('frontend/dist/css/font.css')}}" rel="stylesheet" type="text/css" />
    <style>

        p,tbody,th,tr,table,td{

            border-collapse: collapse;
             /* margin: 1px;
             padding: 1px; */
            font-family: 'kanit,Arial,sans-serif';
            font-weight: normal;
            /* line-height: 16px;
            margin-top: 0px;
            margin-left: 13px;
            margin-right: 33px;
            line-height: 13px; */
        }

        @page {
            padding: 10px;
            size: 100mm 150mm;
            margin: 10px; /* Set margins to 0 if you want no margins */
        }
        body{
            font-family: 'kanit-b,Arial,sans-serif';
            font-size: 10px;
            margin-top: 0px;
            margin-bottom: 0px; /* Adjust the value to reduce the space as needed */
            margin-top: 0px;

        }
        br {
            margin-bottom: 0px; /* Adjust the value to reduce the space as needed */
            margin-top: 0px;
        }
        .horizontal-line {
            border-top: 1px solid black;
            margin: 2px 0;
        }




    </style>
</head>

<body>



    <table style="width: 100%;border: 0px;margin: 0px" border="0">
        <thead>
            <tr>
                <th align="left">

                    <p style="font-size: 10px"> <img src="{{asset('assets/img/MAKESEND_b.png')}}" alt="Girl in a jacket" height="30"><br>



                    Tracking No. MWE15230000072811


                </p>
                </th>

                <th align="right">
                    <img src="{{asset('assets/img/logo-print.png')}}" alt="Girl in a jacket" height="20">
                </th>
            </tr>
        </thead>
    </table>
    <table style="width: 100%;border: 1px solid black;padding: 0px;margin: 0px" border="1">
        <thead>
            <tr>
                <td style="background-color:#000000;padding-left: 2px;"><font style="color: #ffff;font-size: 10px;margin-left: 5px;margin-top: 0px;">ชื่อผู้ส่ง(Sender)</font></td>
                <td style="background-color:#000000;padding-left: 2px;"><font style="color: #ffff;font-size: 10px;margin-left: 5px;margin-top: 0px;">ผู้รับ(Receiver)</font></td>
            </tr>
            <tr>

                <th align="left" style="padding-left: 2px;">
                    <p style="margin-left: 5px;margin-top: 0px;">xxx<br>
                  xxxx
                </th>
                <th align="left" style="padding-left: 2px">
                    <p style="margin-left: 5px;margin-top: 0px;">
                       xxxx
                        </p>
                </th>
            </tr>
            <tr>
                <th align="left" style="padding-left: 2px">
                    <p style="margin-left: 5px;margin-top: 0px;"> เลขที่ใบสั่งซื้อ xxxx  <br>
                        วันที่สั่งซื้อ xxxxx <br>


                        วิธีการจัดส่ง xxx<br>
                        ขนส่ง xxx



                    </p>
                 </th>
                 <th style="">
                    <p style="margin-left: 5px;margin-top: 0px;">การชำระเงิน<br>

                        รออนุมัติ

                     </p>
                 </th>
            </tr>
        </thead>
    </table>
    {{-- <p style="padding: 0px;margin: 0px;">*หากมีปัญหาเกี่ยวกับสินค้ากรุณาติตต่อบริษัทที่ท่านสั่งซื้อสินคำโดยตรงและหากหัสดุดีกลับกรุณานำส่ง ตามชื่อผู้ฝากส่งรายการสินค้า</p> --}}
    <p style="text-align: center;font-size: 10px;padding: 0px;margin: 0px;">รายการสินค้า</p>
    <table style="width: 100%;border: 0px;color:" border="0">
        <thead>
            <tr>
                <th align="left">  เลขที่ใบสั่งซื้อ 1111
                </th>

                <th align="right">จำนวนสินค้า 11 รายการ 11 หน่วย

                </th>
            </tr>
        </thead>
    </table>

    <table style="width: 100%;border: 0px;color: black; padding: 0px" border="0">
        <thead>
            <tr style="margin: 0px">
                <td d colspan="4" ><div class="horizontal-line"></div></td>
            </tr>
            <tr style="margin: 0px">
                <th align="left" style=""> สินค้า
                </th>
                {{-- <th align="center" style="">ราคา/หน่วย

                </th> --}}
                <th align="center" style="">จำนวนสินค้า

                </th>
                {{-- <th align="right" style="">ราคารวม

                </th> --}}
            </tr>
        </thead>
        <tr>
            <td d colspan="4" ><div class="horizontal-line"></div></td>
        </tr>

        <tr style="margin: 0px">
                <td align="left" style="">
                   1
                 </td>

                 <td align="center" style="">
                   1212
                 </td>

            </tr>

            <tr>
                <td colspan="4" ><div class="horizontal-line"></div></td>
            </tr>
        </table>

</body>
<html>
