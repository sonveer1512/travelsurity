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
    <td><?php echo "<b>".$result['cname']."</b>"?> <br> 
        <a href="tel: +91<?php echo $result['cmobile'];?>"><?php echo $result['cmobile'];?></a>  <br> 
        <a href="mailto: <?php echo $result['cmail'];?>"><?php echo $result['cmail'];?></a>
    </td>
    <td><?php echo "<b>Going to: </b>".$result['cgoingTo']."<br>";
              echo "<b>Leaving From : </b>".$result['cfrom']."<br>";
              echo "<b>Departure Date: </b>".$result['creservationDate']."<br>";
              echo "<b>No. of days: </b>".$result['cnoDays']."<br>";
        ?>
    </td>
    
    <?php
      $assign_id=$result['assign_user_id'];
      $resu = $this->WebModel->list_common_where3('user','user_id',$assign_id);
    ?>
    
    <td>
        <select class="form-control" name="user_id" id="assignuser" data-id="<?=$result['lead_id']?>">
          <option>select user</option>
          <?php foreach($user as $value) { ?>      
            <option value=<?php echo $value['user_id'];?> <?php if(!empty($result['assign_user_id'])) { if($result['assign_user_id'] == $value['user_id']) { echo "selected"; } } ?> ><?php echo $value['user_name'];?></option>
          <?php } ?>
        </select>
        <span id="assignerr_<?=$result['lead_id']?>" style="display: none; color: green">User Assigned Successfully</span>
    </td>

    <td>
      <a data-toggle="modal" data-target="#addfollowup" onclick="showclientdetails(<?=$result['lead_id']?>, 'yes')">Add Quick Followup</a> <br>
      <span id="followuperr_<?=$result['lead_id']?>"></span> 
      <span id="followuperrtime_<?=$result['lead_id']?>"></span>

      <span id="lastfollowup_<?=$result['lead_id']?>">
      <?php $followup = $this->WebModel->leadfollowup('followupstatusmaster','lead_id',$result['lead_id']); 
      if(!empty($followup)) {
        echo $followup[0]['followup_text']." at ".$followup[0]['followup_date']; } ?>
      </span>
    </td>

    <td><?php echo $result['create_on'];?></td>
    <td>
      <a class="btn btn-success" href="<?=base_url()?>Lead/view/<?=$result['lead_id'];?>" target="_blank"><i class="fa fa-search-plus"></i></a>
  <?php 
      $usertype = $this->session->userdata('user_type');
      if($usertype=="admin") { ?>
      <a class="btn btn-info" href="<?=base_url()?>Lead/edit/<?=$result['lead_id'];?>" target="_blank"><i class="fa fa-edit"></i></a>  
      <a class="btn btn-danger" href="<?=base_url()?>Lead/delete/<?=$result['lead_id'];?>"onclick="return confirm('Are you sure to Delete!');"><i class="fa fa-trash-o"></i></a> 
  <?php } ?>
    </td>
    <td>
      <div class="dropdown dropdown-action">
        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-plus"></i></a>
        <div class="dropdown-menu dropdown-menu-right" style="padding: 5px;">
          <a class="btn btn-success" href="https://wa.me/?text=<?=$text?>" target="_blank"><i class="fa fa-whatsapp"></i> To Agent</a>
          <br><br>
          <a class="btn btn-success" href="https://wa.me/+91<?=$result['cmobile']?>?text=<?=$text2?>" target="_blank"><i class="fa fa-whatsapp"></i> To Client</a>
        </div>
      </div>
    </td>
  </tr>
<?php } ?>