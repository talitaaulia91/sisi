<!--begin::Aside-->
<div
    id="kt_aside" class="aside aside-light" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle"
>
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto mt-6 mx-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="/backendadm">
            <!-- Default Logo -->
            <img
                alt="Logo"
                src="{{ assetUrl('/assets/img/footer/magenta_new.png') }}"
                class="logo"
                width="150px"
            />
            <!-- Minimized Logo -->
            <img
                alt="Minimized Logo"
                src="{{ assetUrl('/assets/img/header/magenta-min.png') }}"
                class="logo-minimize"
                width="24px"
            />
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div
            id="kt_aside_toggle" class="d-none d-lg-flex align-items-center w-auto position-absolute start-100 px-6 aside-toggle"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize"
        >
            <div class="btn btn-icon btn-active-color-primary fs1 position-fixed top-0 mt-4">
                <i class="bi bi-list fs-1" aria-hidden="true"></i>
            </div>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        @include('layouts.admin.layout.aside._menu')

    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->
