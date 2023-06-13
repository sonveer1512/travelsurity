<?php include("inc/header.php");?>
<?php include("inc/sidemenu.php");?>
<?php include("db.php");?>
 <section class="content">
          <div class="row">
            <div class="col-xs-12">
        
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Meeting List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Srial No.</th>
                        <th>Client Name</th>
                        <th>Client contact No.</th>
                        <th>Meeting_Date</th>
                        <th>meeting Manager</th>
                        <th>meeting Shift</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                      $q="SELECT * FROM `followupstatusmaster` where followup_id='meeting_fixed' AND  meeting_date='". date("Y/m/d") ."' "; 
                      $re=mysqli_query($conn,$q);
            
                      $i=0;
                      while($result =mysqli_fetch_array($re))
                {
                  $i++;
                
            ?>      
                    


                      <tr>
                        <td><?php echo $i;?> </td>
                     <?php  $id=$result['lead_id'];
                        $q="SELECT * FROM `leadmaster` where lead_id=$id"; 
          $red=mysqli_query($conn,$q);
          $res =mysqli_fetch_array($red);
          ?>
                      <td> <?php echo $res['client_name'];?></td>
                      <td> <?php echo $res['contact_no1'];?></td>
                      <td><?php echo $result['meeting_date'];?> </td>
                      
                      <?php
                      $f=$result['meeting_manager'];
                      $q="SELECT * FROM `meetingmanagermaster` where manager_id='$f'"; 
          $rede=mysqli_query($conn,$q);
          $resf =mysqli_fetch_array($rede);
          ?>
                      <td><?php echo $resf['manager_name'];?> </td>
                       <td><?php echo $result['meeting_shift'];?> </td>
                       
                       
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


     <?php include("inc/footer.php");?>