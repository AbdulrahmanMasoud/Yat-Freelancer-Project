<?php 
$title = "Add Job";
 include 'init.php';

 if(isset($_SESSION['email']) && $_SESSION['type'] == 'client'){
    $userData = $con->prepare("SELECT * FROM clients WHERE id = ?");
    $userData->execute(array($_SESSION['userID']));
    $data = $userData->fetch();
   }else{
      header('Location:index.php');
   }





$errors = [];
$success = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
###########################################################################
//For Freelancer
###########################################################################
    if(isset($_POST['add_job'])){
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $badget = $_POST['badget'];
        // Validation First Name
        if(isset($title)){
            $clenTitle = filter_var($title, FILTER_SANITIZE_STRING);
            if(strlen($clenTitle) < 4){
                $errors[] = 'Job Title Is Short';
            }
        }
        // Validation Last Name
        if(isset($desc)){
            $clenDesc = filter_var($desc, FILTER_SANITIZE_STRING);
            if(strlen($clenDesc) < 4){
                $errors[] = 'Description Is Short';
            }
        }
        if(empty($errors)){
            $stmtAddJob = $con->prepare("INSERT INTO  jobs(client_id,title, discription,badget) 
                                                 VALUES(?, ?, ?, ?)");
                $stmtAddJob->execute(array($_SESSION['userID'],$clenTitle,$clenDesc,$badget));
                $success[] = 'Job Add Done';
        }
        

    }}

  ?>
<section class="register">
<div class="container-fluid px-0" id="bg-div">
<div class="row justify-content-center">
<div class="col-lg-9 col-12">
<div class="card card0">
<div class="d-flex" id="wrapper">

<div id="page-content-wrapper">

<div class="tab-content login-form">
    <!-- Client Login -->
    <?php 

if(!empty($errors)){
    foreach($errors as $err){
        echo '<div class="alert alert-danger mt-2" role="alert">'.$err.'</div>';
    }
}
if(isset($success)){
    foreach($success as $succ){
        echo '<div class="alert alert-success mt-2" role="alert">'.$succ.'</div>';
    }
}
?>
    <div id="menu1" class="tab-pane in active">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="form-card">
                <div class="user-icon text-center"><img src="layout/imgs/job/add_job.png" class="mb-3 w-25" alt="Client Icon"></div>
                    <h3 class="mt-0 mb-4 text-center">Add New Job</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> <input name="title" type="text" id=""> <label>Job Title</label> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> <textarea name="desc" id="" cols="30" rows="10"></textarea> <label>Job Description</label> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">  <input name="badget" type="number" id=""><label>Badget</label> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"> <input name="add_job" type="submit" value="Add Job" class="btn btn-success placeicon"> </div>
                        </div>
                        
                    </form>
                </div>
            </div>
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