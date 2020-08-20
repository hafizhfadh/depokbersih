<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BERNITEK">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- vendor css -->
    <link href="{{ asset('lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/select2/select2-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset('lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }} " rel="stylesheet">
    <link href="{{ asset('lib/ion-rangeslider/css/ion.rangeSlider.min.css') }}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.dashboard.css') }}">
</head>

<body>

    @include('layouts.sidebar')

    <div class="content ht-100v pd-0">
        <div class="content-header">
            <div class="content-search">
            </div>
            <nav class="nav">
                <a href="" class="nav-link"><i data-feather="help-circle"></i></a>
                <a href="" class="nav-link"><i data-feather="grid"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
            </nav>
        </div><!-- content-header -->

        <div class="content-body">
            <div class="container pd-x-0">
                @yield('content')
            </div><!-- container -->
        </div>
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form" action="{{ url('user/change-password/'.auth()->user()->id) }}">
                            <div class="form-group">
                                <label for="">Password Lama</label>
                                <input type="password" name="old_password" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <input type="password" name="new_password" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control"
                                    autocomplete="off">
                            </div>
                            <button class="btn btn-primary submit float-right" type="button">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="modal-logout"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-logout">Ready to Leave?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mg-b-0">Select "Logout" below if you are ready to end your current session.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Cancel</button>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="btn btn-primary tx-13">Logout</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('lib/jquery.flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('lib/select2/select2.min.js') }}"></script>
    <script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('lib/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{ asset('lib/jqueryui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('assets/js/dashforge.aside.js') }}"></script>

    <!-- append theme customizer -->
    <script src="{{ asset('lib/js-cookie/js.cookie.js') }}"></script>

    {{-- core js --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script>
        select2Generator('#select-province', '{{ route('provinces') }}', 'Pilih Provinsi');
        $(document).on('change', '.province-all', function () {
            let value = $(this).val(),
                regency = $(this).data('regency')
            params = function (params) {
                return {
                    q: $.trim(params.term),
                    province_id: value
                }
            };

            $(regency).val('').trigger('change');
            select2Generator(regency, '{{ route('regencies') }}', 'Pilih Kabupaten/Kota', params);
        });

        $(document).on('change', '.regency-all', function () {

            let value = $(this).val(),
                district = $(this).data('district'),
                params = function (params) {
                    return {
                        q: $.trim(params.term),
                        regency_id: value
                    }
                };

            $(district).val('').trigger('change');
            select2Generator(district, '{{ route('districts') }}', 'Pilih Kecamatan', params);
        });

        $(document).on('change', '.district-all', function () {
            let value = $(this).val(),
                village = $(this).data('village'),
                params = function (params) {
                    return {
                        q: $.trim(params.term),
                        district_id: value
                    }
                };

            $(village).val('').trigger('change');
            select2Generator(village, '{{ route('villages') }}', 'Pilih Kelurahan', params);
        });
    </script>
    @stack('js')

</body>

</html>