<style>
    .profileImage {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: #182958;
        font-size: 16px;
        color: #fff;
        text-align: center;
        line-height: 35px;
        margin-right: 10px;
    }

    .firstname,
    .lastname {
        display: none;
    }

    .topbar .topbar-item {
        display: flex;
        align-items: center;
        cursor: pointer;
    }
</style>

<!--begin::Toolbar wrapper-->
<div class="topbar d-flex align-items-stretch flex-shrink-0">
    <!--begin::Search-->
    <div class="d-flex align-items-stretch">

        <!--layout-partial:layout/search/_base.html-->

    </div>
    <!--end::Search-->
    <!--begin::Notifications-->
    <div class="d-flex align-items-center px-6">
        @include('admin.referensi.notifikasi.header')
    </div>
    <!--end::Notifications-->
    <!--begin::User-->
    <div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div
            class="topbar-item cursor-pointer symbol pe-15 pe-lg-15 me-n3 me-lg-n5 symbol-30px symbol-md-35px"
            data-kt-menu-trigger="click"
            data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end"
            data-kt-menu-flip="bottom"
        >
            @if(auth('admins')->user()->name)
                @php

                    $initialname = explode(" ",auth('admins')->user()->name);
                    $count = count($initialname);
                @endphp
                <div class="profileImage">
                    <span class="firstName">{{ strtoupper($initialname[0])}}</span>
                    @if($count > 1)
                        <span class="lastName">{{ strtoupper($initialname[1])}}</span>
                    @endif
                </div>
                <a
                    class="text-gray-900"
                    style="font-weight:500;"
                >{{ auth('admins')->user()->name? ucWords(auth('admins')->user()->name) : 'Anonymous' }}<br>
                    <small class="text-gray-600">{{ auth('admins')->user()->getRoleNames()[0] }}</small></a>
            @endif
        </div>
        @include('layouts.admin.layout.topbar.partials._user-menu')

        <!--end::Menu wrapper-->
    </div>
    <!--end::User -->
</div>
<!--end::Toolbar wrapper-->
