<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>

  <section class="content">
    <legend><center><h2><b>User list</b></h2></center></legend>
      <div class="row">
        <div class="col-xs-12">
        
          <div class="box">
            <div class="box-header">
            
              <div class="box-body">
                <div class="col-md-2">
                  <table class="table table-bordered text-center">
                    <tr>
                      <td><a href="<?=base_url()?>User/new" class="btn btn-block btn-success btn-sm">Add New user</a></td>
                    </tr>
                  </table>
                </div>
                
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact NO.</th>
                      <th>User Name </th>
                      <?php 
                        $usertype = $this->session->userdata('user_type');
                        if($usertype=="admin") { ?>
                      <th>Action</th>
                      <?php } ?>
                    </tr>
                  </thead>
              
                  <tbody>
                    <?php $i=0; foreach($user as $result) { $i++; ?>
                      <tr>                       
                        <td><?php echo $i ; ?></td>
                        <td><?php echo $result['name'];?> </td>
                        <td><?php echo $result['email_id'];?></td>
                        <td><?php echo $result['phone'];?></td>
                        <td><?php echo $result['user_name'];?></td>  
                        <?php 
                          $usertype = $this->session->userdata('user_type');
                          if($usertype=="admin") { ?>                      
                        <td>
                          <a class="btn btn-info" href="<?=base_url()?>User/edit/<?=$result['user_id']?>">
                            <i class="fa fa-edit"></i>
                          </a>
                          <a class="btn btn-danger" href="<?=base_url()?>User/delete/<?=$result['user_id']?>" onclick="return confirm('Are you sure to Delete!');">
                            <i class="fa fa-trash-o"></i>
                          </a>
                          <a class="btn btn-warning" href="<?=base_url()?>User/changepassword/<?=$result['user_id']?>">
                            <i class="fa fa-key"></i>
                          </a>  
                        </td>
                        <?php } ?>
                      </tr>
                    <?php }?>

                  </tbody>
                </table>                
                    
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->


<?php include("includes/footer.php");?>
    