@section('footer')
    <!--begin::Footer Section-->
    <div class="mb-0">
        <!--begin::Wrapper-->
        <div class="pt-20">
            <!--begin::Container-->
            <div class="container">

            </div>
            <!--end::Container-->
            <!--begin::Separator-->
            <div class="border"></div>
            <!--end::Separator-->
            <!--begin::Container-->
            <div class="container">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                    <!--begin::Copyright-->
                    <div class="d-flex align-items-center order-2 order-md-1 gap-2">
                        <!--begin::Logo-->
                        <a>
                            <img
                                alt="Logo"
                                src="{{ assetUrl('assets/img/admin/header/bumn-id.png') }}"
                                class="h-70px h-md-70px"
                            />
                        </a>
                        <a href="/">
                            <img
                                alt="Logo"
                                src="{{ assetUrl('assets/img/admin/header/magenta.png') }}"
                                class="h-70px h-md-70px"
                            />
                        </a>
                        <a>
                            <img
                                alt="Logo"
                                src="{{ assetUrl('assets/img/header/fhci.png') }}"
                                class="h-70px h-md-70px"
                            />
                        </a>
                        <!--end::Logo image-->
                        <!--begin::Logo image-->
                        <span
                            class="mx-5 fs-9 fw-semibold text-gray-600 pt-1"
                        >
							<strong>© 2022 by Kementerian BUMN - FHCI. All Right Reserved.</strong>
						</span>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Copyright-->
                    <!--begin::Menu-->
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">

                    </ul>
                    <!--end::Menu-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Footer Section-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect
                    opacity="0.5"
                    x="13"
                    y="6"
                    width="13"
                    height="2"
                    rx="1"
                    transform="rotate(90 13 6)"
                    fill="currentColor"
                />
				<path
                    d="
						M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642
						11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75
						11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25
						12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z
					"
                    fill="currentColor"
                />
			</svg>
		</span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->
@endsection
