import var_animasi from "./animasi.js"

const var_swal = {
	confirm: {
		title: 'Apa anda yakin?',
		text: 'Data yang sudah dihapus tidak dapat dikembalikan!',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#F64E60',
		confirmButtonText: 'Ya, hapus',
		cancelButtonText: 'Batal',
		allowOutsideClick: false,
		allowEscapeKey: false,
		// hideClass: var_animasi.fadeOutUp,
		// showClass: var_animasi.fadeInDown,
	},
	success: {
		icon: 'success',
		title: 'Berhasil!',
		text: 'Record berhasil disimpan.',
		allowOutsideClick: false,
		allowEscapeKey: false,
		showConfirmButton: false,
        timer: 1000,
		// hideClass: var_animasi.fadeOutUp,
		// showClass: var_animasi.fadeInDown,
	},
	warning:  {
		icon: 'warning',
		title: 'Whoops...',
		// text: '',
		allowOutsideClick: false,
		allowEscapeKey: false,
		// hideClass: var_animasi.fadeOutUp,
		// showClass: var_animasi.fadeInDown,
	},
	error: {
		icon: 'error',
		title: 'Oops...',
		text: 'Ada yang salah!',
		allowOutsideClick: false,
		allowEscapeKey: false,
		// hideClass: var_animasi.fadeOutUp,
		// showClass: var_animasi.fadeInDown,
	}
}

export default var_swal