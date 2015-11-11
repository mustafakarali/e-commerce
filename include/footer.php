<footer id="footer" class="vspace20">
		<div class="container">
			<div class="row">
				<div class="span5">
					<h4>Information</h4>
					<ul class="nav nav-stacked">
						<li><a href="#myAbout" data-toggle="modal">About Us</a></li>
						<li><a href="#myTerms" data-toggle="modal">Terms & Conditions</a></li>
					</ul>
				</div> 
				
				<div id="myAbout" class="modal hide" style="width:500px;">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h3 align="center">About Us</h3>
											</div>
											<div class="modal-body">
												<p>
					<?php include "about.php"; ?>
												</p>
											</div>
						</div>
						
						<div id="myTerms" class="modal hide" style="width:500px;">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h3 align="center">Terms and Conditions</h3>
											</div>
											<div class="modal-body">
												<p>
					<?php include "t_c.php"; ?>
												</p>
											</div>
						</div>
						

				<div class="span5">
					<h4>Location and Contacts</h4>
					<p><i class="icon-map-marker"></i>&nbsp;City: G/F, Lifestyle Center, Greenhills Shopping Center of San Juan City, Philippines</p>
					<p><i class="icon-phone"></i>&nbsp;Phone: </p>
					<p><i class="icon-envelope"></i>&nbsp;Email: norasjewelries@gmail.com</p>
				</div>
				
				<div class="span2">
					<p><a href="http://www.dti.gov.ph/dti/index.php?p=720" target="_blank"><img src="products/dti.jpg"/></a></p>
				</div>

			</div>

		</div>
	</footer>