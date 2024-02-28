/*-----------------------------------------------------------------------------------
*				  Project Name: Allcate 					                                           *
* 				Sub Project Name: Allcate 				                                         *
*				  File Name:	article.js         	    		                                   *
* 				Project Creator: Phaninphat					                                       *
* 				Project Create Date: Febuary 08, 2024	                                     *
* 				Defect List: 							                                                 *
* 				                                	                                         *
-------------------------------------------------------------------------------------*/

$(".frm").on("click","#btnUpdate",function(e){
    e.preventDefault();
    var form = $(this).parents('form');

    if (form[0].checkValidity() === false) {
        e.preventDefault()
        e.stopPropagation()
    }
    else{
        Swal.fire({
          title: 'บันทึก!',
          text: "ต้องการบันทึกข้อมูลใช่หรือไม่",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
                'บันทึกข้อมูลเรียบร้อย',
                '',
              'success'
            ).then((result)=> {
                if(result.isConfirmed){
                  valPromotion(rowIdx);
                  form.submit();
                }
            });
          }
        }); 
    }
    
    form.addClass('was-validated');
});