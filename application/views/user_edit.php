
<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>

<style>
    .palel-primary
  {
    border-color: #bce8f1;
  }
  .panel-primary>.panel-heading
  {
    background:#bce8f1;
    
  }
  .panel-primary>.panel-body
  {
    background-color: #EDEDED;
  }
</style>
<body>
  <div class="row">
      <div class="col-md-5 col-sm-12 col-lg-7 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Enter Your Details Here</div>
        <div class="panel-body">
          <form method="post" class="edituser">
            <div class="form-group">
              <label for="myName"> Name *</label>
              <input id="myName" name="myName" value="<?php if(!empty($item['name'])) { echo $item['name']; } ?>"  required class="form-control" type="text" data-validation="required">
              <span id="error_name" class="text-danger"></span>
            </div>
            <div class="form-group">
              <label for="lastname">email *</label>
              <input id="lastname" name="email" required value="<?php if(!empty($item['email_id'])) { echo $item['email_id']; } ?>"  class="form-control" type="email" data-validation="email" readonly>
              <span id="error_email" class="text-danger"></span>
            </div>
            <div class="form-group">
              <label for="lastname">User Name *</label>
              <input id="lastname" name="user_name" required value="<?php if(!empty($item['user_name'])) { echo $item['user_name']; } ?>" class="form-control" type="text" data-validation="text">
              <span id="error_username" class="text-danger"></span>
            </div>
           
            <div class="form-group">
              <label for="phone">Phone Number *</label>
              <input type="text" id="phone" value="<?php if(!empty($item['phone'])) { echo $item['phone']; } ?>" name="phone" required class="form-control" required>
            </div>
            
            <input type="submit"  name="submit" value="submit" class="btn btn-primary center">
            <div class="center"><span id="eqres"></span></div>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>
</div>
<?php include("includes/footer.php");?>


<script>
  $(document).ready(function () {
    $(".edituser").on('submit', (function (e) {
    e.preventDefault();
    err = 0;
    var formData = new FormData(this);
    formData.append('action', "enqdet");

    var myName = $("#myName").val();
    var email = $("#email").val();
    var user_name = $("#user_name").val();
    var phone = $("#phone").val();

    $("#eqres").show();
    if (myName == '' || email == '' || user_name == '' || phone == '') {
      err = 1;
      $("#eqres").html("<span style='color:red'>Enter mandatory fields</span>");
    }

    if (err == 0) {
      $.ajax({
          url: "<?=base_url()?>User/updateuser",
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
              $("#eqres").html("<span style='color:green'>User updated Successfully</span>");
            }else {
              $("#eqres").html("<span style='color:red'>Something went wrong</span>");
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