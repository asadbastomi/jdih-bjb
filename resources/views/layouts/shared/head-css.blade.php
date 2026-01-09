@yield('css')
<!-- Plugins css -->
<link href="{{ asset('assets/libs/ladda/ladda.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

<!-- icons -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />


@if (isset($mode) && $mode == 'rtl')

    <!-- App css -->
    @if (isset($demo) && $demo == 'creative')
        <link href="{{ asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css"
            id="bs-default-stylesheet" />
        <link href="{{ asset('assets/css/app-creative-rtl.min.css') }} " rel="stylesheet" type="text/css"
            id="app-default-stylesheet" />
        <link href="{{ asset('assets/css/bootstrap-creative-dark.min.css') }} " rel="stylesheet" type="text/css"
            id="bs-dark-stylesheet" disabled />
        <link href="{{ asset('assets/css/app-creative-dark-rtl.min.css') }} " rel="stylesheet" type="text/css"
            id="app-dark-stylesheet" disabled />
    @else
        @if (isset($demo) && $demo == 'modern')
            <link href="{{ asset('assets/css/bootstrap-modern.min.css') }}" rel="stylesheet" type="text/css"
                id="bs-default-stylesheet" />
            <link href="{{ asset('assets/css/app-modern-rtl.min.css') }} " rel="stylesheet" type="text/css"
                id="app-default-stylesheet" />
            <link href="{{ asset('assets/css/bootstrap-modern-dark.min.css') }} " rel="stylesheet" type="text/css"
                id="bs-dark-stylesheet" disabled />
            <link href="{{ asset('assets/css/app-modern-dark-rtl.min.css') }} " rel="stylesheet" type="text/css"
                id="app-dark-stylesheet" disabled />
        @else
            @if (isset($demo) && $demo == 'material')
                <link href="{{ asset('assets/css/bootstrap-material.min.css') }}" rel="stylesheet" type="text/css"
                    id="bs-default-stylesheet" />
                <link href="{{ asset('assets/css/app-material-rtl.min.css') }} " rel="stylesheet" type="text/css"
                    id="app-default-stylesheet" />
                <link href="{{ asset('assets/css/bootstrap-material-dark.min.css') }} " rel="stylesheet"
                    type="text/css" id="bs-dark-stylesheet" disabled />
                <link href="{{ asset('assets/css/app-material-dark-rtl.min.css') }} " rel="stylesheet" type="text/css"
                    id="app-dark-stylesheet" disabled />
            @else
                @if (isset($demo) && $demo == 'purple')
                    <link href="{{ asset('assets/css/bootstrap-purple.min.css') }}" rel="stylesheet" type="text/css"
                        id="bs-default-stylesheet" />
                    <link href="{{ asset('assets/css/app-purple-rtl.min.css') }} " rel="stylesheet" type="text/css"
                        id="app-default-stylesheet" />
                    <link href="{{ asset('assets/css/bootstrap-purple-dark.min.css') }} " rel="stylesheet"
                        type="text/css" id="bs-dark-stylesheet" disabled />
                    <link href="{{ asset('assets/css/app-purple-dark-rtl.min.css') }} " rel="stylesheet"
                        type="text/css" id="app-dark-stylesheet" disabled />
                @else
                    @if (isset($demo) && $demo == 'saas')
                        <link href="{{ asset('assets/css/bootstrap-saas.min.css') }}" rel="stylesheet" type="text/css"
                            id="bs-default-stylesheet" />
                        <link href="{{ asset('assets/css/app-saas-rtl.min.css') }} " rel="stylesheet" type="text/css"
                            id="app-default-stylesheet" />
                        <link href="{{ asset('assets/css/bootstrap-saas-dark.min.css') }} " rel="stylesheet"
                            type="text/css" id="bs-dark-stylesheet" disabled />
                        <link href="{{ asset('assets/css/app-saas-dark-rtl.min.css') }} " rel="stylesheet"
                            type="text/css" id="app-dark-stylesheet" disabled />
                    @else
                        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
                            id="bs-default-stylesheet" />
                        <link href="{{ asset('assets/css/app-rtl.min.css') }} " rel="stylesheet" type="text/css"
                            id="app-default-stylesheet" />
                        <link href="{{ asset('assets/css/bootstrap-dark.min.css') }} " rel="stylesheet"
                            type="text/css" id="bs-dark-stylesheet" disabled />
                        <link href="{{ asset('assets/css/app-dark-rtl.min.css') }} " rel="stylesheet"
                            type="text/css" id="app-dark-stylesheet" disabled />
                    @endif
                @endif
            @endif
        @endif
    @endif
