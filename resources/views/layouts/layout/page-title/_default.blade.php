<!--begin::Page title-->
<div
    data-kt-swapper="true"
    data-kt-swapper-mode="prepend"
    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0"
>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <strong>
                <i class="fas fa-home fa-2x text-muted" aria-hidden="true"></i>
            </strong>
        </li>
        <li class="breadcrumb-item text-muted">
            <strong>
                <a href="{{route('admin')}}" class="text-muted text-hover-primary">HOME</a>&nbsp;
            </strong>
        </li>

        @for($i = 3; $i <= count(Request::segments()); $i++)
            <li>
                @if($i == 2)
                    <a href="#" class="text-muted">
                        <strong>
                            <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                            {{strlen(strtoupper(Request::segment($i))) > 20 ? '' : strtoupper(Request::segment($i))}}
                        </strong>
                    </a>
                    &nbsp;
                @else
                    <a
                        href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}"
                        class="text-muted text-hover-primary"
                    >
                        <strong>
                            <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                            {{isset($breadcrumb) ? strtoupper($breadcrumb) : strtoupper(Request::segment($i-1))}}
                        </strong>
                    </a>
                    &nbsp;
                @endif
            </li>
        @endfor
    </ul>
</div>
<!--end::Page title-->
