@extends('admin.layouts.main')
@push('main_bread', 'Companies')
@push('main_bread_url', route('admin.company_user.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]))
@push('second_bread', (isset($data) ? 'Edit' : 'Create') . ' Company User')
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form class="row row-cols-2 align-items-start" id="createForm">
                        @csrf
                        <div class="row mx-0 gy-3 mt-0 align-items-start">
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
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" name="email"
                                    placeholder="Enter Email" value="{{ isset($data) ? $data->email : '' }}" />
                            </div>
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control"
                                        placeholder="Enter your password" name="password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="">
                            <div>
                                <label for="projectImage" class="mb-0">Picture Image</label>
                                <p class="text-muted font-14">Recommended thumbnail size 400x400 (px).</p>

                                <input type="file" id="image" class="form-control image-preview" name="image"
                                    accept="image/*">
                                @if (isset($data) && $data->image_exist)
                                    <img src='{{ $data->image_url }}'
                                        class='w-100 object-fit-contain my-2 border shadow rounded-2 p-2 image-preview-show' />
                                @endif
                            </div>


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
        }, "{{ route('admin.company_user.store', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}", "{{ route('admin.company_user.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}")
    </script>
@endpush
