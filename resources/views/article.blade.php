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
            var article = <?php echo json_encode($article) ?>;
        </script>

        <label for="btnUpdate" id="labelUpdate" tabindex="0" class="btn btn-primary mb-2"><i class="bi bi-floppy"></i> บันทึก</label>

        <table class="table table-sm m-0" style="border-spacing:0;">
            <thead  style="font-size:16px;">
                <th class="text-center">#</th>
                <th class="text-center">รหัสสินค้า</th>
                <th class="text-center">ชื่อสินค้า</th>
                <th class="text-center">บาร์โค้ด</th>
                <th class="text-center">ราคาขายต่อชิ้น</th>
                <th class="text-center">โปรโมชั่น</th>
                <th class="text-center">ราคาโปรโมชั่น</th>
                <th class="text-center">จำนวนแพ็คต่อกล่อง</th>
                <th class="text-center">จำนวนชิ้นต่อกล่อง</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center"></th>
            </thead>
            <form action="/article/search" method="get">
                @csrf
                <tr class="text-center">
                    <th width="2%"></th>
                    <th width="10%">
                        <input type="number" name="sArticle" class="w-100 form-control" value="{{$sArticle}}" onchange="this.form.submit();" placeholder="ค้นหา"></input>
                    </th>
                    <th width="13.5%">
                        <input type="text" name="sArticleName" class="w-100 form-control" value="{{$sArticleName}}" onchange="this.form.submit();"  placeholder="ค้นหา"></input>
                    </th>
                    <th width="12.2%">
                        <input type="number" name="sBarcode" class="w-100 form-control" value="{{$sBarcode}}" onchange="form.submit()"  placeholder="ค้นหา"></input>
                    </th>
                    <th width="12.2%">
                        <input type="number" name="sPrice" class="w-100 form-control" value="{{$sPrice}}" onchange="form.submit()"  placeholder="ค้นหา"></input>
                    </th>
                    <th width="5%">
                    </th>
                    <th width="12.2%">
                        <input type="number" name="sPrice" class="w-100 form-control" value="{{$sPricePromo}}" onchange="form.submit()"  placeholder="ค้นหา"></input>
                    </th>
                    <th width="12.2%">
                        <input type="number" name="sPack" class="w-100 form-control" value="{{$sPack}}" onchange="form.submit()"  placeholder="ค้นหา"></input>
                    </th>
                    <th width="12.2%">
                        <input type="number" name="sSize" class="w-100 form-control" value="{{$sSize}}" onchange="form.submit()"  placeholder="ค้นหา"></input>
                    </th>
                    <th width="7%">
                        <select name="sStatus" class="w-100 form-control" onchange="form.submit()">
                            <option value selected>ค้นหา</option>
                            @if($sStatus == 0)
                                <option value="0" selected>No Active</option>
                            @else
                                <option value="0">No Active</option>
                            @endif
                            @if($sStatus == 1)
                                <option value="1" selected>Active</option>
                            @else
                                <option value="1">Active</option>
                            @endif
                        </select>
                    </th>
                    <th>
                        <button class="btn btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </th>
                </tr>
            </form>
        </table>

        <form action="/article/update" method="post" id="frmSubmit" class="frm needs-validation">
            @csrf
            <button type="button" class="btn btn-primary mb-2 hidden" id="btnUpdate" hidden>
                <i class="bi bi-floppy"></i>
                บันทึก
            </button>
            <table class="table table-sm" style="border-spacing:0;">
                @if(count($article) == 0)
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
       
        <script src="/js/article.js"></script>
        <script src="/js/btn.js"></script>
    </div>
@endsection