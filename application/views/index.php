<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Travel Surity | LMS | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=base_url()?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?=base_url()?>assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b>Travel Surity</b> LMS</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        
        <?php if($this->session->flashdata('error')) { ?>                                    
          <div class="alert alert-danger alert-dismissible">                                        
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> 
            <?php echo $this->session->flashdata('error'); ?>                                     
          </div>                                
        <?php } ?>      

        <form action="<?=base_url()?>Index/login" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" required placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" required name="password" class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
               
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" name="submit" value="Sign In" class="btn btn-primary" />
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
  
  </body>
</html>