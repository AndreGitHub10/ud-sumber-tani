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
	// Declar module variable
	let module
	async function initModul(){
		const master = await import("{{url('/components/master.js')}}")
		return master
	}

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.fn.setRules = function(rules='a-zA-Z0-9'){
		this.on('keypress',(e)=>{
			let regex = new RegExp(`^[${rules}\b]+$`) // Rules only [ numeric ]
			let key = String.fromCharCode(!e.charCode ? e.which : e.charCode) // Get character on keypress
			if(!regex.test(key)){ // Bool, cek "key", rules regex terpenuhi(value===true)
				e.preventDefault()
				return false
			}
		})
		this.on('paste', function(){
			let el = this
			setTimeout(function(){
				const re = new RegExp(`[^${rules}]`,'g')
				let convert = $(el).val().replace(re, '')
				$(el).val(convert)
			}, 20)
		})
		return this
	}

	// $.fn.formatRupiah = function(angka, prefix){
	// $.fn.formatRupiah = function(prefix){
	// 	// var number_string = angka.toString().replace(/[^,\d]/g, "");
	// 	let angka = $(this).val()
	// 	var number_string = angka.toString().replace(/[^,\d]/g, "");
	// 	split = number_string.split(",");
	// 	sisa = split[0].length % 3;
	// 	rupiah = split[0].substr(0, sisa);
	// 	ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// 	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	// 	if (ribuan) {
	// 		separator = sisa ? "." : "";
	// 		rupiah += separator + ribuan.join(".");
	// 	}
	// 	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	// 	// return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
	// 	prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
	// 	$(this).val(prefix)
	// 	// this.value = prefix
	// }
</script>

@stack('scripts')