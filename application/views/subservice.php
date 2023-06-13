<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>
        <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-3"></div>
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Subservice Master</h3>
          </div><!-- /.box-header -->
                <!-- form start -->
          <form role="form" method="post" action="<?=base_url()?>Subservice/add">

            <input type="hidden" name="id" value="<?php if(!empty($item['subservice_id'])) { echo $item['subservice_id']; } ?>">

            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Service Name</label>  
                <select class="form-control"name="service_id"  id="sel1">
                  <option>Select Service </option>
                  <?php foreach($service as $value) { ?>
                  <option value="<?=$value['service_id']?>" <?php if(!empty($item['service_id'])) { if($value['service_id'] == $item['service_id']){ echo "selected"; } } ?> ><?php echo $value['service_name']; ?></option>
                  <?php }?>
                </select>
              </div>  
              <div class="form-group">
                <label for="exampleInputEmail1">Subservice name</label>
                <input type="text" value="<?php if(!empty($item['subservice_name'])) { echo $item['subservice_name']; } ?>" name="subservice_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Subservice Name">
              </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <input type="submit" name="submit" value="submit" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>

      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Subservice List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Serial No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <th>Country Name  <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <th>Subservice Name  <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <?php 
                    $usertype = $this->session->userdata('user_type');
                    if($usertype=="admin") { ?>
                  <th>Action</th>
                   <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0; foreach($subservice as $result) { $i++; 
                  $ser = $this->WebModel->list_common_where3('service','service_id',$result['service_id']); ?>
                  <tr>
                    <td><?php echo $i;?> </td>
                    <td><?php echo $ser[0]['service_name'];?></td>
                    <td><?php echo $result['subservice_name'];?></td>
                    <?php 
                    $usertype = $this->session->userdata('user_type');
                    if($usertype=="admin") { ?>
                    <td>
                      <a class="btn btn-info" href="<?=base_url()?>Subservice/edit/<?=$result['subservice_id']?>">
                        <i class="fa fa-edit"></i>
                      </a>  
                      <a class="btn btn-danger" href="<?=base_url()?>Subservice/delete/<?=$result['subservice_id']?>" onclick="return confirm('Are you sure to Delete!');" >
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