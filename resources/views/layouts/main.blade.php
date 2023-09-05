<!DOCTYPE html>
@auth
    <html class="fixed sidebar-left-sm">
    {{--<html class="fixed">--}}
    {{-- sidebar-left-collapsed  sidebar-left-big-icons left-sidebar-panel --}}
    @endauth

    @guest
        <html class="fixed has-top-menu">
        {{--<html class="fixed">--}}
        @endguest
        <head>
            {{--<!-- Basic -->--}}
            <meta charset="UTF-8">

            <title>{{ config("app.name") . " - " . $title }}</title>
            <meta name="keywords" content="{{ config("env.app.keywords") }}" />
            <meta name="description" content="{{ config("env.app.description") }}">
            <meta name="author" content="{{ config("env.app.vendor") }}">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
            <meta name="csrf-token" content="{{ csrf_token() }}">
            {{ Html::style(url("img/np_fav.png"), ['rel' => 'stylesheet icon', 'type' => 'image/x-icon']) }}

            @stack('before-styles')

            {{ Html::style(url("/css/fonts.googleapis.css"), ['rel' => 'stylesheet', 'type' => 'text/css']) }}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
{{--            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>--}}
            {{ Html::style(url('vendor/bootstrap/css/bootstrap.min.css')) }}
            {{ Html::style(url('vendor/animate/animate.css')) }}
            {{ Html::style(url('vendor/font-awesome/css/fontawesome-all.min.css')) }}
            {{ Html::style(url('vendor/magnific-popup/magnific-popup.css')) }}
            {{ Html::style(url('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')) }}
            {{ Html::style(url("assets/nextbyte/plugins/jquery-ui/css/jquery-ui.min.css"), ['rel' => 'stylesheet']) }}
            @stack('after-styles')
            {{ Html::style(url('css/theme.css')) }}
            {{ Html::style(url('css/theme-elements.css')) }}
            {{ Html::style(url('css/skins/default.css')) }}
            {{ Html::style(url('css/custom.css')) }}
            {{ Html::style(url('vendor/select2/css/select2.min.css')) }}

            {{ Html::script(url('vendor/modernizr/modernizr.js')) }}

            {{--STart notification css--}}
            {{--{{ Html::style(asset_url() . "/nextbyte/plugins/AmaranJS/dist/css/amaran.min.css") }}--}}
            {{--{{ Html::style(asset_url() . "/nextbyte/plugins/AmaranJS/dist/css/animate.min.css") }}--}}
            {{--end notification css--}}
            @stack('custom')

            <style>
                html{
                    background-image: url("/public/HomeImages/Attractions-Of-Tanzania-241113942.jpg");
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                }

                .header{
                    background-color: rgba(255, 255, 255, 0.9);
                }

                .textWhite{
                    color:white;
                }

                .card-body{
                    background-color: rgba(255, 255, 255, 0.85);
                }

                .required_asterik:after {
                    content: '*';
                    color: red;
                    padding-left: 5px;
                }
                .hidden_fields {
                    display: none;
                }
                .switch {
                    position: relative;
                    display: inline-block;
                    width: 60px;
                    height: 34px;
                }

                .switch input {
                    opacity: 0;
                    width: 0;
                    height: 0;
                }

                .slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #ccc;
                    -webkit-transition: .4s;
                    transition: .4s;
                }

                .slider:before {
                    position: absolute;
                    content: "";
                    height: 26px;
                    width: 26px;
                    left: 4px;
                    bottom: 4px;
                    background-color: white;
                    -webkit-transition: .4s;
                    transition: .4s;
                }

                input:checked + .slider {
                    background-color: #2196F3;
                }

                input:focus + .slider {
                    box-shadow: 0 0 1px #2196F3;
                }

                input:checked + .slider:before {
                    -webkit-transform: translateX(26px);
                    -ms-transform: translateX(26px);
                    transform: translateX(26px);
                }

                /* Rounded sliders */
                .slider.round {
                    border-radius: 34px;
                }

                .slider.round:before {
                    border-radius: 50%;
                }
                .top-left {
                    position: absolute;
                    top: 8px;
                    left: 16px;
                }
                .top-right {
                    position: absolute;
                    top: 8px;
                    right: 16px;
                }
                .center-text {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 90%;
                    transform: translate(-50%, -50%);
                    background-color: rgba(30, 144, 255, 0.5);
                }
                .bottom-left {
                    position: absolute;
                    bottom: 8px;
                    left: 16px;
                    width: 92%;
                    background: linear-gradient(rgba(0, 0, 0, 0), rgba(30, 144, 255, 0.8));
                }


            </style>


        </head>
        <body style="background-color: transparent">
        <section class="body">

            @include("includes/components/header")

            <div class="inner-wrapper">

                @auth
                    @include('includes/components/left_sidebars/index')
                @endauth

                <section role="main" class="content-body">


                    {{--Hide header on home page--}}
                    @auth
                    <header  class="page-header">
                        <h2>{{ $header }}</h2>
                        <div style="margin-right: 10px"  class="right-wrapper text-right">
                            {{ Breadcrumbs::render() }}
                        </div>
                    </header>
                    @endauth

                    {{--@include("includes/ads/top_advert")--}}

                    @include("includes.partials.messages")

                    @yield('content')



                </section>


            </div>
            {{--@guest--}}
            @include("includes/components/footer")
            {{--@endguest--}}



        </section>


        <script>
            var base_url = "{{ url("/") }}";
        </script>
        {{--<!-- Scripts -->--}}
        @stack('before-scripts')
        {{ Html::script(url('vendor/jquery/jquery.js')) }}
        {{ Html::script(url('assets/nextbyte/plugins/jquery-ui/js/jquery-ui.min.js')) }}
        {{ Html::script(url('vendor/jquery-browser-mobile/jquery.browser.mobile.js')) }}
        {{ Html::script(url('vendor/popper/umd/popper.min.js')) }}
        {{ Html::script(url('vendor/bootstrap/js/bootstrap.min.js')) }}
        {{ Html::script(url('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')) }}
        {{ Html::script(url('vendor/common/common.js')) }}
        {{ Html::script(url('vendor/nanoscroller/nanoscroller.js')) }}
        {{ Html::script(url('vendor/magnific-popup/jquery.magnific-popup.min.js')) }}
        {{ Html::script(url('vendor/jquery-placeholder/jquery-placeholder.js')) }}
        <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5bdc6737afad5b00117c870d&product=inline-share-buttons' async='async'></script>
        @stack('after-scripts')
        {{ Html::script(url('js/theme.js')) }}
        {{--{{ Html::script(url('js/custom.js')) }}--}}
        {{ Html::script(url('js/theme.init.js')) }}
        {{ Html::script(url('vendor/select2/js/select2.min.js')) }}
        {{ Html::script(url('js/share.js')) }}
        {{ Html::script(url('assets/nextbyte/plugins/maskmoney/js/maskmoney.min.js')) }}
        {{ Html::script(url('vendor/jquery-maskedinput/jquery.maskedinput.js')) }}
        {{ Html::script(url('assets/nextbyte/js/custom.js')) }}
        {{--STart - Notification--}}
        {{--{{ Html::script(asset_url(). "/global/plugins/AmaranJS/dist/js/jquery.amaran.min.js") }}--}}
        {{--End notification--}}
        <script>
            $(document).ready(function () {

                $('.mobile').mask("9999999999");

            })
        </script>

        </body>
        </html>
