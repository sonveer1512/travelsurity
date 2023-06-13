<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>

<style type="text/css">
.box-footer {
  height: 50px;
}  

#example1_wrapper {
  overflow-x: scroll;
}
</style>


        <!-- Main content -->
    <section class="content">
        <legend><center><h2><b>Lead list</b></h2></center></legend>
          <div class="row">
            <div class="col-xs-12">
                 
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                  
                  <div class="col-md-2">
                    <table class="table table-bordered text-center">
                      <tr>
                        <td><a href="<?=base_url()?>userpanel/Lead/new" class="btn btn-block btn-success btn-sm">Add</a></td> 
                      </tr>    
                    </table>
                  </div>

                  <div class="col-md-4"></div>

                  <div class="col-md-6">
                    <table class="table table-bordered text-center">
                      <tr>
                        <td>
                          <input type="text" id="searchbyname" placeholder="Search By Name">
                        </td>
                        <td>
                          <input type="text" id="searchbyphone" placeholder="Search By Mobile">
                        </td>
                        <td>
                          <select id="searchbygoingto">
                            <option selected disabled value="">Going To</option>
                            <option>Goa</option>
                            <option>Mumbai</option>
                            <option>Delhi</option>
                            <option>Chandigarh</option>
                            <option>Leh - Ladakh</option>
                            <option>Maldives</option>
                          </select>
                        </td>
                      </tr>    
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
                    <table id="example1" class="table table-bordered table-responsive table-hover">
                      <thead>
                        <tr>
                          <th>S.No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Name <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Trip Id <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Trip Details<i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Assigned To <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Last Followup <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Created Date <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Action </th>
                        </tr>
                      </thead>
                      <tbody id="changedata">
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
                            <td><?php echo $result['trip_id']; ?></td>
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

                      </tbody>
                      <tfoot>
                        <tr>
                          <th>S.No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Name <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Trip Details<i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Assigned To <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Last Followup <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Created Date <i class="fa fa-filter" aria-hidden="true"></i></th>
                          <th>Action </th>
                        </tr>
                      </tfoot>
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



<div class="modal fade" id="addfollowup" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close pt4" data-toggle="tooltip" title="<?php echo $this->lang->line('close'); ?>" data-dismiss="modal">&times;</button>
                <h4 class="box-title">Quick Followup</h4> 
            </div>
            <form id="formedit" accept-charset="utf-8"  method="post" class="ptt10">   
                <div class="modal-body pt0 pb0" id="showquickfollowup_div">

                </div>  
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="submit" id="formeditbtn" data-loading-text="Processing" class="btn btn-info pull-right"> Save</button>
                        <br>
                        <div><span id="followupsubmitnotify"></span></div>
                    </div>
                </div>
            </form>
        </div>
    </div>    
</div>


<script type="text/javascript">
$(document).ready(function(){      
    $(document).on('change','#assignuser',function(e){
      e.preventDefault(); 
       var id = $(this).data("id");
       var user = $(this).val();
       $.ajax({
           url:'<?=base_url()?>Lead/assignuser',
           type:"get",
           data:"id="+id+"&user="+user,
           processData:false,
           contentType:false,
           cache:false,
           async:false,
           success: function(response){
            if(response.status == true) {
              $("#assignerr_"+id).css('display','block');
            }
           }
       });
    });
});


$(document).ready(function(){      
    $(document).on('click','.refreshdata',function(e){
      e.preventDefault(); 
       $.ajax({
           url:'<?=base_url()?>Lead/showleads',
           processData:false,
           contentType:false,
           cache:false,
           async:false,
           success: function(response){
            if(response.status == true) {
              $("#changedata").html(response.output)
            }
           }
       });
    });
});



function showclientdetails(id, ipdid) {
    $.ajax({
        url: '<?=base_url()?>Dashboard/showquickfollowupdiv/' + id,
        success: function (res) {
            $("#showquickfollowup_div").html(res);
        },
        error: function () {
            alert("Fail")
        }
    });
}



$(document).ready(function (e) {
  $("#formedit").on('submit', (function (e) {
    e.preventDefault();
    $("#formeditbtn").button('loading');
    $.ajax({
        url: '<?php echo base_url(); ?>Dashboard/updatelead',
        type: "POST",
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if (data.status == "fail") {
                $("#followupsubmitnotify").html("<span class='err'>Error try again...</span>");
            } else {
                $("#followupsubmitnotify").html("<span class='err'>Submitted Successfully..</span>");
                $("#addfollowup").modal('hide');
                $("#lastfollowup_"+data.id).html("");
                $("#followuperr_"+data.id).html(data.followup+" at ");
                $("#followuperrtime_"+data.id).html(data.followup_date);
            }
            $("#formeditbtn").button('reset');
        },
        error: function () {
            //  alert("Fail")
        }

    });
  }));
});


$(document).ready(function(){      
  $(document).on('keyup','#searchbyname',function(e){
    e.preventDefault();

      var details = $(this).val(); 

      $.ajax({
          url: '<?=base_url()?>userpanel/Dashboard/showfiltereddatabyname/' + details,
          success: function (res) {
              $("#changedata").html(res);
          },
          error: function () {
              alert("Fail")
          }
      });
  });
});


$(document).ready(function(){      
  $(document).on('keyup','#searchbyphone',function(e){
    e.preventDefault(); 

      var details = $(this).val();

    $.ajax({
        url: '<?=base_url()?>userpanel/Dashboard/showfiltereddatabyphone/' + details,
        success: function (res) {
            $("#changedata").html(res);
        },
        error: function () {
            alert("Fail")
        }
    });
  });
});



$(document).ready(function(){      
  $(document).on('change','#searchbygoingto',function(e){
    e.preventDefault(); 

      var details = $(this).val();

    $.ajax({
        url: '<?=base_url()?>userpanel/Dashboard/showfiltereddatabylocation/' + details,
        success: function (res) {
            $("#changedata").html(res);
        },
        error: function () {
            alert("Fail")
        }
    });
  });
});

</script>