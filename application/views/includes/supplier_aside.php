<aside class="page-sidebar">
	<div class="page-logo">
		<a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">

			<span class="page-logo-text mr-1"> <?php

												$EmailAdd = $this->session->userdata('Username');
												echo $EmailAdd;
												?></span>
			<span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
			<i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
		</a>
	</div>
	<!-- BEGIN PRIMARY NAVIGATION -->
	<nav id="js-primary-nav" class="primary-nav" role="navigation">
		<div class="nav-filter">
			<div class="position-relative">
				<input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
				<a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
					<i class="fal fa-chevron-up"></i>
				</a>
			</div>
		</div>

		<?php


		?>
		<ul id="js-nav-menu" class="nav-menu">

			<li class="active open">
				<a href="#" title="Application Intel" data-filter-tags="application intel">
					<i class="fal fa-info-tachometer"></i>
					<span class="nav-link-text" data-i18n="nav.application_intel">Forward Gift Souvenir</span>
				</a>
				<ul>

					<li>
						<a href="<?php echo base_url(
										'EOT/hodVerfication'
									); ?>" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
							<span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Gift Souvenir Request</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url(
										'EOT/GMDirectorApproval'
									); ?>" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
							<span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">MD/DD Approval</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url(
										'EOT/AdminApproval'
									); ?>" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
							<span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">QR Code Generation </span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url(
										'EOT/GatePassApproval'
									); ?>" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
							<span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Gate Pass Confirmation</span>
						</a>
					</li>
				</ul>
			</li>


		</ul>


		<div class="filter-message js-filter-message bg-success-600"></div>
	</nav>
	<!-- END PRIMARY NAVIGATION -->
	<!-- NAV FOOTER -->

</aside>
