<?php 
// session_start();
$title = 'Profile';
   include 'init.php'; 
   
   // Get User Data
   if(isset($_SESSION['email']) && $_SESSION['type'] == 'freelancer'){
     // Get Data If This User Is Freelancer
    $userData = $con->prepare("SELECT * FROM freelancer WHERE id = ?");
    $userData->execute(array($_SESSION['userID']));
    $data = $userData->fetch();
   }else if(isset($_SESSION['email']) && $_SESSION['type'] == 'client'){
     // Get Data If This User Is Client
    $userData = $con->prepare("SELECT * FROM clients WHERE id = ?");
    $userData->execute(array($_SESSION['userID']));
    $data = $userData->fetch();
   }else{
     // If Not Reirect To Login
      header('Location:login.php');
   }
   
?>
<section class="profile">
<div class="container">
    <div class="main-body">

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $data['first_name'] . ' '.$data['last_name'] ; ?></h4>
                      <?php if($_SESSION['type'] == 'freelancer'): ?>
                      <p class="text-secondary mb-1"><?php echo $data['bio']; ?></p>
                      <p class="text-muted font-size-sm"><?php echo $data['country'] .' , ' .$data['city'] . ' , ' . $data['address'] ; ?></p>
                      <?php elseif($_SESSION['type'] == 'client'): ?>
                        <p class="text-secondary mb-1"><?php echo $data['company']; ?></p>
                        <p class="text-muted font-size-sm"><?php echo $data['country'] .' , ' .$data['city'] ?></p>
                      <?php endif; ?>
                      
                      <a href="edit_profile.php" class="btn btn-outline-primary">Edit Profile</a>
                    </div>
                  </div>
                </div>
              </div>


<!-- ---------------------------------------- -->
<!-- For Freelancer To See Skills -->
<?php if($_SESSION['type'] == 'freelancer'):?>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                <li class="list-group-item ">
                    <div class="row">
                        <div class="col-6"><b class="mt-3">Your Skills</b></div>
                        <div class="col-6"><a class="btn btn-info float-right" data-toggle="modal" data-target="#addSkill">Add Skill</a></div>
                    </div>
                  </li>
               
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">HTML</h6>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">CSS</h6>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Javascript</h6>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">PHP</h6>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Mysql</h6>
                  </li>
                </ul>
              </div>

<div class="modal fade" id="addSkill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Skill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form>
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputEmail1">New Skill</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    </div>
  </div>
</div>
<?php endif; ?>
<!-- ---------------------------------------- -->

<!-- ---------------------------------------- -->
<!-- For Client To See Contracts -->
<?php if($_SESSION['type'] == 'client'):?>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                   <b class="m-3">Your Contracts</b>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Contract 1</h6>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Contract 2</h6>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Contract 3</h6>
                  </li>
                </ul>
              </div>
<?php endif; ?>
<!-- ----------------------------------------- -->
</div>
<!-- Fech Data For Profile If It Freelancer Or Client Debend $data Var -->
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">First Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $data['first_name']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Last Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $data['last_name']; ?>
                    </div>
                  </div>

                <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $data['email']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $data['phone']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php 
                    if($_SESSION['type'] == 'freelancer'){
                    echo $data['country'] .' / ' .$data['city'] . ' / ' . $data['address'];
                    }elseif($_SESSION['type'] == 'client'){
                      echo $data['country'] .' / ' .$data['city'];
                    }
                    ?>
                    </div>
                  </div>
                </div>
              </div>
<!-- -------------------------------------------------------------- -->
              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Your Contracts</i></h6>
                      <small>Web Design</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                      <small>Web Design</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>
    
<?php include  $tpl . 'footer.php'; ?>