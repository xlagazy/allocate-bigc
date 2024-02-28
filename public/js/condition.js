/*-----------------------------------------------------------------------------------
*				Project Name: Allcate 					                            *
* 				Sub Project Name: Allcate 				                            *
*				File Name:	condition.js         	    		                        *
* 				Project Creator: Phaninphat					                        *
* 				Project Create Date: Febuary 08, 2024	                            *
* 				Defect List: 							                            *
* 				                                	                                *
-------------------------------------------------------------------------------------*/

var rowTotal = 0;
var rowIdx = 0;

$(document).ready( function(e){
    
    $.each(cond, function(index, data) 
    {
        var options = Array();

        rowIdx = index;
        rowTotal = rowTotal + 1;

        if(data.math == "0"){
            options.push('<option value="0" selected> <= </option>');
        }
        else{
            options.push('<option value="0"> <= </option>');
        }
        if(data.math == "1"){
            options.push('<option value="1" selected> >= </option>');
            console.log(data.math);
        }
        else{
            options.push('<option value="1"> >= </option>');
        }
        if(data.math == "2"){
            options.push('<option value="2" selected> == </option>');
        }
        else{
            options.push('<option value="2"> == </option>');
        }

        $('#tbody').append(`
            <tr class="align-middle" id="R${rowIdx}">
                <th class="text-center" width="2%">
                    ${++rowIdx} 
                    <input type="hidden" id="no" name="no[]" value="${data.no}">
                </th>
                <td width="14.35%">
                    <input class="w-100 form-control" type="number" name="barcode[]" id="barcode${rowIdx}" value="${data.barcode}" 
                        onkeyup="chkBarcode(this.id)" required />
                    <div id="dupBar${rowIdx}" class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="14.35%">
                    ${data.article_name}
                </td>
                <td width="7.4%">
                    <select class="form-control text-center" name="math[]" id="math${rowIdx}">
                        ${options}
                    </select>
                </td>
                <td width="28.5%">
                    <input class="w-100 form-control" type="number" name="condition[]" id="condition${rowIdx}" value="${data.condition}" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td width="28.5%">
                <td>
                    <input class="w-100 form-control" type="number" name="volume[]" id="volume${rowIdx}" value="${data.volume}" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="5%">
                        <button class="btn btn-danger remove" onclick="getRmvNo(${data.no})" type="button">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        `);
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
                <td width="14.35%">
                    <input class="w-100 form-control" type="number" name="barcode[]" id="barcode${rowIdx}" value="" 
                        onkeyup="chkBarcode(this.id)" required />
                    <div id="dupBar${rowIdx}" class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="14.35%">
                </td>
                <td width="7.4%">
                    <select class="form-control text-center" name="math[]" id="math${rowIdx}">
                        <option value="0"> <= </option>
                        <option value="1"> >= </option>
                        <option value="2"> == </option>
                    </select>
                </td>
                <td width="28.5%">
                    <input class="w-100 form-control" type="number" name="condition[]" id="condition${rowIdx}" value="" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td width="28.5%">
                    <input class="w-100 form-control" type="number" name="volume[]" id="volume${rowIdx}" value="" required />
                    <div class="invalid-feedback">
                        กรุณากรอกข้อมูล
                    </div>
                </td>
                <td>
                        <button class="btn btn-danger remove" type="button">
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

});

function getRmvNo(no){
    $('#tbody').append(`
        <input type="hidden" id="rmvNo" name="rmvNo[]" value="${no}">
    `);
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