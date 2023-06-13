<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>

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
    location.reload();
  }
  return checked;
}
</script>


<form action="<?=base_url()?>Lead/assigned" method="post">
  <!-- Main content -->
  <section class="content">
    <legend><center><h2><b>Coupon/Receipt Issue list</b></h2></center></legend>
      <div class="row">
        <div class="col-xs-12">
             
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>

            </div>
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
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>S.No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Date. <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Name <i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Phone<i class="fa fa-filter" aria-hidden="true"></i></th>
                      <th>Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; foreach ($issuecoupon as $result) { $i++; 
                      ?>
                      <tr>
                        <td><?php echo  $i; ?></td>
                        <td><?php echo $result['date'];?> </td>
                        <td><?php echo $result['issue_to'];?></td>
                        <td><?php echo $result['phone'];?></td>
                        <td>
                          <a class="btn btn-success" href="<?=base_url()?>Coupon/view/<?=$result['id'];?>"><i class="fa fa-search-plus"></i></a>
                        </td>
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

<?php include("includes/footer.php");?>