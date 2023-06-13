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
 	<legend><center><h2><b>Add Coupon/Receipt</b></h2></center></legend><br>
    <div class="row">

      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header"></div>
            <form role="form" method="post" class="leadupdate">

              <input type="hidden" name="lead_id" value="<?php if(!empty($item['lead_id'])) { echo $item['lead_id']; } ?>">

              <div class="box-body">
                <table class="table table-bordered table-hover">

                	<tr>
                    <td colspan="2"><label>Date</label></td>
                    <td colspan="2">
                      <input type="text" class="form-control" name="date" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date('d/m/Y'); ?>">
                    </td>
                  </tr>

                  <tr>
                		<td><label>Type</label></td>
                    <td>
                      <select class="form-control" name="coupon">
                        <option>-- Select Coupon Type</option>  
                        <?php foreach($coupon as $value) { ?>
                          <option value="<?=$value['id']?>"><?=$value['type']?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td><label>No of Booklet</label></td>
                    <td>
                      <select class="form-control changebooklet" name="noofbooklet">
                        <option>-- Select No of Booklet</option>  
                        <?php for($i =1; $i <= 50; $i++) { ?>
                          <option value="<?=$i?>"><?=$i?></option>
                        <?php } ?>
                      </select>
                    </td>
                	</tr>
                </table>

                <span id="changebookletdata"></span>

              </div>
              
              <div>   
          			<table class="table table-bordered table-hover">
          			  <tr>
                    <td align="center"><input type="submit" name="submit" value="submit"class="btn btn-warning"> 
                      <br>
                      <div><span id="eqres"></span></div>
                    </td>
          			  </tr>
                </table>
             </div>

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

      var coupon = $("#coupon").val();
      var noofbooklet = $("#noofbooklet").val();

      $("#eqres").show();
      if (coupon == '' || noofbooklet == '') {
          err = 1;
          $("#eqres").html("<span class='err'>Enter mandatory fields</span>");
      }

      if (err == 0) {
        $.ajax({
          url: "<?=base_url()?>Coupon/add",
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
                  $("#eqres").html("<span class='succ'>Booklet Add</span>");
              }
              else {
                  $("#eqres").html("<span class='err'>Error try again...</span>");
              }
          },
          error: function (e) {
              $("#eqres").html("<span class='err'>Error...</span>");
          },
          complete: function () {
              $('.leadupdate')[0].reset();
              $('#eqres').delay(4000).fadeOut('slow');
          }
        });
      }
    }));
  });



  $(document).ready(function () {
    $(".changebooklet").on('change', (function (e) {
      e.preventDefault();

      var totalbook = $(this).val();

      $.ajax({
        url: "<?=base_url()?>Coupon/changebooklet",
        type: "GET",
        data: "total="+totalbook,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
          $("#changebookletdata").html(response.output);
        },
      });
    }));
  });
</script>    