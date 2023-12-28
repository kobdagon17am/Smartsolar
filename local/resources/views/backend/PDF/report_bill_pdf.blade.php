<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
         @charset "utf-8";
            @font-face {
                font-family: 'THSarabunNew';
                font-style: normal;
                font-weight: normal;
                src: url("{{ asset('frontend/fonts/THSarabunNew.ttf')}}") format('truetype');
            }

            @font-face {
                font-family: 'THSarabunNew_b';
                font-style: normal;
                font-weight: normal;
                src: url("{{asset('frontend/fonts/THSarabunNewBold.ttf')}}") format('truetype');
            }

        p,tbody,th,tr,table,td{
            border-collapse: collapse;
            font-size: 14px;
             /* margin: 1px;
             padding: 1px; */
             font-family: 'kanit';
            font-weight: normal;
            /* line-height: 16px;
            margin-top: 0px;
            margin-left: 13px;
            margin-right: 33px;
            line-height: 13px; */
        }
         body{
            font-family: 'THSarabunNew';
            font-size: 14px;
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
        .text-right{
            text-align: right;
        }


    </style>
</head>

<body>

    <?php


    $months = [
        '01' => 'มกราคม',
        '02' => 'กุมภาพันธ์',
        '03' => 'มีนาคม',
        '04' => 'เมษายน',
        '05' => 'พฤษภาคม',
        '06' => 'มิถุนายน',
        '07' => 'กรกฎาคม',
        '08' => 'สิงหาคม',
        '09' => 'กันยายน',
        '10' => 'ตุลาคม',
        '11' => 'พฤศจิกายน',
        '12' => 'ธันวาคม',
    ];

    if (empty($data['bills_data']->m)) {
        $m = date('m');
    } else {
        $m = $data['bills_data']->m;
    }

    $m_text = $months[$m];

    ?>


<table style="width: 100%;border: 0px;margin: 0px" border="0">
    <thead>
        <tr>
            <th align="left" style="width: 70%;">

                @if ($data['bills_data']->bill_type == 'STC')

                <p style="font-size: 10px"> <img src="{{asset('frontend/images/stc.png')}}" alt="Girl in a jacket" height="85"><br>
                @endif
                @if ($data['bills_data']->bill_type == 'SPP')
                <p style="font-size: 10px"> <img src="{{asset('frontend/images/spp.png')}}" alt="Girl in a jacket" height="85"><br>
                @endif

            </th>


            <th align="center">
                <h3 style="font-size: 36px;color: #123d71">ใบแจ้งค่าไฟฟ้า</h3>
            </th>


        </tr>
        <tr>
        <th style="text-align: left;">

            <p class="inv-to"><b>กิจการร่วมค้า สมาร์ท ไทคอน <br>40/13 หมู่1 ถนนลพบุรีราเมศวร์
                ตาบลคลองแห จังหวัดสงขลา 90110</b>
            </p>
            <p class="inv-customer-name"><b>ผู้ติดต่อ</b> : นายธนพล จันทร์คล้าย<br>
                <b>โทร</b> : 088-7849613
            </p>

            <p class="inv-email-address"><b>สถานที่ผู้ประกอบการ</b> <br>
                {{ $data['bills_data']->customers_name_bu }}<br>

                @if ($data['bills_data']->house_no)
                    {{ $data['bills_data']->house_no }}
                @endif
                @if ($data['bills_data']->moo != '-' and $data['bills_data']->moo != '')
                    หมู่.{{ $data['bills_data']->moo }}
                @endif
                @if ($data['bills_data']->house_name != '-' and $data['bills_data']->house_name != '')
                    บ.{{ $data['bills_data']->house_name }}
                @endif
                @if ($data['bills_data']->soi != '-' and $data['bills_data']->soi != '')
                    ซอย.{{ $data['bills_data']->soi }}
                @endif
                @if ($data['bills_data']->road != '-' and $data['bills_data']->road != '')
                    ถนน.{{ $data['bills_data']->road }}
                @endif
                @if ($data['bills_data']->district != '-' and $data['bills_data']->district != '')
                    อำเภอ{{ $data['bills_data']->district }}
                @endif
                @if ($data['bills_data']->tambon != '-' and $data['bills_data']->tambon != '')
                    ตำบล{{ $data['bills_data']->tambon }}
                @endif
                @if ($data['bills_data']->province != '-' and $data['bills_data']->province != '')
                    จังหวัด{{ $data['bills_data']->province }}
                @endif
                @if ($data['bills_data']->zipcode)
                    {{ $data['bills_data']->zipcode }}
                @endif

            </p>
        </p>
        </th>
        <th align="left">
            <p class="inv-detail-title"><b>เลขประจำตัวผู้เสียภาษี</b>: {{ $data['bills_data']->id_card }}<br>
             <span class="inv-title"><b>เลขที่ใบแจ้ง</b> : </span> <span
                    class="inv-number">{{ $data['bills_data']->code_order }}</span>
            <br><span class="inv-title"><b>วันที่อ่านหน่วย</b> : </span> <span
                    class="inv-date">{{ date('d/m/Y', strtotime($data['bills_data']->date_read)) }}</span>
            <br><span class="inv-title"><b>หมายเลขผู้ใช้ไฟ</b> : </span> <span
                    class="inv-number">{{ $data['bills_data']->sola_no }}</span>
            <br><span class="inv-title"><b>ชื่อผู้ประกอบการ</b> : </span> <span
                    class="inv-customer-name">{{ $data['bills_data']->customers_name_bu }}</span>
            <br><span class="inv-title"><b>วันครบกำหนดชำระ</b> : </span> <span
                    class="inv-date">{{ date('d/m/Y', strtotime($data['bills_data']->date_expri_pay)) }}</span></p>

        </th>

        </tr>
    </thead>
</table>


<table style="width: 100%;border: 0px solid black;padding: 0px;margin: 0px" border="0">
    <thead class="">
        <tr>
            <td style="background-color:#a3a3a3;padding-left: 2px; width: 40%;text-align: center"><b style="color: #000;font-size: 14px;margin-left: 5px;margin-top: 0px;">รายละเอียดค่าไฟฟ้า</b></td>

            <td style="background-color:#a3a3a3;padding-left: 2px; width: 20%;text-align: right"><b style="color: #000;font-size: 14px;margin-left: 5px;margin-top: 0px;">ค่าไฟฟ้า(กิโลวัตต์)</b></td>
           <td style="background-color:#a3a3a3;padding-left: 2px;width: 20%;text-align: right"><b style="color: #000;font-size: 14px;margin-left: 5px;margin-top: 0px;">หน่วย/บาท</b></td>
           <td style="background-color:#a3a3a3;padding-left: 2px;width: 20%;text-align: right"><b style="color: #000;font-size: 14px;margin-left: 5px;margin-top: 0px;">จำนวนเงิน (บาท)</b></td>

        </tr>
    </thead>
    <tbody>
        <tr style="">
            <td>
               วันที่ : {{ date('d/m/Y', strtotime(@$data['bills_data']->date_start)) }}-{{ date('d/m/Y', strtotime(@$data['bills_data']->date_end)) }}
            </td>


            <td></td>
            <td></td>
            <td></td>

        </tr>

        <tr>
            <td>พลังงานไฟฟ้าในช่วงเวลา (หน่วย) On-Peak @if($data['bills_data']->on_peak_discount>0)ส่วนลด({{$data['bills_data']->on_peak_discount}}%)@endif</td>

            <td class="text-right">{{ number_format($data['bills_data']->on_peak_balance,3, '.', '') }}</td>
            <td class="text-right">
                {{ number_format($data['bills_data']->on_peak_per_unit, 6) }}</td>
            <td class="text-right">{{ number_format($data['bills_data']->on_peak_total, 6) }}
            </td>

        </tr>

        <tr>
            <td>พลังงานไฟฟ้าในช่วงเวลา (หน่วย) off-Peak @if($data['bills_data']->off_peak_discount>0)ส่วนลด({{$data['bills_data']->off_peak_discount}}%)@endif</td>

            <td class="text-right">{{ number_format($data['bills_data']->off_peak_balance,3, '.', '') }}</td>
            <td class="text-right">
                {{ number_format($data['bills_data']->off_peak_per_unit, 6) }}</td>
            <td class="text-right">{{ number_format($data['bills_data']->off_peak_total, 6) }}
            </td>

        </tr>


        @if($data['bills_data']->ft_total > 0)
        <tr>
            <td>ค่า FT (หน่วย) @if($data['bills_data']->ft_discount>0)ส่วนลด({{$data['bills_data']->ft_discount}}%)@endif</td>


            <td class="text-right">{{ number_format($data['bills_data']->on_peak + ($data['bills_data']->off_peak + $data['bills_data']->off_peak_day_off),3) }}</td>

            <td class="text-right">{{ number_format($data['bills_data']->ft_per_unit, 6) }}
            </td>
            <td class="text-right">{{ number_format($data['bills_data']->ft_total, 6) }}</td>

        </tr>
        @endif

        @if($data['bills_data']->peak_deman_total > 0)
        <tr>
            <td>ค่าความต้องการพลังงานไฟฟ้า Peak Deman @if($data['bills_data']->peak_deman_discount>0)ส่วนลด({{$data['bills_data']->peak_deman_discount}}%)@endif</td>

            <td class="text-right">{{ number_format($data['bills_data']->peak_deman,3, '.', '') }}</td>

            <td class="text-right">
                {{ number_format($data['bills_data']->peak_deman_per_unit, 6) }}</td>
            <td class="text-right">
                {{ number_format($data['bills_data']->peak_deman_total, 6) }}</td>

        </tr>
        @endif



        <tr>
            <td> </td>

            <td> </td>
            <td class="text-right">รวมเงินค่าไฟฟ้า :</td>

            <td class="text-right">{{ number_format($data['bills_data']->sum_price, 2) }}</td>

        </tr>


        <tr>
            <td> </td>

            <td></td>
            <td class="text-right">ภาษีมูลค่าเพิ่ม 7% :</td>
            <td class="text-right">{{ number_format($data['bills_data']->tax_total, 2) }}</td>

        </tr>
        <tr>
            <td colspan="4"><div class="horizontal-line"></div></td>
        </tr>
        <tr>
            <td></td>

            <td></td>
            <td class="text-right">รวมเงินค่าไฟฟ้าทั้งสิ้น :</td>

            <td class="text-right">{{ number_format($data['bills_data']->total_price, 2) }}</td>

        </tr>
        <tr>
            <td colspan="4"><div class="horizontal-line"></div></td>
        </tr>
    </tbody>
</table>

<table style="width: 100%;border: 0px;text-align: center" border="0">
    <thead>
        <tr>
            <td style="background-color:#a3a3a3;padding-left: 2px;"><b style="color: #000;font-size: 16px;margin-left: 5px;margin-top: 0px;">รวมเงินค่าไฟฟ้าทั้งสิ้น (ตัวอักษร): {{$data['bills_data']->total_price_text}}</b></td>
        </tr>
    </thead>
</table>
<br>
<br>
{{-- <p style="padding: 0px;margin: 0px;">*หากมีปัญหาเกี่ยวกับสินค้ากรุณาติตต่อบริษัทที่ท่านสั่งซื้อสินคำโดยตรงและหากหัสดุดีกลับกรุณานำส่ง ตามชื่อผู้ฝากส่งรายการสินค้า</p> --}}

<table style="width: 100%;border: 0px;" border="0">
    <thead>
        <tr>
            <th align="left" style="width: 50%">

                <p style="font-size: 11px">
                    <b>เกี่ยวกับบิลค่าไฟฟ้า</b><br>
                    อ้างอิงอัตราค่าไฟฟ้าดังต่อไปนี้ อัตราตามช่วงเวลาของการใช้ (TOU)<br> สำหรับแรงดัน 22-33 kv
                    สำหรับแรงดัน 22-33 kv <br>
                    <b>กำหนดช่วงเวลา On-Peak</b><br>
                    วันจันทร์-วันศุกร์ และวันพืชมงคล เวลา 09.00 น. จนถึง 22.00 น.<br>
                    <b> กำหนดช่วงเวลา Off-Peak</b><br>
                    วันจันทร์-วันศุกร์ เวลา 22.00 น. จนถึง 09.00 น.<br>
                    วันเสาร์-วันอาทิตย์ , วันแรงงาน และวันหยุดราชการตามปกติ <br>
                    เวลา 00:00 น. - 24:00 น.<br>
                    (ไม่รวมวันหยุดชดเชยและวันพืชมงคล)


                </p>
            </th>

            <th align="left">
                <p style="font-size: 11px">
                    <b>อัตราค่าไฟของการไฟฟ้าส่วนภูมิภาค (กฟภ.) ในปัจจุบัน</b><br>
                    ช่วงเวลา On-Peak (บาท/kWh) = {{$data['bills_data']->on_peak_per_unit}}<br>
                    ช่วงเวลา Off-Peak (บาท/kWh) = {{$data['bills_data']->off_peak_per_unit}}<br>
                    <b> {{$data['bills_data']->ft_text}}</b><br>
                    Ft (บาท/kWh.) = {{$data['bills_data']->ft_per_unit}} <br>

                @if ($data['bills_data']->bill_type == 'STC')
                    <b>อัตราค่าไฟฟ้าของ กิจการร่วมค้า สมาร์ท ไทคอน</b><br>
                @endif
                @if ($data['bills_data']->bill_type == 'SPP')
                <b>อัตราค่าไฟฟ้าของ กิจการร่วมค้า สมาร์ท เพาเวอร์ แพลนท์</b><br>
                @endif

                @if($data['bills_data']->on_peak_discount <= 0)
                ช่วงเวลา On-Peak (บาท/kWh) = {{number_format($data['bills_data']->on_peak_per_unit,4, '.', '')}}<br>

                @else
                ช่วงเวลา On-Peak (บาท/kWh) = {{number_format($data['bills_data']->on_peak_per_unit*($data['bills_data']->on_peak_discount/100),3, '.', '')}}  (ส่วนลดอัตราค่าไฟ {{$data['bills_data']->on_peak_discount}}% จาก กฟภ.)<br>

                @endif


                @if($data['bills_data']->off_peak_discount <= 0)
                ช่วงเวลา Off-Peak (บาท/kWh) = {{number_format($data['bills_data']->off_peak_per_unit,4, '.', '')}}<br>

                @else
                ช่วงเวลา Off-Peak (บาท/kWh) = {{number_format($data['bills_data']->off_peak_per_unit*($data['bills_data']->off_peak_discount/100),4, '.', '')}}  (ส่วนลดอัตราค่าไฟ {{$data['bills_data']->off_peak_discount}}% จาก กฟภ.)<br>

                @endif


                @if($data['bills_data']->ft_discount <= 0)
                Ft (บาท/kWh.) = {{number_format($data['bills_data']->ft_per_unit,4, '.', '')}}<br>

                @else
                Ft (บาท/kWh.) = {{number_format($data['bills_data']->ft_per_unit*($data['bills_data']->ft_discount/100),4, '.', '')}} (ส่วนลดอัตราค่าไฟ {{$data['bills_data']->ft_discount}}% จาก กฟภ.)<br>

                @endif
                    <b>ผลประหยัดที่ได้ ในเดือน {{$m_text}}</b><br>
                    {{number_format($data['bills_data']->discout_price_total,4)}} <br>
                </p>
            </th>
        </tr>

             <tr>
            <th align="left">

                @if ($data['bills_data']->bill_type == 'STC')

                    <p class="" style="font-size: 14px">ช่องทางการชำระเงิน : ธนาคารกรุงเทพ สาขาตลาดพงศ์เจริญ หาดใหญ่ <br>
                        ชื่อบัญชี : กิจการร่วมค้า สมาร์ท ไทคอน เลขที่ : 764-0-18148-8</p>

            @endif
            @if ($data['bills_data']->bill_type == 'SPP')

                    <p class="" style="font-size: 14px">ช่องทางการชำระเงิน : ธนาคารกรุงเทพ สาขาตลาดพงศ์เจริญ หาดใหญ่ <br>
                        ชื่อบัญชี : กิจการร่วมค้า สมาร์ท เพาเวอร์ แพลนท์ <br>เลขที่ : 764-0-18379-9</p>

            @endif

            </th>

            <th align="left">

            </th>
        </tr>
    </thead>
</table>



</body>
<html>
