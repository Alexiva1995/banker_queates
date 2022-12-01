<!DOCTYPE html>
@php $configData = Helper::applClasses(); @endphp

<html
    lang="@if (session()->has('locale')) {{ session()->get('locale') }}@else{{ $configData['defaultLanguage'] }} @endif"
    class="loading {{ $configData['theme'] === 'light' ? 'light-layout' : 'dark-layout' }}">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Take Profits</title>

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors.min.css')) }}" />
    <link rel="stylesheet" href="{{ asset('vendors/css/extensions/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-sliders.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/core/colors/palette-noui.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-wizard.css') }}">
    <link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('css/style.css')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/ico/favicon1.ico') }}">

    {{-- <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/ico/favicon-16x16.png') }}"> --}}
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

    :root {
        --bg-color: #152231;
        --bs-font-sans-serif: 'Poppins', sans-serif !important;
    }

    body {
        overflow-x: hidden;
        font-family: var(--bs-font-sans-serif);
        background-color: #fff !important;
        font-size: 16px;
        scroll-behavior: smooth;
    }

    html {
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    a,
    a:link,
    a:not([href]) {
        font-size: 16px;
    }

    /* HEADER */
    .header {
        color: #fff;
        /* height: 100vh; */
        position: relative;
    }

    nav {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
    }

    .header {
        background-image: linear-gradient(180deg, #060606 25%, rgba(6, 6, 6, 0) 100%), url('/images/welcome/bannerproject.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }

    .digitalM,
    .img-promo {
        background-color: transparent;
    }

    .nav-header {
        width: 90%;
        margin: 0 auto;
    }

    .logo-header {
        max-width: 100%;
        height: fit-content;
        width: 120px;
    }

    .slogan:link,
    .slogan:visited {
        font-size: 16px;
        font-weight: 400 !important;
        color: #808E9E;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    li {
        list-style: none;
    }

    .dropdown-language .nav-link:link,
    .dropdown-language .nav-link:visited {
        color: #fff;
        font-weight: 500;
    }

    .dropdown-item {
        color: #182738;
    }

    .cryptoBar {
        background: #fff;
        width: 100%;
    }

    #cryptoBarWrapper:hover {
        animation-play-state: paused;
    }

    @keyframes slideCryptoBar {
        0% {
            left: -250rem;
        }

        100% {
            left: 100rem;
        }
    }

    #cryptoBarWrapper {
        position: relative;
        width: 100%;
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        animation: slideCryptoBar 30s -1s ease-in-out infinite reverse none;
        animation-timing-function: linear;
    }

    .crypto:first-of-type {
        margin-left: 1.5rem !important;
    }

    .crypto:not(:last-of-type)::after {
        content: "";
        display: block;
        width: 1px;
        height: 46px;
        position: relative;
        background: #6c7a8a;
        margin-left: 10px;
    }

    .coin-stats p {
        width: max-content;
    }

    .heading-1 {
        font-size: 36px;
        color: #fff;
        font-weight: 400;
        line-height: 54px;
    }

    .heading-accent {
        font-weight: 600;
    }

    .header-text p {
        line-height: 28px;
        font-size: 16px;
    }

    .text-heading-shadow {
        color: #FFFFFF;
        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25), 0px 4px 4px rgba(0, 0, 0, 0.25), 0px 4px 4px rgba(0, 0, 0, 0.25), 0px 4px 4px rgba(0, 0, 0, 0.25), 0px 4px 4px rgba(0, 0, 0, 0.25), 0px 4px 4px rgba(0, 0, 0, 0.25), 0px 4px 4px rgba(0, 0, 0, 0.25), 0px 4px 4px rgba(0, 0, 0, 0.25);

    }

    .bg-dark {
        background: #2C2C2C !important;
    }

    .card-dark {
        background: #182738;
        box-shadow: 0px 0px 0px 1px rgb(21 34 49 / 5%);
        border-radius: 20px;
        width: 98%;
    }

    .card-dark .card-title {
        color: #D0D2D6;
        font-size: 20px;
    }

    .red-mark {
        font-weight: 700;
        color: #b62323;
    }

    .scroll-top {
        display: none;
        right: 33px;
        width: fit-content;
    }

    /* FEATURES */
    .py-9 {
        padding-top: 9rem;
        padding-bottom: 9rem;
    }

    .heading-2 {
        font-weight: 400;
        color: #0E133A;
        line-height: 54px;
        font-size: 36px;
    }

    .accent-blue {
        color: #0255B8;
    }

    .fw-700 {
        font-weight: 700 !important;
    }

    .features .card-title {
        color: #0E133A;
        font-size: 23px;
        font-weight: 600;
    }

    .bg-white {
        background-color: #fff;
    }

    /*markets*/
    .markets {
        background-color: #182738;
    }

    .markets .card {
        box-shadow: 0px 10px 57px 0px rgba(2, 85, 184, 0.051);
    }

    .markets img {
        width: 100%;
    }

    .markets .row {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        align-items: center;
    }

    .markets .row a {
        width: fit-content;
    }

    /* HOW IT WORKS*/
    .hiw {
        /* background-image: url('/images/welcome/fondopro.png'); */
        background-repeat: no-repeat;
        background-position: bottom;
    }

    /* C IRV*/
    .cirv {
        background: rgba(24, 39, 56, 0.03);
    }

    .heading-3 {
        font-weight: 600;
        color: #0E133A;
        font-size: 24px;
    }

    .noUi-tooltip {
        background: var(--bs-primary);
        color: #fff;
        font-weight: 300;
        bottom: 22px !important;
        min-width: 38.5px;
        font-size: 14px;
    }

    .noUi-horizontal .noUi-tooltip {
        bottom: 252% !important;
    }

    .noUi-tooltip::after {
        content: "";
        width: 10px;
        height: 10px;
        position: absolute;
        bottom: -4px;
        background: #0255b8;
        transform: rotate(45deg);
        left: 39%;
        z-index: -10;
    }

    .noUi-value {
        font-weight: 300;
        font-size: 16px;
        color: #808E9E;
    }

    .bs-stepper-title {
        color: #808E9E;
        font-weight: 600;
    }

    .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-box {
        background-color: rgba(2, 85, 184, 0.2);
        color: #0255b8;
        box-shadow: 0 0px 8px -1px rgb(2 85 184 / 20%);
    }

    #wz-outcome .card {
        box-shadow: 0 0px 19px 1px rgb(129 130 131 / 8%);
        border-radius: 6px;
    }

    #wz-outcome .card-title {
        color: #0E133A;
        font-size: 20px;
        font-weight: 600;
        text-align: center;
    }

    .wizard-irv {
        min-height: 379.5px;
    }

    .maxA,
    .minA,
    .inf-card h3 {
        font-size: 24px;
        font-weight: 600;
        text-align: center;
        color: #28C76F;
    }

    .maxAsub,
    .minAsub {
        font-size: 14px;
        font-weight: 400;
        line-height: 21px;
        text-align: center;
    }

    /* CALC INCOME*/
    .heading-4 {
        font-weight: 500;
        font-size: 14px;
        color: #0E133A;
    }

    .cpmi .card-title {
        color: #0E133A;
        font-size: 24px;
        font-weight: 600;
        text-align: center;
    }

    #calci {
        align-self: center;
        width: fit-content;
        z-index: 5;
    }

    #tablaIncome {
        display: none;
        transition: display .3s ease-in;
    }

    .cpmi-info {
        border-radius: 0;
        top: -6px;
        z-index: 0;
    }

    .cpmi th {
        font-weight: 600;
        font-size: 16px !important;
        color: #fff;
        text-align: center;
    }

    .cpmi .table-responsive::after {
        content: "";
        width: 48px;
        height: 48px;
        background: #fff;
        position: absolute;
        top: -32px;
        transform: rotate(45deg);
        left: 48%;
    }

    .cpmi .table-responsive tbody p {
        margin-bottom: 0;
    }

    .cpmi .table-responsive td p:first-of-type {
        font-weight: 600;
        font-size: 16px;
    }

    .cpmi .table-responsive td p:not(:first-of-type) {
        font-size: 14px;
    }

    .inf-card h3 {
        font-size: 30px;
    }

    .border-bottom-l {
        border-bottom: 1.2px solid #415163;
    }

    /* DIGITAL MARKETS*/

    .digitalM h2,
    .img-promo h2 {
        /*  color: #fff; */
    }

    .digitalM p {
        line-height: 28px;
    }

    /* FQA */
    .accordion-button:not(.collapsed) {
        color: #fff;
        background-color: #0255B8;
        transition: all .3s ease;
        /* box-shadow: inset 0 calc(var(--bs-accordion-border-width) * -1) 0 var(--bs-accordion-border-color); */
    }

    .accordion-body {
        font-size: 15px;
        line-height: 24px;
        color: #808E9E;
    }

    .accordion-button::after {
        width: 1.5rem;
        height: 1.5rem;
        background-size: 1.5rem;
        transform: rotate(180deg);
        transition: transform 0.3s ease-in-out;
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236e6b7b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-up'%3e%3cpolyline points='18 15 12 9 6 15'%3e%3c/polyline%3e%3c/svg%3e);
        transform: rotate(360deg);
        filter: brightness(100);
    }

    .accordion-header button {
        color: #808E9E;
    }

    /* PROMO */
    .nav-tabs .nav-link {
        color: #fff;
    }

    .card-body.promo-box {
        /* height: 163.9px;
        max-height: 163.9px; */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23808E9E33' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image'%3E%3Crect x='3' y='3' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Ccircle cx='8.5' cy='8.5' r='1.5'%3E%3C/circle%3E%3Cpolyline points='21 15 16 10 5 21'%3E%3C/polyline%3E%3C/svg%3E");
        background-size: 60px;
        background-repeat: no-repeat;
        background-position: center;
        padding: 0;
        overflow: hidden;
        border-radius: inherit;
        position: relative;
        transition: all .3s ease-in;
        min-height: 469px;
    }

    .card-body.promo-box-range {
        /* height: 163.9px;
        max-height: 163.9px; 
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23808E9E33' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image'%3E%3Crect x='3' y='3' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Ccircle cx='8.5' cy='8.5' r='1.5'%3E%3C/circle%3E%3Cpolyline points='21 15 16 10 5 21'%3E%3C/polyline%3E%3C/svg%3E");*/
        background-size: 60px;
        background-repeat: no-repeat;
        background-position: center;
        padding: 0;
        overflow: hidden;
        border-radius: inherit;
        position: relative;
        transition: all .3s ease-in;
    }

    .promo-down {
        cursor: pointer;
        display: block;
        position: relative;
    }

    .promo-down1 {
        cursor: pointer;
        display: block;
        position: relative;
    }

    .promo-down1::after {
        content: "";
        background-image: url("/images/welcome/Group16.png");
        backdrop-filter: blur(75px);
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 10;
        top: 0;
        background-size: auto;
        left: 0;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0;
        transition: all .4s ease-in-out;
        border-radius: 25px;
    }

    .promo-down::after {
        content: "";
        background-image: url("/images/welcome/MercadoP7K1-hover.png");
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 10;
        top: 0;
        background-size: 22.7rem;
        left: 0;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0;
        transition: all .4s ease-in-out;
    }

    .promo-down2::after {
        content: "";
        background-image: url("/images/welcome/MercadoP7K2-hover.png");
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 10;
        top: 0;
        background-size: 22.7rem;
        left: 0;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0;
        transition: all .4s ease-in-out;
    }

    .promo-down3::after {
        content: "";
        background-image: url("/images/welcome/MercadoP7K3-hover.png");
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 10;
        top: 0;
        background-size: 22.7rem;
        left: 0;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0;
        transition: all .4s ease-in-out;
    }

    .promo-down4::after {
        content: "";
        background-image: url("/images/welcome/MercadoP7K4-hover.png");
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 10;
        top: 0;
        background-size: 22.7rem;
        left: 0;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0;
        transition: all .4s ease-in-out;
    }

    .promo-down:hover::after {
        opacity: 1;
    }

    .promo-down2:hover::after {
        opacity: 1;
    }

    .promo-down3:hover::after {
        opacity: 1;
    }

    .promo-down4:hover::after {
        opacity: 1;
    }

    .promo-down1:hover::after {
        opacity: 0.3;
    }

    .promo-down1:hover::after > ~ .centrado{
        opacity: 1;
    }

    .img-encima{
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .centrado{
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
    }

    .centrado-2{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    .btn-register-custom {
        background: #9B51E0 !important;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        color: #fff;
        border-radius: 37px;
        letter-spacing: 5.2px;
    }

    .btn-register-custom:hover {
        color: #fff;
    }

    .carousel-control-prev-icon {
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAfCAYAAAD5h919AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAGLSURBVHgB3ZbBbYNAEEX/AFIUn1wC6cDpwOnAl0SWD8auAHcAqcBKBYT4YI7pIOkgJYQSco/EZHYVEIoAA7tc8g6WxS76+2f27wL8B04PvErX/Kr+e5iAZM2+R0gYWBLwbl0oWfHcmyEUgQMz5vUxa0LiYukqFwy/adxYSLlwZziCsWuZ4qsfBwakGw5F5LNDpGKUo2TDC49xlDIt+74zSEiX6RqRODgwhtFbSGWCXekFmpttLFTPBAzo3AynDUeugw9TEUWjo0uZMBaqmi3JhmUqIZUJOZdi/Dk6rAmNycRA9MIdFPgqYK8XrUL7jPLgTDdSsr3srhwTUW3vbUbPxRVupYSPmABqeqhCKiuIiRDAAtszEXVNeFnzjgkRGfbwolCJ3PuxeA/GCiqhXvdRkFFcMO6kfylG0stRHd0/wtsQd70d1Rkbh9FXuY6DKifw1Gf+4NI1ocrpyjEmy141jctN4FsRKmmLg3WhEh0HByH93gRKyOhzqw0dh0IfZ1UcJnFUJ7nnBb6R/wCE7Y+uJn+38AAAAABJRU5ErkJggg==') !important;
    }

    .carousel-control-next-icon {
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAfCAYAAAD5h919AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAF/SURBVHgBtZXBbcIwFIZ/JxzanjpCRugKbMClElChwgZlgsIE0AlCw6Hc6AZlg45ANii3cmjy+hwnCEUmJLH9HxLZsfLJ//ufDbDCHt3DsTz58O+wiPo0hkNlIJEigEAYDWgb9imAA3mlcc8X2K+H9ArL8nSTRJjx7vbrAfVgFSSgC0NAwDYaUmjDzgzEP7ycOsKY7fwyDYtXc10Rln3b3dUFnYAyLNETLZr2XlOQUooX/xbfTexsB1JSdtYMiwlISYXlau+Zgwpe3nvhIz04BeUK/A7XTmOnbZCSpveEfLwP6UcQXF0VcULoqtPbHUTuJOZX0IEjkcCBr5/paCNWcmwdJAHc0G/pL5aTT3Eo5q2C2KZdkmIy2Yi4/M0KiE//OKUMsLu0xghU2PS8EbNra9uDCCuuw/S8DlZBsg5/hHmVTUagLK4MGH2IJVqoFogPzHk5ro1BVXdJbpM2ro1Busk6cTUCnbr6aGZTNUjGVaUphgN1cINDckTXpk06/QNu5qxjORUxQQAAAABJRU5ErkJggg==') !important;
    }

    .carousel-control-next {
        right: -45px;
    }

    .carousel-control-prev {
        left: -45px;
    }

    .carousel-caption {
        background: none;
        filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
    }

    .tab-content>.active {
        display: flex !important;
    }

    /*FOOTER*/
    .warningF {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' viewBox='0 0 20 20' fill='%23415163'%3E%3Cpath fill-rule='evenodd' d='M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z' clip-rule='evenodd' /%3E%3C/svg%3E");
        background-repeat: no-repeat;
        width: 100p%;
        height: 127px;
        background-size: 157px;
        background-position: center;
        margin-bottom: 2rem;
        margin-top: 2rem;
    }

    .warningF span {
        font-Weight: 700;
        font-size: 15px;
    }

    .f-link:link,
    .f-link:visited {
        font-size: 16px;
        font-weight: 400;
        color: #fff;
        text-decoration: underline;
    }

    .text-justify {
        text-align: justify !important;
        color: #4F4F4F;
    }

    /*Media queries*/
    @media (max-width: 75em) {

        p,
        a,
        a:link,
        a:not([href])h1,
        h2,
        h3,
        h4,
        h5 {
            /*9/16*/
            font-size: 56.25%;
        }
    }

    @media (min-width: 1024px) {

        /*desktop*/
        .markets img {
            /* width: 19.3%; */
        }

        .markets .row {
            gap: 0.7rem;
        }

        @keyframes slideCryptoBar {
            0% {
                left: -250rem;
            }

            100% {
                left: 100rem;
            }
        }
    }

    @media (max-width: 992px) and (min-width:768px) {
        .bs-stepper .bs-stepper-header {
            flex-direction: row;
            gap: 1.5rem;
        }
    }

    @media (max-width: 991px) {
        .navbar-nav {
            /*9/16*/
            flex-direction: row !important;
            justify-content: flex-end;
            margin-top: 1rem;
        }

        .navbar-collapse {
            background: #152231;
        }

        .dropdown-language,
        .navbar-collapse .btn,
        .navbar-nav {
            float: right;
            width: 100%;
        }

        .dropdown-language {
            text-align: right;
            margin-bottom: 1rem;
        }

        .bs-stepper .bs-stepper-header .line {
            padding: 0 0.75rem;
        }

        select.goog-te-combo {
            width: max-content;
        }

        #\:0\.targetLanguage span {
            display: none !important;
        }

        .goog-te-gadget {
            margin-left: auto;
            width: auto !important;
        }

        .goog-logo-link {
            display: none !important;
        }
    }

    @media (max-width: 843px) {

        /*tablet md*/
        @keyframes slideCryptoBar {
            0% {
                left: -250rem;
            }

            100% {
                left: 100rem;
            }
        }

        .markets .row {
            gap: 1rem;
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
            grid-template-columns: repeat(6, 1fr);
        }

        .markets .row a {
            grid-column: span 2;
        }

        .markets .row a:nth-child(4) {
            grid-column: 2/4;
        }

        .col-md-5.header-text.mx-auto {
            width: 100% !important;
            padding: 0 6rem;
        }

        .hero {
            display: none !important;
        }

        .header-text,
        .heading-2,
        .features .card-body:first-of-type p,
        .hiw .card-body,
        .hiw .col-md-6,
        .hiw .col-md-5 {
            text-align: center;
        }

        .features .card-body p,
        .hiw .card-body p {
            line-height: 28px;
        }

        .features .card-body p {
            font-size: 18px;
        }

        .f-link:not(:first-of-type) {
            text-align: right;
        }
    }

    @media (max-width:768px) {
        .markets .row {
            gap: 1rem;
            justify-content: center !important;
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }
    }

    @media (max-width: 575px) {

        /* tablet sm*/
        .pt-xxs-3 {
            padding-top: 3rem;
        }

        .pt-xxs-4 {
            padding-top: 4rem;
        }

        .pb-xxs-0 {
            padding-bottom: 0 !important;
        }

        .pb-xxs-1 {
            padding-bottom: 1rem !important;
        }

        .py-xxs-2 {
            padding-top: 2rem !important;
            padding-bottom: 1rem !important;

        }

        .py-xxs-4 {
            padding-top: 4rem !important;
            padding-bottom: 4rem !important;
        }

        .px-xxs-1 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .px-xxs-2 {
            padding-left: 2rem !important;
            padding-right: 2rem !important;
        }

        .px-xxs-3 {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .px-xxs-4 {
            padding-left: 4rem;
            padding-right: 4rem;
        }

        .mx-xxs-1 {
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .mx-xxs-2 {
            margin-left: 2rem;
            margin-right: 2rem;
        }

        .mt-xxs-1 {
            margin-top: 1rem;
        }

        .mt-xxs-2 {
            margin-top: 2rem;
        }

        .my-xxs-3 {
            margin-bottom: 3rem;
            margin-top: 3rem;
        }

        .mb-xxs-0 {
            margin-bottom: 0 !important;
        }

        .mb-xxs-3 {
            margin-bottom: 3rem !important;
        }

        .mb-xxs-2 {
            margin-bottom: 2rem !important;
        }

        .hiw .img-fluid {
            width: 273px;
        }

        .col-md-5.header-text.mx-auto {
            padding: 0 3rem;
        }

        .slg {
            display: block;
            margin-top: 1rem;
            max-width: 84px;
        }

        .navbar-toggler {
            align-self: flex-start;
            padding-top: 0;
        }

        .heading-1,
        .heading-2 {
            font-size: 29px;
        }

        .noUi-value {
            font-size: 13px;
        }

        .cpmi th {
            font-size: 14px !important;
        }

        .ti-svg {
            margin-left: 36px;
            text-indent: -1rem;
        }

        .cpmi .table-responsive td p:first-of-type {
            font-size: 13px;
        }

        .cpmi .table-responsive td p:not(:first-of-type) {
            font-size: 13px;
        }

        .digitalM p {
            text-align: center;
        }

        .digitalM .card-dark p {
            text-align: left;
        }

        .img-promo .card-body.d-flex.align-items-center.px-0.mb-2 {
            flex-direction: column;
        }

        .card-body.d-flex.align-items-center.px-0.mb-2 p {
            text-align: center;
        }

        .warningF {
            width: 100%;
        }

        .warningF span {
            transform: translateX(74%);
        }

        .txt-warning {
            margin-bottom: 3rem;
            text-align: center;
        }

        .col-md-12.d-flex.justify-content-between.align-items-center.py-2 {
            flex-direction: column;
        }

        .f-link:link:first-of-type {
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 425px) {
        .bs-stepper-content button {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .noUi-marker-normal {
            display: none;
        }

        .px-xxxs-1 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .wz-period {
            padding-left: 0.3rem !important;
            padding-right: 0.3rem !important;
        }

        .cpmi .card {
            /* width: 70%;
            margin-left: 15%; */

            padding: 0 !important;
        }

        .cpmi .col-lg-9 {
            width: inherit;
        }

        .cpmi .card-body {
            margin: 0 !important;
        }

        .cpmi .card-title {
            padding-top: 4rem;
        }

        #calci {
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
            margin-bottom: 3rem !important;
        }

        .cpmi .table-responsive::after {
            left: 45%;
        }

        .card-body.px-3.px-xxs-1 {
            padding: 0 3rem !important;
        }

        .warningF span {
            transform: translateX(50px);
        }

        @keyframes slideCryptoBar {
            0% {
                left: -250rem;
            }

            100% {
                left: 100rem;
            }
        }
    }

    @media (max-width: 575px)and(min-width:325px) {
        .cpmi .card {
            width: 98%;
            margin-left: 1%;
            margin-bottom: 0rem !important;
        }

        #calci {
            margin-bottom: 4rem !important;
        }
    }

    @media (max-width: 375px) {
        /* Phone md */

        .hiw .card-body {
            padding: 0;
        }

        .markets img {
            /* width: 43.3%; */
        }

        .markets .row {
            gap: 1rem;
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .features .card-title {
            font-size: 22px;
        }

        .features .card-body p {
            font-size: 16px;
        }

        .py-9 {
            padding-top: 1rem !important;
            padding-bottom: 3rem !important;
        }

        .heading-1,
        .heading-2 {
            font-size: 29px;
            line-height: 1.5;
        }

        .cpmi h2 {
            padding-left: 3rem !important;
            padding-right: 3rem !important;
        }

        .cpmi .col-lg-9 {
            padding: 6rem 0;
        }

        .cpmi .card {
            margin-bottom: 0rem !important;
            padding-bottom: 1rem !important;
        }

        .warningF span {
            transform: translateX(21px);
        }

        @keyframes slideCryptoBar {
            0% {
                left: -250rem;
            }

            100% {
                left: 100rem;
            }
        }
    }

    @media (max-width: 320px) {

        /* Phone sm */
        .navbar-toggler {
            padding-top: 0rem;
            margin-left: unset;
            margin: 0 auto;
        }

        .nav-header .container-fluid {
            justify-content: center;
        }

        .slogan:link,
        .slogan:visited {
            margin: 0;
        }

        .navbar-nav {
            justify-content: center;
        }

        .dropdown-language {
            text-align: center;
        }

        .cirv .col-md-9 {
            padding: 0;
        }

        .wizard-irv {
            padding-left: 0.2rem !important;
            padding-right: 0.5rem !important;
        }

        .heading-1,
        .heading-2 {
            font-size: 25px;
        }

        .cpmi .card {
            margin-left: 1rem !important;
            margin-right: 1rem !important;
        }

        .cpmi .card-title {
            padding-top: 4rem;
            font-size: 22px;
            padding-left: 2rem !important;
            padding-right: 2rem !important;
        }

        footer .col-md-12:first-of-type {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }

        @keyframes slideCryptoBar {
            0% {
                left: -250rem;
            }

            100% {
                left: 100rem;
            }
        }
    }
</style>

<body>
    <div class="header pb-3">
        <nav class="nav-header navbar navbar-expand-lg pt-md-2 pt-sm-2  pt-xxs-3">
            <div class="container-fluid">
                <a class="navbar-brand slogan" href="{{ route('welcome') }}">
                    <img src="{{ asset('images/welcome/logo-solid-white.png') }}" alt="logo connect"
                        class="logo-header me-1">
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-menu "style="height:3rem;width: 3rem;color: #fff;">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <div class="collapse navbar-collapse gap-md-2" id="navbarTogglerDemo03">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-1">
                       {{--  <li class="nav-item">
                            <div class="form-check form-switch form-check-light">
                                <input type="checkbox" class="form-check-input nav-link-style form-check-darkM" checked id="flexSwitchCheckDefault" >
                                <label class="form-check-label" for="flexSwitchCheckDefault">
                                  <span class="switch-icon-right">
                                    <i class="ficonCustom" data-feather='moon'></i>
                                  </span>
                                  <span class="switch-icon-left">
                                    <i class="ficonCustom" data-feather='sun'></i>
                                  </span>
                                </label>
                              </div>
                        </li> --}}
                        <li class="nav-item">
                            <a class="text-white" href="#">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white" href="#home">
                                Quiénes somos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white" href="#vision">
                                Visión
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white" href="#mision">
                                Misión
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white" href="#bnb">
                                ¿Qué es BNB?
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white" href="#market">
                                Mercados P7K
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white" href="#package">
                                Paquetes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white" href="#range">
                                Rangos
                            </a>
                        </li>
                    </ul>
                    {{-- <li class="dropdown dropdown-language" id="google_translate_element">
                    </li> --}}

                    <a class="btn btn-gradient-primary round" href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </nav>
        {{-- <div class="cryptoBar px-1 mb-2 mb-sm-3 mt-md-3 mt-lg-3 mt-sm-3 mt-xxs-2 carousel slide cycle" data-bs-ride="carousel" data-bs-wrap="true">
                <div id="cryptoBarWrapper" >
                        @foreach ($cryptos as $crypto)
                            <div class="col-md-4 p-1 ps-0 d-flex crypto border-right align-items-center carousel-item">
                                <img src="https://www.cryptocompare.com{{ $crypto->CoinInfo->ImageUrl }}" alt="{{ $crypto->CoinInfo->Name }} logo" width="40" height="40">
                                <div class="coin-name mx-1 ">
                                    <p class="crypto-name my-0 fw-bold text-white">
                                       {{ $crypto->CoinInfo->FullName }}
                                    </p>
                                    <p class="crypto-code my-0">{{ $crypto->CoinInfo->Name }}</p>
                                </div>
                                <img src="https://images.cryptocompare.com/sparkchart/{{$crypto->CoinInfo->Name }}/USD/latest.png?ts={{ $crypto->RAW->USD->LASTUPDATE}}" alt="" width="80">
                                <div class="coin-stats mx-1 text-right">
                                    <p class="crypto-value my-0 fw-bold text-white">{{$crypto->DISPLAY->USD->PRICE}}</p>
                                    <p class="crypto-value my-0 ms-auto {{ $crypto->DISPLAY->USD->CHANGEPCT24HOUR>0 ? 'text-success' : 'text-danger' }}">{{ $crypto->DISPLAY->USD->CHANGEPCT24HOUR }}%</p>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div> --}}
        <div class="container-fluid mt-2 my-md-4 my-lg-4 px-0 py-1">
            <div class="d-flex justify-content-between align-items-center g-sm-1 mb-sm-4 my-xxs-3">
                <div class="col-lg-5 col-md-6 col-md-9 header-text mx-auto mx-md-5">
                    <h2 class="heading-1 mb-2 ms-2 text-uppercase">
                        <span class="heading-accent fw-500 text-heading-shadow">Tus sueños, no se hacen realidad por si
                            solos. <br>
                            En tí está el poder de<br> hacerlos Realidad. </span>
                    </h2>
                    {{-- <a href="{{ route('login') }}" class="btn btn-lg btn-gradient-primary px-4 py-1">Start Now</a> --}}
                </div>
            </div>
        </div>
        <div class="container px-xxs-3">
            <div class="d-none d-xl-block" style="height: 20rem;">
            </div>
            <div class="d-none d-md-block" style="height: 3rem;">
            </div>
        </div>
    </div>
    <section class="features py-sm-1">
        <div class="container py-5 px-xxs-3" id="home">
            <div class="col-md-12">
                <div class="row g-lg-3 match-height flex-wrap gap-sm-2 gap-lg-0 gap-md-0">
                    <div class="col-md-12 mb-xxs-2 d-flex justify-content-center">
                        <div class="card-body px-0">
                            <h2 class="heading-2 mb-sm-2 mb-xxs-2 text-center"><strong class="fw-700">Quiénes
                                    somos</strong></h2>
                            <p class="text-justify fw-400" style="font-size: 20px;">Project7k es una empresa
                                visionaria que pretende unir los negocios tradicionales
                                a la era digital, enlazar la necesidad latente que tienen muchas personas,
                                regiones y comunidades para conectarse, de manera efectiva y segura,
                                a las oportunidades de la nueva economía. Donde los capitales están en las
                                diferentes plataformas globales de comercio electrónico, como son los mercados
                                de valores en los que opera la compañía, con bases sólidas de muchos años
                                de experiencia en instrumentos como CRIPTOMONEDAS, TRAIDING, COMMODITIES,
                                FUTUROS, STAKING y NFTs, entre muchos más mercados que requieren una experiencia
                                en el área y unos elementos operativos que permitan ser rentables en estos
                                comercios de la era digital en la que vivimos. </p>
                        </div>
                    </div>
                    {{-- <div class="col-md-8">
                            <video src=""></video>
                        </div> --}}
                </div>
            </div>
        </div>
    </section>
    <section class="hiw pt-xxs-4 mb-5">
        <div class="container my-5 h-100 d-flex align-items-center px-xxs-3" id="vision">
            <div class="col-md-12">
                <div class="row gap-md-2 gap-sm-3 d-flex justify-content-center">
                    <div class="col-md-5">
                        <img class="img-fluid" src="{{ asset('images/welcome/2.png') }}" width="350"
                            alt="">
                    </div>
                    <div class="col-md-6 my-auto mb-xxs-2">
                        <div class="card-body">
                            <h2 class="heading-2 mb-2 fw-700">Visión</h2>
                            <p class="text-justify fw-400" style="font-size: 20px;">
                                Ser la compañía que lleva a los usuarios y colaboradores de nuestros servicios,
                                a que tengan un crecimiento y desarrollo personal y también a conocer las
                                FINANZAS DIGITALES, para alcanzar la libertad financiera, a través del
                                conocimiento y educación en el MUNDO DEL MERCADO CRYPTO, asegurando la
                                superioridad operacional y la transparencia en nuestras acciones,
                                Comprometiéndonos en renovar la forma en la que las personas y
                                las comunidades ven e intervienen en la sociedad y en los diferentes
                                mercados de la era digital.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="hiw pt-xxs-4 mt-5">
        <div class="container my-5 h-100 d-flex align-items-center px-xxs-3" id="mision">
            <div class="col-md-12">
                <div class="row gap-md-2 gap-sm-3 d-flex justify-content-center">
                    <div class="col-md-6 my-auto mb-xxs-2">
                        <div class="card-body">
                            <h2 class="heading-2 mb-2 fw-700">Misión</h2>
                            <p class="text-justify" style="font-size: 20px;">
                                Nuestro trabajo es caminar hacia a la excelencia para ser una organización dirigida en
                                conectar a través de continuas capacitaciones, talleres y seminarios, a las personas
                                con un Crecimiento y Desarrollo Personal que sea planeado e Intencionalmente,
                                como también en los negocios y finanzas digitales, donde se usará un sistema de
                                seguimiento para que así satisfagan las necesidades emocionales y financieras de
                                nuestros usuarios y cooperadores. Integrando de manera homogénea los sistemas económicos
                                a nivel mundial, a través de los instrumentos financieros que son tendencia en la
                                CRIPTOECONOMÍA, enfocados en una economía cooperativa responsable.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img class="img-fluid" src="{{ asset('images/welcome/1.png') }}" width="350"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="hiw pt-xxs-4 mt-5">
        <div class="container my-5 h-100 d-flex align-items-center px-xxs-3" id="bnb">
            <div class="col-md-12">
                <h2 class="heading-2 mb-sm-2 mb-xxs-2 text-center mb-2 fw-700">La Cripto moneda BNB</h2>
                <div class="row gap-md-2 gap-sm-3 d-flex justify-content-center">
                    <div class="col-md-12">
                        <img class="img-fluid" src="{{ asset('images/welcome/Default.png') }}" style="width: 100%"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="img-promo py-xxs-4">
        <div class="container py-0 px-xxs-3" id="market">
            <div class="col-md-12 my-5">
                <h2 class="heading-2 mb-sm-2 mb-xxs-2 text-center mb-2 fw-700">Mercados P7K</h2>
                <div class="row mb-3 match-height">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card bg-dark">
                            <div class="card-body promo-box">
                                <a class="promo-down">
                                    <img src="{{ asset('images/welcome/MercadoP7K1.png') }}" alt=""
                                        class="d-block" style="width: 100% !important; height: 469px;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card bg-dark">
                            <div class="card-body promo-box">
                                <a class="promo-down2">
                                    <img src="{{ asset('images/welcome/MercadoP7K2.png') }}" alt=""
                                        class="d-block" style="width: 100% !important; height: 469px;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card bg-dark">
                            <div class="card-body promo-box">
                                <a class="promo-down3">
                                    <img src="{{ asset('images/welcome/MercadoP7K3.png') }}" alt=""
                                        class="d-block" style="width: 100% !important; height: 469px;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card bg-dark">
                            <div class="card-body promo-box">
                                <a class="promo-down4">
                                    <img src="{{ asset('images/welcome/MercadoP7K4.png') }}" alt=""
                                        class="d-block" style="width: 100% !important; height: 469px;">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="img-promo py-xxs-4">
        <div class="container py-0 px-xxs-3" id="range">
            <div class="col-md-12 my-5">
                <h2 class="heading-2 mb-sm-2 mb-xxs-2 text-center mb-2 fw-700">Rangos</h2>
                <div class="row mb-3 match-height d-flex justify-content-center">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card" style="background: transparent; border: none;">
                            <div class="card-body promo-box-range">
                                <a class="promo-down1">
                                    <img src="{{ asset('images/welcome/Yes.png') }}" alt="" class="d-block"
                                        style="width: 100% !important;">
                                        <img class="img-encima" src="{{ asset('images/welcome/rango-diamante-1.png') }}">
                                        <div class="centrado">PAQUETE</div>
                                        <div class="centrado-2 text-nowrap fw-600">DIAMANTE</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card" style="background: transparent; border: none;">
                            <div class="card-body promo-box-range">
                                <a class="promo-down1">
                                    <img src="{{ asset('images/welcome/Yes.png') }}" alt="" class="d-block"
                                        style="width: 100% !important;">
                                        <img class="img-encima" src="{{ asset('images/welcome/rango-doblediamante-1.png') }}">
                                        <div class="centrado">PAQUETE</div>
                                        <div class="centrado-2 text-nowrap fw-600">DOBLE DIAMANTE</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card" style="background: transparent; border: none;">
                            <div class="card-body promo-box-range">
                                <a class="promo-down1">
                                    <img src="{{ asset('images/welcome/Yes.png') }}" alt="" class="d-block"
                                        style="width: 100% !important;">
                                        <img class="img-encima" src="{{ asset('images/welcome/rango-triplediamante-1.png') }}">
                                        <div class="centrado">PAQUETE</div>
                                        <div class="centrado-2 text-nowrap fw-600">TRIPLE DIAMANTE</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-5">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('register') }}" class="btn btn-lg btn-register-custom">Quiero Registrarme</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="img-promo py-xxs-4">
        <div class="container py-0 px-xxs-3" id="package">
            <div class="col-md-12 my-5">
                <h2 class="heading-2 mb-sm-2 mb-xxs-2 text-center mb-2 fw-700">Paquetes de gestión</h2>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <h4 class="mb-sm-2 mb-xxs-2 mb-2 fw-400 text-justify">Constantemente la compañía busca la excelencia en los procesos por eso reconocemos que lo bueno requiere esfuerzo y sacrifico, por lo cual debe ser acreditado y premiado. </h4>
                    </div>
                </div>
                <div class="row mb-3 match-height d-flex justify-content-center">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                  <div class="carousel-item active" data-bs-interval="10000">
                                    <img src="{{ asset('images/welcome/plata.png') }}" class="d-block w-100" alt="...">
                                  </div>
                                  <div class="carousel-item" data-bs-interval="2000">
                                    <img src="{{ asset('images/welcome/bronce.png') }}" class="d-block w-100" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="{{ asset('images/welcome/oro.png') }}" class="d-block w-100" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="{{ asset('images/welcome/platino.png') }}" class="d-block w-100" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="{{ asset('images/welcome/diamante.png') }}" class="d-block w-100" alt="...">
                                  </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                              </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-5">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('register') }}" class="btn btn-lg btn-register-custom">Quiero Registrarme</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-dark position-relative " >
        <button class="btn btn-primary btn-icon scroll-top waves-effect waves-float waves-light" type="button"
            style=""><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-arrow-up">
                <line x1="12" y1="19" x2="12" y2="5"></line>
                <polyline points="5 12 12 5 19 12"></polyline>
            </svg></button>
        <div class="col-md-12 px-4 py-3">
            <div class="row px-2">
                <div class="col-md-8 mx-auto d-flex justify-content-center p-0 align-items-start flex-wrap">
                    <div class=" mt-4 position-relative col-md-6 col-sm-3">
                        <span class="text-white ms-3 " style="font-size: 24px;"> Project 7K</span>
                        <p class="text-white ms-3 mt-2">the quick fox jumps over the lazy dog</p>
                        <ul class="d-flex px-0 " style="margin-top: 100px;">
                            <li>
                                <a class="me-1 ms-3" href="#">
                                    <svg width="20" height="16" viewBox="0 0 20 16" fill="#9B51E0"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.582 2.186C19.352 1.326 18.674 0.648 17.814 0.418C16.254 2.08616e-07 10 0 10 0C10 0 3.746 2.08616e-07 2.186 0.418C1.326 0.648 0.648 1.326 0.418 2.186C-2.98023e-08 3.746 0 8 0 8C0 8 -2.98023e-08 12.254 0.418 13.814C0.648 14.674 1.326 15.352 2.186 15.582C3.746 16 10 16 10 16C10 16 16.254 16 17.814 15.582C18.675 15.352 19.352 14.674 19.582 13.814C20 12.254 20 8 20 8C20 8 20 3.746 19.582 2.186ZM8 11.464V4.536L14 8L8 11.464Z"
                                            fill="#9B51E0" />
                                    </svg>
                                </a>
                            </li>
                            <li class="link-item">
                                <a class="me-1 " href="#">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 10C20 4.48 15.52 0 10 0C4.48 0 0 4.48 0 10C0 14.84 3.44 18.87 8 19.8V13H6V10H8V7.5C8 5.57 9.57 4 11.5 4H14V7H12C11.45 7 11 7.45 11 8V10H14V13H11V19.95C16.05 19.45 20 15.19 20 10Z"
                                            fill="#9B51E0" />
                                    </svg>
                                </a>
                            </li>
                            <li class="link-item">
                                <a class="" href="https://www.instagram.com/p/Cdv2qM4LnO2/?igshid=YmMyMTA2M2Y="
                                    target="_blank">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5 0C2.239 0 0 2.239 0 5V13C0 15.761 2.239 18 5 18H13C15.761 18 18 15.761 18 13V5C18 2.239 15.761 0 13 0H5ZM15 2C15.552 2 16 2.448 16 3C16 3.552 15.552 4 15 4C14.448 4 14 3.552 14 3C14 2.448 14.448 2 15 2ZM9 4C11.761 4 14 6.239 14 9C14 11.761 11.761 14 9 14C6.239 14 4 11.761 4 9C4 6.239 6.239 4 9 4ZM9 6C8.20435 6 7.44129 6.31607 6.87868 6.87868C6.31607 7.44129 6 8.20435 6 9C6 9.79565 6.31607 10.5587 6.87868 11.1213C7.44129 11.6839 8.20435 12 9 12C9.79565 12 10.5587 11.6839 11.1213 11.1213C11.6839 10.5587 12 9.79565 12 9C12 8.20435 11.6839 7.44129 11.1213 6.87868C10.5587 6.31607 9.79565 6 9 6Z"
                                            fill="#9B51E0" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        <br>
                    </div>
                    <div class="mt-4 position-relative col-md-6 col-sm-3">
                        <span class="text-white ms-3" style="font-size: 24px;"> Informacion</span>
                        <a href="#home" class="text-white ms-3 mt-2">Quienes Somos?</a>
                        <a href="#vision" class="text-white ms-3 ">Visión</a>
                        <a href="#mision" class="text-white ms-3 ">Misión</a>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-center align-items-center py-2">

                    <div class="socials-logo">
                    </div>
                    <p style="font-size: 24px; color:#9B51E0">All Right Reserve</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('vendors/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/js/vendors.min.js') }}"></script>
    {{-- <script src="{{ asset('vendors/js/bootstrap/bootstrap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/scripts/components/components-dropdowns.js') }}"></script> --}}
    <script src="{{ asset('vendors/js/extensions/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendors/js/extensions/wNumb.min.js') }}"></script>
    <script src="{{ asset('vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>


    <script>
        /* SLIDERS */
        // RTL Support
        var direction = 'ltr';
        if ($('html').data('textdirection') == 'rtl') {
            direction = 'rtl';
        }
        /* SLIDER C IRV*/
        var sliderirv = document.getElementById('default-color-slider');
        noUiSlider.create(sliderirv, {
            start: '0',
            step: 25,
            connect: 'lower',
            direction: direction, // RTL Support
            range: {
                'min': 0,
                '0%': 1,
                '25%': 10,
                '50%': 20,
                '75%': 50,
                'max': 100,
            },
            format: wNumb({
                decimals: 0,
                suffix: 'k',
                prefix: '$',
                thousand: '.',
                to: function(value) {
                    return value + ',-';
                },
                from: function(value) {
                    return Number(value.replace(',-', ''));
                }
            }),
            tooltips: true,
            pips: {
                mode: 'steps',
                density: 3,
                format: wNumb({
                    decimals: 0,
                    prefix: '$',
                    suffix: 'k',
                }),
            }
        });

        //calci
        /* SLIDER REFERIDOS 1*/
        var referidos1 = document.getElementById('referidos1');
        noUiSlider.create(referidos1, {
            start: 1,
            step: 1,
            tooltips: true,
            connect: 'lower',
            range: {
                'min': 1,
                'max': 10
            },
            format: wNumb({
                decimals: 0
            }),
            tooltips: true,
            pips: {
                mode: 'steps',
                density: 3,
            }
        });
        /* SLIDER REFERIDOS 2*/
        var referidos2 = document.getElementById('referidos2');
        noUiSlider.create(referidos2, {
            start: 1,
            step: 1,
            connect: 'lower',
            direction: direction, // RTL Support
            range: {
                'min': 1,
                'max': 10,
            },
            format: wNumb({
                decimals: 0,
            }),
            tooltips: true,
            pips: {
                mode: 'steps',
                density: 3,
            }
        });
        /* SLIDER membresia  */
        var membresia = document.getElementById('membresia');
        noUiSlider.create(membresia, {
            start: '40',
            step: 40,
            connect: 'lower',
            direction: direction, // RTL Support
            range: {
                'min': 40,
                'max': 240,
            },
            format: wNumb({
                decimals: 0,
            }),
            tooltips: true,
            pips: {
                mode: 'steps',
                density: 3,
            }
        });

        //calcular posible impuesto anual

        $(function() {
            $('#calci').click(function(e) {
                e.preventDefault();
                const niveles = [0.04, 0.04, 0.04, 0.03, 0.03, 0.03, 0.02, 0.02, 0.01, 0.01, 0.005, 0.005,
                    0.005, 0.005
                ]

                referidos1.noUiSlider.on('update', function(values, handle) {
                    ref1 = values[handle];
                    parseRef1 = parseInt(ref1);
                });
                referidos2.noUiSlider.on('update', function(values, handle) {
                    ref2 = values[handle];
                    parseRef2 = parseInt(ref2);
                });
                membresia.noUiSlider.on('update', function(values, handle) {
                    memb = values[handle];
                    parseMemb = parseInt(memb);
                });
                //calc 1
                calRef = parseRef1;
                let total = 0;
                var nf = new Intl.NumberFormat('de-DE', {
                    currency: 'USD',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                });
                $('#incomesNiveles > tr').remove();

                $('#incomesNiveles').append(
                    `<tr class='border-bottom-l'>
                            <td>
                                <p class='text-white'>Nivel de Referido 1</p>
                                <p>Commission: <span class='accent-blue'>15%</span></p>
                            </td>
                            <td>
                                <p class='my-2 text-white'>${nf.format(calRef)}</p> 
                            </td>
                            <td class="inc">
                                <p class='text-white'>${nf.format(calRef*parseMemb*0.15)}</p>
                            </td>
                        </tr>`);
                $.each(niveles, function(index, val) {
                    calRef = calRef * parseRef2;
                    var cal = calRef * val * parseMemb;
                    let curLevel = 1;
                    total += cal;
                    $('#incomesNiveles:last-child').append(
                        `<tr class='border-bottom-l'>
                                <td>
                                    <p class='text-white'>Nivel de Referidos ${curLevel+index+1}</p>
                                    <p>Commission: <span class='accent-blue'>${val*100}%</span></p>
                                </td>
                                <td>
                                    <p class='my-2 text-white'>${nf.format(calRef)}</p> 
                                </td>
                                <td class="inc">
                                    <p class='text-white'>$${nf.format(cal)}</p>
                                </td>
                        </tr>`);
                });
                $('#posIncome').text(`$${nf.format(total)}`);
                $('#tablaIncome').fadeIn('slow');
            });
        });
        /* IRV wizard*/
        var wizardIRV = document.querySelector('.wizard-irv');
        var amountValue = document.querySelector('#amountValue');
        var parseAmount = 1000;
        let amount, period, calcForexMax, calcForexMin, calcSynMin, calcSynMax, calcCryptoAPY;
        amountValue.addEventListener('change', function() {
            sliderirv.noUiSlider.set(this.value);
        });
        if (typeof wizardIRV !== undefined && wizardIRV !== null) {
            var wizardStepper = new Stepper(wizardIRV, {
                linear: false,
            });
            $(wizardIRV)
                .find('#amountNext')
                .on('click', function() {
                    sliderirv.noUiSlider.on('update', function(values, handle) {
                        amountValue = values[handle];
                        amount = values[handle];
                        parseAmount = amount.toString().slice(1, -1) * 1000;
                    });
                    wizardStepper.next()
                })
            $(wizardIRV)
                .find('#periodNext')
                .on('click', function() {
                    period = $('#selectPeriod').val();
                    if (period === '1m') {
                        period = 1;
                    } else if (period === '3m') {
                        period = 3;
                    } else if (period === '6m') {
                        period = 6;
                    } else {
                        period = 12;
                    }
                    calcForexMin = (parseAmount * 0.08) * period;
                    calcForexMax = (parseAmount * 0.15) * period;

                    $('#forexMin').text('$' + calcForexMin);
                    $('#forexMax').text('$' + calcForexMax);

                    calcSynMin = (parseAmount * 0.15) * period;
                    calcSynMax = (parseAmount * 0.3) * period;

                    $('#SynMin').text('$' + calcSynMin);
                    $('#SynMax').text('$' + calcSynMax);

                    calcCryptoAPY = (parseAmount * 4.5);

                    $('#cryptoAPY').text('$' + calcCryptoAPY);

                    wizardStepper.next();
                })
            $(wizardIRV)
                .find('.btn-prev')
                .on('click', function() {
                    wizardStepper.previous()
                })
            $(wizardIRV)
                .find('.btn-reset')
                .on('click', function(e) {
                    e.preventDefault();
                    $('#selectPeriod').prop('selectedIndex', 0);
                    $('#amountValue').val('');
                    calcForexMin = calcForexMax = calcSynMin = calcSynMax = calcCryptoMin = calcCryptoMax =
                        amountValue = 0;
                    sliderirv.noUiSlider.reset();
                    wizardStepper.reset();
                });
        }

        //cargar mas imagenes cuadradas
        $(function() {
            $("#square-align-end div").slice(0, 12).show();
            $("#loadMoreSq").click(function(e) {
                e.preventDefault();
                $("#square-align-end div:hidden").slice(0, 12).fadeIn('slow');
                if ($("#square-align-end div:hidden").length == 0) {
                    $("#loadMoreSq").prop('disabled', true);
                }
            });
        });

        //scroll to top
        $(function() {
            var featPos = $('.features').position().top + 100;
            $('body').scroll(function() {
                if ($(this).scrollTop() > featPos) {
                    $(".scroll-top").fadeIn('slow');
                } else {
                    $(".scroll-top").fadeOut('slow');
                }
            });

            $(".scroll-top").click(function(e) {
                e.preventDefault();
                var position = $('.header').position().top;
                $('body').scrollTop(position);
            });
        });
    </script>
</body>

</html>
