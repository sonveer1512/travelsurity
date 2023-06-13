
<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>

<!------ Include the above in your HEAD tag ---------->
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
      <div class="panel-heading" style="color: black;">Enter Your Details Here</div>
      <div class="panel-body">

        <?php if($this->session->flashdata('message')) { ?>                                    
          <div class="alert alert-success alert-dismissible fade show">                                        
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
            <?php echo $this->session->flashdata('message'); ?>                                     
          </div>                                
        <?php } ?>  

        <?php if($this->session->flashdata('error')) { ?>                                    
          <div class="alert alert-danger alert-dismissible fade show">                                        
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
            <?php echo $this->session->flashdata('error'); ?>                                     
          </div>                                
        <?php } ?> 

        <form method="post" class="adduser">
          <div class="form-group">
            <label for="myName"> Name *</label>
            <input id="myName" name="myName" required class="form-control" type="text" data-validation="required" value="<?php if(!empty($item['name'])) { echo $item['name']; } ?>">
          </div>
          <div class="form-group">
            <label for="lastname">email *</label>
            <input id="email" name="email" required class="form-control" type="email" data-validation="email" value="<?php if(!empty($item['email'])) { echo $item['email']; } ?>">
          </div>
          <div class="form-group">
            <label for="lastname">User Name *</label>
            <input id="user_name" name="user_name" required  class="form-control" type="text" data-validation="text" value="<?php if(!empty($item['user_name'])) { echo $item['user_name']; } ?>">
          </div>
           <div class="form-group">
            <label for="lastname">password *</label>
            <input id="password" name="password"  class="form-control" type="password" data-validation="text" value="<?php if(!empty($item['password'])) { echo $item['password']; } ?>">
          </div>
             <div class="form-group">
            <label for="lastname"> Confirm password *</label>
            <input id="confpassword" name="confpassword"  class="form-control" type="password" data-validation="text" value="<?php if(!empty($item['confpassword'])) { echo $item['confpassword']; } ?>">
          </div>
          <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input type="text" id="phone"  name="phone" required class="form-control" value="<?php if(!empty($item['phone'])) { echo $item['phone']; } ?>" required>
          </div>
          <input type="submit" name="submit" value="submit" class="btn btn-primary center">
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
    $(".adduser").on('submit', (function (e) {
    e.preventDefault();
    err = 0;
    var formData = new FormData(this);
    formData.append('action', "enqdet");

    var myName = $("#myName").val();
    var email = $("#email").val();
    var user_name = $("#user_name").val();
    var password = $("#password").val();
    var confpassword = $("#confpassword").val();
    var phone = $("#phone").val();

    $("#eqres").show();
    if (myName == '' || email == '' || user_name == '' || password == '' || confpassword == '' || phone == '') {
      err = 1;
      $("#eqres").html("<span style='color:red'>Enter mandatory fields</span>");
    }

    if(password != confpassword) {
      err = 1;
      $("#eqres").html("<span style='color:red'>Password not matched</span>"); 
    }

    if (err == 0) {
      $.ajax({
          url: "<?=base_url()?>User/add",
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
              if(response.exist == false) {
                  $("#eqres").html("<span style='color:green'>User added Successfully</span>");
              }
              else {
                  $("#eqres").html("<span style='color:red'>User Already Exist</span>");
              }
            }else {
              $("#eqres").html("<span style='color:red'>Password not matched</span>");
            }  
          },
          error: function (e) {
              $("#eqres").html("<span style='color:red'>Error...</span>");
          },
          complete: function () {
              $('.adduser')[0].reset();
              $('#eqres').delay(4000).fadeOut('slow');
          }
      });
    }
  }));
});
</script>