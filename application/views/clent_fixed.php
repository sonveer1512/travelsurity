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


              <table data-page-length='25' id="example1" class="table table-bordered table-responsive table-hover" data-page-length='25'>
                <thead>
                  <tr>
                    <th>S.No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Name <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Trip Details<i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Assigned To <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Last Remark <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Created Date <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Action </th>
                    <th>Whatsapp </th>
                  </tr>
                </thead>
                <tbody id="changedata">
                  <?php 
                  $text2 = 'Regards TravelSurity';
                  $text2 .= '%0Ahttps://www.travelsurity.com';

                  $i=0; foreach ($client_fixed as $res) { 

                    $id=$res['lead_id'];
                    $result = $this->WebModel->list_common_where3('leadmaster','lead_id',$id);
                    $i++; 


                    $text = 'Name : ' .$result[0]['cname'].'';
                    $text .= '%0AGoing to :   ' .$result[0]['cgoingTo'].'';
                    $text .= '%0ALeaving from :   '.$result[0]['cfrom'].'';
                    $text .= '%0ADeparture date :   '.$result[0]['creservationDate'].'';
                    $text .= '%0ANo. of days  :   '.$result[0]['cnoDays'].'';
                    $text .= '%0AEmail :   '.$result[0]['cmail'].'';
                    $text .= '%0AMobile no. :   '.$result[0]['cmobile'].'';

                    ?>
                    <tr>
                      <td><?php echo  $i; ?></td>
                      <td><?php echo "<b>".$result[0]['cname']."</b>"?> <br> 
                          <a href="tel: +91<?php echo $result[0]['cmobile'];?>"><?php echo $result[0]['cmobile'];?></a>  <br> 
                          <a href="mailto: <?php echo $result[0]['cmail'];?>"><?php echo $result[0]['cmail'];?></a>
                      </td>
                      <td><?php echo "<b>Going to: </b>".$result[0]['cgoingTo']."<br>";
                                echo "<b>Leaving From : </b>".$result[0]['cfrom']."<br>";
                                echo "<b>Departure Date: </b>".$result[0]['creservationDate']."<br>";
                                echo "<b>No. of days: </b>".$result[0]['cnoDays']."<br>";
                          ?>
                      </td>
                      
                      <?php
                        $assign_id=$result[0]['assign_user_id'];
                        $resu = $this->WebModel->list_common_where3('user','user_id',$assign_id);
                      ?>
                      
                      <td>
                          <select class="form-control assignuser" name="user_id" data-id="<?=$result[0]['lead_id']?>">
                            <option>select user</option>
                            <?php foreach($user as $value) { ?>      
                              <option value=<?php echo $value['user_id'];?> <?php if(!empty($result[0]['assign_user_id'])) { if($result[0]['assign_user_id'] == $value['user_id']) { echo "selected"; } } ?> ><?php echo $value['user_name'];?></option>
                            <?php } ?>
                          </select>
                          <span id="assignerr_<?=$result[0]['lead_id']?>" style="display: none; color: green">User Assigned Successfully</span>
                      </td>

                      <td>
                        <a data-toggle="modal" data-target="#addfollowup" onclick="showclientdetails(<?=$result[0]['lead_id']?>, 'yes')">Add Quick Followup</a> <br>
                        <span id="followuperr_<?=$result[0]['lead_id']?>"></span> 
                        <span id="followuperrtime_<?=$result[0]['lead_id']?>"></span>

                        <span id="lastfollowup_<?=$result[0]['lead_id']?>">
                        <?php $followup = $this->WebModel->leadfollowup('followupstatusmaster','lead_id',$result[0]['lead_id']); 
                        if(!empty($followup)) {
                          foreach($followup as $val) {
                            echo $val['followup_text']." at ".$val['followup_date']."<br>"; 
                          } }?>
                        </span>
                      </td>

                      <td><?php echo $result[0]['create_on'];?></td>
                      <td>
                        <a class="btn btn-success" href="<?=base_url()?>Lead/view/<?=$result[0]['lead_id'];?>" target="_blank"><i class="fa fa-search-plus"></i></a>
                        <?php 
                             $usertype = $this->session->userdata('user_type');
                             if($usertype=="admin") { ?>
                        <a class="btn btn-info" href="<?=base_url()?>Lead/edit/<?=$result[0]['lead_id'];?>" target="_blank"><i class="fa fa-edit"></i></a>  
                        <a class="btn btn-danger" href="<?=base_url()?>Lead/delete/<?=$result[0]['lead_id'];?>"onclick="return confirm('Are you sure to Delete!');"><i class="fa fa-trash-o"></i></a> 
                        <?php } ?>
                      </td>
                      <td>
                        <div class="dropdown dropdown-action">
                          <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-plus"></i></a>
                          <div class="dropdown-menu dropdown-menu-right" style="padding: 5px;">
                            <a class="btn btn-success" href="https://wa.me/?text=<?=$text?>" target="_blank"><i class="fa fa-whatsapp"></i> To Agent</a>
                            <br><br>
                            <a class="btn btn-success" href="https://wa.me/+91<?=$result[0]['cmobile']?>?text=<?=$text2?>" target="_blank"><i class="fa fa-whatsapp"></i> To Client</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
                <tfoot>
                  <tr>
                    <th>S.No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Name <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Trip Details<i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Assigned To <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Last Remark <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Created Date <i class="fa fa-filter" aria-hidden="true"></i></th>
                    <th>Action </th>
                    <th>Whatsapp </th>
                  </tr>
                </tfoot>
              </table>



            </div><!-- /.box-body -->

          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
</div>


     <?php include("includes/footer.php");?>