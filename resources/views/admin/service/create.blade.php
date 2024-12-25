@extends('admin.layouts.main')
@push('main_bread', 'Companies')
@push('main_bread_url', route('admin.service.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]))
@push('second_bread', (isset($data) ? 'Edit' : 'Create') . ' Service')
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form class="row row-cols-2" id="createForm">
                        @csrf
                        <div class="row mx-0 gy-3 mt-0 mx-auto shadow p-3 border rounded-2">
                            @can('SA')
                                <div class="mt-0">
                                    <label for="company" class="form-label">Company</label>
                                    <select name="company" id="company" class="form-select select2" data-toggle="select2">
                                        <option>Select Company</option>
                                        @foreach ($companies as $item)
                                            <option value="{{ $item->id }}"
                                                {{ isset($data) ? ($data->company == $item->id ? 'selected' : '') : ($company == $item->id ? 'selected' : '') }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            @endcan
                            <div @can('CA-ONLY') class="mt-0" @endcan>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" name="name"
                                    placeholder="Enter Name" value="{{ isset($data) ? $data->name : '' }}" />
                            </div>                            
                            <div class="col-12 px-3 mt-3 text-end input-group justify-content-between align-items-center ">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-bold">Active?</span>
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" id="switch3"
                                        {{ isset($data) ? ($data->is_active == 1 ? 'checked' : '') : 'checked' }}
                                        data-switch="success" />
                                    <label for="switch3" data-on-label="Yes" data-off-label="No"></label>
                                </div>
                                @if (isset($data))
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                @endif
                                <button type="submit" class="btn btn-dark">Save <i class="far fa-check-circle"></i></button>
                            </div>
                        </div>
                    </form>
                    <!-- end row -->

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
@endsection
@push('scripts')
    <script>
        imagePreview();
        createEdit({
            name: {
                required: true,
            },
            image: {
                required: false,
                image: true
            }
        }, {
            name: {
                required: "Please Enter Name!",
            },
            password: {
                image: "Only JPEG, PNG, or GIF files are allowed."
            }
        }, "{{ route('admin.service.store', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}", "{{ route('admin.service.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}")
    </script>
@endpush
