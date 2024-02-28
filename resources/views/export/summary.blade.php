<table>
    <thead>
    <tr>
        <th style="text-align:center;vertical-align:middle;background-color:#E2EFDA;" width="15" ><b>Article</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#E2EFDA;" ><b>Barcode</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#E2EFDA;" ><b>Article Name</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#E2EFDA;border:solid;" ><b>Cost Ex.VAT</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#DEFDB5;border:solid;" ><b>จำนวน (ชิ้น)</b></th>
        <th style="text-align:center;vertical-align:middle;background-color:#DEFDB5;border:solid;" ><b>Total (THB)</b></th>
    </tr>
    </thead>
    @php
        $article = [];

        for($i=0;$i < count($allocate);$i++)
        {
            $article[] = $allocate[$i]['article'];
        }

        $article = array_unique($article);
        $article = array_values($article);

        $barcode = [];
        $article_name = [];
        $price = [];
        $totalstock = [];
        $totalprice = [];

        for($i=0;$i < count($article);$i++)
        {
            $totalstock[$i] = 0;
            $totalprice[$i] = 0;

            for($j=0;$j < count($allocate);$j++)
            {
                if($article[$i] == $allocate[$j]['article']){
                    $barcode[$i] = $allocate[$j]['barcode'];
                    $article_name[$i] = $allocate[$j]['article_name'];
                    $price[$i] = $allocate[$j]['price'];
                    $totalstock[$i] = $totalstock[$i] + (float)$allocate[$j]['sumstock'];
                    $totalprice[$i] = $totalstock[$i] * $price[$i];
                }
            }
        } 
    @endphp
    <tbody>
        @php 
            $netsum = 0;
            $nettotal = 0;
        @endphp 
        @for($i=0;$i < count($article); $i++)
            <tr>
                <td style="text-align:center;"><b>{{$article[$i]}}</b></td>
                <td style="text-align:center;"><b>{{$barcode[$i]}}</b></td>
                <td>{{$article_name[$i]}}</td>
                <td style="border:solid;">{{$price[$i]}}</td>
                <td style="background-color:#DEFDB5;border:solid;" >{{$totalstock[$i]}}</td>
                <td style="background-color:#DEFDB5;border:solid;" >{{$totalprice[$i]}}</td>
                @php 
                    $netsum = $netsum + (float)$totalstock[$i];
                    $nettotal = $nettotal + (float)$totalprice[$i];
                @endphp
            </tr>
        @endfor
        <tr>
            <td colspan="3" style="text-align:right;vertical-align:middle;background-color:#E2EFDA;font-size:14px;"><b>ผลรวมทั้งหมด</b></td>
            <td style="border:solid;background-color:#E2EFDA;font-size:14px;"></td>
            <td style="background-color:#DEFDB5;border:solid;text-align:right;color:#0070C0;font-size:14px;"><b>{{number_format($netsum, 2)}}</b></td>
            <td style="background-color:#DEFDB5;border:solid;text-align:right;color:#0070C0;font-size:14px;"><b>{{number_format($nettotal, 2)}}</b></td>
        </tr>
    </tbody>
</table>