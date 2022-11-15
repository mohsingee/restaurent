<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="Ground Control 2">
    <title>@yield('page_title')</title>

    <link rel="canonical" href="https://appstack.bootlab.io/dashboard-default.html" />
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- ************************************************************************ !-->
    <!-- ****                                                              **** !-->
    <!-- ****       ¤ Designed and Developed by  LEADconcept               **** !-->
    <!-- ****               http://www.leadconcept.com                     **** !-->
    <!-- ****                                                              **** !-->
    <!-- ************************************************************************ !-->

    <!-- Choose your prefered color scheme -->
    <!-- <link href="css/light.css" rel="stylesheet"> -->
    <!-- <link href="css/dark.css" rel="stylesheet"> -->
    @include('admin.layouts.base.css-links')
    <!-- Page Css -->
    @yield('css')
    <style>
        /* Loader  */
        .loader-wrapper {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #39444e57;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999999;
        }

        .message {
            align-items: center !important;
            justify-content: center !important;
            position: absolute;
            width: 100%;
            z-index: 99;
            display: flex;
            top: 50px;
        }

    </style>

</head>
<!--
  HOW TO USE:
  data-theme: default (default), dark, light
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-behavior: sticky (default), fixed, compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="message">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible redirect_back" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-message" style="margin-right: 40px">
                    {{ session()->get('success') }}
                </div>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible redirect_back" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-message" style="margin-right: 40px">
                    {{ session()->get('error') }}
                </div>
            </div>
        @endif
    </div>
    <div class="wrapper">
        <div class="loader-wrapper">
            <img src="{{ asset('img/loader.svg') }}" alt="">
        </div>
        <!---- Sidebar ---->
        @include('admin.layouts.base.sidebar')

        <div class="main">
            <!---- header ---->
            @include('admin.layouts.base.header')

            <!---- Main Content ---->
            <main class="content">
                @yield('content')
            </main>
            <!---- Footer ---->
            @include('admin.layouts.base.footer')
        </div>
    </div>

    <!---- Script links ---->
    @include('admin.layouts.base.js-links')

    <!---- Page Script link ---->
    @yield('scripts')

</body>

</html>
