@php
    $orderTypes = ['asc' => 'desc', 'desc' => 'asc'];
    $arrows = ['asc' => 'up', 'desc' => 'down'];
@endphp

<a class="text-decoration-none text-light"
    href="{{ $url }}?orderBy={{ $keyName }}&orderType={{ $orderBy === $keyName ? $orderTypes[$orderType] ?? 'desc' : 'desc' }}&key={{ $key }}&value={{ $value }}">{{ $name }}
    <i class="far fa-sm ms-1 fa-arrow-{{ $orderBy === $keyName ? $arrows[$orderType] ?? '' : '' }}"></i>
</a>
