<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>
        
  <section class="content">
    <div class="row">
      <div class="col-xs-3"></div>
      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Followup Master</h3>
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

          <form role="form" method="post" action="<?=base_url()?>Followup/add">
            <div class="box-body">

              <input type="hidden" name="id" value="<?php if(!empty($item['followup_id'])) { echo $item['followup_id']; } ?>">
          
              <div class="form-group">
                <label for="exampleInputEmail1">followup Name</label>
                <input type="text" value="<?php if(!empty($item['followup_name'])) { echo $item['followup_name']; } ?>" name="followup_name" class="form-control" id="exampleInputEmail1" placeholder="Enter followup Name">
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
          <h3 class="box-title">Followup List</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Srial No.</th>
                <th>Followup Title</th>
                <?php 
                  $usertype = $this->session->userdata('user_type');
                  if($usertype=="admin") { ?>
                  <th>Action</th>
                 <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php $i=0; foreach($followup as $result) { $i++;?>
                <tr>
                  <td><?php echo $i;?> </td>
                  <td><?php echo $result['followup_name'];?></td>
                  <td> 
                  <?php 
                  $usertype = $this->session->userdata('user_type');
                  if($usertype=="admin") { ?>
                    <a class="btn btn-info" href="<?=base_url()?>Followup/edit/<?=$result['followup_id']?>">
                      <i class="fa fa-edit"></i>
                    </a>  

                    <a class="btn btn-danger" href="<?=base_url()?>Followup/delete/<?=$result['followup_id']?>" onclick="return confirm('Are you sure to Delete!');" >
                    <i class="fa fa-trash-o"></i>
                    </a> 
                    <?php } ?>
                  </td>
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