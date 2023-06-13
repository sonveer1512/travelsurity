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
<style>
a {
  &.next {
    float: right;
  }
}
</style>


        <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Follow-up</h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Client Fixed<sup style="font-size: 20px"></sup></h3>
              <p></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?=base_url()?>Lead/fixed" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div><!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <span id="message"></span>
          <div class="small-box " style="display:block">
            <div class="inner">
              <h6>Upload CSV<sup style="font-size: 10px"></sup></h6>
              <form action="<?=base_url()?>dashboard/importcsv" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-10">
                  <input type="file" class="form-control" id="uploadFile" name="uploadFile" placeholder="Select Your File" required accept=".xls, .xlsx">
                  </div>
                  <div class="col-md-2">
                  <input type="submit" name="submit" value="Import" style="padding: 4px;">
                  </div>
                </div>
              </form>
            </div>
            
           
          </div>
        </div><!-- ./col -->
       
      </div><!-- /.row -->
      <!-- Main row -->
    
      <script language="javascript">

      function CheckForm(){
        var checked=false;
        var elements = document.getElementsByName("checkbox[]");
        for(var i=0; i < elements.length; i++){
          if(elements[i].checked) {
            checked = true;
          }
        }
        if (!checked) {
          alert('Please select at least one checkbox');
        }
        return checked;
      }

      </script>

    <!-- Main content -->
