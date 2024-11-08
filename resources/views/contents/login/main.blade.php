<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
	/>
	<title>LOGIN | UD SUMBER TANI</title>
</head>

<body>
	<div class="wrapper">
		{{-- <div class="authentication-header"></div> --}}
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						{{-- <div class="mb-4 text-center">
							<img src="assets/images/logo-img.png" width="180" alt="" />
						</div> --}}
						
						<div class="card border-top border-0 border-4 border-dark">
							<div class="card-body p-5">
								<div class="card-title text-center"><i class="bx bxs-user-circle text-dark font-50"></i>
									<h5 class="mb-4 mt-2 text-dark">User Login</h5>
								</div>
								<hr>
								<form class="row g-3" id="form-login" class="form-login">
									<div class="col-12">
										<label for="username" class="form-label">Enter Username</label>
										<div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
											<input type="text" class="form-control border-start-0" id="username" name="username" placeholder="Enter Username" />
										</div>
									</div>
									<div class="col-12">
										<label for="password" class="form-label">Enter Password</label>
										<div class="input-group input-group-lg" id="show_hide_password"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock-open'></i></span>
											<input
												type="password"
												class="form-control border-start-0 border-end-0" id="password" name="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="gridCheck3">
											<label class="form-check-label" for="gridCheck3">Check me out</label>
										</div>
									</div>
									<div class="col-md-6 text-end">	<a href="javascript:;">Forgot Password ?</a></div>
									<div class="col-12">
										<div class="d-grid">
											<button class="btn btn-dark btn-lg px-5 btn-login"><i class='bx bxs-lock-open'></i>Login</button>
										</div>
									</div>
								</form>
							</div>
						</div>

						{{-- <div class="card">
							<div class="card-body">
								<div class="p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign in</h3>
										<p>Don't have an account yet? <a href="authentication-signup.html">Sign up here</a>
										</p>
									</div>
									<div class="d-grid">
										<a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
											<img class="me-2" src="assets/images/icons/search.svg" width="16" alt="Image Description">
											<span>Sign in with Google</span>
										</span>
									</a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign in with Facebook</a>
								</div>
								<div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH EMAIL</span>
									<hr/>
								</div>
								<div class="form-body">
									<form class="row g-3">
										<div class="col-12">
											<label for="inputEmailAddress" class="form-label">Email Address</label>
											<input type="email" class="form-control" id="inputEmailAddress" placeholder="Email Address">
										</div>
										<div class="col-12">
											<label for="inputChoosePassword" class="form-label">Enter Password</label>
											<div class="input-group" id="show_hide_password">
												<input type="password" class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
												<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
											</div>
										</div>
										<div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
										</div>
										<div class="col-12">
											<div class="d-grid">
												<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div> --}}



					</div>
				</div>
			</div>
			<!--end row-->
		</div>
	</div>
</div>

<!--plugins-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>

<script src="{{asset('requestor/axios.min.js')}}"></script>
<script src="{{asset('requestor/axios.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--Password show & hide js -->
<script>
	$(document).ready(function () {
		$("#show_hide_password a").on('click', function (event) {
			event.preventDefault()
			if ($('#show_hide_password input').attr("type") == "text") {
				$('#show_hide_password input').attr('type', 'password')
				$('#show_hide_password i').addClass("bx-hide")
				$('#show_hide_password i').removeClass("bx-show")
			} else if ($('#show_hide_password input').attr("type") == "password") {
				$('#show_hide_password input').attr('type', 'text')
				$('#show_hide_password i').removeClass("bx-hide")
				$('#show_hide_password i').addClass("bx-show")
			}
		})
	})

	const fadeInDown = {
		popup: `
			animate__animated
			animate__fadeInDown
			animate__faster
		`,
	}
	const fadeOutUp = {
		popup: `
			animate__animated
			animate__fadeOutUp
			animate__faster
		`,
	}

	$('.btn-login').click(async(e) => {
		e.preventDefault()
		const data = new FormData($('#form-login')[0])
		let response = await postRequest("{{route('auth.generateToken')}}", data)

		if (response.status === 200) {
			await Swal.fire({
				icon: 'success',
				title: response.data.message,
				showConfirmButton: false,
				timer: 900,
				hideClass: fadeOutUp,
			})

			return window.location.href = "{{route('dashboard.main')}}"
		}

		Swal.fire({
			icon: 'warning',
			title: 'Oops..',
			text: response.data.message,
			showClass: {
				popup: `
					animate__animated
					animate__fadeInDown
					animate__faster
				`,
			},
			hideClass: fadeOutUp,
		})
	})
</script>
</body>

</html>