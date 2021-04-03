
<?php 
$title = "Edit Profile";
// session_start();
   include 'init.php'; 
   if(isset($_SESSION['email']) && $_SESSION['type'] == 'freelancer'){
    $userData = $con->prepare("SELECT * FROM freelancer WHERE id = ?");
    $userData->execute(array($_SESSION['userID']));
    $data = $userData->fetch();
   }else if(isset($_SESSION['email']) && $_SESSION['type'] == 'client'){
    $userData = $con->prepare("SELECT * FROM clients WHERE id = ?");
    $userData->execute(array($_SESSION['userID']));
    $data = $userData->fetch();
   }else{
      header('Location:login.php');
   }
   

$errors = [];
$success = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['update'])){
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $phone = $_POST['phone'];
        $country = $_POST['country'];
        $city = $_POST['city'];
          $bio = $_POST['bio'];
          $address = $_POST['address'];
        $company = $_POST['company']; // For Client
        // Validation First Name
        if(isset($f_name)){
            $clenFName = filter_var($f_name, FILTER_SANITIZE_STRING);
            if(strlen($clenFName) < 4){
                $errors[] = 'First Name Is Short';
            }
        }
        // Validation Last Name
        if(isset($l_name)){
            $clenLName = filter_var($l_name, FILTER_SANITIZE_STRING);
            if(strlen($clenLName) < 4){
                $errors[] = 'Last Name Is Short';
            }
        }
        // Validation Email Name
        if(isset($email)){
            $clenEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(filter_var($email, FILTER_SANITIZE_EMAIL) == false){
                $errors[] = 'Please Write Valid Email';
            }
        }
        // Validation Password Name
        if(isset($pass)){
            if(strlen($pass) < 6){
                $errors[] = 'Password Must Be More 6 Characters';
            }
        }

        if(empty($errors) && $_SESSION['type'] == 'freelancer'){
          $userUpdate = $con->prepare("UPDATE  freelancer SET first_name = ?, last_name = ?, email = ? , `password` = ?,phone = ? , country = ?, city = ?, `address` = ?, bio = ? WHERE id = ?");
          $userUpdate->execute(array($f_name,$l_name,$email,sha1($pass),$phone,$country,$city,$address,$bio,$_SESSION['userID']));
          header('Location:profile.php');
        }elseif(empty($errors) && $_SESSION['type'] == 'client'){
          $userUpdate = $con->prepare("UPDATE  clients SET first_name = ?, last_name = ?, email = ? , `password` = ?,phone = ? , country = ?, city = ?,company = ? WHERE id = ?");
          $userUpdate->execute(array($f_name,$l_name,$email,sha1($pass),$phone,$country,$city,$company,$_SESSION['userID']));
          header('Location:profile.php');
        }
        if(!empty($errors)){
            foreach($errors as $err){
                echo '<div class="alert alert-danger mt-2" role="alert">'.$err.'</div>';
            }
        }
    }
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
                      <a href="profile.php" class="btn btn-outline-primary">View Profile</a>
                    </div>
                  </div>
                </div>
              </div>



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
                  <li class="list-group-item w-100">
                   <input type="submit" class="btn btn-outline-primary" value="Update Skills">
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
</div>

          <div class="col-md-8">
         
          
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">First Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="f_name" type="text" class="form-control" value="<?php echo $data['first_name']; ?>">
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Last Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="l_name" type="text" class="form-control" value="<?php echo $data['last_name']; ?>">
                    </div>
                  </div>

                <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="email"  type="email" class="form-control" value="<?php echo $data['email']; ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="pass" type="password" class="form-control" value="<?php echo sha1($data['password']); ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="phone" type="text" class="form-control" value="<?php echo $data['phone']; ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Country</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="country" type="text" class="form-control" value="<?php echo $data['country']; ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">City</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="city" type="text" class="form-control" value="<?php echo $data['city']; ?>">
                    </div>
                  </div>
                  <?php if($_SESSION['type'] == 'freelancer'): ?>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="address" type="text" class="form-control" value="<?php echo $data['address']; ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Bio</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <textarea name="bio" class="form-control"><?php echo $data['bio']; ?></textarea>
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($_SESSION['type'] == 'client'): ?>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Company</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="company" type="text" class="form-control" value="<?php echo $data['company']; ?>">
                    </div>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row gutters-sm">
              <input name="update" type="submit" class="form-control btn btn-success"  value="Update Profile">
              </div>
              </form>
          
            </div>
            
          </div>
        </div>
    </div>
</section>
    
<?php include  $tpl . 'footer.php'; ?>