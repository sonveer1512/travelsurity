<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
    
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Client Fixed</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>S. No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Date  <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Name  <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Going to <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>contact No.  <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Email Id  <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>No of Days  <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Reservation Date  <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>From  <i class="fa fa-filter" aria-hidden="true"></i></th>
                  </tr>
                </thead>
                <tbody>
                
                <?php 
                $ids = $this->session->userdata('usersession_id');
                $i =0; foreach($client_fixed as $result) { 
                  $id=$result['lead_id'];
                  $res = $this->WebModel->list_common_where3('leadmaster','lead_id',$id);
                  if($res[0]['assign_user_id'] == $ids) { $i++; ?>      

                  <tr>
                    <td><?php echo $i;?> </td>
                    <td><?php echo $res[0]['create_on'];?></td>
                    <td><?php echo $res[0]['cname'];?></td>
                    <td><?php echo $res[0]['cgoingTo'];?> </td>
                    <td><?php echo $res[0]['cmobile'];?></td>
                    <td><?php echo $res[0]['cmail'];?></td>
                    <td><?php echo $res[0]['creservationDate'];?></td>
                    <td><?php echo $res[0]['cnoDays'];?></td>
                    <td><?php echo $res[0]['cfrom'];?></td>
                  </tr>
                <?php } } ?>
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