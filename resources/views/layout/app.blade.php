<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KLY - NewsHub</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}" />

    @yield('css')
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <script type="text/javascript">
        function timeNow() {
            // Refresh rate in milli seconds
            var refresh = 1000;
            mytime = setTimeout('displayTimeNow()', refresh)
        }

        function displayTimeNow() {
            var x = new Date()
            document.getElementById('footerTime').innerHTML = x;
            timeNow();
        }
    </script>
</head>

<body onload=displayTimeNow();>
    <div id="app">
        <x-sidebar />
        <div id="main" class='layout-navbar'>
            <x-navbar />
            <div id="main-content">
                <div class="page-heading">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <strong>{{ session('status') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible show fade">
                            <strong>
                                {{ $error }}
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endforeach
                    @yield('body')
                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <span id='footerTime'></span>
                        </div>
                        <div class="float-end">
                            <p>KapanLagi Youniverse</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    @yield('javascript')
</body>

</html>
