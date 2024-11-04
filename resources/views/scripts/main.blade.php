<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<!--app JS-->
<script src="{{asset('assets/js/app.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('requestor/axios.min.js')}}"></script>
<script src="{{asset('requestor/axios.js')}}"></script>
<script>
	const fadeOutUp = {
		popup: `
			animate__animated
			animate__fadeOutUp
			animate__faster
		`,
	}
</script>

@stack('scripts')