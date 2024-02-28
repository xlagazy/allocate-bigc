<!-----------------------------------------------------------------------------------
*				Project Name: Allcate 					                            *
* 				Sub Project Name: Allcate 				                            *
*				File Name:	article.php         			                        *
* 				Project Creator: Phaninphat					                        *
* 				Project Create Date: Febuary 08, 2024	                            *
* 				Defect List: 							                            *
* 				                                                                    *
------------------------------------------------------------------------------------->

@extends('master')
@section('contents')
    <div class="m-5 table-responsive">
        <script>
            var cond = <?php echo json_encode($cond) ?>;
        </script>

        <label for="btnUpdate" id="labelUpdate" tabindex="0" class="btn btn-primary mb-2"><i class="bi bi-floppy"></i> บันทึก</label>

        <table class="table table-sm m-0" style="border-spacing:0;">
            <thead style="font-size:16px;">
                <th class="text-center" width="2%">#</th>
                <th class="text-center" width="14.35%">บาร์โค้ด</th>
                <th class="text-center" width="14.35%">ชื่อสินค้า</th>
                <th class="text-center" width="7.4%">เงื่อนไข</th>
                <th class="text-center" width="28.5%">จำนวนเงื่อนไข</th>
                <th class="text-center" width="28.5%">จำนวนสินค้าที่เติม</th>
                <th></th>
            </thead>
            <form action="/condition/search" method="get">
                <tr>
                    <td></td>
                    <td>
                        <input type="number" name="sBarcode" class="w-100 form-control" value="{{$sBarcode}}" onchange="this.form.submit();" placeholder="ค้นหา"></input>
                    </td>
                    <td>
                        <input type="text" name="sAriticleName" class="w-100 form-control" value="{{$sAriticleName}}" onchange="this.form.submit();" placeholder="ค้นหา"></input>
                    </td>
                    <td>
                        <select name="sMath" class="w-100 form-control" onchange="form.submit()">
                            <option value selected>ค้นหา</option>
                            @if($sMath == 0)
                                <option value="0" selected><=</option>
                            @else
                                <option value="0"><=</option>
                            @endif
                            @if($sMath == 1)
                                <option value="1" selected>>=</option>
                            @else
                                <option value="1">>=</option>
                            @endif
                            @if($sMath == 2)
                                <option value="2" selected>==</option>
                            @else
                                <option value="2">==</option>
                            @endif
                        </select>
                    </td>
                    <td>
                        <input type="number" name="sCondition" class="w-100 form-control" value="{{$sCondition}}" onchange="this.form.submit();" placeholder="ค้นหา"></input>
                    </td>
                    <td>
                        <input type="number" name="sVolume" class="w-100 form-control" value="{{$sVolume}}" onchange="this.form.submit();" placeholder="ค้นหา"></input>
                    </td>
                    <td></td>
                </tr>
            </form>
        </table>

        <form action="/condition/update" method="post" class="frm needs-validation">
            @csrf
            <button type="button" class="btn btn-primary mb-2" id="btnUpdate" hidden>
                <i class="bi bi-floppy"></i>
                บันทึก
            </button>
            <table class="table table-sm caption-top" style="border-spacing:0;">
                @if(count($cond) == 0)
                    <caption class="text-center bg-white border h3">
                        ไม่พบข้อมูล
                    </caption>
                @endif
                <tbody id="tbody">
                    <!-- include from article.js -->
                </tbody>
            </table>
            <button class="btn btn-success w-100" type="button" id="add">
                <i class="bi bi-plus-lg h4"></i>
            </button>
        </form>
       
        <script src="/js/condition.js"></script>
        <script src="/js/btn.js"></script>
    </div>
@endsection