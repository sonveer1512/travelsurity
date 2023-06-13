<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>

<script language="javascript">
function CheckForm(){
  var checked=false;
  var elements = document.getElementsByName("checkbox[]");
  for(var i=0; i < elements.length; i++){
    if(elements[i].checked) {
      checked = true;
    }
  }
  if (!checked) {
    alert('Please select at least one checkbox');
    location.reload();
  }
  return checked;
}
</script>


<form action="<?=base_url()?>Lead/assigned" method="post">
  <!-- Main content -->
  <section class="content">
    <legend><center><h2><b>Hide Data list</b></h2></center></legend>
      <div class="row">
        <div class="col-xs-12">
             
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              
              <div class="col-md-2">
                <table class="table table-bordered text-center">
                     
                </table>
              </div>

            </div><!-- /.box-header -->
           <div class="box-body">

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


              <form method="post">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Select</th>
                      <th>S.No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Name <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Going to<i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Contact NO. <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Assigned To <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Created Date <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Action </th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $text2 = 'Regards TravelSurity';
                    $text2 .= '%0Ahttps://www.travelsurity.com';

                    $i=0; foreach ($lead as $result) { $i++; 
                      $text = 'Name : ' .$result['cname'].'';
                      $text .= '%0AGoing to :   ' .$result['cgoingTo'].'';
                      $text .= '%0ALeaving from :   '.$result['cfrom'].'';
                      $text .= '%0ADeparture date :   '.$result['creservationDate'].'';
                      $text .= '%0ANo. of days  :   '.$result['cnoDays'].'';
                      $text .= '%0AEmail :   '.$result['cmail'].'';
                      $text .= '%0AMobile no. :   '.$result['cmobile'].'';
                      ?>
                      <tr>
                        <td>
                          <input type="checkbox" name="checkbox[]" value="<?php echo $result['lead_id'];?>">
                        </td>
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
                          
                          <?php 
                             $usertype = $this->session->userdata('user_type');
                             if($usertype=="admin") { ?>
                         
                        
                          <a class="btn btn-primary" href="<?=base_url()?>Lead/activate/<?=$result['lead_id'];?>" onclick="return confirm('Are you sure to Show!');">Remove Hode</a>  
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

<?php include("includes/footer.php");?>
     
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <table>
          <tr>
            <td><label>select User </label></td> 
            <td>&nbsp;&nbsp;</td>
            <td>
              <select class="form-control" name="user_id" id="sel1">
                <option>select user</option>
                <<?php foreach($user as $value) { ?>      
                  <option value=<?php echo $value['user_id'];?>><?php echo $value['user_name'];?></option>
                <?php }?>
              </select>
            </td>
            <td>&nbsp;&nbsp;</td>
            <td> <input type="submit" onclick="CheckForm()" name="submit" class="btn btn-block btn-success btn-sm" value="submit" ></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


</form>
