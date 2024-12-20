<!--favicon-->
{{-- <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" /> --}}
<!--plugins-->
<link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
<!-- Bootstrap CSS -->
<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
<!-- Theme Style CSS -->
{{-- <link rel="stylesheet" href="{{asset('assets/css/dark-theme.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/semi-dark.css')}}" /> --}}
<link rel="stylesheet" href="{{asset('assets/css/header-colors.css')}}" />


<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />

<style>
	.select2-middle{
		text-align: center;
		vertical-align: middle;
	}
	body .select2-container--bootstrap4 .select2-results__option--highlighted[aria-selected] {
		background-color: #F0F1F2;
		color: #393A3B; 
	}
</style>

@stack('styles')