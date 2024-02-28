
<table>
    <thead>
    <tr>
        <th style="text-align:center;vertical-align:middle;background-color:#FFFFCD;" width="11"><b>Report Code</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#FFFFCD;" width="30"><b>Supplier</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#FFFFCD;" width="14"><b>Business Format</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#FFFFCD;" width="30"><b>Store</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#FFFFCD;" width="15"><b>Barcode</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#FFFFCD;" width="11"><b>Article</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#FFFFCD;" width="28"><b>Article Name</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#FFFFCD;" width="11"><b>Stock Qty TY</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#FCE7DB;border:solid;" width="25"><b>พิจารณาเปิดเติม Stock <br> พร้อมส่ง 100% (ชิ้น)</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#FCE7DB;border:solid;" width="12"><b>Cost Ex.VAT</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#FCE7DB;border:solid;" width="14"><b>Total (THB)</b></th>
    </tr>
    </thead>
    <tbody>
    @php
        $totalstock = 0;
        $totalprice = 0;
        $net = 0;
    @endphp
    @for($i=0;$i < count($allocate);$i++)
        <tr>
            <td style="background-color:#FFFFCD;" >{{$allocate[$i]['report_code']}}</td>
            <td style="background-color:#FFFFCD;" >{{$allocate[$i]['supplier']}}</td>
            <td style="background-color:#FFFFCD;" >{{$allocate[$i]['bussiness_format']}}</td>
            <td style="background-color:#FFFFCD;" >{{$allocate[$i]['store']}}</td>
            <td style="background-color:#FFFFCD;" >{{$allocate[$i]['barcode']}}</td>
            <td style="background-color:#FFFFCD;" >{{$allocate[$i]['article']}}</td>
            <td style="background-color:#FFFFCD;" >{{$allocate[$i]['article_name']}}</td>
            <td style="background-color:#FFFFCD;" >{{$allocate[$i]['stock']}}</td>
            <td style="background-color:#FCE7DB;border-left:5px solid black;border-right:solid;border-width:medium;text-align:right;">{{$allocate[$i]['sumstock']}}</td>
            <td style="background-color:#FCE7DB;border-left:5px solid black;border-right:solid;border-width:medium;text-align:right;">{{$allocate[$i]['price']}}</td>
            <td style="background-color:#FCE7DB;border-left:5px solid black;border-right:solid;border-width:medium;text-align:right;">{{$allocate[$i]['total']}}</td>
            @php 
                $totalstock = $totalstock + (float)$allocate[$i]['sumstock'];
                $net = $net + (float)$allocate[$i]['total'];
            @endphp
        </tr>
    @endfor
        <tr>
            <td style="text-align:right;background-color:#FFFFCD;border:solid;font-size:14px;" colspan="8"><b>ผลรวมทั้งหมด</b></td>
            <td style="text-align:right;background-color:#FCE7DB;border:solid;color:#0070C0;font-size:14px;"><b>{{number_format($totalstock, 2)}}</b></td>
            <td style="text-align:right;background-color:#FCE7DB;border:solid;font-size:14px;"></td>
            <td style="text-align:right;background-color:#FCE7DB;border:solid;color:#0070C0;font-size:14px;"><b>{{number_format($net, 2)}}</b></td>
        </tr>
    </tbody>
</table>