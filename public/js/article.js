/*-----------------------------------------------------------------------------------
*				Project Name: Allcate 					                            *
* 				Sub Project Name: Allcate 				                            *
*				File Name:	article.js         	    		                        *
* 				Project Creator: Phaninphat					                        *
* 				Project Create Date: Febuary 08, 2024	                            *
* 				Defect List: 							                            *
* 				                                	                                *
-------------------------------------------------------------------------------------*/

var rowTotal = 0;
var rowIdx = 0;

$(document).ready( function(e){
    $.each(article, function(index, data) 
    {
        var options = new Array();

        rowIdx = index;
        rowTotal = rowTotal + 1;
        chkPromo = "";

        if(data.status == 0)
        {
            options.push('<option value="0" selected>No Active</option>');
        }
        else
        {
            options.push('<option value="0">No Active</option>');
        }
        if(data.status == 1)
        {
            options.push('<option value="1" selected>Active</option>');
        }
        else
        {
            options.push('<option value="1">Active</option>');
        }

        if(data.promotion == 1)
        {
            chkPromo = "checked";
        }

        $('#tbody').append(`
            <tr class="align-middle" id="R${rowIdx}">
                <th class="text-center" width="2%">
                    ${++rowIdx} 
                    <input type="hidden" id="no" name="no[]" value="${data.no}">
                </th>
                <td width="10%">
                    <input type="number" class="w-100 form-control" name="article_no[]" id="article${rowIdx}" value="${Number(data.article_no)}"
                        onkeyup="chkArticleNo(this.id)" required />
                    <div id="dupVal${rowIdx}" class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="13.5%">
                    ${data.article_name}
                </td>
                <td width="12.2%">
                    <input class="w-100 form-control" type="number" name="barcode[]" id="barcode${rowIdx}" value="${data.barcode}" 
                        onkeyup="chkBarcode(this.id)" required />
                    <div id="dupBar${rowIdx}" class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="12.2%">
                    <input class="w-100 form-control" type="number" name="price[]" id="price${rowIdx}" value="${data.price}" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td class="text-center" width="5%">
                    <input class="form-check-input" type="checkbox" value="" name="promotion[]" id="promotion${rowIdx}" ${chkPromo}>
                </td>
                <td width="12.2%">
                    <input class="w-100 form-control" type="number" name="price_promo[]" id="price_promo${rowIdx}" value="${data.price_promo}" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="12.2%">
                    <input class="w-100 form-control" type="number" name="pack[]" id="pack${rowIdx}" value="${data.pack}" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="12.2%">
                    <input class="w-100 form-control" type="number" name="size[]" id="size${rowIdx}" value="${data.size}" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="7%">
                    <select class="w-100 form-control" name="status[]" id="status${rowIdx}"  required>
                        ${options}
                    </select>
                </td>
                <td>
                    <button class="btn btn-danger remove" onclick="getRmvNo(${data.no})" type="button">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        `);
    });
    

    $('#tbody').on('click', '.remove', function () 
    {
        Swal.fire({
            title: 'ลบข้อมูล!',
            text: "ต้องการลบข้อมูลใช่หรือไม่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                  'ลบข้อมูลเรียบร้อย',
                  '',
                'success'
              ).then((result)=> {
                  if(result.isConfirmed)
                  {
                    var child = $(this).closest('tr').nextAll();

                    child.each(function () {
                        var id = $(this).attr('id');
                        var idx = $(this).children('.row-index').children('label');
                        var dig = parseInt(id.substring(1));
            
                        idx.html(`${dig - 1}`);
                            $(this).attr('id', `R${dig - 1}`);
                    });
            
                    $(this).closest('tr').remove();
            
                    rowIdx--;                  
                }
              });
            }
          }); 
    });

    $('#add').on('click', function()
    {
        rowTotal = rowTotal + 1;
        $('#tbody').append(`
            <tr class="align-middle" id="R${rowIdx}">
                <th class="text-center" width="2%">
                    ${++rowIdx}
                    <input type="hidden" id="no" name="no[]" value="">
                </th>
                <td width="10%">
                    <input class="w-100 form-control" type="number" name="article_no[]" id="article${rowIdx}" value=""
                        onkeyup="chkArticleNo(this.id)" required />
                    <div id="dupVal${rowIdx}" class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="13.5%">
                </td>
                <td width="12.2%">
                    <input class="w-100 form-control" type="number" name="barcode[]" id="barcode${rowIdx}" value="" 
                        onkeyup="chkBarcode(this.id)" required />
                    <div id="dupBar${rowIdx}" class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="12.2%">
                    <input class="w-100 form-control" type="number" name="price[]" id="price${rowIdx}" value="" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td class="text-center" width="5%">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="promotion[]" id="promotion${rowIdx}" >
                    </div>
                </td>
                <td width="12.2%">
                    <input class="w-100 form-control" type="number" name="price_promo[]" id="price_promo${rowIdx}" value="" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="12.2%">
                    <input class="w-100 form-control" type="number" name="pack[]" id="pack${rowIdx}" value="" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="12.2%">
                    <input class="w-100 form-control" type="number" name="size[]" id="size${rowIdx}" value="" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="7%">
                    <select class="w-100 form-control" name="status[]" id="status${rowIdx}" required>
                        <option value="0">No Active</option>
                        <option value="1">Active</option>
                    </select>
                </td>
                <td>
                        <button class="btn btn-danger remove" type="button">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        `);
    });
    
});

