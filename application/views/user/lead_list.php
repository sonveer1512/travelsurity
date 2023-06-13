<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>


  <!-- Main content -->
  <section class="content">
    <legend><center><h2><b>Lead list</b></h2></center></legend>
      <div class="row">
        <div class="col-xs-12">
             
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              
              <div class="col-md-2">
                <table class="table table-bordered text-center">
                  <tr>
                    <td><a href="<?=base_url()?>userpanel/Lead/new" class="btn btn-block btn-success btn-sm">Add</a></td>
                  </tr>    
                </table>
              </div>

            </div><!-- /.box-header -->
           <div class="box-body">

            <?php if($this->session->flashdata('message')) { ?>                                    
              <div class="alert alert-success alert-dismissible">                                        
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                <?php echo $this->session->flashdata('message'); ?>                                     
              </div>                                
            <?php } ?>  

            <?php if($this->session->flashdata('error')) { ?>                                    
              <div class="alert alert-danger alert-dismissible">                                        
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                <?php echo $this->session->flashdata('error'); ?>                                     
              </div>                                
            <?php } ?> 


              <form method="post">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Select</th>
                      <th>Name <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Going to<i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Contact NO. <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Assigned To <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Created Date <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach ($lead as $result) { $i++; 
                      $text = '%0ARegards TravelSurity';
                          $text .= '%0Ahttps://www.travelsurity.com';
                      ?>
                      <tr>
                        <td><?php echo  $i; ?></td>
                        <td><?php echo $result['cname'];?> </td>
                        <td><?php echo $result['cgoingTo'];?></td>
                        <td><a href="tel: +91<?php echo $result['cmobile'];?>"><?php echo $result['cmobile'];?></a></td>
                        
                        <?php
                          $assign_id=$result['assign_user_id'];
                          $resu = $this->WebModel->list_common_where3('user','user_id',$assign_id);
                        ?>
                        
                        <td><?php if(!empty($resu[0]['user_name'])) { echo $resu[0]['user_name']; } ?></td>
                        <td><?php echo $result['create_on'];?></td>
                        <td>
                          <a class="btn btn-success" href="https://wa.me/+91<?=$result['cmobile']?>?text=<?=$text?>" target="_blank"><i class="fa fa-whatsapp"></i></a>
                          <a class="btn btn-success" href="<?=base_url()?>userpanel/Lead/view/<?=$result['lead_id'];?>"><i class="fa fa-search-plus"></i></a>
                          <a class="btn btn-info" href="<?=base_url()?>userpanel/Lead/edit/<?=$result['lead_id'];?>"><i class="fa fa-edit"></i></a>  
                          <a class="btn btn-danger" href="<?=base_url()?>userpanel/Lead/delete/<?=$result['lead_id'];?>"onclick="return confirm('Are you sure to Delete!');"><i class="fa fa-trash-o"></i></a> 
                        </td>
                      </tr>
                    <?php }?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Select</th>
                      <th>S.No.  <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Name  <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Going to  <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Contact No.  <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Assigned To  <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Created Date  <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>

                    
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

<?php include("includes/footer.php");?>