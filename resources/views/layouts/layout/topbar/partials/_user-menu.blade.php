<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary
		fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
	<!--begin::Menu item-->
	<div class="menu-item px-3">
		<div class="menu-content d-flex align-items-center px-3">
			<!--begin::Avatar-->
			@if(auth('admins')->user()->name)
				@php
					$initialname = explode(" ",auth('admins')->user()->name);
					$count = count($initialname);
				@endphp
				<div class="symbol symbol-50px me-5 profileImage " >
					<span class="firstName">{{ strtoupper($initialname[0])}}</span>
					@if($count > 1)
					<span class="lastName">{{ strtoupper($initialname[1])}}</span>
					@endif
				</div>
			@endif
			<!--end::Avatar-->
			<!--begin::Username-->
			<div class="d-flex flex-column">
				<div class="fw-bolder d-flex align-items-center fs-5" style="color: #181c32">
					{{ !empty(Auth::user()->name) ? ucfirst(Auth::user()->name) : 'undefined'}}
					{{-- <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">
						{{Auth::user()->kategori_user ? Auth::user()->kategori_user : ''}}
					</span> --}}
				</div>
				<a class="fw-bold text-muted text-hover-primary fs-7">
					{{ !empty(Auth::user()->email) ? Auth::user()->email : 'undefined'}}
				</a>
				<a class="fw-bold text-muted text-hover-primary fs-7">

					{{ auth('admins')->user()->getRoleNames()? ucfirst(auth('admins')->user()->getRoleNames()[0]) : "" }}
				</a>
			</div>
			<!--end::Username-->
		</div>
	</div>
	<!--end::Menu item-->
	<!--begin::Menu separator-->
	<!--begin::Menu item-->
	<div class="menu-item px-5">
		<a href="{{route('ubahpassword')}}" class="menu-link px-5" id='ubahpass'>
			<strong>
			<i class="fas fa-circle-notch" aria-hidden="true"></i>
			&nbsp;Ubah Password
			</strong>
		</a>
	</div>
	<div class="menu-item px-5">
		<a href="{{route('admin.logout')}}" class="menu-link px-5">
			<strong>
			<i class="fas fa-sign-out-alt" aria-hidden="true"></i>
			&nbsp;Log Out
			</strong>
		</a>
	</div>
	<!--end::Menu item-->
</div>
<!--end::Menu-->
