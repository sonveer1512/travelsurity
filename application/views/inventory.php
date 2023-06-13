<?php include("includes/header.php");?>
<?php include("includes/sidemenu.php");?>


  <section class="content">
    <div class="row">

    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Coupon/Receipt List</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <!-- <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Srial No.  <i class="fa fa-filter" aria-hidden="true"></i></th>
                <th>Type  <i class="fa fa-filter" aria-hidden="true"></i></th>
                <th>Total Coupon  <i class="fa fa-filter" aria-hidden="true"></i></th>
                <th>Balance Coupon  <i class="fa fa-filter" aria-hidden="true"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0; foreach($coupon as $result){ $i++;   
                $cal = $this->WebModel->calculate_sum($result['id']);
                ?>
              <tr>
                <td><?php echo $i;?> </td>
                <td><?php echo $result['type'];?></td>
                <td><?php echo $cal[0]['booklet'];?></td>
                <td></td>
              </tr>
              <?php }?>
            </tbody>
              
            </table> -->

            <?php $i=0; foreach($coupon as $result){ $i++;   
            $cal = $this->WebModel->calculate_sum($result['id']);
            ?>
            <div class="container">
              <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse<?=$i?>"><?php echo $i;?>.  <?php echo $result['type'];?></a>
                    </h4>
                  </div>
                  <div id="collapse<?=$i?>" class="panel-collapse collapse">
                    <div class="panel-body">
                      <table>
                        <tbody>
                          <tr>
                            <td><strong>Total No of Booklets:</strong> <?php if(!empty($cal[0]['booklet'])) { echo $cal[0]['booklet']; }else{ echo "0"; } ?></td>
                          </tr>
                        </tbody>
                      </table>

                      <?php 
                      $dat = $this->WebModel->list_common_where3('coupon_booklet','coupontype',$result['id']);
                      if(!empty($dat)) { ?>

                      <div class="col-md-12" style="border: 1px solid black;">
                        
                        <?php foreach($dat as $values) {  ?>
                          <div class="col-md-4">
                              <strong>Date:</strong> <?php if(!empty($values['date'])) { echo $values['date']; } ?>
                          </div>
                          <div class="col-md-8">
                            <?php $bookdata = json_decode($values['bookletdata'],TRUE);
                             foreach ($bookdata as $bookvalue) { ?>
                                <strong>Serial No. From</strong> - <?php if(!empty($bookvalue['serialfrom'])) { echo $bookvalue['serialfrom']; } ?> ----
                                <strong>Serial No. To</strong> - <?php if(!empty($bookvalue['serialto'])) { echo $bookvalue['serialto']; } ?> </li>
                                <br>
                             <?php } ?>
                          </div>
                        <?php } ?>
                      </div>    
                    <?php } ?>
                    </div>
                    <!-- <div class="panel-footer">Panel Footer</div> -->
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>



          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
</div>


<?php include("includes/footer.php");?>