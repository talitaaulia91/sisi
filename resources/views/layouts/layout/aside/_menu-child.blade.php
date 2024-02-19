@can($item['code'].':view')
    @isset($item['children'])
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $item['is_active'] ? 'show' : '' }}">
            <span class="child menu-link {{ $item['is_active'] ? 'active' : '' }}">
                <span class="menu-title-magenta ms-6">{{ $item['label'] }}</span>
                <x-svg.chevron-down class="child-arrow ms-auto"/>
            </span>
            <div class="menu-sub menu-sub-accordion">
                @foreach ($item['children'] as $item)
                    @include('layouts.admin.layout.aside._menu-child', compact('item'))
                @endforeach
            </div>
        </div>
    @else
        <div class="menu-item">
            <a class="child menu-link {{ $item['is_active'] ? 'active' : '' }}"
                href="{{ Route::has($item['route_name']) ? route($item['route_name'], $item['route_params'] ?? []) : '#' }}">
                <span class="menu-title-magenta ms-6">{{ $item['label'] }}</span>
            </a>
        </div>
    @endisset
@endcan