@else
    <!-- App css -->
    @if (isset($demo) && $demo == 'creative')
        <link href="{{ asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css"
            id="bs-default-stylesheet" />
        <link href="{{ asset('assets/css/app-creative.min.css') }} " rel="stylesheet" type="text/css"
            id="app-default-stylesheet" />
        <link href="{{ asset('assets/css/bootstrap-creative-dark.min.css') }} " rel="stylesheet" type="text/css"
            id="bs-dark-stylesheet" disabled />
        <link href="{{ asset('assets/css/app-creative-dark.min.css') }} " rel="stylesheet" type="text/css"
            id="app-dark-stylesheet" disabled />
    @else
        @if (isset($demo) && $demo == 'modern')
            <link href="{{ asset('assets/css/bootstrap-modern.min.css') }}" rel="stylesheet" type="text/css"
                id="bs-default-stylesheet" />
            <link href="{{ asset('assets/css/app-modern.min.css') }} " rel="stylesheet" type="text/css"
                id="app-default-stylesheet" />
            <link href="{{ asset('assets/css/bootstrap-modern-dark.min.css') }} " rel="stylesheet" type="text/css"
                id="bs-dark-stylesheet" disabled />
            <link href="{{ asset('assets/css/app-modern-dark.min.css') }} " rel="stylesheet" type="text/css"
                id="app-dark-stylesheet" disabled />
        @else
            @if (isset($demo) && $demo == 'material')
                <link href="{{ asset('assets/css/bootstrap-material.min.css') }}" rel="stylesheet" type="text/css"
                    id="bs-default-stylesheet" />
                <link href="{{ asset('assets/css/app-material.min.css') }} " rel="stylesheet" type="text/css"
                    id="app-default-stylesheet" />
                <link href="{{ asset('assets/css/bootstrap-material-dark.min.css') }} " rel="stylesheet"
                    type="text/css" id="bs-dark-stylesheet" disabled />
                <link href="{{ asset('assets/css/app-material-dark.min.css') }} " rel="stylesheet" type="text/css"
                    id="app-dark-stylesheet" disabled />
            @else
                @if (isset($demo) && $demo == 'purple')
                    <link href="{{ asset('assets/css/bootstrap-purple.min.css') }}" rel="stylesheet" type="text/css"
                        id="bs-default-stylesheet" />
                    <link href="{{ asset('assets/css/app-purple.min.css') }} " rel="stylesheet" type="text/css"
                        id="app-default-stylesheet" />
                    <link href="{{ asset('assets/css/bootstrap-purple-dark.min.css') }} " rel="stylesheet"
                        type="text/css" id="bs-dark-stylesheet" disabled />
                    <link href="{{ asset('assets/css/app-purple-dark.min.css') }} " rel="stylesheet" type="text/css"
                        id="app-dark-stylesheet" disabled />
                @else
                    @if (isset($demo) && $demo == 'saas')
                        <link href="{{ asset('assets/css/bootstrap-saas.min.css') }}" rel="stylesheet"
                            type="text/css" id="bs-default-stylesheet" />
                        <link href="{{ asset('assets/css/app-saas.min.css') }} " rel="stylesheet" type="text/css"
                            id="app-default-stylesheet" />
                        <link href="{{ asset('assets/css/bootstrap-saas-dark.min.css') }} " rel="stylesheet"
                            type="text/css" id="bs-dark-stylesheet" disabled />
                        <link href="{{ asset('assets/css/app-saas-dark.min.css') }} " rel="stylesheet"
                            type="text/css" id="app-dark-stylesheet" disabled />
                    @else
                        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
                            id="bs-default-stylesheet" />
                        <link href="{{ asset('assets/css/app.min.css') }} " rel="stylesheet" type="text/css"
                            id="app-default-stylesheet" />
                        <link href="{{ asset('assets/css/bootstrap-dark.min.css') }} " rel="stylesheet"
                            type="text/css" id="bs-dark-stylesheet" disabled />
                        <link href="{{ asset('assets/css/app-dark.min.css') }} " rel="stylesheet" type="text/css"
                            id="app-dark-stylesheet" disabled />
                    @endif
                @endif
            @endif
        @endif
    @endif
@endif
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.16/dist/css/tempus-dominus.css" />
<!-- custome -->
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
