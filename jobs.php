<?php 
include "init.php"; 

$stmtAllJobs = $con->prepare("SELECT * FROM jobs");
$stmtAllJobs->execute();
$jobs = $stmtAllJobs->fetchAll();
?>
<section class="jobs pt-5">
<div class="tr-job-posted section-padding pt-5">
    <div class="container">
		<div class="job-tab text-center">
			<div class="tab-content text-left">
				<div role="tabpanel" class="tab-pane fade active show" id="hot-jobs">
					<div class="row">
                        <?php foreach($jobs as $job): ?>
						<div class="col-md-6 col-lg-3">
							<div class="job-item">
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
											<li><a href="jobid=<?php echo $job['id']?>"><i class="fas fa-arrow-right"></i></a></li>
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
				
					</div><!-- /.row -->	
				</div><!-- /.tab-pane -->
			</div>				
		</div><!-- /.job-tab -->			
</section>

<?php include  $tpl . 'footer.php'; ?>