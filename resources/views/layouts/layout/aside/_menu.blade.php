<!--begin::Aside Menu-->
<div
    class="hover-scroll-overlay-y my-2 py-5 py-lg-8" id="kt_aside_menu_wrapper" data-kt-scroll="true"
    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
    data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
    data-kt-scroll-offset="0"
>
    <!--begin::Menu-->
    <div
        class="menu menu-column" id="#kt_aside_menu" data-kt-menu="true"
    >
        <div class="menu-item">
            <div class="menu-content pb-2">
            </div>
        </div>

        @foreach ($adminMenu as $item)
            @include('layouts.admin.layout.aside._menu-item', compact('item'))
        @endforeach
    </div>
    <!--end::Menu-->
</div>
