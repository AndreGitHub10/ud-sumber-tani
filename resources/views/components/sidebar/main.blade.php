{{-- List menu App\Http\View\Composers\MenuComposer --}}

<div class="sidebar-wrapper" data-simplebar="true">
	<div class="sidebar-header">
		<div>
			<img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
		</div>
		<div>
			<h4 class="logo-text">Sumber Tani</h4>
		</div>
		<div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
		</div>
	</div>

	<!--navigation-->
	<ul class="metismenu" id="menu">
		@if (count($menu))
		<!--menu utama-->
		@foreach ($menu as $item1)
		@php
			$subMenu1 = isset($item1['sub_menu']) ? $item1['sub_menu'] : [];
		@endphp

		<li>
			<a href="{{$item1['link']}}" {{ count($subMenu1) ? "class=has-arrow" : '' }}>
				<div class="parent-icon"><i class='{{$item1['icon']}}'></i></div>
				<div class="menu-title">{{$item1['text']}}</div>
			</a>

			<!--submenu level 1-->
			@if (count($subMenu1))
			<ul>
				@foreach ($item1['sub_menu'] as $item2)
				@php
					$subMenu2 = isset($item2['sub_menu']) ? $item2['sub_menu'] : [];
				@endphp
				<li>
					<a href="{{ $item2['link'] }}" {{ count($subMenu2) ? "class=has-arrow" : '' }}>
						<i class="{{ $item1['sub_menu_icon'] }}"></i>{{ $item2['text'] }}
					</a>

					<!--submenu level 2-->
					@if (count($subMenu2))
					<ul>
						@foreach ($item2['sub_menu'] as $item3)
						<li>
							<a href="{{ $item3['link'] }}"><i class="{{ $item1['sub_menu_icon'] }}"></i>{{ $item3['text'] }}</a>
						</li>
						@endforeach
					</ul>
					@endif
					<!--end submenu level 2-->
				</li>
				@endforeach
			</ul>
			@endif
			<!--end submenu level 1-->
		</li>
		@endforeach
		@endif
		<!--end menu utama-->
	</ul>
	<!--end navigation-->
</div>