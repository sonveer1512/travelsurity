<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-3"></div>
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Change Password</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" class="changepassword">
            <div class="box-body">
            
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" name="email"  class="form-control" value="<?php if(!empty($item['email_id'])) { echo $item['email_id']; } ?>" readonly>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">New password</label>
                <input type="password" name="password"  class="form-control"  placeholder="Enter New Password">
              </div>
      
              <div class="form-group">
                <label for="exampleInputEmail1">Confrom password</label>
                <input type="password" name="confpassword"  class="form-control"  placeholder="Enter Confrom Password">
              </div>
            
            </div><!-- /.box-body -->

            <div class="box-footer">
              <input type="submit" name="submit" value="submit" class="btn btn-primary">
              <div class="center"><span id="eqres"></span></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php include("includes/footer.php");?>



<script>
  $(document).ready(function () {
    $(".changepassword").on('submit', (function (e) {
    e.preventDefault();
    err = 0;
    var formData = new FormData(this);
    formData.append('action', "enqdet");

    var password = $("#password").val();
    var confpassword = $("#confpassword").val();

    $("#eqres").show();
    if (password == '' || confpassword == '') {
      err = 1;
      $("#eqres").html("<span style='color:red'>Enter mandatory fields</span>");
    }

    if(password != confpassword) {
      err = 1;
      $("#eqres").html("<span style='color:red'>Password not matched</span>"); 
    }

    if (err == 0) {
      $.ajax({
          url: "<?=base_url()?>User/updatepassword",
          type: "POST",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function () {
              $("#eqres").html("<span class='process'>Please wait...</span>");
          },
          success: function (response) {
            if(response.status == true) {
              $("#eqres").html("<span style='color:green'>User added Successfully</span>");
            }else {
              $("#eqres").html("<span style='color:red'>Password not matched</span>");
            }  
          },
          error: function (e) {
              $("#eqres").html("<span style='color:red'>Error...</span>");
          },
          complete: function () {
              $('#eqres').delay(4000).fadeOut('slow');
          }
      });
    }
  }));
});
</script>
