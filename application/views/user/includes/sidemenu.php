<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active treeview">
        <a href="<?=base_url()?>userpanel/Dashboard">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span> </i>
        </a>
      </li> 

      <li class="treeview">
        <a href="#">
          <i class="fa fa-table"></i> <span>Lead Master</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url()?>userpanel/Lead/new"><i class="fa fa-circle-o"></i>Add Lead</a></li>
          <li><a href="<?=base_url()?>userpanel/Lead"><i class="fa fa-circle-o"></i>lead List</a></li>
        </ul>
      </li>


        <li class="treeview">
        <a href="<?=base_url()?>userpanel/lead/fixed">
          <i class="fa fa-table"></i> <span>Converted Leads</span>
        </a>
      </li>


      <li class="treeview">
        <a href="<?=base_url()?>userpanel/lead/hot">
          <i class="fa fa-table"></i> <span>Hot Leads</span>
        </a>
      </li>


      <li class="treeview">
        <a href="<?=base_url()?>userpanel/lead/notinterested">
          <i class="fa fa-table"></i> <span>Not Interested Leads</span>
        </a>
      </li>
       
  </section>
  <!-- /.sidebar -->
</aside>