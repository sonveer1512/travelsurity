 <?php $user_details = $this->WebModel->list_common_where3('user','user_id',$this->session->userdata('lmssession_id')); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?=ucfirst($user_details[0]['user_type'])?> | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <link href="<?=base_url()?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?=base_url()?>assets/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?=base_url()?>assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?=base_url()?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?=base_url()?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?=base_url()?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?=base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url()?>" class="logo"><b><?=ucfirst($user_details[0]['user_type'])?> </b>LMS</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="<?=base_url()?>User/new">User Registration</a>
              </li>

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=base_url()?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $user_details[0]['user_name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-footer">
                    <div class="pull-center">
                      <a href="<?=base_url()?>Index/LogOut" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper" style="min-height: 960px;">
        
