@can($item['code'].':view')
    @isset($item['children'])
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $item['is_active'] ? 'show' : '' }}">
            <span class="menu-link {{ $item['is_active'] ? 'active' : '' }}">
                @if (Str::startsWith($item['icon'], 'x-'))
                    {!! Blade::render('<'.$item['icon'].' class="fill-icon me-2" />') !!}
                @else
                    <span class="menu-icon">
                        <i class="{{ $item['icon'] }} fs-3"></i>
                    </span>
                @endif
                <span class="menu-title-magenta">{{ $item['label'] }}</span>
                <x-svg.chevron-down class="fill-arrow ms-auto"/>
            </span>
            <div class="menu-sub menu-sub-accordion">
                @foreach ($item['children'] as $item)
                    @include('layouts.admin.layout.aside._menu-child', compact('item'))
                @endforeach
            </div>
        </div>
    @else
        <div class="menu-item">
            <a class="menu-link {{ $item['is_active'] ? 'active' : '' }}"
                href="{{ Route::has($item['route_name']) ? route($item['route_name'], $item['route_params'] ?? []) : '#' }}">
                    @if (Str::startsWith($item['icon'], 'x-'))
                        {!! Blade::render('<'.$item['icon'].' class="fill-icon me-2" />') !!}
                    @else
                        <span class="menu-icon justify-content-center" style="width: 24px">
                            <i class="{{ $item['icon'] }} fs-3"></i>
                        </span>
                    @endif

                <span class="menu-title-magenta">{{ $item['label'] }}</span>
            </a>
        </div>
    @endisset
@endcan
