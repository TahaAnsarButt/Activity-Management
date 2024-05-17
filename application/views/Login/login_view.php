<?php
if ($this->session->has_userdata('NamazUserId')) {
	redirect('Classes');
} else {
	// print_r("here");
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>100% Namazi</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>/assets/login/images/icons/pic1.jpg" />
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/login/vendor/bootstrap/css/bootstrap.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/login/vendor/animate/animate.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/login/vendor/css-hamburgers/hamburgers.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/login/vendor/animsition/css/animsition.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/login/vendor/select2/select2.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/login/vendor/daterangepicker/daterangepicker.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/login/css/util.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/login/css/main.css">

		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>/assets/css/notifications/toastr/toastr.css">
		<!--===============================================================================================-->
		<style>
			body {
				font-family: 'Arial', sans-serif;
				background-image: url("<?php echo base_url('assets/img/backgrounds/pexels-adnan-uddin-1439331.jpg') ?>");
				background-position: center center;
				background-size: cover;
				height: auto;
			}

			.container {
				margin-top: 100px;
				max-width: 400px;
			}

			.login-box {
				background-color: #000000a1;
				padding: 20px;
				border-radius: 40px;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
				
				border: 3px solid #fff;
			}

			.login-key {
				font-size: 50px;
				color: #fff;
			}

			.login-title {
				font-size: 24px;
				font-weight: bold;
				color: #fff;
				margin-bottom: 20px;
			}

			.form-group {
				margin-bottom: 20px;
			}

			.form-control {
				border-radius: 20px;
				background-color: #fff0;
				border: 1px solid #9f897b;
				color: #fff;
			}

			.btn-primary {
				background-color: #9f897b;
				border: none;
				border-radius: 20px;
				font-weight: bold;
				padding: 10px 20px;
			}

			.btn-primary:hover {
				background-color: #6a2a11;
			}

			.login-btm {
				text-align: center;
				margin-top: 20px;
			}

			.login-text {
				color: #6C757D;
			}
		</style>
	</head>



	<body>
		<div class="container">
			<div class="login-box mx-auto">
				<div class="text-center login-key">
					<i class="fa fa-key"></i>
				</div>
				<?php if ($this->session->flashdata('info')) { ?>
					<div class="alert alert-success alert-dismissible show fade">
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
				<div class="text-center login-title">
					100% Namazi System
				</div>
				<!-- <form method="POST" action="<?php echo base_url('LoginController/authenticate'); ?>">
					<div class="form-group">
						<input type="number" class="form-control" name="username" placeholder="CardNo" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="Password" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">LOGIN</button>
					</div>
				</form> -->


				<div class="form-group">
					<input type="number" class="form-control" name="username" id="username" placeholder="CardNo">
					<span id="username-error" class="error invalid-feedback">The Card No field is required</span>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" id="password" placeholder="Password">
					<span id="password-error" class="error invalid-feedback">The password field is required</span>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" onclick="login()">LOGIN</button>
				</div>



			</div>
		</div>

		<!--===============================================================================================-->
		<script src="<?php echo base_url(); ?>/assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url(); ?>/assets/login/vendor/animsition/js/animsition.min.js"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url(); ?>/assets/login/vendor/bootstrap/js/popper.js"></script>
		<script src="<?php echo base_url(); ?>/assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url(); ?>/assets/login/vendor/select2/select2.min.js"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url(); ?>/assets/login/vendor/daterangepicker/moment.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/login/vendor/daterangepicker/daterangepicker.js"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url(); ?>/assets/login/vendor/countdowntime/countdowntime.js"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url() ?>/assets/login/js/main.js"></script>

		<script src="<?php echo base_url() ?>assets/js/notifications/toastr/toastr.js"></script>

	</body>

	</html>
<?php

}

?>

<script src="<?php echo base_url() ?>assets/js/crypto-js.min.js"></script>







<script>
	$(document).ready(function() {
		// login();
	})

	function login() {
		// let LOGIN_ACCESS_BY_GRADE_ID = [1, 2, 3, 4, 18, 19];

		url = "http://10.10.100.4:8010/api/login/check_credentials/";
		let cardno = $('input[id=username]');
		let password = $('input[id=password]');

		if (cardno.val().length <= 0) {
			cardno.addClass('is-invalid')
			is_valid = false
		} else {
			cardno.removeClass('is-invalid')
			is_valid = true
		}

		if (password.val().length <= 0) {
			password.addClass('is-invalid')
			is_valid = false
		} else {
			password.removeClass('is-invalid')
			is_valid = true
		}

		if (!is_valid) {
			return;
		}


		var fd = new FormData();
		fd.append("username", cardno.val());
		fd.append("password", password.val());
		$.ajax({
			url: url,
			type: 'post',
			data: fd,
			contentType: false,
			processData: false,
			success: function(data, status) {
				if (data && data.error) {
					alert(data.error);
				} else {
					console.log("all data", data);
					console.log("encrpt", data.encypt);
					// console.log("gradeid", data.gradeID);
					// console.log("grade name", data.gradeName);


					const encryptedData = data.encypt;
					const decryptedBytes = CryptoJS.AES.decrypt(encryptedData, 'Password@2022').toString(CryptoJS.enc.Utf8);
					console.log('Decrypted password:', decryptedBytes);

					// if (data.gradeID == 1 || data.gradeID == 2 || data.gradeID == 3 || data.gradeID == 4 || data.gradeID == 18 || data.gradeID == 19) {
					if (!(decryptedBytes.replace(/"/g, "") === password.val())) {
						toastr["error"]("Password is incorrect")
						toastr.options = {
							"closeButton": true,
							"debug": false,
							"newestOnTop": true,
							"progressBar": true,
							"positionClass": "toast-top-center",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"timeOut": 0,
						}
						$('input[id=password]').val('');
						return true;
					} else {
						storeSession(data);
					}
					// } else {
					// 	toastr["error"]("You do not have rights to access Gift Souvenir.")
					// 	toastr.options = {
					// 		"closeButton": true,
					// 		"debug": false,
					// 		"newestOnTop": true,
					// 		"progressBar": true,
					// 		"positionClass": "toast-top-center",
					// 		"preventDuplicates": false,
					// 		"onclick": null,
					// 		"showDuration": "300",
					// 		"timeOut": 0,
					// 	}
					// 	$('input[id=username]').val('');
					// 	$('input[id=password]').val('');
					// 	return true;
					// }

				}

			},
			error: function() {
				alert("Error: Server is not responding.");

			}
		});
	}

	function storeSession(data) {

		console.log("store session data: ", data);

		url = "<?php echo base_url(''); ?>LoginController/authenticate2";

		$.post(url, {
			data: data
		}, function(data) {
			if (data == true) {
				window.location.href = "<?php echo base_url(''); ?>Classes";
			}
		});
	}
</script>
