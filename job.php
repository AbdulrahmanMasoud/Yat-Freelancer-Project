<?php 
 $title = 'Job';
 include 'init.php'; 
 $jobId = isset($_GET['jobid'])&& is_numeric($_GET['jobid']) ? intval($_GET['jobid']) : 0;
//  $stmtJob = $con->prepare("SELECT *FROM jobs WHERE id = ?");

 $stmtJob = $con->prepare("SELECT jobs.*,clients.first_name
 FROM jobs 
 INNER JOIN clients ON clients.id = jobs.client_id WHERE jobs.id = ?");



 $stmtJob->execute(array($jobId));
 $job = $stmtJob->fetch();
 $count = $stmtJob->rowCount();
    if($count > 0):
?>




<section class="job">
  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class=""><?php echo $job['title']; ?></h1>

        <!-- Author -->
        <p class="lead">
          by
          <span><?php echo $job['first_name']; ?></span>
        </p>

        <hr>

        <!-- Date/Time -->
        <div class="row">
        <div class="col-6 text-left"><p>Posted on January 1, 2019 at 12:00 PM</p></div>
        <div class="col-6 text-right"><h5 class="mr-3 badget"> $<?php echo $job['badget']; ?></h5></div>
        </div>
        

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded w-100" src="https://discountseries.com/wp-content/uploads/2017/09/default.jpg" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead"><?php echo $job['discription']; ?></p>
        <hr>
        <div class="row">
        <?php if(isset($_SESSION['email']) && $_SESSION['type'] == 'freelancer'): ?>
        <div class="col-12 "> <a href="proposal.php?jobid=<?php echo $job['id']; ?>" class="btn btn-success w-100"> Submit Probosel</a> </div>
        <?php else:?>
        <div class="col-md-12"> <a href="" class="btn btn-success w-100 disabled">Must Login To Submit Probosel</a> </div>
        <?php endif;?>
        </div>
      </div>

      <!-- jobs  Column -->
      <div class="col-md-4">

      <h5 class="card-header my-3">New Jobs</h5>
        <?php 
        $stmtAllJobs = $con->prepare("SELECT * FROM jobs LIMIT 3");
        $stmtAllJobs->execute();
        $jobs = $stmtAllJobs->fetchAll();
        ?>
      <div role="tabpanel" class="tab-pane fade active show" id="hot-jobs">
					<div class="row">
                        <?php foreach($jobs as $job): ?>
						<div class="col-12">
							<div class="job-item border">
								<div class="item-overlay">
									<div class="job-info">
										<a href="#" class="btn btn-primary">Full Time</a>
                                        <br>
										<span class="tr-title">
											<h3 class="pt-2"><a href="#"><?php echo $job['title'] ?></a></h3>
										
										</span>
										<ul class="tr-list job-meta">
										<li><p class="py-2  text-break"><?php echo $job['discription'] ?></p></li>
										<li><?php echo $job['badget'] ?></li>
										</ul>
										<ul class="job-social tr-list">
											<li><a href="job.php?jobid=<?php echo $job['id']?>"><i class="fas fa-arrow-right"></i></a></li>
										</ul>
									</div>										
								</div>
								<div class="job-info">
                                <a href="#" class="btn btn-primary">Full Time</a>
                                <br>
									<span class="tr-title">
									<h3 class="pt-3"><a href="#"><?php echo $job['title'] ?></a></h3>
									</span>
									<ul class="tr-list job-meta">
										<li><p class="py-2  text-break"><?php echo $job['discription'] ?></p></li>
										<li><?php echo $job['badget'] ?></li>
									</ul>
																												
								</div>
							</div>
						</div>
                        <?php endforeach; ?>
					</div><!-- /.row -->
				</div><!-- /.tab-pane -->
      
        

      </div>

    </div>

  </div>
  </section>
<?php else: header("Location: jobs.php"); endif; ?>

<?php include  $tpl . 'footer.php'; ?>