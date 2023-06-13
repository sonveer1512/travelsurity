<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>
<!---datetimepickar link-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

 <section class="content">
 	<legend><center><h2><b>Leadmaster</b></h2></center></legend><br>
    <div class="row">

      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header"></div>
            <form role="form" method="post" class="leadupdate">

              <input type="hidden" name="lead_id" value="<?php if(!empty($item['lead_id'])) { echo $item['lead_id']; } ?>">

              <div class="box-body">
                <table class="table table-bordered table-hover">
                	<tr>
                		<td><label>Name</label></td>
	                    <td><input name="cname" placeholder="Name" value="<?php if(!empty($item['cname'])) { echo $item['cname']; } ?>" class="form-control"  type="text" <?php if($this->uri->segment(2) == 'view') { echo "readonly"; } ?>></td>
	                    <td><label>Going to</label></td>
	                    <td>  
	                    	<input name="cgoingTo" placeholder="Going to" value="<?php if(!empty($item['cgoingTo'])) { echo $item['cgoingTo']; } ?>" class="form-control"  type="text" <?php if($this->uri->segment(2) == 'view') { echo "readonly"; } ?>></td>
	                      <!-- <select class="form-control" id="cgoingTo" name="cgoingTo" <?php if($this->uri->segment(2)=='view'){ echo "readonly"; } ?>>
	                        <option value="">Going to</option>
	                        <option value="Goa" <?php if(!empty($item['cgoingTo'])) { if($item['cgoingTo'] == 'Goa') { echo "selected"; } } ?> >Goa</option>
	                        <option value="Kashmir" <?php if(!empty($item['cgoingTo'])) { if($item['cgoingTo'] == 'Kashmir') { echo "selected"; } } ?>>Kashmir</option>
	                        <option value="Kerala" <?php if(!empty($item['cgoingTo'])) { if($item['cgoingTo'] == 'Kerala') { echo "selected"; } } ?>>Kerala</option>
	                        <option value="Himachal" <?php if(!empty($item['cgoingTo'])) { if($item['cgoingTo'] == 'Himachal') { echo "selected"; } } ?>>Himachal</option>
	                        <option value="Andaman" <?php if(!empty($item['cgoingTo'])) { if($item['cgoingTo'] == 'Andaman') { echo "selected"; } } ?>>Andaman</option>
	                        <option value="North" <?php if(!empty($item['cgoingTo'])) { if($item['cgoingTo'] == 'North') { echo "selected"; } } ?>>North East</option>
	                        <option value="Rajasthan" <?php if(!empty($item['cgoingTo'])) { if($item['cgoingTo'] == 'Rajasthan') { echo "selected"; } } ?>>Rajasthan</option>
	                      </select> -->
	                    </td>
                	</tr>

                	<tr>
                		<td><label>Contact No.</label> </td>
	        			<td> <input name="cmobile" value="<?php if(!empty($item['cmobile'])) { echo $item['cmobile']; } ?>" placeholder="(639)" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "10" <?php if($this->uri->segment(2)=='view'){ echo "readonly"; } ?>></td>

	        			<td><label>E-Mail</label></td>
	        			<td> <input name="cmail" value="<?php if(!empty($item['cmail'])) { echo $item['cmail']; } ?>" placeholder="E-Mail Address" class="form-control"  type="email" <?php if($this->uri->segment(2)=='view'){ echo "readonly"; } ?>></td>
                	</tr>
                	<tr>
                		<td><label>Leaving from</label> </td>
              			<td> <input name="cfrom" value="<?php if(!empty($item['cfrom'])) { echo $item['cfrom']; } ?>" placeholder="Delhi" class="form-control" type="text" <?php if($this->uri->segment(2)=='view'){ echo "readonly"; } ?>></td>

              			<td><label>Departure date</label></td>
              			<td> <input name="creservationDate" value="<?php if(!empty($item['creservationDate'])) { echo $item['creservationDate']; } ?>" class="form-control" type="date" <?php if($this->uri->segment(2)=='view'){ echo "readonly"; } ?>></td>
                	</tr>
                	<tr>
                		<td><label>Duration</label> </td>
            			  <td><select class="form-control" id="cnoDays" name="cnoDays" <?php if($this->uri->segment(2)=='view'){ echo "readonly"; } ?>>
                          <option value="">Duration</option>
                          <option value="1" <?php if(!empty($item['cnoDays'])) { if($item['cnoDays'] == '1') { echo "selected"; } } ?> >1N/2D</option>
                          <option value="2" <?php if(!empty($item['cnoDays'])) { if($item['cnoDays'] == '2') { echo "selected"; } } ?> >2N/3D</option>
                          <option value="3" <?php if(!empty($item['cnoDays'])) { if($item['cnoDays'] == '3') { echo "selected"; } } ?> >3N/4D</option>
                          <option value="4" <?php if(!empty($item['cnoDays'])) { if($item['cnoDays'] == '4') { echo "selected"; } } ?> >4N/5D</option>
                          <option value="5" <?php if(!empty($item['cnoDays'])) { if($item['cnoDays'] == '5') { echo "selected"; } } ?> >5N/6D</option>
                          <option value="5+" <?php if(!empty($item['cnoDays'])) { if($item['cnoDays'] == '5+') { echo "selected"; } } ?> >6N +</option>
                        </select>
                    </td>
                	</tr>
                </table>
              </div>


            <?php if($this->uri->segment(2) != 'view') { ?>
              <div style="border: 2px solid #74767a; ">
	              <table class="table table-bordered table-hover">
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
                 
          			<table class="table table-bordered table-hover">
          			  <tr>
                    <td align="center"><input type="submit" name="submit" value="submit"class="btn btn-warning"> 
                      <br>
                      <div><span id="eqres"></span></div>
                    </td>
          			  </tr>
                </table>
             </div>

             <?php }else{ ?>
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
                          <th>Srial No.  <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Followup Description  <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Followup Date</th>
                          <th>Create on</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(!empty($followup)) { $i=0; foreach($followup as $value) { $i++;?>
                        <tr>
                          <td><?=$i?></td>
                          <td><?=$value['followup_text']?></td>
                          <td><?=$value['followup_date']?></td>
                          <td><?=$value['create_date']?></td>
                        </tr>
                        <?php } } ?>
                      </tbody>
                      
                    </table>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.col -->
             </div> 

             <?php } ?>


          </form>
        </div>
      </div>
    </div>
  </section>