function getRmvNo(no){
    $('#tbody').append(`
        <input type="hidden" id="rmvNo" name="rmvNo[]" value="${no}">
    `);
}


function chkArticleNo(article)
{
    const id = article.substring(article.length, 7);

    for(var i=1;i<rowTotal;i++)
    {
        if(i != id){
            if(document.getElementById("article"+i).value == document.getElementById(article).value)
            {
                //block submit
                document.getElementById("btnUpdate").disabled = true;
                document.getElementById("labelUpdate").classList.add("disabled");
                document.getElementById(article).classList.add("is-invalid");
                document.getElementById("dupVal"+id).innerHTML = "ข้อมูลซ้ำ";
                break;
            }
            else
            {
                //unblock submit
                document.getElementById("btnUpdate").disabled = false;
                document.getElementById("labelUpdate").classList.remove("disabled");
                document.getElementById(article).classList.remove("is-invalid");
                document.getElementById("dupVal"+id).innerHTML = "กรุณากรอกข้อมูล";
            }
        }

        if(document.getElementById(article).value.length > 9)
        {
            document.getElementById("btnUpdate").disabled = true;
            document.getElementById("labelUpdate").classList.add("disabled");
            document.getElementById(article).classList.add("is-invalid");
            document.getElementById("dupVal"+id).innerHTML = "กรอกได้ไม่เกิน 9 ตัวอักษร";
        }
    }
}

function chkBarcode(barcode)
{
    const id = barcode.substring(barcode.length, 7);

    if(document.getElementById(barcode).value.length > 13)
    {
        document.getElementById("btnUpdate").disabled = true;
        document.getElementById("labelUpdate").classList.add("disabled");
        document.getElementById(barcode).classList.add("is-invalid");
        document.getElementById("dupBar"+id).innerHTML = "กรอกได้ไม่เกิน 13 ตัวอักษร";
    }
    else
    {
        document.getElementById("btnUpdate").disabled = false;
        document.getElementById("labelUpdate").classList.remove("disabled");
        document.getElementById(barcode).classList.remove("is-invalid");
        document.getElementById("dupBar"+id).innerHTML = "กรุณากรอกข้อมูล";
    }
}

function valPromotion(rowIdx)
{
    for(i=1;i<=rowIdx;i++){
        var promotion = document.getElementById("promotion"+i);
    
        if(promotion.checked == false)
        {
            promotion.checked = true;
            promotion.value = 0;
        }
        else{
            promotion.value = 1;
        }
    }
}