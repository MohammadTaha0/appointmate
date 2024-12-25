@extends('appointment.layouts.main')
@section('main')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
        <svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' viewBox='0 0 800 800'>
            <g fill-opacity='0.22'>
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.1);" cx='400' cy='400' r='600' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.2);" cx='400' cy='400' r='500' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.3);" cx='400' cy='400' r='300' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.4);" cx='400' cy='400' r='200' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.5);" cx='400' cy='400' r='100' />
            </g>
        </svg>
    </div>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <!-- Logo -->
                        <div class="card-header py-1 text-center bg-dark">
                            <a href="{{ route('company.page', ['id' => $data->id, 'slug' => Str::slug($data->name)]) }}"
                                class="w-100 d-block">
                                <span class="w-100 d-block">
                                    @if ($data->image_exist)
                                        <img src="{{ $data->image_url }}" alt="logo" class="avatar-md rounded-circle">
                                    @endif
                                    <h3 class="text-light">
                                        {{ $data->name }}
                                    </h3>
                                    <h5 class="text-light">
                                        AppointMate
                                    </h5>
                                </span>
                            </a>
                        </div>

                        <div class="card-body p-4 pt-1">
                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">{{ $data->name }}</h4>
                                <p class="text-muted mb-4">Please kindly book an appointment at your earliest convenience.
                                </p>
                            </div>

                            <form id="login-form" class="row row-cols-2">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                        placeholder="Enter your Name">
                                </div>
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" name="email" id="emailaddress"
                                        placeholder="Enter your Email">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input class="form-control" type="tel" name="phone" id="phone"
                                        placeholder="Enter your Phone">
                                </div>
                                <div class="mb-3">
                                    <label for="whatsapp" class="form-label">Whatsapp</label>
                                    <input class="form-control" type="tel" name="whatsapp" id="whatsapp"
                                        placeholder="Enter your Whatsapp">
                                </div>
                                <div class="mb-3">
                                    <label for="service" class="form-label">Services</label>
                                    <select name="service" id="service" class="form-select select2" data-toggle="select2">
                                        <option>Select Service</option>
                                        @foreach ($services as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="doctor" class="form-label">Doctor</label>
                                    <select name="doctor" id="doctor" class="form-select select2" data-toggle="select2">
                                        <option>Select Doctor</option>
                                        @foreach ($doctors as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date & Time</label>
                                    <input type="text" id="datetime-datepicker" class="form-control flatpickr"
                                        placeholder="Date and Time">
                                </div>
                                <div class="mb-3">
                                    <label for="payment_mode" class="form-label">Payment Mode</label>
                                    <select name="payment_mode" id="payment_mode" class="form-select select2"
                                        data-toggle="select2">
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                @csrf

                                <div class="mb-3 mb-0 text-center w-100 text-center">
                                    <button class="btn btn-dark btn-lg" type="submit"> Book <i
                                            class="far fa-arrow-circle-right"></i> </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    @push('scripts')
        <script>
            $(".flatpickr").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        </script>
    @endpush
@endsection
