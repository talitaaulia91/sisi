<!--begin::Header-->
<div id="kt_header" class="header align-items-stretch bg-white">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Aside mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-white" id="kt_aside_mobile_toggle">
                <i class="bi bi-list fs-1" aria-hidden="true"></i>
            </div>
        </div>
        <!--end::Aside mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="?page=index" class="d-lg-none">
                <img alt="Logo" src="{{ assetUrl('/assets/img/header/bumn.png') }}" class="h-50px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">

                <!--layout-partial:layout/header/_menu.html-->

            </div>
            <!--end::Navbar-->
            <!--begin::Topbar-->
            <div class="d-flex align-items-stretch flex-shrink-0">

                <!--layout-partial:layout/topbar/_base.html-->
                @include('layouts.admin.layout.topbar._base')

            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
