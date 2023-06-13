





<?php include("inc/header.php");?>
<?php include("inc/sidemenu.php");?>
<?php include("db.php");?>
<?php


if(isset($_GET['del']))
   {
    $del = $_GET['del'];

      $q="DELETE FROM `meetingmanagermaster` where manager_id='$del'"; 
          $red=mysqli_query($conn,$q);
  }

if(isset($_GET['edit']))
   {
    $id = $_GET['edit'];
  }

  else
  { 
    $id=0;
}
     $q="SELECT * FROM `meetingmanagermaster` where manager_id='$id'"; 
          $red=mysqli_query($conn,$q);
          $res =mysqli_fetch_array($red);


?>

        <!-- Main content -->
        <section class="content">
          <div class="row">

            <div class="col-xs-12">
      <div class="box box-primary">
                  <div class="box-header">
                  <h3 class="box-title">Meeting Manager Master</h3>
                  </div><!-- /.box-header -->
                <!-- form start -->
                  <form role="form" method="post" action="">
                  
                    <div class="box-body">
                 
                    <table class="table table-bordered table-hover">
                    	<tr>
                    		<td><label>Manager Name</label></td>
 <td> <input  name="manager_name" placeholder="Name" required value="<?php echo $res['manager_name'];?> "   class="form-control"  type="text"></td>
 
                    	
                    		<td><label>Contact No.</label> </td>
                    			<td> <input name="mobile" required placeholder="(639)" value="<?php echo $res['mobile'];?> "  class="form-control" type="text"></td>
                    			</tr>
                    	
                    	</tr>
                    	<tr>
                    		<td><label>E-Mail</label></td>
                    			<td> <input name="email" required placeholder="E-Mail Address"value="<?php echo $res['email_id'];?> " class="form-control"  type="email"></td>
                    		

            
                    			

                    	</tr>
                    	<tr><td></td><td><input type="submit"name="submit" </td></tr>
                  
                  </table>
                  </div><!-- /.box-body -->

                 
                </form>
              </div>
</div>

            <div class="col-xs-12">
        


<?php
if(isset($_POST['submit']))
{
$manager_name=mysqli_real_escape_string($conn,$_POST['manager_name']);
$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
$email_id=mysqli_real_escape_string($conn,$_POST['email']);

if(isset($_GET['edit']))
   {
    $id = $_GET['edit'];

  $qu="UPDATE `meetingmanagermaster` SET `manager_name`='$manager_name',mobile='$mobile',email_id='$email_id' WHERE manager_id='$id'";
  }
  else
 {
$qu="INSERT INTO  meetingmanagermaster (manager_name,mobile,email_id,create_date) VALUES ('$manager_name','$mobile','$email_id',now())";
}
   $re=mysqli_query($conn,$qu);
    if($re)
    {
        //echo '<script>alert("gallery add successfully")</script>';
         //header('location:product_insert.php');
         echo ("<script LANGUAGE='JavaScript'>
    window.alert('Succesfully add manager');
    window.location.href='managermeetingmaster.php';
    </script>");


}
else
{
     echo ("<script LANGUAGE='JavaScript'>
    window.alert('manager is not add ');
    window.location.href='';
    </script>");
}
}
?>





              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Manager List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Srial No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                        <th>manager Name <i class="fa fa-filter" aria-hidden="true"></i></th>
                        <th>mobile No. <i class="fa fa-filter" aria-hidden="true"></i></th>
                        <th>email <i class="fa fa-filter" aria-hidden="true"></i></th>
                        <?php 
                             $usertype = $this->session->userdata('user_type');
                             if($usertype=="admin") { ?>
                        <th>Action</th>
                        <?php } ?>
                        
                      </tr>
                    </thead>
                    <tbody>


                      <?php
                   $q="SELECT * FROM `meetingmanagermaster`"; 
          $re=mysqli_query($conn,$q);
            
                $i=0;
                while($result =mysqli_fetch_array($re))
                {
                $i++;    
            ?>      
                    


                      <tr>
                        <td><?php echo $i;?> </td>
                      <td><?php echo $result['manager_name'];?></td>
                      <td><?php echo $result['mobile'];?></td>
                      <td><?php echo $result['email_id'];?></td>
  <?php 
          $usertype = $this->session->userdata('user_type');
          if($usertype=="admin") { ?>
<td>
 <a class="btn btn-info" href="managermeetingmaster.php?edit=<?php echo $result['manager_id']; ?>">
<i class="fa fa-edit"></i>
</a>  

<a class="btn btn-danger" href="managermeetingmaster.php?del=<?php echo $result['manager_id']; ?>"onclick="return confirm('Are you sure to Delete!');" >
<i class="fa fa-trash-o"></i>
</a> 

</td>
<?php } ?>
                       
                       
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
</div>


     <?php include("inc/footer.php");?>