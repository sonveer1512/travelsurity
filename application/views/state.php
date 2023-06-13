<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>
        <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-3"></div>
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">State Master</h3>
          </div><!-- /.box-header -->
                <!-- form start -->

          <?php if($this->session->flashdata('error')) { ?>                                    
            <div class="alert alert-danger alert-dismissible">                                        
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> 
              <?php echo $this->session->flashdata('error'); ?>                                     
            </div>                                
          <?php } ?> 

          <?php if($this->session->flashdata('message')) { ?>                                    
            <div class="alert alert-success alert-dismissible">                                        
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> 
              <?php echo $this->session->flashdata('message'); ?>                                     
            </div>                                
          <?php } ?> 


          <form role="form" method="post" action="<?=base_url()?>State/add">

            <input type="hidden" name="id" value="<?php if(!empty($item['state_id'])) { echo $item['state_id']; } ?>">

            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Country Name</label>  
                <select class="form-control"name="country_id"  id="sel1">
                  <option>Select Country </option>
                  <?php foreach($country as $value) { ?>
                  <option value="<?=$value['country_id']?>" <?php if(!empty($item['country_id'])) { if($value['country_id'] == $item['country_id']){ echo "selected"; } } ?> ><?php echo $value['country_name']; ?></option>
                  <?php }?>
                </select>
              </div>  
              <div class="form-group">
                <label for="exampleInputEmail1">State Name</label>
                <input type="text" value="<?php if(!empty($item['state_name'])) { echo $item['state_name']; } ?>" name="state_name" class="form-control" id="exampleInputEmail1" placeholder="Enter state Name">
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
            <h3 class="box-title">State List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Srial No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <th>Country Name  <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <th>State Name  <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <?php 
                    $usertype = $this->session->userdata('user_type');
                    if($usertype=="admin") { ?>
                  <th>Action</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0; foreach($state as $result) { $i++; 
                  $country = $this->WebModel->list_common_where3('country','country_id',$result['country_id']);
                  ?>
                  <tr>
                    <td><?php echo $i;?> </td>
                    <td><?php echo $country[0]['country_name'];?></td>
                    <td><?php echo $result['state_name'];?></td>
                    <?php 
                    $usertype = $this->session->userdata('user_type');
                    if($usertype=="admin") { ?>
                    <td>
                      <a class="btn btn-info" href="<?=base_url()?>State/edit/<?=$result['state_id']?>">
                        <i class="fa fa-edit"></i>
                      </a>  
                      <a class="btn btn-danger" href="<?=base_url()?>State/delete/<?=$result['state_id']?>" onclick="return confirm('Are you sure to Delete!');" >
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