<form action="<?=base_url()?>Lead/assigned" method="post">
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
                    <td><a href="<?=base_url()?>Lead/new" class="btn btn-block btn-success btn-sm">Add</a></td>
                    <td><button type="button" name="submit" class="btn btn-block btn-success btn-sm" data-toggle="modal"  data-target="#myModal">Assigned</button></td>
                    <td><button type="button" class="btn btn-block btn-success btn-sm refreshdata">Refresh</button></td>
                    <td><a href="<?=base_url()?>index/exportresult" class="btn btn-sm btn-primary">Download</a></td>  
                  </tr>    
                </table>
              </div>

              <div class="col-md-4"></div>

              <div class="col-md-6">
                <div class="row">
                  <div class="col-lg-12">
                    <form id="submitdateform" method="post">
                      <table class="table table-bordered text-center">
                        <tr>
                          <td>
                            <input type="date" name="formdate" class="form-control" placeholder="From" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d')?>">
                          </td>
                          <td>
                            <input type="date" name="todate" class="form-control" placeholder="To">
                          </td>
                          <td>
                            <input type="submit" name="submitform" value="Submit">
                          </td>
                        </tr>    
                      </table>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-bordered text-center">
                      <tr>
                        <td>
                          <label>Search By Employee</label>
                          <select id="searchbyemployee" class="form-control">
                            <option selected disabled value="">Employee</option>
                            <?php foreach($user as $value) { ?>    
                              <option value="<?php echo $value['user_id'];?>"><?php echo $value['user_name'];?></option>
                            <?php } ?>  
                          </select>
                        </td>
                        <td>
                          <label>Search By Name</label>
                          <input type="text" id="searchbyname" placeholder="Search By Name" class="form-control">
                        </td>
                        <td>
                          <label>Search By Phone</label>
                          <input type="text" id="searchbyphone" placeholder="Search By Mobile" class="form-control">
                        </td>
                        <td>
                          <label>Search By Going To</label>
                          <select id="searchbygoingto" class="form-control">
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
                </div>    
              </div>

            </div><!-- /.box-header -->
           <div class="box-body ">
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


              <form action="<?=base_url()?>Lead/selectedDelete" method="post">
                <table data-page-length='25' id="example1" class="table table-bordered table-responsive table-hover" data-page-length='25'>
                  <div class="allButton" style="display: none;">
                  		<button type="submit" class="btn btn-danger" name="Deletesubmit" >Delete All</button>
                        <button type="submit" class="btn btn-primary" name="Not_Interestedsubmit">Not_Interested</button>
                        <button type="submit" class="btn btn-warning" name="Hidesubmit">Hide All</button>
                        <button type="submit" class="btn btn-info" name="hotsubmit" >Hot list</button>
                        
                  </div>
                  <thead>
                    <tr>
                      <th>Select</th>
                      <th>S.No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Trip ID <i class="fa fa-filter" aria-hidden="true"></i></th>
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
                        <td class="text-center">
                          <input type="checkbox" name="checkbox[]" value="<?php echo $result['lead_id'];?>" onclick="showAllButton(this)">
                        </td>
                        <td><?php echo  $i; ?></td>
                        <td><?php echo $result['trip_id']?></td> 
                        <td><?php echo "<b>".$result['cname']."</b>"?> <br> 
                            <a href="tel: +91<?php echo $result['cmobile'];?>"><?php echo $result['cmobile'];?></a>  <br> 
                            <a href="mailto: <?php echo $result['cmail'];?>"><?php echo $result['cmail'];?></a>
                        </td>
                        <td><?php echo "<b>Going to: </b>".$result['cgoingTo']."<br>";
                                  echo "<b>Leaving From : </b>".$result['cfrom']."<br>";
                                  echo "<b>Departure Date: </b>".$result['creservationDate']."<br>";
                                  echo "<b>No. of days: </b>".$result['cnoDays']."<br>";
                                  echo "<b>Plateform: </b>".$result['platform']."<br>";    
                                                 	
                            ?>
                        </td>
                        <?php
                          $assign_id=$result['assign_user_id'];
                          $resu = $this->WebModel->list_common_where3('user','user_id',$assign_id);
                        ?>
                        
                        <td>
                            <select class="form-control assignuser" name="user_id" data-id="<?=$result['lead_id']?>">
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
                          <?php $followup = $this->WebModel->leadfollowup2('followupstatusmaster','lead_id',$result['lead_id']); 
                          if(!empty($followup)) { $j =0;
                            foreach($followup as $val) { $j++; 
                              echo $j.". ".$val['followup_text']." at ".$val['create_date']."<br>"; 
                            } } ?>
                          </span>
                        </td>

                        <td><?php echo $result['create_on'];?></td>
                        <td>
                          <a class="btn btn-success" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="View" href="<?=base_url()?>Lead/view/<?=$result['lead_id'];?>" target="_blank"><i class="fa fa-search-plus"></i></a>
                          <?php 
                             $usertype = $this->session->userdata('user_type');
                             if($usertype=="admin") { ?>
                                <a class="btn btn-info" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="Edit" href="<?=base_url()?>Lead/edit/<?=$result['lead_id'];?>" target="_blank"><i class="fa fa-edit"></i></a>  
                                <a class="btn btn-danger"  data-toggle="tooltip" data-placement="top" data-trigger="hover" title="Delete" href="<?=base_url()?>Lead/delete/<?=$result['lead_id'];?>"><i class="fa fa-trash-o"></i></a> 
                          		<a class="btn btn-warning mt-2" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="Hide" href="<?=base_url()?>Lead/deactivate/<?=$result['lead_id'];?>" ><i class="fa fa-hand-o-up"></i></a>  
                          		<a class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="Hot List" href="<?=base_url()?>Lead/hotlist/<?=$result['lead_id'];?>" ><i class="fa fa-file-o"></i></a>  
                          		<!--<a class="btn btn-secondary" href="<?=base_url()?>Lead/Not_Interested/<?=$result['lead_id'];?>" >not</a>  -->
                          
                            	<a class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="Not_Interested" href="<?=base_url()?>Lead/Not_Interested/<?=$result['lead_id'];?>" ><i class="fa fa-flag"></i></a>  
  									  
							
                          
                          		
                          		
                         
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

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Select</th>
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
             </form>
                    
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
    $(document).on('change','.assignuser',function(e){
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
</script>

<script type="text/javascript">
$(document).ready(function(){      
  $(document).on('keyup','#searchbyname',function(e){
    e.preventDefault();

      var details = $(this).val(); 

      $.ajax({
          url: '<?=base_url()?>Dashboard/showfiltereddatabyname/' + details,
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
  $(document).on('change','#searchbyemployee',function(e){
    e.preventDefault();

      var details = $(this).val(); 

      $.ajax({
          url: '<?=base_url()?>Dashboard/showfiltereddatabyemployee/' + details,
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
        url: '<?=base_url()?>Dashboard/showfiltereddatabyphone/' + details,
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
        url: '<?=base_url()?>Dashboard/showfiltereddatabylocation/' + details,
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

<script type="text/javascript">
$(document).ready(function () {
  $("#submitdateform").on('submit', (function (e) {
    e.preventDefault();
    err = 0;
    var formData = new FormData(this);
    formData.append('action', "enqdet");

    $.ajax({
        url: "<?=base_url()?>Dashboard/changedatadatewise",
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
          $("#changedata").html(res);
        }
    });

  }));
});
</script>

<script>
 
 $(document).ready(function(){

  $('#importcsv').on('submit', function(event){
   $('#message').html('');
   event.preventDefault();
   $.ajax({
    url:"<?=base_url()?>dashboard/importcsv",
    method:"POST",
    data: new FormData(this),
    dataType:"json",
    contentType:false,
    cache:false,
    processData:false,
    success:function(data)
    {
     $('#message').html('<div class="alert alert-success">'+data.success+'</div>');
     $('#sample_form')[0].reset();
    }
   })
  });

 });
</script>
<script>
	$(function () {
  $('[data-toggle="tooltip"]').tooltip({delay: { "show": 500, "hide": 100 }})
})
</script>
<script>
   function showAllButton() {
    var allCheckboxes = $('input[name="checkbox[]"]');
    var allButton = $(".allButton");
    
    var checkedCount = allCheckboxes.filter(':checked').length;
    
    if (checkedCount > 0) {
      allButton.show();
    } else {
      
      allButton.hide();
    }
  }
</script>







