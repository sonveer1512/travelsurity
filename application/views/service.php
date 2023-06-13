<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>

  <section class="content">
    <div class="row">
      <div class="col-xs-3"></div>
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header">
          <h3 class="box-title">Service Master</h3>
          </div><!-- /.box-header -->
          <form role="form" method="post" action="<?=base_url()?>Service/add">

            <input type="hidden" name="id" value="<?php if(!empty($item['service_id'])) { echo $item['service_id']; } ?>">

            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Service Name</label>
                <input type="text" value="<?php if(!empty($item['service_name'])) { echo $item['service_name']; } ?>" name="service_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Service Name">
              </div>
            </div>
            <div class="box-footer">
              <input type="submit" name="submit" value="submit" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Service List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Serial No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <th>Service Name <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <?php 
                    $usertype = $this->session->userdata('user_type');
                    if($usertype=="admin") { ?>
                  <th>Action </th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
              <?php $i=0; foreach($service as $result){ $i++;   ?>
              <tr>
                <td><?php echo $i;?> </td>
                <td><?php echo $result['service_name'];?></td>
                <?php 
                    $usertype = $this->session->userdata('user_type');
                    if($usertype=="admin") { ?>
                <td> 
                  <a class="btn btn-info" href="<?=base_url()?>Service/edit/<?=$result['service_id']?>">
                    <i class="fa fa-edit"></i>
                  </a>  
                  <a class="btn btn-danger" href="<?=base_url()?>Service/delete/<?=$result['service_id']?>" onclick="return confirm('Are you sure to Delete!');" >
                    <i class="fa fa-trash-o"></i>
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
</div>


<?php include("includes/footer.php");?>