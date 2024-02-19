@section('header')
<!--begin::Header-->
<div class="mb-0" id="home">
	<!--begin::Wrapper-->
	<div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom">
		<!--begin::Header-->
		<div
			class="landing-header"
			data-kt-sticky="true"
			data-kt-sticky-name="landing-header"
			data-kt-sticky-offset="{default: '200px', lg: '300px'}"
			style="background:white;"
		>
			<!--begin::Container-->
			<div class="container">
				<!--begin::Wrapper-->
				<div class="d-flex align-items-center justify-content-between">
					<!--begin::Logo-->
					<div class="d-flex align-items-center flex-equal gap-3">
						<!--begin::Mobile menu toggle-->
						<button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
							<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
							<span class="svg-icon svg-icon-2hx">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="
											M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6
											21.6 7 21 7Z
										"
										fill="currentColor"
									/>
									<path
										opacity="0.3"
										d="
											M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22
											11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4
											2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z
										"
										fill="currentColor"
									/>
								</svg>
							</span>
							<!--end::Svg Icon-->
						</button>
						<!--end::Mobile menu toggle-->
						<!--begin::Logo image-->
						<a>
							<img
								alt="Logo"
								src="{{ assetUrl('assets/img/header/bumn.png') }}"
								class="logo-default"
								style="width: 120px;"
							/>
						</a>
						<a>
							<img
								alt="Logo"
								src="{{ assetUrl('assets/img/admin/header/bumn-id.png') }}"
								class="logo-default"
								style="width: 120px;"
							/>
						</a>
						<a href="/">
							<img
								alt="Logo"
								src="{{ assetUrl('assets/img/admin/header/magenta.png') }}"
								class="logo-default"
								style="width: 120px;"
							/>
						</a>
						<a>
							<img
								alt="Logo"
								src="{{ assetUrl('assets/img/header/fhci.png') }}"
								class="logo-default"
								style="width: 90px;"
							/>
						</a>
						<!--end::Logo image-->
					</div>
					<!--end::Logo-->
					<!--begin::Menu wrapper-->
					<!--end::Toolbar-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Header-->

	</div>
	</div>
@endsection
