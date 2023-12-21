<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
         @charset "utf-8";
            @font-face {
                font-family: 'kanit';
                font-style: normal;
                font-weight: normal;
                src: url("{{ asset('frontend/fonts/Kanit-Regular.ttf')}}") format('truetype');
            }

            @font-face {
                font-family: 'kanit';
                font-style: normal;
                font-weight: normal;
                src: url("{{asset('frontend/fonts/Kanit-Bold.ttf')}}") format('truetype');
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
            font-family: 'kanit';
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
                <h3 style="font-size: 30px">ใบแจ้งค่าไฟฟ้า</h3>
            </th>


        </tr>
        <tr>
        <th style="text-align: left;">

            <p class="inv-to">กิจการร่วมค้า สมาร์ท ไทคอน <br>40/13 หมู่1 ถนนลพบุรีราเมศวร์
                ตาบลคลองแห จังหวัดสงขลา 90110
            </p>
            <p class="inv-customer-name">ผู้ติดต่อ : นายธนพล จันทร์คล้าย<br>
                โทร : 088-7849613
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
            <p class="inv-detail-title">เลขประจำตัวผู้เสียภาษี: {{ $data['bills_data']->id_card }}<br>
             <span class="inv-title">เลขที่ใบแจ้ง : </span> <span
                    class="inv-number">{{ $data['bills_data']->code_order }}</span>
            <br><span class="inv-title">วันที่อ่านหน่วย : </span> <span
                    class="inv-date">{{ date('d/m/Y', strtotime($data['bills_data']->date_read)) }}</span>
            <br><span class="inv-title">หมายเลขผู้ใช้ไฟ : </span> <span
                    class="inv-number">{{ $data['bills_data']->sola_no }}</span>
            <br><span class="inv-title">ชื่อผู้ประกอบการ : </span> <span
                    class="inv-customer-name">{{ $data['bills_data']->customers_name_bu }}</span>
            <br><span class="inv-title">วันครบกำหนดชำระ : </span> <span
                    class="inv-date">{{ date('d/m/Y', strtotime($data['bills_data']->date_expri_pay)) }}</span></p>

        </th>

        </tr>
    </thead>
</table>


<table style="width: 100%;border: 0px solid black;padding: 0px;margin: 0px" border="0">
    <thead class="">
        <tr>
            <td style="background-color:#a3a3a3;padding-left: 2px;"><b style="color: #000;font-size: 14px;margin-left: 5px;margin-top: 0px;">รายละเอียดค่าไฟฟ้า</b></td>
            <td style="background-color:#a3a3a3;padding-left: 2px;"><b style="color: #000;font-size: 14px;margin-left: 5px;margin-top: 0px;">เลขอ่านครั้งก่อน(กิโลวัตต์)</b></td>
            <td style="background-color:#a3a3a3;padding-left: 2px;"><b style="color: #000;font-size: 14px;margin-left: 5px;margin-top: 0px;">เลขอ่านปัจจุบัน(กิโลวัตต์)</b></td>
            <td style="background-color:#a3a3a3;padding-left: 2px;"><b style="color: #000;font-size: 14px;margin-left: 5px;margin-top: 0px;">ค่าไฟฟ้า(กิโลวัตต์)</b></td>
           <td style="background-color:#a3a3a3;padding-left: 2px;"><b style="color: #000;font-size: 14px;margin-left: 5px;margin-top: 0px;">หน่วย/บาท</b></td>
           <td style="background-color:#a3a3a3;padding-left: 2px;"><b style="color: #000;font-size: 14px;margin-left: 5px;margin-top: 0px;">จำนวนเงิน (บาท)</b></td>

        </tr>
    </thead>
    <tbody>
        <tr style="">
            <td>ค่าไฟฟ้าเดือนที่แล้ว</td>
            @if (@$data['bills_history_old'])
                <td>วันที่
                    :{{ date('d/m/Y', strtotime(@$data['bills_history_old']->date_start)) }}-{{ date('d/m/Y', strtotime(@$data['bills_history_old']->date_end)) }}
                </td>
            @else
                <td>ไม่พบข้อมูลบิลเดือนก่อนหน้า</td>
            @endif
            <td></td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>

        </tr>
        <tr>
            <td>ค่าความต้องการพลังงานไฟฟ้า Peak Deman @if($data['bills_data']->peak_deman_discount>0)ส่วนลด({{$data['bills_data']->peak_deman_discount}}%)@endif</td>
            @if (@$data['bills_history_old'])
                <td>{{ number_format(@$data['bills_history_old']->peak_deman, 6) }}</td>
            @else
                <td></td>
            @endif

            <td class="">{{ number_format($data['bills_data']->peak_deman, 6) }}</td>
            <td class=""> </td>

            <td class="text-right">
                {{ number_format($data['bills_data']->peak_deman_per_unit, 6) }}</td>
            <td class="text-right">
                {{ number_format($data['bills_data']->peak_deman_total, 6) }}</td>

        </tr>
        <tr>
            <td>พลังงานไฟฟ้าในช่วงเวลา (หน่วย) On-Peak @if($data['bills_data']->on_peak_discount>0)ส่วนลด({{$data['bills_data']->on_peak_discount}}%)@endif</td>
            @if (@$data['bills_history_old'])
                <td>{{ number_format(@$data['bills_history_old']->on_peak_deman_balance, 6) }}
                </td>
            @else
                <td></td>
            @endif

            <td class=" ">{{ number_format($data['bills_data']->on_peak, 6) }}</td>
            <td class="">{{ number_format($data['bills_data']->on_peak_balance, 6) }}</td>


            <td class="text-right">
                {{ number_format($data['bills_data']->on_peak_per_unit, 6) }}</td>
            <td class="text-right">{{ number_format($data['bills_data']->on_peak_total, 6) }}
            </td>

        </tr>

        <tr>
            <td>พลังงานไฟฟ้าในช่วงเวลา (หน่วย) off-Peak @if($data['bills_data']->off_peak_discount>0)ส่วนลด({{$data['bills_data']->off_peak_discount}}%)@endif</td>
            @if (@$data['bills_history_old'])
                <td>{{ number_format(@$data['bills_history_old']->off_peak_total, 6) }}
                </td>
            @else
                <td></td>
            @endif
            <td class=" ">
                {{ number_format($data['bills_data']->off_peak, 6) }}
            </td>
            <td class="">{{ number_format($data['bills_data']->off_peak_balance, 6) }}</td>


            <td class="text-right">
                {{ number_format($data['bills_data']->off_peak_per_unit, 6) }}</td>
            <td class="text-right">{{ number_format($data['bills_data']->off_peak_total, 6) }}
            </td>

        </tr>

        <tr>
            <td> </td>
            @if (@$data['bills_history_old'])
                <td>{{ number_format(@$data['bills_history_old']->ft, 6) }}</td>
            @else
                <td></td>
            @endif
            <td>
                {{ number_format($data['bills_data']->on_peak_balance + $data['bills_data']->off_peak_balance, 6) }}
            </td>
            <td class="">{{ number_format($data['bills_data']->on_peak + ($data['bills_data']->off_peak + $data['bills_data']->off_peak_day_off), 6) }}</td>

            <td class="text-right">{{ number_format($data['bills_data']->ft_per_unit, 6) }}
            </td>
            <td class="text-right">{{ number_format($data['bills_data']->ft_total, 6) }}</td>

        </tr>



        <tr>
            <td> </td>
            <td></td>
            <td> </td>
            <td> </td>
            <td>รวมเงินค่าไฟฟ้า :</td>

            <td class="text-right">{{ number_format($data['bills_data']->sum_price, 2) }}</td>

        </tr>


        <tr>
            <td> </td>
            <td></td>
            <td> </td>
            <td></td>

            <td>ภาษีมูลค่าเพิ่ม 7% :</td>
            <td class="text-right">{{ number_format($data['bills_data']->tax_total, 2) }}</td>

        </tr>
        <tr>
            <td colspan="6"><div class="horizontal-line"></div></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td> </td>
            <td></td>
            <td>รวมเงินค่าไฟฟ้าทั้งสิ้น :</td>

            <td class="text-right">{{ number_format($data['bills_data']->total_price, 2) }}</td>

        </tr>
        <tr>
            <td colspan="6"><div class="horizontal-line"></div></td>
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

{{-- <p style="padding: 0px;margin: 0px;">*หากมีปัญหาเกี่ยวกับสินค้ากรุณาติตต่อบริษัทที่ท่านสั่งซื้อสินคำโดยตรงและหากหัสดุดีกลับกรุณานำส่ง ตามชื่อผู้ฝากส่งรายการสินค้า</p> --}}

<table style="width: 100%;border: 0px;" border="0">
    <thead>
        <tr>
            <th align="left">

                <p>
                    <b>เกี่ยวกับบิลค่าไฟฟ้า</b><br>
                    อ้างอิงอัตราค่าไฟฟ้าดังต่อไปนี้ อัตราตามช่วงเวลาของการใช้ (TOU) สำหรับแรงดัน 22-33 kv
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
                <p>
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

                    ช่วงเวลา On-Peak (บาท/kWh) = {{number_format($data['bills_data']->on_peak_per_unit*($data['bills_data']->on_peak_discount/100), 6)}}  (ส่วนลดอัตราค่าไฟ {{$data['bills_data']->on_peak_discount}}% จาก กฟภ.)<br>
                    ช่วงเวลา Off-Peak (บาท/kWh) = {{number_format($data['bills_data']->off_peak_per_unit*($data['bills_data']->off_peak_discount/100), 6)}}  (ส่วนลดอัตราค่าไฟ {{$data['bills_data']->off_peak_discount}}% จาก กฟภ.)<br>
                    Ft (บาท/kWh.) = {{number_format($data['bills_data']->ft_per_unit*($data['bills_data']->ft_discount/100), 6)}} (ส่วนลดอัตราค่าไฟ {{$data['bills_data']->ft_discount}}% จาก กฟภ.)<br>
                    <b>ผลประหยัดที่ได้ ในเดือน {{$m_text}}</b><br>
                    {{number_format($data['bills_data']->discout_price_total,2)}} <br>
                </p>
            </th>
        </tr>

             <tr>
            <th align="left">

                @if ($data['bills_data']->bill_type == 'STC')

                    <p class="">ช่องทางการชำระเงิน : ธนาคารกรุงเทพ สาขาตลาดพงศ์เจริญ หาดใหญ่ <br>
                        ชื่อบัญชี : กิจการร่วมค้า สมาร์ท ไทคอน เลขที่ : 764-0-18148-8</p>

            @endif
            @if ($data['bills_data']->bill_type == 'SPP')

                    <p class="">ช่องทางการชำระเงิน : ธนาคารกรุงเทพ สาขาตลาดพงศ์เจริญ หาดใหญ่ <br>
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
