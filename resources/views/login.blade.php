<div class="modal fade modal-fullscreen" id="loginmodal" data-keyboard="false"data-keyboard="false" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow: hidden;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body d-flex justify-content-center">
        
            <form action="/login" method="post" style="text-align:center;width:35%;">

              <img src="/images/spaclean.png" width="300px" height="180px;" ></img>

                @csrf
                <div class="card" style="background-color:#fff;margin-top:10%;">
                    <div class="card-header">
                    <h5><b>Allocate Big C</b></h5>
                    <div class="card-body">

                        @if(session()->has('failLogin'))
                          <script>
                              $(function() {
                                  $('#loginbtn').click();
                              });
                          </script>
                          <div class="alert alert-danger" role="alert">
                            {{session()->get('failLogin')}}
                          </div>
                        @endif

                        <div class="form-group" style="margin:20px;">
                          <input type="text" class="form-control" name="code" placeholder="ชื่อผู้ใช้งาน" style="height:50px; text-align:center; background-color:#EEEEEE;" autofocus required>
                        </div>
                        <div class="form-group" style="margin:20px;">
                          <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" style="height:50px; text-align:center; background-color:#EEEEEE;" required>
                        </div>

                        <button type="submit" class="btn-purple text-white" style="padding: 10px 20px 10px 20px;">เข้าสู่ระบบ</button>
                    </div>
                </div>

                <div class="bg-purple text-white fixed-bottom w-100 d-flex align-items-center justify-content-center" style="height:8%;">
                    Copyright © 2024 KCCP 2011 Group Co.,Ltd. All rights reserved.
                </div>
              
            </form>
        </div>
    </div>
  </div>
</div>