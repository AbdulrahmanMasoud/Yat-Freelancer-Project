<?php 
include 'init.php'; 
?>

<section class="register">
<div class="container-fluid px-0" id="bg-div">
<div class="row justify-content-center">
<div class="col-lg-9 col-12">
<div class="card card0">
<div class="d-flex" id="wrapper">
<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
<div class="sidebar-heading pt-5 pb-4">LOGIN WITH<strong style = "color:#28a745;"> ARR</strong></div>
<div class="list-group list-group-flush"> 
    <a data-toggle="tab" href="#menu1" id="tab1" class="tabs list-group-item bg-light">
        <div class="list-div my-2">
        <i class="fas fa-sign-in-alt"></i> Sign UP As Client
        </div>
    </a> 
    <a data-toggle="tab" href="#menu2" id="tab2" class="tabs list-group-item">
        <div class="list-div my-2">
        <i class="fas fa-sign-in-alt"></i> Sign UP As Freelancer
        </div>
    </a> 
 </div>
</div> <!-- Page Content -->
<div id="page-content-wrapper">
<?php
$errors = [];
$success = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
###########################################################################
//For Freelancer
###########################################################################
    if(isset($_POST['f_register'])){
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
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

        if(empty($errors)){
            $stmtRegister = $con->prepare("INSERT INTO  freelancer(first_name,last_name, email, `password` ,created_at) 
                                                 VALUES(?, ?, ?, ? ,?)");
                $stmtRegister->execute(array($f_name,$l_name,$email,sha1($pass),date("Y-m-d H:i:s")));
                $success[] = 'Register Done As Freelancer';
        }
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

    }

###########################################################################
//For Client
###########################################################################
    if(isset($_POST['c_register'])){
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
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

        if(empty($errors)){
            $stmtRegister = $con->prepare("INSERT INTO  clients(first_name,last_name, email, `password` ,created_at) 
                                                 VALUES(?, ?, ?, ? ,?)");
                $stmtRegister->execute(array($f_name,$l_name,$email,sha1($pass),date("Y-m-d H:i:s")));
                $success[] = 'Register Done As Client';
        }
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

    }


}



?>
<div class="tab-content mt-3">
    <div id="menu1" class="tab-pane">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="form-card ">
                <div class="user-icon text-center"><img src="layout/imgs/user/client.png" class="mb-3 w-25" alt="Client Icon"></div>
                    <h3 class="mt-0 mb-4 text-center">Sign UP As a Client</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> 
                                    <input name="f_name" type="text" id="f_name"> <label>First Name</label> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> 
                                    <input name="l_name" type="text" id="l_name"> <label>Last Name</label> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> 
                                    <input name="email" type="email" id="email"> <label>Email</label> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">
                                     <input name="pass" type="password" name="ben_nm" id="ben-nm" > <label>Password</label> 
                                    </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12"> <input name="c_register" type="submit" value="Register As a Client" class="btn btn-success placeicon"> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center mb-5" id="below-btn"><a href="#">Sign In</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="menu2" class="tab-pane in active">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="form-card">
                <div class="user-icon text-center"><img src="layout/imgs/user/freelancer.png" class="mb-3 w-25" alt=""></div>
                    <h3 class="mt-0 mb-4 text-center">Sign UP As a Freelancer</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> 
                                    <input name="f_name" type="text" id="f_name"> <label>First Name</label> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> 
                                    <input name="l_name" type="text" id="l_name"> <label>Last Name</label> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> 
                                    <input name="email" type="email" id="email"> <label>Email</label> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">
                                     <input name="pass" type="password" name="ben_nm" id="ben-nm" > <label>Password</label> 
                                    </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12"> <input name="f_register" type="submit" value="Register As Freelancer" class="btn btn-success placeicon"> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center mb-5" id="below-btn"><a href="login.php">Sign In</a></p>
                            </div>
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