<input type="hidden" name="lead_id" value="<?=$id?>">

<table class="table table-hover">
	<tr> 
		<td><label>Followup Status</label></td>
		<td>
	    <select id="ddlPassport" name="followup" class="form-control selectpicker" onchange ="ShowHideDiv()">
        <option value="">Select Followup Status</option>
        <?php foreach($followup as $value) { ?>      
          <option value=<?php echo $value['followup_id'];?>><?php echo $value['followup_name'];?></option>
        <?php }?>
      </select>
    </td>
	  <td>
	    <div id="dThresholdx" style="display:block"><label>Next Followup Date</label> </div>
		</td>

    <td>
      <div id="dThreshold" style="display:block">
        <div class="input-group date" id="datetimepicker">
          <input type="date" name="date"  class="form-control" />  <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
        </div>
      </div>
    </td>
              
	</tr>
	<tr>
		<td> <label>Follow Comment</label></td>
		<td><textarea class="form-control" rows="5" name="followup_dis" id="comment"></textarea></td>
  </tr>
</table>



<?php if(!empty($leadfollowup)) { ?>
<div class="row" style="margin-top: 20px;"> 
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Followup List</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Srial No. <i class="fa fa-filter" aria-hidden="true"></i></th>
              <th>Followup Description <i class="fa fa-filter" aria-hidden="true"></i></th>
              <th>Followup Date</th>
              <th>Create on</th>
              <?php 
                $usertype = $this->session->userdata('user_type');
                if($usertype=="admin") { ?>
              <th>Action</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($leadfollowup)) { $i=0; foreach($leadfollowup as $value) { $i++;?>
            <tr id="rows_<?=$value['followupstatus_id']?>">
              <td><?=$i?></td>
              <td><?=$value['followup_text']?></td>
              <td><?=$value['followup_date']?></td>
              <td><?=$value['create_date']?></td>
              <?php 
                $usertype = $this->session->userdata('user_type');
                if($usertype=="admin") { ?>
              <th><a onclick="deleterow(<?=$value['followupstatus_id']?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a></th>
               <?php } ?>
            </tr>
            <?php } } ?>
          </tbody>
          
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
 </div> 
<?php } ?> 


<script type="text/javascript">
  function deleterow(id) {
    $.ajax({
       url:'<?=base_url()?>Lead/deletefollowup',
       type:"get",
       data:"id="+id,
       processData:false,
       contentType:false,
       cache:false,
       async:false,
       success: function(response){
        if(response.status == true) {
          $("#rows_"+id).html("");
        }
       }
    });
  }
</script>