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
 	<legend><center><h2><b>Issue Coupon/Receipt</b></h2></center></legend><br>
    <div class="row">

      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header"></div>
            <form role="form" method="post" class="leadupdate">

              <input type="hidden" name="lead_id" value="<?php if(!empty($item['lead_id'])) { echo $item['lead_id']; } ?>">

              <div class="box-body">
                <table class="table table-bordered table-hover">

                  <?php if($this->uri->segment(2) == 'view') {  ?>
                    <tr>
                      <td colspan="2"><label>Date</label></td>
                      <td colspan="2">
                        <input type="text" class="form-control" name="date" id="date" value="<?php if(!empty($item['date'])) { echo $item['date']; } ?>" <?php if($this->uri->segment(2) == 'view') { echo "readonly"; } ?>>
                      </td>
                    </tr>
                  <?php }else{ ?>
                    <tr>
                      <td colspan="2"><label>Date</label></td>
                      <td colspan="2">
                        <input type="text" class="form-control" name="date" id="date" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date('d/m/Y'); ?>" <?php if($this->uri->segment(2) == 'view') { echo "readonly"; } ?>>
                      </td>
                    </tr>  
                  <?php } ?>
                	

                  <tr>
                		<td><label>Issued to</label></td>
                    <td>
                      <input type="text" name="issue_to" value="<?php if(!empty($item['issue_to'])) { echo $item['issue_to']; } ?>" id="issue_to" class="form-control" <?php if($this->uri->segment(2) == 'view') { echo "readonly"; } ?>>
                    </td>
                    <td><label>Phone</label></td>
                    <td>
                      <input type="text" name="phone" id="phone" value="<?php if(!empty($item['phone'])) { echo $item['phone']; } ?>" class="form-control" <?php if($this->uri->segment(2) == 'view') { echo "readonly"; } ?>>
                    </td>
                	</tr>

                  <tr>
                    <td><label>Nagar</label></td>
                    <td>
                      <input type="text" name="nagar" id="nagar" value="<?php if(!empty($item['nagar'])) { echo $item['nagar']; } ?>" class="form-control" <?php if($this->uri->segment(2) == 'view') { echo "readonly"; } ?>>
                    </td>
                    <td><label>Mandal</label></td>
                    <td>
                      <input type="text" name="mandal" id="mandal" value="<?php if(!empty($item['manadal'])) { echo $item['manadal']; } ?>" class="form-control" <?php if($this->uri->segment(2) == 'view') { echo "readonly"; } ?>>
                    </td>
                  </tr>

                  <tr>
                    <td><label>Role</label></td>
                    <td>
                      <input type="text" name="role" id="role" value="<?php if(!empty($item['role'])) { echo $item['role']; } ?>" class="form-control" <?php if($this->uri->segment(2) == 'view') { echo "readonly"; } ?>>
                    </td>
                    <td><label>Address</label></td>
                    <td>
                      <input type="text" name="address" id="address" value="<?php if(!empty($item['address'])) { echo $item['address']; } ?>" class="form-control" <?php if($this->uri->segment(2) == 'view') { echo "readonly"; } ?>>
                    </td>
                  </tr>
                </table>
              </div>

              <div style="margin-top: 25px;">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Coupon/Receipt Type</th>
                      <th>Total</th>
                      <th>Issued</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php if(!empty($item['detail'])) { 

                      $bookdata = json_decode($item['detail'],TRUE);
                        if(!empty($bookdata)) {
                          for($i = 0; $i < count($bookdata); $i++) { 
                          ?>
                        <tr> 
                          <td><input type="text" name="type[]" id="type_<?=$i?>" class="form-control" value="<?=$bookdata[$i]['type']?>" readonly></td>
                          <td><input type="text" name="total[]" id="total_<?=$i?>" class="form-control" value="<?php if(!empty($bookdata[$i]['total'])) { echo $bookdata[$i]['total']; }else{ echo "0"; } ?>" readonly></td>
                          <td><input type="text" name="issued[]" id="issued_<?=$i?>" class="form-control" value="<?php if(!empty($bookdata[$i]['issued'])) { echo $bookdata[$i]['issued']; }else{ echo "0"; } ?>"></td>
                          <td><input type="text" name="amount[]" id="amount_<?=$i?>" class="form-control" value="<?php if(!empty($bookdata[$i]['amount'])) { echo $bookdata[$i]['amount']; }else{ echo "0"; } ?>" readonly></td>  
                        </tr>
                    <?php } } }else{ 

                      $i =0; foreach($coupon as $value) { $i++; 
                      $cal = $this->WebModel->calculate_sum($value['id']); ?>
                        <tr> 
                          <td><input type="text" name="type[]" id="type_<?=$i?>" class="form-control" value="<?=$value['type']?>" readonly></td>
                          <td><input type="text" name="total[]" id="total_<?=$i?>" class="form-control" value="<?php if(!empty($cal[0]['booklet'])) { echo $cal[0]['booklet']; }else{ echo "0"; } ?>" readonly></td>
                          <td><input type="text" name="issued[]" id="issued_<?=$i?>" class="form-control" onkeyup="getprice(this.value,<?=$i?>)"  onkeydown="getprice(this.value,<?=$i?>)" value="0"></td>
                          <td><input type="text" name="amount[]" id="amount_<?=$i?>" class="form-control" value="0" readonly></td>  
                        </tr>

                    <?php } } ?>


                  </tbody>  
                </table>
              </div>
                
              <?php if($this->uri->segment(2) != 'view') {  ?>
              <div>   
          			<table class="table table-bordered table-hover">
          			  <tr>
                    <td align="center"><input type="submit" name="submit" value="submit" class="btn btn-warning"> 
                      <br>
                      <div><span id="eqres"></span></div>
                    </td>
          			  </tr>
                </table>
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

      var date = $("#date").val();
      var issue_to = $("#issue_to").val();
      var phone = $("#phone").val();
      var nagar = $("#nagar").val();
      var mandal = $("#mandal").val();
      var role = $("#role").val();

      $("#eqres").show();
      if (date == '' || issue_to == '' || phone == '' || nagar == '' || mandal == '' || role == '') {
          err = 1;
          $("#eqres").html("<span class='err'>Enter mandatory fields</span>");
      }

      if (err == 0) {
        $.ajax({
          url: "<?=base_url()?>Coupon/addissue",
          type: "POST",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function () {
              $("#eqres").html("<span class='process'>Please wait...</span>");
          },
          success: function (response) {
              if (response.status == true) {
                  $("#eqres").html("<span class='succ'>Booklet Issued</span>");
              }
              else {
                  $("#eqres").html("<span class='err'>Error try again...</span>");
              }
          },
          error: function (e) {
              $("#eqres").html("<span class='err'>Error...</span>");
          },
          complete: function () {
             /* $('.leadupdate')[0].reset();*/
              $('#eqres').delay(4000).fadeOut('slow');
          }
        });
      }
    }));
  });



function getprice(type,i) {
  var type = document.getElementById("issued_"+i).value; 

  var coupon = document.getElementById("type_"+i).value; 
  newCoupon = coupon.replace('Rs. ', ''); 

  var pricequantity = (newCoupon * type);

  var divobj = document.getElementById('amount_'+i);
  divobj.value = pricequantity;

}


</script>    