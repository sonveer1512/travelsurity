<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>

  <section class="content">
    <div class="row">
      <div class="col-xs-3"></div>
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">City Master</h3>
          </div><!-- /.box-header -->

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
        
          <form role="form" method="post" action="<?=base_url()?>City/add">

            <input type="hidden" name="id" value="<?php if(!empty($item['city_id'])) { echo $item['city_id']; } ?>">

            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Country Name</label>  
                <select class="form-control" name="country_id" onChange="getState(this.value);">
                  <option>Select Country </option>
                  <?php foreach($country as $value) { ?>
                    <option value="<?=$value['country_id']?>" <?php if(!empty($item['country_id'])) { if($value['country_id'] == $item['country_id']){ echo "selected"; } } ?> ><?=$value['country_name']; ?></option>
                  <?php } ?>  
                </select>
              </div>  

              <div class="form-group">
                <label for="exampleInputEmail1">State Name</label>
                <select name="state" class="form-control" id="state-list">
                  <option>Select State </option>
                  <?php foreach($state as $value) { ?>
                    <option value="<?=$value['state_id']?>" <?php if(!empty($item['state_id'])) { if($value['state_id'] == $item['state_id']){ echo "selected"; } } ?> ><?=$value['state_name']; ?></option>
                  <?php } ?>  
                </select>
              </div>
              
              <div class="form-group">
                <label for="exampleInputEmail1">City Name</label>
                <input type="text" value="<?php if(!empty($item['city_name'])) { echo $item['city_name']; } ?>" name="city_name" class="form-control" id="exampleInputEmail1" placeholder="Enter City Name">
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
            <h3 class="box-title">City List</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Serial No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <th>Country Name  <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <th>State Name  <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <th>City Name  <i class="fa fa-filter" aria-hidden="true"></i></th>
                  <?php 
                    $usertype = $this->session->userdata('user_type');
                    if($usertype=="admin") { ?>
                  <th>Action</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach($city as $result) { $i++;
                  $country = $this->WebModel->list_common_where3('country','country_id',$result['country_id']);
                  $state = $this->WebModel->list_common_where3('state','state_id',$result['country_id']);
                  ?>
                  <tr>
                    <td><?php echo $i;?> </td>
                    <td><?php echo $country[0]['country_name'];?></td>
                    <td><?php echo $state[0]['state_name'];?></td>
                    <td><?php echo $result['city_name'];?></td>
                    <td> 
                    <?php 
                        $usertype = $this->session->userdata('user_type');
                        if($usertype=="admin") { ?>
                      <a class="btn btn-info" href="<?=base_url()?>City/edit/<?=$result['city_id']?>">
                        <i class="fa fa-edit"></i>
                      </a>  

                      <a class="btn btn-danger" href="<?=base_url()?>City/delete/<?=$result['city_id']?>" onclick="return confirm('Are you sure to Delete!');" >
                      <i class="fa fa-trash-o"></i>
                      </a> 
                    <?php } ?>   
                    </td>
                   
                  </tr>
                <?php } ?>
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


<script>
function getState(val) {
    $.ajax({
    type: "POST",
    url: "<?=base_url()?>City/get_state",
    data:'country_id='+val,
    success: function(response){
        $("#state-list").html(response.output);
    }
    });
}
</script>     