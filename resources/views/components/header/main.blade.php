<header>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="mobile-toggle-menu">
				<i class='bx bx-menu'></i>
			</div>
			<div class="top-menu ms-auto">
				<ul class="navbar-nav align-items-center">
					<li class="nav-item dropdown dropdown-large">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">{{$notif}}</span>
							<i class='bx bx-package'></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="javascript:;">
								<div class="msg-header">
									<p class="msg-header-title">Barang Habis</p>
									{{-- <p class="msg-header-clear ms-auto">Marks all as read</p> --}}
								</div>
							</a>
							<div class="header-notifications-list">
								@foreach ($barang_habis as $item)
								<a class="dropdown-item" href="javascript:;">
									<div class="d-flex align-items-center">
										<div class="notify bg-light-primary text-primary"><i class="bx bx-package"></i>
										</div>
										<div class="flex-grow-1">
											<h6 class="msg-name">
												{{$item->data_produk->nama_produk}}<span class="msg-time float-end">{{$item->satuan_produk?$item->satuan_produk->nama:''}}</span>
											</h6>
											<p class="msg-info">{{$item->data_produk->kode_produk}}</p>
										</div>
									</div>
								</a>
								@endforeach
							</div>
							<a href="javascript:;">
								{{-- <div class="text-center msg-footer">View All Notifications</div> --}}
							</a>
						</div>
					</li>
					{{-- <li class="nav-item dropdown dropdown-large">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">2</span>
							<i class='bx bx-comment'></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="javascript:;">
								<div class="msg-header">
									<p class="msg-header-title">Messages</p>
									<p class="msg-header-clear ms-auto">Marks all as read</p>
								</div>
							</a>
							<div class="header-message-list">
								<a class="dropdown-item" href="javascript:;">
									<div class="d-flex align-items-center">
										<div class="user-online">
											<img src="{{asset('assets/images/avatars/avatar-1.png')}}" class="msg-avatar" alt="user avatar">
										</div>
										<div class="flex-grow-1">
											<h6 class="msg-name">
												Daisy Anderson <span class="msg-time float-end">5 sec ago</span>
											</h6>
											<p class="msg-info">The standard chunk of lorem</p>
										</div>
									</div>
								</a>
								<a class="dropdown-item" href="javascript:;">
									<div class="d-flex align-items-center">
										<div class="user-online">
											<img src="{{asset('assets/images/avatars/avatar-2.png')}}" class="msg-avatar" alt="user avatar">
										</div>
										<div class="flex-grow-1">
											<h6 class="msg-name">
												Althea Cabardo <span class="msg-time float-end">14 sec ago</span>
											</h6>
											<p class="msg-info">Many desktop publishing packages</p>
										</div>
									</div>
								</a>
							</div>
							<a href="javascript:;">
								<div class="text-center msg-footer">View All Messages</div>
							</a>
						</div>
					</li> --}}
				</ul>
			</div>
			<div class="user-box dropdown">
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<img src="{{asset('assets/images/avatars/avatar-2.png')}}" class="user-img" alt="user avatar">
					<div class="user-info ps-3">
						<p class="user-name mb-0">{{Auth::user()->name}}</p>
						<p class="designattion mb-0">{{Auth::user()->level}}</p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					{{-- <li>
						<a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
					</li>
					<li>
						<a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
					</li>
					<li>
						<a class="dropdown-item" href="javascript:;"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
					</li>
					<li>
						<a class="dropdown-item" href="javascript:;"><i class='bx bx-dollar-circle'></i><span>Earnings</span></a>
					</li>
					<li>
						<a class="dropdown-item" href="javascript:;"><i class='bx bx-download'></i><span>Downloads</span></a>
					</li>
					<li>
						<div class="dropdown-divider mb-0"></div>
					</li> --}}
					<li>
						<a class="dropdown-item" href="{{route('auth.removeToken')}}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</header>