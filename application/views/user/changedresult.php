<?php $i=0; foreach ($lead as $result) { $i++; 
  $text = '%0ARegards TravelSurity';
  $text .= '%0Ahttps://www.travelsurity.com';
  ?>
  <tr>
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
    
    <td><?php if(!empty($resu[0]['user_name'])) { echo $resu[0]['user_name']; } ?></td>
    <td>

      <a data-toggle="modal" data-target="#addfollowup" onclick="showclientdetails(<?=$result['lead_id']?>, 'yes')">Add Quick Followup</a> <br>
      <span id="followuperr_<?=$result['lead_id']?>"></span> 
      <span id="followuperrtime_<?=$result['lead_id']?>"></span>

      <span id="lastfollowup_<?=$result['lead_id']?>">
        <?php $last = $this->WebModel->list_common_last($result['lead_id']); 
        if(!empty($last)) {
          echo $last[0]['followup_text']." - ".$last[0]['followup_date'];
        }
        ?>  
      </span>

    </td>
    <td><?php echo $result['create_on'];?></td>
    <td>
      <a class="btn btn-success" href="https://wa.me/+91<?=$result['cmobile']?>?text=<?=$text?>" target="_blank"><i class="fa fa-whatsapp"></i></a>
      <a class="btn btn-success" href="<?=base_url()?>userpanel/Lead/view/<?=$result['lead_id'];?>" target="_blank"><i class="fa fa-search-plus"></i></a>
      <a class="btn btn-info" href="<?=base_url()?>userpanel/Lead/edit/<?=$result['lead_id'];?>" target="_blank"><i class="fa fa-edit"></i></a>  
      <a class="btn btn-danger" href="<?=base_url()?>userpanel/Lead/delete/<?=$result['lead_id'];?>"onclick="return confirm('Are you sure to Delete!');"><i class="fa fa-trash-o"></i></a> 
    </td>
  </tr>
<?php }?>