@extends('admin.layouts.main')

@push('second_bread', 'Company Users Lists')
@section('main')

    <div class="table-responsive">
        <div class="input-group gap-1 mx-0 my-2">
            <div class="p-0" id="show-delete-btn">
                <button class="btn btn-sm btn-danger" data-bs-custom-class="danger-tooltip"
                    title="Delete Selection (0 selected)" id="deleteAll">
                    <span id="counter">0</span>
                    <i class="far fa-trash-can-list"></i></button>
            </div>
            <div class="ms-auto search-cont col-md-8 col-11">
                <form
                    action="{{ route('admin.service.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}"
                    class="input-group">
                    <input type="hidden" name="orderBy" value="{{ $orderBy }}">
                    <input type="hidden" name="orderType" value="{{ $orderType }}">
                    <select name="key" class="form-select select2" data-toggle="select2">
                        @foreach (['name'] as $item)
                            <option class="text-capitalize" {{ $key === $item ? 'selected' : '' }}>{{ $item }}
                            </option>
                        @endforeach
                    </select>
                    <input type="search" class="form-control" value="{{ $value }}" placeholder="Search Here..."
                        name="value" />
                    <button class="btn btn-dark"><i class="far fa-search"></i></button>
                </form>
            </div>
            <a href="{{ route('admin.service.create', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}" class="btn btn-dark"><i class="far fa-plus"></i>
                Create Another</a>
        </div>

        <table class="table table-hover table-striped table-bordered table-sm align-middle text-center">
            <thead>
                <tr class="table-dark">
                    <th width="1%">
                        <input type="checkbox" id="selectAll" class="form-check-input">
                    </th>
                    <th width="6%">
                        @include('admin.components.th', [
                            'url' => route('admin.service.index', [
                                'company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA'),
                            ]),
                            'keyName' => 'id',
                            'name' => 'ID',
                        ])
                    </th>
                    @can('SA')
                        <th class="text-start">
                            Company
                        </th>
                    @endcan
                    <th class="text-start">
                        @include('admin.components.th', [
                            'url' => route('admin.service.index', [
                                'company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA'),
                            ]),
                            'orderBy' => $orderBy,
                            'orderType' => $orderType,
                            'keyName' => 'name',
                            'name' => 'Name',
                        ])
                    </th>
                    <th width="7%">
                        @include('admin.components.th', [
                            'url' => route('admin.service.index', [
                                'company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA'),
                            ]),
                            'orderBy' => $orderBy,
                            'orderType' => $orderType,
                            'keyName' => 'is_active',
                            'name' => 'Active',
                        ])
                    </th>

                    <th width="5%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $item)
                    <tr>
                        <td>
                            <input type="checkbox" value="{{ $item->id }}" name="selection[]" class="form-check-input">
                        </td>
                        <td>
                            <a title="Edit" class="text-decoration-underline text-dark fw-bold"
                                href="{{ route('admin.service.edit', ['id' => $item->id, 'company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">
                                {{ $item->id }}
                            </a>
                        </td>
                        @can('SA')
                            <td class="text-start">
                                @if ($item->getCompany->image_exist)
                                    <img src="{{ $item->getCompany->image_url }}" class="avatar-sm rounded-circle"
                                        alt="">
                                @endif
                                {{ $item->getCompany->name }}
                            </td>
                        @endcan
                        <td>
                            <div class="input-group gap-1 gy-2 align-items-center">
                                {{ $item->name }}
                            </div>
                        </td>
                        <td class="text-center">
                            {!! $item->is_active_name_badge !!}
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu overflow-auto">
                                    <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                                            href="{{ route('admin.service.edit', ['id' => $item->id, 'company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">Edit
                                            <i class="fa-light fa-edit text-success"></i></a></li>
                                    <li>
                                        <a type="button"
                                            class="delete dropdown-item d-flex justify-content-between align-items-center"
                                            data-id='{{ $item->id }}'>Delete <i
                                                class="fa-light fa-trash text-danger ms-1"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="20">No Records Found!</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @include('admin.components.pagination')
    </div>
    @push('scripts')
        <script>
            updates(
                "{{ route('admin.service.updates', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}");
            deletes(
                "{{ route('admin.service.delete', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}");
            selectAll(
                "{{ route('admin.service.deleteAll', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}"
                );
        </script>
    @endpush
@endsection
