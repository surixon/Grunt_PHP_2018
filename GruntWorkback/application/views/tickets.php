<?php  $Result = $this->Ticket_model->get_pending_tickets();?>
<?php  $Result1 = $this->Ticket_model->get_completed_tickets();?>
<div class="content">
<ul class="nav nav-tabs ">
  <li class="active"><a data-toggle="tab" href="#home">Pending Tickets</a></li>
</ul>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active"> 
<div class="container-fluid">
  <div class="col-md-12">
    <div class="row">
      <div class="card">
        <div class="header">
          <h4 class="title">Pending Tickets</h4>
          <p class="category"></p>
        </div>
        <div class="content table-responsive table-full-width">
          <table class="table table-striped" id="dataTables">
            <thead>
              <th>User ID</th>
              <th>User Type</th>
              <th>Fullname</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Datetime</th>
              <th>Message</th>
              <th>Status</th>
              <th>Action</th>
                </thead>
            <tbody>
              
                <?php foreach($Result as $users): ?><tr>
                <td><?php echo $users['user_id']; ?></td>
                 <td><?php if($users['user_type']=='1')
                         {
							 echo 'Employer';
							}
							else
							{
								echo 'Employee';
							}
                 
                  ?></td>
                <td><?php echo $users['fullname']; ?></td>
                <td><?php echo $users['email']; ?></td>
                <td><?php echo $users['contact']; ?></td>
                <td><?php echo $users['datetime']; ?></td>
                <td><?php echo $users['message']; ?></td>
                   <td><?php if($users['status']=='0') 
                         {echo 'Pending';}
                         ?></td>
                <td>
	            <a href="<?php echo base_url('Ticket/user_detail/' . $users['user_id']) ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                </td>
 
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<ul class="nav nav-tabs ">
  <li class="active"><a data-toggle="tab" href="#home">Completed Tickets</a></li>
</ul>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active"> 
<div class="container-fluid">
  <div class="col-md-12">
    <div class="row">
      <div class="card">
        <div class="header">
          <h4 class="title">Completed Tickets</h4>
          <p class="category"></p>
        </div>
        <div class="content table-responsive table-full-width">
          <table class="table table-striped" id="dataTables1">
            <thead>
              <th>User ID</th>
              <th>User Type</th>
              <th>Fullname</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Datetime</th>
              <th>Message</th>
              <th>Status</th>
               <th>Action</th>
                </thead>
            <tbody>
             
                <?php foreach($Result1 as $users): ?> <tr>
                <td><?php echo $users['user_id']; ?></td>
                 <td><?php if($users['user_type']=='1')
                         {
							 echo 'Employer';
							}
							else
							{
								echo 'Employee';
							}
                 
                  ?></td>
                <td><?php echo $users['fullname']; ?></td>
                <td><?php echo $users['email']; ?></td>
                <td><?php echo $users['contact']; ?></td>
                <td><?php echo $users['datetime']; ?></td>
                <td><?php echo $users['message']; ?></td>
                   <td><?php if($users['status']=='1') 
                         {echo 'Completed';}
                         ?></td>
                <td>
	            <a href="<?php echo base_url('Ticket/user_detail/' . $users['user_id']) ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                </td>
 
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
  
