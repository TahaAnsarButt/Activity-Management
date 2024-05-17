<?php
if (!$this->session->has_userdata('NamazUserId')) {
	redirect('LoginController');
} else {
	// echo "pending";

	// print_r($this->session->userdata());
?>

	<?php $this->load->view('includes/supplier_header'); ?>
	<!-- BEGIN Page Wrapper -->
	<div class="page-wrapper">
		<div class="page-inner">
			<!-- BEGIN Left Aside -->
			<?php
			$this->load->view('includes/class_aside.php');
			?>
			<!-- END Left Aside -->
			<div class="page-content-wrapper">
				<!-- BEGIN Page Header -->
				<?php

				$this->load->view('includes/supplier_top_header.php');
				?>
				<main id="js-page-content" role="main" class="page-content">
					<!-- <div hidden="toastupdate" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                        <div class="toast-body">
                            Record Updated Successfully
                        </div>
                    </div> -->


					<?php if ($this->session->flashdata('info')) { ?>
						<div class="alert alert-info alert-dismissible show fade">
							<div class="alert-body">
								<button class="close" data-dismiss="alert">
									<span>&times;</span>
								</button>
								<?php echo $this->session->flashdata('info'); ?>
							</div>
						</div>
					<?php } ?>

					<?php if ($this->session->flashdata('danger')) { ?>
						<div class="alert alert-danger alert-dismissible show fade">
							<div class="alert-body">
								<button class="close" data-dismiss="alert">
									<span>&times;</span>
								</button>
								<?php echo $this->session->flashdata('danger'); ?>
							</div>
						</div>
					<?php } ?>


					<div class="row">
						<div class="col-md-12">
							<div id="panel-11" class="panel">
								<div class="panel-hdr">
									<h2>
										Prayers Management

									</h2>
								</div>
								<div class="panel-container show m-1">

									<ul class="nav nav-pills m-3" role="tablist">
										<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_direction-1">Prayer Count Entry</a></li>
										<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_direction-2">Manage Prayer</a></li>

									</ul>


									<div class="tab-content py-3">
										<div class="tab-pane fade show active" id="tab_direction-1" role="tabpanel">

											<?php
											$Month = date('m');
											$Year = date('Y');
											$Day = date('d') - 1;
											$CurrentDate = $Year . '-' . $Month . '-' . $Day;
											?>
											<form method="post">
												<div class="row p-3 m-1">
													<div class="col-md-3">
														<label class="form-contol" for="selectClassbox">Class</label>
														<select name="selectClassbox" id="selectClassbox" class="form-control" onchange="callfun()">
															<option value="" selected>Select Class:</option>
														</select>
													</div>
													<div class="col-md-3">
														<label class="form-contol" for="customFile">Prayer Date</label>

														<input type="date" class="form-control" name="start_date" id="start_date" value="" onchange="callfun()">
													</div>
													<div class="col-md-6" style="display:none">
														<label class="form-contol" for="customFile">user_id</label>
														<input type="hidden" class="form-control" value="" id="HiddenTID" name="HiddenTID">
													</div>






											</form>
											<div id="getData" class="container-fluid m-3"></div>
											<div class="col-md-12 mt-2" id="sendButton">
												<button type="submit" class="btn btn-primary" id="saveFGTBtn">Save</button>
												<button type="submit" class="btn btn-primary" id="updateFGTBtn" style="display: none;">Update</button>
											</div>
										</div>

									</div>
									<div class="tab-pane fade" id="tab_direction-2" role="tabpanel">
										<?php
										$Month = date('m');
										$Year = date('Y');
										$Day = date('d') - 1;
										$CurrentDate = $Year . '-' . $Month . '-' . $Day;
										?>

										<div class="row p-3 m-1">
											<div class="col-md-3">
												<label class="form-contol" for="selectClassbox">Class</label>
												<select name="selectClassboxsearch" id="selectClassboxsearch" class="form-control" onchange="getAllClassEntries()">
													<option value="" selected>Select Class:</option>
												</select>
											</div>
											<div class="col-md-3">
												<label class="form-contol" for="customFile">Prayer Date</label>

												<input type="date" class="form-control" name="search_date" id="search_date" value="">
											</div>
											<div class="col-md-6" style="display:none">
												<input type="hidden" class="form-control" value="" id="HiddenTID" name="HiddenTID">
											</div>
											<div class="col-md-2 mt-4" id="sendButton">
												<button class="btn btn-primary" onclick="getPrayerDataByDate()">Search</button>
											</div>






											<div id="getPrayerData" class="container-fluid m-3"></div>
										</div>


									</div>


								</div>




							</div>
						</div>
					</div>
				</main>
				<!-- this overlay is activated only when mobile menu is triggered -->
				<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
				<!-- BEGIN Page Footer -->
				<footer class="page-footer" role="contentinfo">
					<div class="d-flex align-items-center flex-1 text-muted">
						<span class="hidden-md-down fw-700">2024 © 100% Namazi by&nbsp;IT Dept Forward Sports</span>
					</div>
					<div>

					</div>
				</footer>
				<!-- END Page Footer -->
				<!-- BEGIN Shortcuts -->

				<!-- END Shortcuts -->
				<!-- BEGIN Color profile -->
				<!-- this area is hidden and will not be seen on screens or screen readers -->
				<!-- we use this only for CSS color refernce for JS stuff -->
				<p id="js-color-profile" class="d-none">
					<span class="color-primary-50"></span>
					<span class="color-primary-100"></span>
					<span class="color-primary-200"></span>
					<span class="color-primary-300"></span>
					<span class="color-primary-400"></span>
					<span class="color-primary-500"></span>
					<span class="color-primary-600"></span>
					<span class="color-primary-700"></span>
					<span class="color-primary-800"></span>
					<span class="color-primary-900"></span>
					<span class="color-info-50"></span>
					<span class="color-info-100"></span>
					<span class="color-info-200"></span>
					<span class="color-info-300"></span>
					<span class="color-info-400"></span>
					<span class="color-info-500"></span>
					<span class="color-info-600"></span>
					<span class="color-info-700"></span>
					<span class="color-info-800"></span>
					<span class="color-info-900"></span>
					<span class="color-danger-50"></span>
					<span class="color-danger-100"></span>
					<span class="color-danger-200"></span>
					<span class="color-danger-300"></span>
					<span class="color-danger-400"></span>
					<span class="color-danger-500"></span>
					<span class="color-danger-600"></span>
					<span class="color-danger-700"></span>
					<span class="color-danger-800"></span>
					<span class="color-danger-900"></span>
					<span class="color-warning-50"></span>
					<span class="color-warning-100"></span>
					<span class="color-warning-200"></span>
					<span class="color-warning-300"></span>
					<span class="color-warning-400"></span>
					<span class="color-warning-500"></span>
					<span class="color-warning-600"></span>
					<span class="color-warning-700"></span>
					<span class="color-warning-800"></span>
					<span class="color-warning-900"></span>
					<span class="color-success-50"></span>
					<span class="color-success-100"></span>
					<span class="color-success-200"></span>
					<span class="color-success-300"></span>
					<span class="color-success-400"></span>
					<span class="color-success-500"></span>
					<span class="color-success-600"></span>
					<span class="color-success-700"></span>
					<span class="color-success-800"></span>
					<span class="color-success-900"></span>
					<span class="color-fusion-50"></span>
					<span class="color-fusion-100"></span>
					<span class="color-fusion-200"></span>
					<span class="color-fusion-300"></span>
					<span class="color-fusion-400"></span>
					<span class="color-fusion-500"></span>
					<span class="color-fusion-600"></span>
					<span class="color-fusion-700"></span>
					<span class="color-fusion-800"></span>
					<span class="color-fusion-900"></span>
				</p>
				<!-- END Color profile -->
			</div>
		</div>
	</div>
	<!-- END Page Wrapper -->
	<!-- BEGIN Quick Menu -->
	<!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
	<nav class="shortcut-menu d-none d-sm-block">
		<input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
		<label for="menu_open" class="menu-open-button ">
			<span class="app-shortcut-icon d-block"></span>
		</label>
		<a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
			<i class="fal fa-arrow-up"></i>
		</a>
		<a href="page_login_alt.html" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
			<i class="fal fa-sign-out"></i>
		</a>
		<a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
			<i class="fal fa-expand"></i>
		</a>
		<a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left" title="Print page">
			<i class="fal fa-print"></i>
		</a>
		<a href="#" class="menu-item btn" data-action="app-voice" data-toggle="tooltip" data-placement="left" title="Voice command">
			<i class="fal fa-microphone"></i>
		</a>
	</nav>
	<!-- END Quick Menu -->
	<!-- BEGIN Messenger -->
	<div class="modal fade js-modal-messenger modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-right">
			<div class="modal-content h-100">
				<div class="dropdown-header bg-trans-gradient d-flex align-items-center w-100">
					<div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
						<span class="mr-2">
							<span class="rounded-circle profile-image d-block" style="background-image:url('img/demo/avatars/avatar-d.png'); background-size: cover;"></span>
						</span>
						<div class="info-card-text">
							<a href="javascript:void(0);" class="fs-lg text-truncate text-truncate-lg text-white" data-toggle="dropdown" aria-expanded="false">
								Tracey Chang
								<i class="fal fa-angle-down d-inline-block ml-1 text-white fs-md"></i>
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">Send Email</a>
								<a class="dropdown-item" href="#">Create Appointment</a>
								<a class="dropdown-item" href="#">Block User</a>
							</div>
							<span class="text-truncate text-truncate-md opacity-80">IT Director</span>
						</div>
					</div>
					<button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fal fa-times"></i></span>
					</button>
				</div>
				<div class="modal-body p-0 h-100 d-flex">
					<!-- BEGIN msgr-list -->
					<div class="msgr-list d-flex flex-column bg-faded border-faded border-top-0 border-right-0 border-bottom-0 position-absolute pos-top pos-bottom">
						<div>
							<div class="height-4 width-3 h3 m-0 d-flex justify-content-center flex-column color-primary-500 pl-3 mt-2">
								<i class="fal fa-search"></i>
							</div>
							<input type="text" class="form-control bg-white" id="msgr_listfilter_input" placeholder="Filter contacts" aria-label="FriendSearch" data-listfilter="#js-msgr-listfilter">
						</div>
						<div class="flex-1 h-100 custom-scroll">
							<div class="w-100">
								<ul id="js-msgr-listfilter" class="list-unstyled m-0">
									<li>
										<a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="tracey chang online">
											<div class="d-table-cell align-middle status status-success status-sm ">
												<span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-d.png'); background-size: cover;"></span>
											</div>
											<div class="d-table-cell w-100 align-middle pl-2 pr-2">
												<div class="text-truncate text-truncate-md">
													Tracey Chang
													<small class="d-block font-italic text-success fs-xs">
														Online
													</small>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="oliver kopyuv online">
											<div class="d-table-cell align-middle status status-success status-sm ">
												<span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
											</div>
											<div class="d-table-cell w-100 align-middle pl-2 pr-2">
												<div class="text-truncate text-truncate-md">
													Oliver Kopyuv
													<small class="d-block font-italic text-success fs-xs">
														Online
													</small>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="dr john cook phd away">
											<div class="d-table-cell align-middle status status-warning status-sm ">
												<span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
											</div>
											<div class="d-table-cell w-100 align-middle pl-2 pr-2">
												<div class="text-truncate text-truncate-md">
													Dr. John Cook PhD
													<small class="d-block font-italic fs-xs">
														Away
													</small>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney online">
											<div class="d-table-cell align-middle status status-success status-sm ">
												<span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-g.png'); background-size: cover;"></span>
											</div>
											<div class="d-table-cell w-100 align-middle pl-2 pr-2">
												<div class="text-truncate text-truncate-md">
													Ali Amdaney
													<small class="d-block font-italic fs-xs text-success">
														Online
													</small>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="sarah mcbrook online">
											<div class="d-table-cell align-middle status status-success status-sm">
												<span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-h.png'); background-size: cover;"></span>
											</div>
											<div class="d-table-cell w-100 align-middle pl-2 pr-2">
												<div class="text-truncate text-truncate-md">
													Sarah McBrook
													<small class="d-block font-italic fs-xs text-success">
														Online
													</small>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney offline">
											<div class="d-table-cell align-middle status status-sm">
												<span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-a.png'); background-size: cover;"></span>
											</div>
											<div class="d-table-cell w-100 align-middle pl-2 pr-2">
												<div class="text-truncate text-truncate-md">
													oliver.kopyuv@gotbootstrap.com
													<small class="d-block font-italic fs-xs">
														Offline
													</small>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney busy">
											<div class="d-table-cell align-middle status status-danger status-sm">
												<span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-j.png'); background-size: cover;"></span>
											</div>
											<div class="d-table-cell w-100 align-middle pl-2 pr-2">
												<div class="text-truncate text-truncate-md">
													oliver.kopyuv@gotbootstrap.com
													<small class="d-block font-italic fs-xs text-danger">
														Busy
													</small>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney offline">
											<div class="d-table-cell align-middle status status-sm">
												<span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-c.png'); background-size: cover;"></span>
											</div>
											<div class="d-table-cell w-100 align-middle pl-2 pr-2">
												<div class="text-truncate text-truncate-md">
													oliver.kopyuv@gotbootstrap.com
													<small class="d-block font-italic fs-xs">
														Offline
													</small>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney inactive">
											<div class="d-table-cell align-middle">
												<span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-m.png'); background-size: cover;"></span>
											</div>
											<div class="d-table-cell w-100 align-middle pl-2 pr-2">
												<div class="text-truncate text-truncate-md">
													+714651347790
													<small class="d-block font-italic fs-xs opacity-50">
														Missed Call
													</small>
												</div>
											</div>
										</a>
									</li>
								</ul>
								<div class="filter-message js-filter-message"></div>
							</div>
						</div>
						<div>
							<a class="fs-xl d-flex align-items-center p-3">
								<i class="fal fa-cogs"></i>
							</a>
						</div>
					</div>
					<!-- END msgr-list -->
					<!-- BEGIN msgr -->
					<div class="msgr d-flex h-100 flex-column bg-white">
						<!-- BEGIN custom-scroll -->
						<div class="custom-scroll flex-1 h-100">
							<div id="chat_container" class="w-100 p-4">
								<!-- start .chat-segment -->
								<div class="chat-segment">
									<div class="time-stamp text-center mb-2 fw-400">
										Jun 19
									</div>
								</div>
								<!--  end .chat-segment -->
								<!-- start .chat-segment -->
								<div class="chat-segment chat-segment-sent">
									<div class="chat-message">
										<p>
											Hey Tracey, did you get my files?
										</p>
									</div>
									<div class="text-right fw-300 text-muted mt-1 fs-xs">
										3:00 pm
									</div>
								</div>
								<!--  end .chat-segment -->
								<!-- start .chat-segment -->
								<div class="chat-segment chat-segment-get">
									<div class="chat-message">
										<p>
											Hi
										</p>
										<p>
											Sorry going through a busy time in office. Yes I analyzed the solution.
										</p>
										<p>
											It will require some resource, which I could not manage.
										</p>
									</div>
									<div class="fw-300 text-muted mt-1 fs-xs">
										3:24 pm
									</div>
								</div>
								<!--  end .chat-segment -->
								<!-- start .chat-segment -->
								<div class="chat-segment chat-segment-sent chat-start">
									<div class="chat-message">
										<p>
											Okay
										</p>
									</div>
								</div>
								<!--  end .chat-segment -->
								<!-- start .chat-segment -->
								<div class="chat-segment chat-segment-sent chat-end">
									<div class="chat-message">
										<p>
											Sending you some dough today, you can allocate the resources to this project.
										</p>
									</div>
									<div class="text-right fw-300 text-muted mt-1 fs-xs">
										3:26 pm
									</div>
								</div>
								<!--  end .chat-segment -->
								<!-- start .chat-segment -->
								<div class="chat-segment chat-segment-get chat-start">
									<div class="chat-message">
										<p>
											Perfect. Thanks a lot!
										</p>
									</div>
								</div>
								<!--  end .chat-segment -->
								<!-- start .chat-segment -->
								<div class="chat-segment chat-segment-get">
									<div class="chat-message">
										<p>
											I will have them ready by tonight.
										</p>
									</div>
								</div>
								<!--  end .chat-segment -->
								<!-- start .chat-segment -->
								<div class="chat-segment chat-segment-get chat-end">
									<div class="chat-message">
										<p>
											Cheers
										</p>
									</div>
								</div>
								<!--  end .chat-segment -->
								<!-- start .chat-segment for timestamp -->
								<div class="chat-segment">
									<div class="time-stamp text-center mb-2 fw-400">
										Jun 20
									</div>
								</div>
								<!--  end .chat-segment for timestamp -->
							</div>
						</div>
						<!-- END custom-scroll  -->
						<!-- BEGIN msgr__chatinput -->
						<div class="d-flex flex-column">
							<div class="border-faded border-right-0 border-bottom-0 border-left-0 flex-1 mr-3 ml-3 position-relative shadow-top">
								<div class="pt-3 pb-1 pr-0 pl-0 rounded-0" tabindex="-1">
									<div id="msgr_input" contenteditable="true" data-placeholder="Type your message here..." class="height-10 form-content-editable"></div>
								</div>
							</div>
							<div class="height-8 px-3 d-flex flex-row align-items-center flex-wrap flex-shrink-0">
								<a href="javascript:void(0);" class="btn btn-icon fs-xl width-1 mr-1" data-toggle="tooltip" data-original-title="More options" data-placement="top">
									<i class="fal fa-ellipsis-v-alt color-fusion-300"></i>
								</a>
								<a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Attach files" data-placement="top">
									<i class="fal fa-paperclip color-fusion-300"></i>
								</a>
								<a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Insert photo" data-placement="top">
									<i class="fal fa-camera color-fusion-300"></i>
								</a>
								<div class="ml-auto">
									<a href="javascript:void(0);" class="btn btn-info">Send</a>
								</div>
							</div>
						</div>
						<!-- END msgr__chatinput -->
					</div>
					<!-- END msgr -->
				</div>
			</div>
		</div>
	</div>



	<div id="editPrayerCount" class="modal fade">
		<div class="modal-dialog modal-sm-centered modal-transparent">
			<div class="modal-content">
				<div class="modal-header" style="font-weight:bolder;">
					<h1 class="modal-title" id="changeTitle" style="color: white;">Update Prayer Count</h1>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" style="color: white;">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row p-3">
						<div class="col-md-6" style="display:none">
							<label class="form-contol" for="customFile">user_id</label>
							<input type="hidden" class="form-control" value="" id="HiddenTID" name="HiddenTID">
						</div>
						<div class="col-md-6">
							<label class="form-contol" for="customFile" style="color: white; font-size:14px">Name:</label>
							<input disabled style="background-color: none; color: black;" class="form-control" value="" id="MemberName" name="MemberName">
						</div>
						<div class="col-md-6">
							<label class="form-contol" for="customFile" style="color: white; font-size:14px">Card No:</label>
							<input style="background-color: none; color: black;" disabled class="form-control" value="" id="MemberCardNo" name="MemberCardNo">
						</div>
						<div class="col-md-6">
							<label class="form-contol" for="qty" style="color: white; font-size:14px">Counter:</label><span class="text-danger"> *</span>
							<input style="background-color: none; color: black;" type="number" class="form-control" value="" id="prayerqty" name="prayerqty">
						</div>

						<div class="col-md-6 mt-2" id="sendButton">
							<button class="btn btn-primary" id="savePrayerCount" style="margin-top:15px">Update</button>
						</div>


					</div>


				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	<!-- END Messenger -->
	<!-- BEGIN Page Settings -->
	<div class="modal fade js-modal-settings modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-right modal-md">
			<div class="modal-content">
				<div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center w-100">
					<h4 class="m-0 text-center color-white">
						Layout Settings
						<small class="mb-0 opacity-80">User Interface Settings</small>
					</h4>
					<button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fal fa-times"></i></span>
					</button>
				</div>
				<div class="modal-body p-0">
					<div class="settings-panel">
						<div class="mt-4 d-table w-100 px-5">
							<div class="d-table-cell align-middle">
								<h5 class="p-0">
									App Layout
								</h5>
							</div>
						</div>
						<div class="list" id="fh">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="header-function-fixed"></a>
							<span class="onoffswitch-title">Fixed Header</span>
							<span class="onoffswitch-title-desc">header is in a fixed at all times</span>
						</div>
						<div class="list" id="nff">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-fixed"></a>
							<span class="onoffswitch-title">Fixed Navigation</span>
							<span class="onoffswitch-title-desc">left panel is fixed</span>
						</div>
						<div class="list" id="nfm">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-minify"></a>
							<span class="onoffswitch-title">Minify Navigation</span>
							<span class="onoffswitch-title-desc">Skew nav to maximize space</span>
						</div>
						<div class="list" id="nfh">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-hidden"></a>
							<span class="onoffswitch-title">Hide Navigation</span>
							<span class="onoffswitch-title-desc">roll mouse on edge to reveal</span>
						</div>
						<div class="list" id="nft">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-top"></a>
							<span class="onoffswitch-title">Top Navigation</span>
							<span class="onoffswitch-title-desc">Relocate left pane to top</span>
						</div>
						<div class="list" id="mmb">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-main-boxed"></a>
							<span class="onoffswitch-title">Boxed Layout</span>
							<span class="onoffswitch-title-desc">Encapsulates to a container</span>
						</div>
						<div class="expanded">
							<ul class="">
								<li>
									<div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
								</li>
								<li>
									<div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
								</li>
								<li>
									<div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
								</li>
								<li>
									<div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
								</li>
							</ul>
							<div class="list" id="mbgf">
								<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-fixed-bg"></a>
								<span class="onoffswitch-title">Fixed Background</span>
							</div>
						</div>
						<div class="mt-4 d-table w-100 px-5">
							<div class="d-table-cell align-middle">
								<h5 class="p-0">
									Mobile Menu
								</h5>
							</div>
						</div>
						<div class="list" id="nmp">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-push"></a>
							<span class="onoffswitch-title">Push Content</span>
							<span class="onoffswitch-title-desc">Content pushed on menu reveal</span>
						</div>
						<div class="list" id="nmno">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-no-overlay"></a>
							<span class="onoffswitch-title">No Overlay</span>
							<span class="onoffswitch-title-desc">Removes mesh on menu reveal</span>
						</div>
						<div class="list" id="sldo">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-slide-out"></a>
							<span class="onoffswitch-title">Off-Canvas <sup>(beta)</sup></span>
							<span class="onoffswitch-title-desc">Content overlaps menu</span>
						</div>
						<div class="mt-4 d-table w-100 px-5">
							<div class="d-table-cell align-middle">
								<h5 class="p-0">
									Accessibility
								</h5>
							</div>
						</div>
						<div class="list" id="mbf">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-bigger-font"></a>
							<span class="onoffswitch-title">Bigger Content Font</span>
							<span class="onoffswitch-title-desc">content fonts are bigger for readability</span>
						</div>
						<div class="list" id="mhc">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-high-contrast"></a>
							<span class="onoffswitch-title">High Contrast Text (WCAG 2 AA)</span>
							<span class="onoffswitch-title-desc">4.5:1 text contrast ratio</span>
						</div>
						<div class="list" id="mcb">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-color-blind"></a>
							<span class="onoffswitch-title">Daltonism <sup>(beta)</sup> </span>
							<span class="onoffswitch-title-desc">color vision deficiency</span>
						</div>
						<div class="list" id="mpc">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-pace-custom"></a>
							<span class="onoffswitch-title">Preloader Inside</span>
							<span class="onoffswitch-title-desc">preloader will be inside content</span>
						</div>
						<div class="mt-4 d-table w-100 px-5">
							<div class="d-table-cell align-middle">
								<h5 class="p-0">
									Global Modifications
								</h5>
							</div>
						</div>
						<div class="list" id="mcbg">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-clean-page-bg"></a>
							<span class="onoffswitch-title">Clean Page Background</span>
							<span class="onoffswitch-title-desc">adds more whitespace</span>
						</div>
						<div class="list" id="mhni">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-nav-icons"></a>
							<span class="onoffswitch-title">Hide Navigation Icons</span>
							<span class="onoffswitch-title-desc">invisible navigation icons</span>
						</div>
						<div class="list" id="dan">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-disable-animation"></a>
							<span class="onoffswitch-title">Disable CSS Animation</span>
							<span class="onoffswitch-title-desc">Disables CSS based animations</span>
						</div>
						<div class="list" id="mhic">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-info-card"></a>
							<span class="onoffswitch-title">Hide Info Card</span>
							<span class="onoffswitch-title-desc">Hides info card from left panel</span>
						</div>
						<div class="list" id="mlph">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-lean-subheader"></a>
							<span class="onoffswitch-title">Lean Subheader</span>
							<span class="onoffswitch-title-desc">distinguished page header</span>
						</div>
						<div class="list" id="mnl">
							<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-link"></a>
							<span class="onoffswitch-title">Hierarchical Navigation</span>
							<span class="onoffswitch-title-desc">Clear breakdown of nav links</span>
						</div>
						<div class="list mt-1">
							<span class="onoffswitch-title">Global Font Size <small>(RESETS ON REFRESH)</small> </span>
							<div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
								<label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-sm" data-target="html">
									<input type="radio" name="changeFrontSize"> SM
								</label>
								<label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text" data-target="html">
									<input type="radio" name="changeFrontSize" checked=""> MD
								</label>
								<label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-lg" data-target="html">
									<input type="radio" name="changeFrontSize"> LG
								</label>
								<label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-xl" data-target="html">
									<input type="radio" name="changeFrontSize"> XL
								</label>
							</div>
							<span class="onoffswitch-title-desc d-block mb-0">Change <strong>root</strong> font size to effect rem
								values</span>
						</div>
						<hr class="mb-0 mt-4">
						<div class="mt-2 d-table w-100 pl-5 pr-3">
							<div class="fs-xs text-muted p-2 alert alert-warning mt-3 mb-2">
								<i class="fal fa-exclamation-triangle text-warning mr-2"></i>The settings below uses localStorage to load
								the external CSS file as an overlap to the base css. Due to network latency and CPU utilization, you may
								experience a brief flickering effect on page load which may show the intial applied theme for a split
								second. Setting the prefered style/theme in the header will prevent this from happening.
							</div>
						</div>
						<div class="mt-2 d-table w-100 pl-5 pr-3">
							<div class="d-table-cell align-middle">
								<h5 class="p-0">
									Theme colors
								</h5>
							</div>
						</div>
						<div class="expanded theme-colors pl-5 pr-3">
							<ul class="m-0">
								<li>
									<a href="#" id="myapp-0" data-action="theme-update" data-themesave data-theme="" data-toggle="tooltip" data-placement="top" title="Wisteria (base css)" data-original-title="Wisteria (base css)"></a>
								</li>
								<li>
									<a href="#" id="myapp-1" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-1.css" data-toggle="tooltip" data-placement="top" title="Tapestry" data-original-title="Tapestry"></a>
								</li>
								<li>
									<a href="#" id="myapp-2" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-2.css" data-toggle="tooltip" data-placement="top" title="Atlantis" data-original-title="Atlantis"></a>
								</li>
								<li>
									<a href="#" id="myapp-3" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-3.css" data-toggle="tooltip" data-placement="top" title="Indigo" data-original-title="Indigo"></a>
								</li>
								<li>
									<a href="#" id="myapp-4" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-4.css" data-toggle="tooltip" data-placement="top" title="Dodger Blue" data-original-title="Dodger Blue"></a>
								</li>
								<li>
									<a href="#" id="myapp-5" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-5.css" data-toggle="tooltip" data-placement="top" title="Tradewind" data-original-title="Tradewind"></a>
								</li>
								<li>
									<a href="#" id="myapp-6" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-6.css" data-toggle="tooltip" data-placement="top" title="Cranberry" data-original-title="Cranberry"></a>
								</li>
								<li>
									<a href="#" id="myapp-7" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-7.css" data-toggle="tooltip" data-placement="top" title="Oslo Gray" data-original-title="Oslo Gray"></a>
								</li>
								<li>
									<a href="#" id="myapp-8" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-8.css" data-toggle="tooltip" data-placement="top" title="Chetwode Blue" data-original-title="Chetwode Blue"></a>
								</li>
								<li>
									<a href="#" id="myapp-9" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-9.css" data-toggle="tooltip" data-placement="top" title="Apricot" data-original-title="Apricot"></a>
								</li>
								<li>
									<a href="#" id="myapp-10" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-10.css" data-toggle="tooltip" data-placement="top" title="Blue Smoke" data-original-title="Blue Smoke"></a>
								</li>
								<li>
									<a href="#" id="myapp-11" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-11.css" data-toggle="tooltip" data-placement="top" title="Green Smoke" data-original-title="Green Smoke"></a>
								</li>
								<li>
									<a href="#" id="myapp-12" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-12.css" data-toggle="tooltip" data-placement="top" title="Wild Blue Yonder" data-original-title="Wild Blue Yonder"></a>
								</li>
								<li>
									<a href="#" id="myapp-13" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-13.css" data-toggle="tooltip" data-placement="top" title="Emerald" data-original-title="Emerald"></a>
								</li>
							</ul>
						</div>
						<hr class="mb-0 mt-4">
						<div class="pl-5 pr-3 py-3 bg-faded">
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<a href="#" class="btn btn-outline-danger fw-500 btn-block" data-action="app-reset">Reset Settings</a>
								</div>
								<div class="col-6 pl-1">
									<a href="#" class="btn btn-danger fw-500 btn-block" data-action="factory-reset">Factory Reset</a>
								</div>
							</div>
						</div>
					</div> <span id="saving"></span>
				</div>
			</div>
		</div>
	</div>
	<!-- END Page Settings -->
	<!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
	<script src="<?php echo base_url(); ?>assets/js/vendors.bundle.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/app.bundle.js"></script>
	<script type="text/javascript">
		/* Activate smart panels */
		$('#js-page-content').smartPanel();
	</script>
	<!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
	<script src="<?php echo base_url(); ?>assets/js/statistics/peity/peity.bundle.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/statistics/flot/flot.bundle.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/statistics/easypiechart/easypiechart.bundle.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datagrid/datatables/datatables.bundle.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datagrid/datatables/datatables.bundle.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/highcharts.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/data.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/drilldown.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/exporting.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/export-data.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/accessibility.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/highcharts-more.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/solidGuage.js"></script>
	<script src="<?php echo base_url() ?>assets/js/notifications/toastr/toastr.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

	<script src="<?php echo base_url(); ?>/assets/js/select2.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/select2.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<script src="<?php echo base_url(); ?>assets/js/printThis.js"></script>


	<script>
		/* defined datas */
		var dataTargetProfit = [
			[1354586000000, 153],
			[1364587000000, 658],
			[1374588000000, 198],
			[1384589000000, 663],
			[1394590000000, 801],
			[1404591000000, 1080],
			[1414592000000, 353],
			[1424593000000, 749],
			[1434594000000, 523],
			[1444595000000, 258],
			[1454596000000, 688],
			[1464597000000, 364]
		]
		var dataProfit = [
			[1354586000000, 53],
			[1364587000000, 65],
			[1374588000000, 98],
			[1384589000000, 83],
			[1394590000000, 980],
			[1404591000000, 808],
			[1414592000000, 720],
			[1424593000000, 674],
			[1434594000000, 23],
			[1444595000000, 79],
			[1454596000000, 88],
			[1464597000000, 36]
		]
		var dataSignups = [
			[1354586000000, 647],
			[1364587000000, 435],
			[1374588000000, 784],
			[1384589000000, 346],
			[1394590000000, 487],
			[1404591000000, 463],
			[1414592000000, 479],
			[1424593000000, 236],
			[1434594000000, 843],
			[1444595000000, 657],
			[1454596000000, 241],
			[1464597000000, 341]
		]
		var dataSet1 = [
			[0, 10],
			[100, 8],
			[200, 7],
			[300, 5],
			[400, 4],
			[500, 6],
			[600, 3],
			[700, 2]
		];
		var dataSet2 = [
			[0, 9],
			[100, 6],
			[200, 5],
			[300, 3],
			[400, 3],
			[500, 5],
			[600, 2],
			[700, 1]
		];
	</script>
	<script>
		$(document).ready(function() {

			// Copy code
			        let today = new Date();
    let d = today.getDate() - 1; // Subtract 1 day to allow selecting today
    let m = today.getMonth() + 1;
    let y = today.getFullYear();

    if (d === 0) {
        // If today is the first day of the month, calculate the previous month's date
        let prevMonthDate = new Date(y, m, 0); // Get the last day of the previous month
        d = prevMonthDate.getDate() + 1; // Use the last day of the previous month
        m = prevMonthDate.getMonth(); // Use the month of the previous month
        y = prevMonthDate.getFullYear(); // Use the year of the previous month
    }

    // Format the date
    let fulldate = y + '-' + (m < 10 ? '0' : '') + m + '-' + (d < 10 ? '0' : '') + d;

    // Set the value and maximum date for start_date input field
    $("#start_date").val(fulldate);
    $("#start_date").attr('max', fulldate);
	$("#search_date").attr('max', fulldate); // Set the minimum date

$("#search_date").val(fulldate); // Set the input field's value to yesterday

			$.get(url = '<?php echo base_url('Classes/getCurrentHeadsClass'); ?>',
				function(data) {

					// console.log('data of the class of current head', data)

					for (let i = 0; i < data.length; i++) {
						// $("#selectClassbox").val('')
						$("#selectClassbox").append($(`<option>`, {
							value: data[i]['TID'],
							text: data[i]['Class']
						}))
						$("#selectClassboxsearch").append($(`<option>`, {
							value: data[i]['TID'],
							text: data[i]['Class']
						}))
					}
				})

			getAllClassEntries();
			getPrayerDataByDate();

			$("#savePrayerCount").on('click', function() {
				$.post(url = '<?php echo base_url('Classes/editPrayerCount') ?>', data = {
					TID: $("#HiddenTID").val(),
					NoOfPrayers: $("#prayerqty").val()
				}, function(data) {
					$("#editPrayerCount").modal('hide')
					// $('.toastupdate').toast('show');
					toastr.success('Counter updated Successfully')
					getPrayerDataByDate()
				})

			})

			let url1 = '<?php echo base_url('Classes/GetDeptCardCount') ?>'

            $.ajax({
                url: url1,
                method: 'GET',
                success: function(data) {
                    DepartmentCardCount = data[0]['deptWiseCount']
                    // alert(DepartmentCardCount);
                }
            })



		});

		let filteredarr;

		let firstObj;
		let EntriesObj;

		let CurrentClass
		let totalClassPrayerCount

		function getAllClassEntries() {


			url1 = '<?php echo base_url('Classes/getAllClass'); ?>'

			$.post(url1, {
				CurrentClass: $("#selectClassbox").val()
			}, function(data) {
				// console.log("All data", data);
				var SaveEntries = data;
				EntriesObj = SaveEntries.map(function(NewObj) {
					var {
						Class,
						ClassID,
						Department,
						CardNo,
						Designation,
						ClassMemberName

					} = NewObj;
					return {
						Class,
						ClassID,
						Department,
						CardNo,
						Designation,
						ClassMemberName

					}
				})
				let cards = EntriesObj.map(item => item.CardNo)
				totalClassPrayerCount = cards.length
				// alert(coun);

				if (data.length > 0) {
					let html = `<table id="dataTable1" class="table table-bordered table-stripped ">
													<thead class="bg-primary-600">
														<tr>
															<th>Class</th>
															<th>Card NO</th>
															<th>Name</th>
															<th>Department</th>
															<th>Designation</th>
                                                            <th>Prayer Counter</th>
															<!-- <th>Action</th> -->
														</tr>
													</thead>
													<tbody>`;
					data.forEach(element => {
						html += `<tr>	
											<td data-Class = "${element.Class}">${element.Class}</td>
											<td data-CardNo = ${element.CardNo}>${element.CardNo}</td>
											<td data-ClassMemberName = "${element.ClassMemberName}">${element.ClassMemberName}</td>                                        

											<td data-DeptName = id = "DepartmentID"><?php echo $_SESSION['deptName'] ?></td>
											<td data-DesigID = "${element.Designation}" id = "DesignationID">${element.Designation}</td>

                                            <td> 
                                                        
                                                        <input type="number" class="form-control" value="" id="PrayerEntry${element.NoOfPrayers}" name="PrayerEntry">
                                                     </td>
											<!-- <td>											 
												<button type="button" style="display: inline-block;" class="btn btn-primary btn-sm updatebtn2" id="" onclick="editSubClass(${element.TID})"><i class="fal fa-edit" aria-hidden="true"></i><span class="tooltiptext">Click to edit Counter</span></button>  &nbsp;
                                
                                				<button type="button" style="display: inline-block;" class="btn btn-danger btn-sm updatebtn2" id="" onclick="deleteSubClass(${element.TID})"><i class="fal fa-trash" aria-hidden="true" ></i></button>												
											</td> -->
													
									</tr>`
					})
					$("#getData").html(html);

					// $('#dataTable1').dataTable({
					//     ordering: false,
					//     responsive: false,
					//     lengthChange: true,
					//     lengthMenu: [
					//         [10, 25, 50, -1],
					//         [10, 25, 50, 'All'],
					//     ],
					//     dom:
					//         /*	--- Layout Structure 
					//           --- Options
					//           l	-	length changing input control
					//           f	-	filtering input
					//           t	-	The table!
					//           i	-	Table information summary
					//           p	-	pagination control
					//           r	-	processing display element
					//           B	-	buttons
					//           R	-	ColReorder
					//           S	-	Select

					//           --- Markup
					//           < and >				- div element
					//           <"class" and >		- div with a class
					//           <"#id" and >		- div with an ID
					//           <"#id.class" and >	- div with an ID and a class

					//           --- Further reading
					//           https://datatables.net/reference/option/dom
					//           --------------------------------------
					//          */
					//         "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
					//         "<'row'<'col-sm-12'tr>>" +
					//         "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
					//     buttons: [
					//         /*{
					//           extend:    'colvis',
					//           text:      'Column Visibility',
					//           titleAttr: 'Col visibility',
					//           className: 'mr-sm-3'
					//         },*/
					//         {
					//             extend: 'pdfHtml5',
					//             text: 'PDF',
					//             titleAttr: 'Generate PDF',
					//             className: 'btn-outline-danger btn-sm mr-1'
					//         },
					//         {
					//             extend: 'excelHtml5',
					//             text: 'Excel',
					//             titleAttr: 'Generate Excel',
					//             className: 'btn-outline-success btn-sm mr-1'
					//         },
					//         {
					//             extend: 'csvHtml5',
					//             text: 'CSV',
					//             titleAttr: 'Generate CSV',
					//             className: 'btn-outline-primary btn-sm mr-1'
					//         },
					//         {
					//             extend: 'copyHtml5',
					//             text: 'Copy',
					//             titleAttr: 'Copy to clipboard',
					//             className: 'btn-outline-primary btn-sm mr-1'
					//         },
					//         {
					//             extend: 'print',
					//             text: 'Print',
					//             titleAttr: 'Print Table',
					//             className: 'btn-outline-primary btn-sm'
					//         }
					//     ]
					// });



				}

			})







		}



		function callfun() {
			getAllClassEntries()
			existentry()
		}

		let existingprayers = [];

		async function existentry() {
			let entryexist = $("#start_date").val();
			let SelectedClass = $("#selectClassbox").val();
			var disabledentries;

			await $.post('<?php echo base_url() ?>Classes/entryexist', {
				"CurrentClass": SelectedClass,
				"Date": entryexist
			}, async function(data) {
				// console.log("all entry exist", data);
				let newobj = Object.values(data)
				let filteredArr = newobj.filter(entry => entry.Date.split(" ")[0] === entryexist);

				let existingCardNos = filteredArr.map(entry => entry.SubordinateCardNo);
				let filt = data.filter(item => item.NoOfPrayers == '')

				await data;
				if (data) {
					$("#getData tbody tr").each(function() {
						let existingcardNo = $(this).find("td[data-CardNo]").attr("data-CardNo");
						// console.log("existingcrd", existingcardNo);
						if (existingCardNos.includes(parseInt(existingcardNo))) {
							$(this).find("input[name='PrayerEntry']").val(data.NoOfPrayers);

							$(this).find("input[name='PrayerEntry']").prop('disabled', true);
						}
					})
				}




			})

		}

        let DepartmentCardCount;

		$('#saveFGTBtn').on('click', function(e) {
			e.preventDefault();

			let entryexist = $("#start_date").val();
			let SelectedClass = $("#selectClassbox").val();
			$.post('<?php echo base_url() ?>Classes/entryexist', {
				"CurrentClass": SelectedClass,
				"Date": entryexist
			}).then(function(data) {
				let newobj = Object.values(data)
				let filteredArr = newobj.filter(entry => entry.Date.split(" ")[0] === entryexist);
				let existingCardNos = filteredArr.map(entry => entry.SubordinateCardNo);
				// console.log('data exist of', existingCardNos);

				let PrayerEntries = [];
				let newcard = [];
				let DeptName = [];
				let Designation = [];
				let MemberName = [];
				let DeptID = [];
				let ClassName = [];
				$("#getData tbody tr").each(function() {
					var cardNo = $(this).find("td[data-CardNo]").attr("data-CardNo");
					newcard.push(cardNo);
					var PrayerEntry = $(this).find("input[name='PrayerEntry']").val();
					PrayerEntries.push(PrayerEntry);
					var Memname = $(this).find("td[data-ClassMemberName]").attr("data-ClassMemberName");
					MemberName.push(Memname);
					var DepName = $(this).find("td[data-DeptName]").attr("data-DeptName");
					DeptName.push(DepName);
					var Desig = $(this).find("td[data-DesigID]").attr("data-DesigID");
					Designation.push(Desig);
					var CName = $(this).find("td[data-Class]").attr("data-Class");
					ClassName.push(CName);
					// }
				});



				let url = "<?php echo base_url('Classes/insertPrayerDetail') ?>";


				if (PrayerEntries.length > 0) {
					// Send only the PrayerEntries that don't have existing entries for the selected date and class
					$.post(url, {
						CardNo: newcard,
						Class: ClassName,
						ClassID: SelectedClass,
						Department: DeptName,
						Designation: Designation,
						PrayerEntry: PrayerEntries,
						Date: entryexist,
						ClassMemberName: MemberName,
						ClassPrayerCount: totalClassPrayerCount,
						DepartmentCardCount:DepartmentCardCount


					}).done(function(response) {
						if (response.success) {
							toastr.success('Data added successfully')
							callfun()
						} else {
							toastr.error('Failed to add data')
						}
					}).fail(function() {
						toastr.error('Data already exist in the date')
						
						callfun()
					});
				} else {
					alert("Data already exist in the date");
				}
			});
		});


		function getPrayerDataByDate() {

			url1 = '<?php echo base_url('Classes/getPrayerData'); ?>'

			$.post(url1, data = {
				"Date": $("#search_date").val(),
				"ClassID": $("#selectClassboxsearch").val()
			}, function(data) {
				console.log("All Prayer data", data);

				if (data.length > 0) {
					let html = `<table id="PrayerEntries" class="table table-bordered table-stripped ">
                                        <thead class="bg-primary-600">
                                            <tr>
                                                <th>Class</th>
                                                <th>Card NO</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>EntryDate</th>

                                                <th>Prayer Counter</th>

												<th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>`;
					data.forEach(element => {
						html += `<tr>	
                                <td data-Class = ${element.MemberClass}>${element.MemberClass}</td>
                                <td data-CardNo = ${element.SubordinateCardNo}>${element.SubordinateCardNo}</td>
                                <td>${element.ClassMemberName}</td>                                        

                                <td data-DeptName id = "DepartmentID"><?php echo $_SESSION['deptName']; ?></td>
                                <td data-DesigID id = "DesignationID">${element.DesignationName}</td>
                                <td data-DesigID id = "DesignationID">${element.Date.split(" ")[0]}</td>
                                <td data-noofprayerID id = "noofprayerID">${element.NoOfPrayers}</td>


                                <td>											 
								<button title = "Click to edit counter" type="button" style="display: inline-block;" class="btn btn-primary btn-sm updatebtn2" id = "BtnCounter"  onclick="editPrayerEntry(${element.TID})"><i class="fal fa-edit" aria-hidden="true"></i></button>  &nbsp;
                                </td>
                                        
                            </tr>`
					})
					$("#getPrayerData").html(html);

					// $('#PrayerEntries').dataTable({
					// 	ordering: false,
					// 	responsive: false,
					// 	lengthChange: false,
					// 	dom:
					// 		/*	--- Layout Structure 
					// 		  --- Options
					// 		  l	-	length changing input control
					// 		  f	-	filtering input
					// 		  t	-	The table!
					// 		  i	-	Table information summary
					// 		  p	-	pagination control
					// 		  r	-	processing display element
					// 		  B	-	buttons
					// 		  R	-	ColReorder
					// 		  S	-	Select

					// 		  --- Markup
					// 		  < and >				- div element
					// 		  <"class" and >		- div with a class
					// 		  <"#id" and >		- div with an ID
					// 		  <"#id.class" and >	- div with an ID and a class

					// 		  --- Further reading
					// 		  https://datatables.net/reference/option/dom
					// 		  --------------------------------------
					// 		 */
					// 		"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
					// 		"<'row'<'col-sm-12'tr>>" +
					// 		"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
					// 	buttons: [
					// 		/*{
					// 		  extend:    'colvis',
					// 		  text:      'Column Visibility',
					// 		  titleAttr: 'Col visibility',
					// 		  className: 'mr-sm-3'
					// 		},*/
					// 		{
					// 			extend: 'pdfHtml5',
					// 			text: 'PDF',
					// 			titleAttr: 'Generate PDF',
					// 			className: 'btn-outline-danger btn-sm mr-1'
					// 		},
					// 		{
					// 			extend: 'excelHtml5',
					// 			text: 'Excel',
					// 			titleAttr: 'Generate Excel',
					// 			className: 'btn-outline-success btn-sm mr-1'
					// 		},
					// 		{
					// 			extend: 'csvHtml5',
					// 			text: 'CSV',
					// 			titleAttr: 'Generate CSV',
					// 			className: 'btn-outline-primary btn-sm mr-1'
					// 		},
					// 		{
					// 			extend: 'copyHtml5',
					// 			text: 'Copy',
					// 			titleAttr: 'Copy to clipboard',
					// 			className: 'btn-outline-primary btn-sm mr-1'
					// 		},
					// 		{
					// 			extend: 'print',
					// 			text: 'Print',
					// 			titleAttr: 'Print Table',
					// 			className: 'btn-outline-primary btn-sm'
					// 		}
					// 	]
					// });



				} else {
					alert("No data available")
				}

			})

		}
		editPrayerEntry = (TID) => {
			// alert(TID);
			$("#editPrayerCount").modal('toggle')
			$("#HiddenTID").val(TID)

			$.post(url = '<?php echo base_url('Classes/getPrayerCount') ?>', data = {
				TID: TID
			}, function(data) {
				console.log(data);
				$("#prayerqty").val(data[0].NoOfPrayers)
				$("#MemberName").val(data[0].ClassMemberName)
				$("#MemberCardNo").val(data[0].SubordinateCardNo)

			})
		}
	</script>

	</body>

	</html>

<?php
} ?>