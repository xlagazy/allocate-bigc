@extends('master')
@section('contents')
    <div class="container-xxl py-5" data-wow-delay="0.1s" style="margin-bottom:6.8%;">
        <div class="text-center">
            @if(Session::get('error'))
                <div class="alert alert-danger" role="alert">
                        <h3 class="alert-heading">                   
                        <i class="bi bi-x-circle-fill"></i>
                        เกิดข้อผิดพลาด!!
                        </h3>
                    <p class="mb-0">ข้อมูลไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์และลองใหม่อีกครั้ง</p>
                </div>
            @elseif(Session::get('success'))
                <div class="alert alert-success" role="alert">
                        <h3 class="alert-heading">                   
                        <i class="bi bi-check-circle-fill"></i>
                        เสร็จสิ้น!!
                        </h3>
                    <p class="mb-0">แปลงไฟล์เสร็จสิ้น กรุณาตรวจสอบไฟล์ดาวน์โหลด</p>
                </div>
                @if(Session::get('fileName'))
                    <table class="table table-light">
                        <tr>
                            <td class="text-left">
                                <i class="bi bi-filetype-xlsx text-success h3"></i> {{Session::get('fileName')}}
                            </td>
                            <td>
                                <button tyle="button" id="btnDownload" class="btn btn-success" onclick="download()">
                                    <i class="bi bi-download"></i> ดาวน์โหลด
                                </button>
                            </td>
                        </tr>
                    </table>
                @endif
            @endif

            <form action="/import" method="post" id="frm" enctype="multipart/form-data">
                <div id="loader" class="mb-3" style="display:none">
                    <img class="imgshadow" src="/images/spaclean.png" width="250" height="150" />
                    <div class="word drop-title" style="height:100px;"></div>
                </div>

                <div id="areafile" class="mb-3">
                    @csrf
                    <label for="file" class="drop-container" id="dropcontainer">
                        <i class="bi bi-cloud-arrow-up-fill" style="color:#7034fc;font-size:6rem;"></i>
                        <span class="drop-title">วางไฟล์ CSV ที่นี่ <br> เพื่อแปลงไฟล์</span>
                        <input type="file" name="file" id="file" accept="text/csv" onchange="frmSubmit()" style="display:none;">
                    </label>
                </div>
            </form>
        </div>
    </div>

    <script src="/js/textanimate.js"></script> 
    <script type="text/javascript">
        const dropContainer = document.getElementById("dropcontainer")
        const fileInput = document.getElementById("file")
            
        dropContainer.addEventListener("dragover", (e) => {
            // prevent default to allow drop
            e.preventDefault()
        }, false)

        dropContainer.addEventListener("dragenter", () => {
            dropContainer.classList.add("drag-active")
        })

        dropContainer.addEventListener("dragleave", () => {
            dropContainer.classList.remove("drag-active")
        })

        dropContainer.addEventListener("drop", (e) => {
            e.preventDefault()
            dropContainer.classList.remove("drag-active")
            fileInput.files = e.dataTransfer.files
            frmSubmit();
        })

        function frmSubmit(){
            $('#loader').show();
            $('#areafile').hide();

            $('form#frm').submit();

        }

        function download(){
            var fileName =  '<?php echo session()->get('fileName') ?>';
            window.location.href='/download/'+fileName;
        }
    </script>
@endsection