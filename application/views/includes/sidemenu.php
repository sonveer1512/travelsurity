<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active treeview">
        <a href="<?=base_url()?>Dashboard">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span> </i>
        </a>
      </li> 

      <li class="treeview">
        <a href="<?=base_url()?>Country">
          <i class="fa fa-table"></i> <span>Country Master</span>
        </a>
      </li>
       <li class="treeview">
        <a href="<?=base_url()?>State">
          <i class="fa fa-table"></i> <span>State Master</span>
        </a>
      </li>
       <li class="treeview">
        <a href="<?=base_url()?>City">
          <i class="fa fa-table"></i> <span>City Master</span>
        </a>
      </li>
      <li class="treeview">
        <a href="<?=base_url()?>Followup">
          <i class="fa fa-table"></i> <span>Followup Master</span>
        </a>
      </li>
      <li class="treeview">
        <a href="<?=base_url()?>User">
          <i class="fa fa-table"></i> <span>User Master</span>
        </a>
      </li>
     
      <li class="treeview">
        <a href="#">
          <i class="fa fa-table"></i> <span>Service Master</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url()?>Service"><i class="fa fa-circle-o"></i>Add Service</a></li>
          <li><a href="<?=base_url()?>Subservice"><i class="fa fa-circle-o"></i>Add SubService</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="<?=base_url()?>Source">
          <i class="fa fa-table"></i> <span>Source Master</span>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-table"></i> <span>Lead Master</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url()?>Lead/new"><i class="fa fa-circle-o"></i>Add Lead</a></li>
          <li><a href="<?=base_url()?>Lead"><i class="fa fa-circle-o"></i>lead List</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="<?=base_url()?>Lead/fixed">
          <i class="fa fa-table"></i> <span>Converted Leads</span>
        </a>
      </li>


      <li class="treeview">
        <a href="<?=base_url()?>Lead/hotLead">
          <i class="fa fa-table"></i> <span>Hot Leads</span>
        </a>
      </li>


      <li class="treeview">
        <a href="<?=base_url()?>Lead/Not_Interested_Leads">
          <i class="fa fa-table"></i> <span>Not Interested Leads</span>
        </a>
      </li>
  		<li class="treeview">
        <a href="<?=base_url()?>Lead/hidedata">
          <i class="fa fa-table"></i> <span>Hide/Show List</span>
        </a>
      </li>
       
  </section>
  <!-- /.sidebar -->
</aside>