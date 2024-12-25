@extends('admin.layouts.main')
@push('main_bread', 'Companies')
@push('main_bread_url', route('admin.company.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]))
@push('second_bread', (isset($data) ? 'Edit' : 'Create') . ' Company')
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form class="row" id="createForm">
                        <div class="col-xl-7 mx-auto row row-cols-1 gy-3 shadow p-3 rounded-3">
                            @csrf
                            <div class="mt-0">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" name="name"
                                    placeholder="Enter name" value="{{ isset($data) ? $data->name : '' }}" />
                            </div>

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
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold">Active?</span>
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" id="switch3"
                                    {{ isset($data) ? ($data->is_active == 1 ? 'checked' : '') : 'checked' }}
                                    data-switch="success" />
                                <label for="switch3" data-on-label="Yes" data-off-label="No"></label>
                            </div>
                            <div class="col text-center">
                                @if (isset($data))
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                @endif
                                <button type="submit" class="btn btn-dark w-100">Save <i
                                        class="far fa-check-circle"></i></button>
                            </div>
                        </div> <!-- end col-->
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
        }, "{{ route('admin.company.store', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}", "{{ route('admin.company.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}")
    </script>
@endpush