</div>


<?php include("includes/footer.php");?>


<script>
  $(document).ready(function () {
    $(".leadupdate").on('submit', (function (e) {
      e.preventDefault();
      err = 0;
      var formData = new FormData(this);
      formData.append('action', "enqdet");

      var cname = $("#cname").val();
      var cgoingTo = $("#cgoingTo").val();
      var cfrom = $("#cfrom").val();
      var creservationDate = $("#creservationDate").val();
      var cmobile = $("#cmobile").val();
      var cmail = $("#cmail").val();
      var nodays = $("#cnoDays").val();

      $("#eqres").show();
      if (cname == '' || cmobile == '' || cmail == '' || cgoingTo == '' || cfrom == '' || creservationDate == '') {
          err = 1;
          $("#eqres").html("<span style='color: red'>Enter mandatory fields</span>");
      }
      else if (nodays == '') {
          err = 1;
          $("#eqres").html("<span style='color: red'>Select no. of days</span>");
      }

      if (err == 0) {
        $.ajax({
          url: "<?=base_url()?>Lead/add",
          type: "POST",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function () {
              $("#eqres").html("<span style='color: blue'>Please wait...</span>");
          },
          success: function (response) {
              if (response.status == true) {
                  $("#eqres").html("<span style='color: green'>Enquiry submitted</span>");
              }
              else {
                  $("#eqres").html("<span style='color: red'>Error try again...</span>");
              }
          },
          error: function (e) {
              $("#eqres").html("<span style='color: red'>Error...</span>");
          },
          complete: function () {
              $('#enqform')[0].reset();
              $('#eqres').delay(4000).fadeOut('slow');
          }
        });
      }
    }));
  });
</script>    