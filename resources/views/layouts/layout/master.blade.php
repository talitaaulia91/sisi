<!--begin::Main-->
<!--begin::Root-->

<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        @include('layouts.admin.layout.aside._base')

        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

            <!--layout-partial:layout/header/_base.html-->
            @include('layouts.admin.layout.header._base')

            <!--begin::Content-->
            <div class="d-flex flex-column flex-column-fluid" id="kt_content">

                <!--begin::Post-->

                <!--layout-partial:layout/_content.html-->
                @include('layouts.admin.layout._content')
                <!--end::Post-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
<!--begin::Drawers-->

<!--layout-partial:layout/topbar/partials/_activity-drawer.html-->

<!--layout-partial:layout/explore/_main.html-->

<!--end::Drawers-->
<!--begin::Modals-->

<!--layout-partial:partials/modals/_invite-friends.html-->


<!--layout-partial:partials/modals/create-app/_main.html-->


<!--layout-partial:partials/modals/_upgrade-plan.html-->

<!--end::Modals-->

<!--layout-partial:layout/_scrolltop.html-->
@include('layouts.admin.layout._scrolltop')

<!--end::Main-->
