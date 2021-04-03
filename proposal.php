<?php 
$title = "Submit Proposel";
 include 'init.php';
$jobId = isset($_GET['jobid'])&& is_numeric($_GET['jobid']) ? intval($_GET['jobid']) : 0;


$errors = [];
$success = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
###########################################################################
//For Freelancer
###########################################################################
    if(isset($_POST['submit_proposel'])){
        $cover = $_POST['cover'];
        $price = $_POST['price'];
        $job =  $_GET['jobid'];
       
        if(empty($errors)){
            $stmtproposel = $con->prepare("INSERT INTO  proposal(job_id,freelancer_id,coverletter,	price) 
                                                 VALUES(?, ?, ?, ?)");
                $stmtproposel->execute(array($job,$_SESSION['userID'],$cover,$price));
                $success[] = 'Proposel Submited Done';
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
                <div class="user-icon text-center"><img src="layout/imgs/proposel/proposal.png" class="mb-3 w-25" alt="Client Icon"></div>
                    <h3 class="mt-0 mb-4 text-center">Submit Proposel</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'].'?jobid='. $jobId ?>" method="POST">
                      
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group"> <textarea name="cover" id="" cols="30" rows="10" placeholder="Cover Letter"></textarea> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">  <input name="price" type="number" id=""><label>Price</label> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"> <input name="submit_proposel" type="submit" value="Submit Proposel" class="btn btn-success placeicon"> </div>
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