<!-- Top Bar Start -->
<?php 
session_start(); 

?>
<div class="top-bar d-none d-md-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="top-bar-left">
                            <div class="text">
                                <i class="far fa-clock"></i>
                                <h2>8:00 - 9:00</h2>
                                <p>Mon - Fri</p>
                            </div>
                            <div class="text">
                                <i class="fa fa-phone-alt"></i>
                                <h2>+123 456 7890</h2>
                                <p>For Appointment</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="top-bar-right">
                            <div class="social">
                                <a href="login.php"><i class="fas fa-sign-in-alt"></i></a>
                                <a href="register.php"><i class="fas fa-user-plus"></i></i></a>
                                
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand">JOBY</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="jobs.php" class="nav-item nav-link">Jobs</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                        <?php 
                        
                       
                           // Get User Data
                        if(isset($_SESSION['email']) && $_SESSION['type'] == 'freelancer'){
                            // Get Data If This User Is Freelancer
                        $userData = $con->prepare("SELECT * FROM freelancer WHERE id = ?");
                        $userData->execute(array($_SESSION['userID']));
                        $data = $userData->fetch();
                        ?>
                        
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $data['first_name'].' '. $data['last_name']; ?></a>
                            <div class="dropdown-menu">
                                <a href="profile.php" class="dropdown-item">Profile</a>
                                <a href="logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                        <?php
                        }else if(isset($_SESSION['email']) && $_SESSION['type'] == 'client'){
                            // Get Data If This User Is Client
                        $userData = $con->prepare("SELECT * FROM clients WHERE id = ?");
                        $userData->execute(array($_SESSION['userID']));
                        $data = $userData->fetch();
                        ?>
                        
                        
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $data['first_name'].' '. $data['last_name']; ?></a>
                            <div class="dropdown-menu">
                                <a href="profile.php" class="dropdown-item">Profile</a>
                                <a href="logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                        
                        <?php
                        }
                        
                        ?>
                        
                   
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->