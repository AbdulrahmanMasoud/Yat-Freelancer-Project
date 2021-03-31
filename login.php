<?php 

session_start();
include 'init.php'; 

if(isset($_SESSION['email'])){
    header("Location: index.php");
}
?>

<section class="login">
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
        <i class="fas fa-sign-in-alt"></i> Login As Client
        </div>
    </a> 
    <a data-toggle="tab" href="#menu2" id="tab2" class="tabs list-group-item active1">
        <div class="list-div my-2">
        <i class="fas fa-sign-in-alt"></i> Login As Freelancer
        </div>
    </a> 
 </div>
</div> <!-- Page Content -->
<div id="page-content-wrapper">
<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['f_login'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $hashed_pass = sha1($pass);

        $stmt = $con->prepare("SELECT id , email , password FROM freelancer WHERE email = ? AND password = ?");
        $stmt->execute(array($email,$hashed_pass));

        $getRow = $stmt->fetch();
        $count = $stmt->rowCount();
        // echo $count;
        if($count > 0){
            $_SESSION['email'] = $email; 
            $_SESSION['userID'] = $getRow['id'];
            $_SESSION['type'] = 'freelancer';
            if(isset($_SESSION['email']) && $_SESSION['type'] == 'freelancer'){
                header("Location: index.php");
            }
            }else{
                echo '<div class="alert alert-danger mt-2" role="alert">Password Or Email Is Wrong</div>';
            }
    }

    if(isset($_POST['c_login'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $hashed_pass = sha1($pass);

        $stmt = $con->prepare("SELECT id , email , password FROM clients WHERE email = ? AND password = ?");
        $stmt->execute(array($email,$hashed_pass));

        $getRow = $stmt->fetch();
        $count = $stmt->rowCount();
        if($count > 0){
            $_SESSION['email'] = $email; 
            $_SESSION['userID'] = $getRow['id'];
            $_SESSION['type'] ="client";
            if(isset($_SESSION['email']) && $_SESSION['type'] == 'client'){
                header("Location: index.php");
            }
        }else{
                echo '<div class="alert alert-danger mt-2" role="alert">Password Or Email Is Wrong</div>';
        }
    }
}


?>
<div class="tab-content login-form">
    <!-- Client Login -->
    <div id="menu1" class="tab-pane">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="form-card">
                <div class="user-icon text-center"><img src="layout/imgs/user/client.png" class="mb-3 w-25" alt="Client Icon"></div>
                    <h3 class="mt-0 mb-4 text-center">Login As a Client</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> <input name="email" type="email" id="bk_nm"> <label>Email</label> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> <input name="pass" type="password" name="ben_nm" id="ben-nm" > <label>Enter Password</label> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"> <input name="c_login" type="submit" value="Login" class="btn btn-success placeicon"> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center mb-5" id="below-btn"><a href="register.php">Sign Up</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Freelancer Login -->
    <div id="menu2" class="tab-pane in active">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="form-card">
                <div class="user-icon text-center"><img src="layout/imgs/user/freelancer.png" class="mb-3 w-25" alt="Freelancer Icon"></div>
                    <h3 class="mt-0 mb-4 text-center">Login As a Freelancer</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> <input name="email" type="email" id="bk_nm"> <label>Email</label> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> <input name="pass" type="password" name="ben_nm" id="ben-nm" > <label>Enter Password</label> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"> <input name="f_login" type="submit" value="Login" class="btn btn-success placeicon"> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center mb-5" id="below-btn"><a href="register.php">Sign Up</a></p>
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