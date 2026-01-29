<?php
setlocale(LC_TIME, 'id_ID');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        content="Dalam pelaksanaan Jaringan Dokumentasi dan Informasi Hukum (JDIH) Kota Banjarbaru yang dikelola oleh Bagian Hukum dan Perundang-undangan."
        name="description" />
    <meta content="Kota Banjarbaru" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />

    <!--Material Icon -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom  Css -->
    <link href="{{ asset('assets/css/landing_copy.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/headline.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/chartist/chartist.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/ladda/ladda.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Rajdhani&display=swap" rel="stylesheet">

    <!-- Elfsight Instagram Feed | JDIH Banjarbaru Instagram Feed -->
    <script src="https://static.elfsight.com/platform/platform.js" async></script>

    <style>
        /* Animation Keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-60px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(60px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes bounceIn {
            0%, 20%, 40%, 60%, 80%, 100% {
                transition-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
            }
            0% {
                opacity: 0;
                transform: scale3d(.3, .3, .3);
            }
            20% {
                transform: scale3d(1.1, 1.1, 1.1);
            }
            40% {
                transform: scale3d(.9, .9, .9);
            }
            60% {
                opacity: 1;
                transform: scale3d(1.03, 1.03, 1.03);
            }
            80% {
                transform: scale3d(.97, .97, .97);
            }
            100% {
                opacity: 1;
                transform: scale3d(1, 1, 1);
            }
        }

        @keyframes rotateIn {
            from {
                opacity: 0;
                transform: rotate(-180deg);
            }
            to {
                opacity: 1;
                transform: rotate(0);
            }
        }

        @keyframes flipInX {
            from {
                transform: perspective(400px) rotate3d(1, 0, 0, 90deg);
                animation-timing-function: ease-in;
                opacity: 0;
            }
            40% {
                transform: perspective(400px) rotate3d(1, 0, 0, -20deg);
                animation-timing-function: ease-in;
            }
            60% {
                transform: perspective(400px) rotate3d(1, 0, 0, 10deg);
                opacity: 1;
            }
            80% {
                transform: perspective(400px) rotate3d(1, 0, 0, -5deg);
            }
            to {
                transform: perspective(400px) rotate3d(1, 0, 0, 0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        /* Animation Classes - Initial State (hidden) */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(60px);
            /* No transition initially to prevent page load animation */
            transition: none;
        }

        /* Animation Direction Variants - Initial States */
        .animate-on-scroll.fade-in-up,
        .animate-on-scroll[data-animate="fade-in-up"] {
            transform: translateY(60px);
        }

        .animate-on-scroll.fade-in-down,
        .animate-on-scroll[data-animate="fade-in-down"] {
            transform: translateY(-60px);
        }

        .animate-on-scroll.fade-in-left,
        .animate-on-scroll[data-animate="fade-in-left"] {
            transform: translateX(-60px);
        }

        .animate-on-scroll.fade-in-right,
        .animate-on-scroll[data-animate="fade-in-right"] {
            transform: translateX(60px);
        }

        .animate-on-scroll.scale-in,
        .animate-on-scroll[data-animate="scale-in"] {
            transform: scale(0.8);
        }

        .animate-on-scroll.bounce-in,
        .animate-on-scroll[data-animate="bounce-in"] {
            transform: scale(0.8);
        }

        /* Active State - When element enters viewport */
        .animate-on-scroll.is-visible {
            opacity: 1 !important;
            transform: translateY(0) translateX(0) scale(1) !important;
            /* Enable transition when becoming visible */
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Staggered Delays */
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }
        .delay-700 { animation-delay: 0.7s; }
        .delay-800 { animation-delay: 0.8s; }

        /* Page Load Animations */
        body.loading .hero-slider {
            animation: fadeIn 1.5s ease-out;
        }

        body.loading .search-section {
            animation: fadeInUp 1s ease-out 0.3s backwards;
        }

        body.loading .theme-section {
            animation: fadeInUp 1s ease-out 0.5s backwards;
        }

        body.loading .modern-card {
            animation: fadeInUp 1s ease-out 0.7s backwards;
        }

        body.loading .stat-card {
            animation: scaleIn 0.8s ease-out 0.9s backwards;
        }

        body.loading .content-card {
            animation: fadeInLeft 0.8s ease-out 1s backwards;
        }

        body.loading .news-card {
            animation: fadeInUp 0.8s ease-out 1.2s backwards;
        }

        body.loading .penghargaan-item {
            animation: scaleIn 0.8s ease-out 1.4s backwards;
        }

        body.loading .link-item {
            animation: fadeInUp 0.8s ease-out 1.6s backwards;
        }

        /* Hover Effects for elements WITH scroll animations */
        .animate-on-scroll.is-visible:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-2xl);
        }

        /* Smooth Scroll Behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Loading Animation */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-spinner {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Scroll Progress Indicator */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            z-index: 9998;
            transition: width 0.1s ease-out;
        }

        /* Parallax Effect */
        .parallax-element {
            transform: translateY(var(--parallax-offset, 0));
            transition: transform 0.1s ease-out;
        }

        /* Counter Animation */
        .counter-value {
            display: inline-block;
        }

        /* Image Reveal Animation */
        .img-reveal {
            position: relative;
            overflow: hidden;
        }

        .img-reveal::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
            transition: left 0.6s ease-out;
        }

        .img-reveal:hover::before {
            left: 100%;
        }

        /* Modern SaaS Design System */
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary-color: #8b5cf6;
            --accent-color: #ec4899;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --info-color: #06b6d4;
            --danger-color: #ef4444;
            --light-color: #f8fafc;
            --dark-color: #1e293b;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --gradient-secondary: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --gradient-dark: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --border-radius: 12px;
            --border-radius-lg: 16px;
            --border-radius-xl: 24px;
        }

        body {
            {{-- font-family: 'Rajdhani', sans-serif; --}} color: #333;
        }

        /* Hero Section Styles */
        .hero-slider {
            position: relative;
            height: 70vh;
            min-height: 600px;
            overflow: hidden;
        }

        .swiper-slide {
            height: 100vh;
        }

        .slide-inner {
            height: 100%;
            width: 100%;
            background-size: contain;
            background-position: center;
            display: flex;
            align-items: center;
            position: relative;
        }

        .slide-inner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0);
            z-index: 1;
        }

        .containerme {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .slide-title h2 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 1rem;
        }

        .slide-text p {
            font-size: 1.5rem;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        /* Search Section Styles */
        .search-section {
            background: var(--gradient-primary);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .search-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,106.7C1248,96,1344,96,1392,96L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
        }

        .search-section::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .search-container {
            position: relative;
            z-index: 2;
        }

        .search-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 2rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-input {
            font-size: 1.2rem;
            padding: 18px 24px;
            border: 2px solid transparent;
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-lg);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--primary-light);
            box-shadow: var(--shadow-xl);
            outline: none;
        }

        .search-select {
            font-size: 1rem;
            padding: 18px 24px;
            border: 2px solid transparent;
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-lg);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .search-select:focus {
            border-color: var(--primary-light);
            box-shadow: var(--shadow-xl);
            outline: none;
        }

        .search-btn {
            padding: 18px 32px;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            border-radius: var(--border-radius-xl);
            background: var(--gradient-secondary);
            color: #fff;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        /* Advanced Search Container */
        .advanced-search-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius-xl);
            padding: 32px;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 24px;
        }

        .search-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-label {
            display: block;
            color: #fff;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-select {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid transparent;
            border-radius: var(--border-radius);
            padding: 16px 20px;
            font-size: 1rem;
            font-weight: 500;
            color: var(--dark-color);
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            width: 100%;
            height: auto;
            min-height: 52px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 20px;
            padding-right: 40px;
        }

        .filter-select:focus {
            background: #fff;
            border-color: var(--primary-light);
            box-shadow: var(--shadow-lg);
            outline: none;
        }

        .filter-select option {
            background: #fff;
            color: var(--dark-color);
            padding: 12px;
        }

        .search-button-group {
            display: flex;
            align-items: flex-end;
        }

        .btn-search-advanced {
            background: var(--gradient-secondary);
            color: #fff;
            border: none;
            border-radius: var(--border-radius);
            padding: 14px 28px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-search-advanced:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        .search-quick-tags {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }

        .quick-tag-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .quick-tag {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .quick-tag:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .quick-tag.active {
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary-color);
            border-color: var(--primary-light);
        }

        /* Theme Section Styles */
        .theme-section {
            padding: 60px 0;
        }

        .theme-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 2rem;
        }

        .theme-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            overflow-x: auto;
            padding: 20px 0;
        }

        .theme-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-width: 120px;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .theme-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .theme-item img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .theme-item span {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .theme-item small {
            color: #6c757d;
        }

        /* Card Styles */
        .modern-card {
            border: none;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transition: all 0.3s ease;
            background: #fff;
        }

        .modern-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-2xl);
        }

        .card-header-custom {
            background: var(--gradient-primary);
            color: #fff;
            padding: 24px;
            font-size: 1.3rem;
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .card-header-custom::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .product-list {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 400px;
            overflow-y: auto;
        }

        .product-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
        }

        .product-item:hover {
            background: #f8f9fa;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-badge {
            display: inline-block;
            padding: 6px 12px;
            background: var(--gradient-primary);
            color: #fff;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 8px;
            box-shadow: var(--shadow-sm);
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 5px 0;
        }

        .product-meta {
            font-size: 0.9rem;
            color: #6c757d;
        }

        /* Statistics Section */
        .stats-section {
            padding: 80px 0;
            background: var(--gray-50);
            position: relative;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--gradient-primary);
        }

        .stats-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
        }

        .stats-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .stat-card {
            background: #fff;
            border-radius: var(--border-radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-lg);
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-2xl);
        }

        .stat-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
        }

        .stat-icon::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: inherit;
            opacity: 0.2;
            z-index: -1;
        }

        .stat-icon i {
            font-size: 2.2rem;
            color: #fff;
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 8px;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 1rem;
            color: var(--gray-600);
            font-weight: 500;
        }

        /* Chart Section */
        .chart-container {
            background: #fff;
            border-radius: var(--border-radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-lg);
            margin-bottom: 32px;
            transition: all 0.3s ease;
        }

        .chart-container:hover {
            box-shadow: var(--shadow-xl);
        }

        .chart-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 24px;
            text-align: center;
            position: relative;
        }

        .chart-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        /* Content Section */
        .content-section {
            padding: 80px 0;
        }

        .content-card {
            background: #fff;
            border-radius: var(--border-radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-lg);
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
        }

        .content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient-primary);
            border-radius: var(--border-radius-lg) 0 0 var(--border-radius-lg);
        }

        .content-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .content-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 24px;
            position: relative;
        }

        /* Schedule Table */
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .schedule-table th {
            background: var(--primary-color);
            color: #fff;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }

        .schedule-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        .schedule-table tr:last-child td {
            border-bottom: none;
        }

        .schedule-table tr:hover {
            background: #f8f9fa;
        }

        /* News Section */
        .news-section {
            padding: 60px 0;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .news-title {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 2rem;
            text-align: center;
        }

        .news-card {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .news-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .news-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .news-date {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .news-headline {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Awards Section */
        .awards-section {
            padding: 60px 0;
            background: url('assets/images/bg/bg-15.png') center center/cover;
            position: relative;
        }

        .awards-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 1;
        }

        .awards-container {
            position: relative;
            z-index: 2;
        }

        .awards-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 2rem;
            text-align: center;
        }

        .penghargaan-item {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            margin: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            max-width: 200px;
        }

        .penghargaan-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .penghargaan-img-wrapper {
            width: 100%;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .penghargaan-img-wrapper img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .penghargaan-text {
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Social Media Section */
        .social-section {
            padding: 60px 0;
        }

        .social-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 2rem;
            text-align: center;
        }

        /* App Banner Section */
        .app-banner {
            padding: 60px 0;
            background: var(--primary-color);
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .app-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }

        .app-description {
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            line-height: 1.5;
        }

        .app-badge {
            max-width: 200px;
            height: auto;
            transition: all 0.3s ease;
        }

        .app-badge:hover {
            transform: scale(1.05);
        }

        .app-screenshots {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .app-screenshot {
            max-width: 200px;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Contact Section */
        .contact-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .contact-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 2rem;
            text-align: center;
        }

        .contact-info {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .contact-info h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
        }

        .contact-info ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-info li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 1.1rem;
            color: #333;
        }

        .contact-info i {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-right: 15px;
        }

        .contact-form {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .contact-form h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
        }

        .form-control-custom {
            width: 100%;
            padding: 15px 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 137, 221, 0.25);
            outline: none;
        }

        .btn-submit {
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #0077b3;
            transform: translateY(-2px);
        }

        /* Survey Section */
        .survey-section {
            padding: 60px 0;
            background: url('assets/images/bg/bg-15.png') center center/cover;
            position: relative;
        }

        .survey-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 1;
        }

        .survey-container {
            position: relative;
            z-index: 2;
        }

        .survey-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 2rem;
            text-align: center;
        }

        /* Links Section */
        .links-section {
            padding: 60px 0;
            background: url('assets/images/bg/bg-15.png') center center/cover;
            position: relative;
        }

        .links-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 1;
        }

        .links-container {
            position: relative;
            z-index: 2;
        }

        .links-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 2rem;
            text-align: center;
        }

        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .link-item {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            width: 100%;
            max-width: 200px;
            height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 10px;
        }

        .link-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .link-item img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .link-item span {
            font-weight: 600;
            color: var(--dark-color);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.4;
            max-height: 2.8em;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: #fff;
            border-radius: 15px 15px 0 0;
            border: none;
        }

        .modal-title {
            font-weight: 600;
        }

        .close {
            color: #fff;
            opacity: 0.8;
        }

        .close:hover {
            opacity: 1;
        }

        /* Custom Hero Slider Styles */
        .hero-slider {
            position: relative;
            height: 70vh;
            min-height: 600px;
            overflow: hidden;
            background: #000;
        }

        .hero-container {
            position: relative;
            height: 100%;
            width: 100%;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            visibility: hidden;
            transition: all 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hero-slide.active {
            opacity: 1;
            visibility: visible;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transform: scale(1.1);
            transition: transform 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hero-slide.active .hero-background {
            transform: scale(1);
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .hero-heading {
            font-size: 3.5rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 1rem;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;
        }

        .hero-slide.active .hero-heading,
        .hero-slide.active .hero-subtitle {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hero Navigation */
        .hero-navigation {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            z-index: 10;
            pointer-events: none;
        }

        .hero-nav-btn {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: all;
            backdrop-filter: blur(10px);
        }

        .hero-prev {
            left: 30px;
        }

        .hero-next {
            right: 30px;
        }

        .hero-nav-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .hero-nav-btn i {
            font-size: 28px;
            color: #fff;
            transition: all 0.3s ease;
        }

        .hero-nav-btn:hover i {
            transform: scale(1.2);
        }

        /* Hero Progress Bar */
        .hero-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            z-index: 10;
        }

        .hero-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            width: 0%;
            transition: width 0.1s linear;
        }

        /* Hero Indicators */
        .hero-indicators {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .hero-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .hero-indicator.active {
            background: #fff;
            border-color: #fff;
            transform: scale(1.2);
        }

        .hero-indicator:hover {
            background: rgba(255, 255, 255, 0.7);
            border-color: rgba(255, 255, 255, 0.9);
            transform: scale(1.1);
        }

        /* Slick Dots Styling */
        .hero-carousel .slick-dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }

        .hero-carousel .slick-dots li {
            margin: 0 5px;
        }

        .hero-carousel .slick-dots li button:before {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .hero-carousel .slick-dots li.slick-active button:before {
            color: #fff;
            opacity: 1;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .slide-title h2 {
                font-size: 2rem;
            }

            .slide-text p {
                font-size: 1.2rem;
            }

            .search-title {
                font-size: 2rem;
            }

            .search-input {
                font-size: 1rem;
                margin-bottom: 15px;
            }

            .search-select {
                margin-bottom: 15px;
            }

            .stat-number {
                font-size: 2rem;
            }

            .app-title {
                font-size: 2rem;
            }

            .app-screenshots {
                flex-direction: column;
                align-items: center;
            }

            /* Advanced Search Responsive */
            .advanced-search-container {
                padding: 20px;
            }

            .search-filters {
                flex-direction: column;
                gap: 15px;
            }

            .filter-group {
                min-width: 100%;
            }

            .search-quick-tags {
                justify-content: center;
            }

            .quick-tag {
                font-size: 0.8rem;
                padding: 5px 12px;
            }
        }
    </style>
</head>

<body class="loading">
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Scroll Progress Indicator -->
    <div class="scroll-progress" id="scrollProgress"></div>

    @include('public.header')

    <!-- Hero Section -->
    <section class="hero-slider hero-style translate parallax-element" id="heroSlider" data-parallax-speed="0.3">
        <div class="hero-container">
            @foreach ($slide as $item)
                <div class="hero-slide" data-background="{{ url($item->foto) }}">
                    <div class="hero-background parallax-element" data-parallax-speed="0.5" style="background-image: url('{{ url($item->foto) }}')"></div>
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <div class="containerme">
                            <div class="slide-title">
                                <h2 class="hero-heading">{{ translateIt($item->judul) }}</h2>
                            </div>
                            @if ($item->subjudul)
                                <div class="slide-text">
                                    <p class="hero-subtitle">{{ translateIt($item->subjudul) }}</p>
                                </div>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Custom Slider Controls -->
        <div class="hero-navigation">
            <button type="button" class="hero-nav-btn hero-prev" id="heroPrev">
                <i class="mdi mdi-chevron-left"></i>
            </button>
            <button type="button" class="hero-nav-btn hero-next" id="heroNext">
                <i class="mdi mdi-chevron-right"></i>
            </button>
        </div>
        
        <!-- Slider Progress Bar -->
        <div class="hero-progress">
            <div class="hero-progress-bar" id="heroProgress"></div>
        </div>
        
        <!-- Slider Indicators -->
        <div class="hero-indicators" id="heroIndicators"></div>
    </section>

    <!-- Search Section -->
    <section class="search-section animate-on-scroll fade-in-up">
        <div class="container search-container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <h1 class="search-title animate-on-scroll fade-in-down">{{ translateIt('Cari Produk Hukum') }}</h1>
                        <div class="form-group">
                            <input type="text" class="form-control search-input"
                                placeholder="{{ translateIt('Ketikkan Sesuatu') }}" id="textsearch">
                        </div>
                        <div class="advanced-search-container">
                            <div class="search-filters">
                                <div class="filter-group">
                                    <label for="tipe" class="filter-label">
                                        <i class="fas fa-file-alt mr-2"></i>{{ translateIt('Jenis Dokumen') }}
                                    </label>
                                    <select id="tipe" class="form-control filter-select">
                                        <option value="">{{ translateIt('Semua Jenis') }}</option>
                                        <option value="perda">PERDA</option>
                                        <option value="perwal">PERWAL</option>
                                        <option value="keputusan-wali-kota">KEPUTUSAN WALI KOTA</option>
                                        <option value="propemperda">PROPEMPERDA</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label for="status" class="filter-label">
                                        <i class="fas fa-check-circle mr-2"></i>{{ translateIt('Status') }}
                                    </label>
                                    <select id="status" class="form-control filter-select">
                                        <option value="">{{ translateIt('Semua Status') }}</option>
                                        <option value="berlaku">Berlaku</option>
                                        <option value="tidak-berlaku">Tidak Berlaku</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label for="tahun" class="filter-label">
                                        <i class="fas fa-calendar-alt mr-2"></i>{{ translateIt('Tahun') }}
                                    </label>
                                    <select id="tahun" class="form-control filter-select">
                                        <option value="ALL">{{ translateIt('Semua Tahun') }}</option>
                                        @for ($i = $mintahun; $i <= $maxtahun; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="filter-group search-button-group">
                                    <button class="btn btn-search-advanced" type="button" id="btnsearch">
                                        <i class="fas fa-search mr-2"></i> {{ translateIt('Cari Dokumen') }}
                                    </button>
                                </div>
                            </div>
                            <div class="search-quick-tags">
                                <span class="quick-tag-label">{{ translateIt('Pencarian Cepat') }}:</span>
                                <button class="quick-tag" data-type="perda">PERDA</button>
                                <button class="quick-tag" data-type="perwal">PERWAL</button>
                                <button class="quick-tag" data-status="berlaku">{{ translateIt('Berlaku') }}</button>
                                <button class="quick-tag"
                                    data-year="{{ date('Y') }}">{{ date('Y') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Theme Section -->
    <section class="theme-section">
        <div class="container">
            <h3 class="theme-title animate-on-scroll fade-in-up">{{ translateIt('Telusur Tema Peraturan') }}</h3>
            <div class="theme-container" id="tema-dokumen-container">
                <!-- Tema dokumen akan dimuat melalui AJAX -->
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="content-section animate-on-scroll fade-in-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="modern-card animate-on-scroll fade-in-left delay-100">
                        <div class="card-header-custom">
                            Produk Hukum Terbaru
                        </div>
                        <div class="card-body p-0">
                            <div class="splide slider-terbaru" role="group" aria-label="Produk Hukum Terbaru">
                                <div class="splide__track">
                                    <ul class="splide__list product-list">
                                        @foreach ($regulasi as $r)
                                            <li class="splide__slide product-item">
                                                <a href="/produk-hukum/{{ $r->nama_singkat }}/{{ $r->id }}/{{ Str::slug($r->judul) }}"
                                                    class="text-decoration-none">
                                                    <span class="product-badge">{{ $r->nama_singkat }}</span>
                                                    <div class="product-meta">
                                                        {{ $r->tanggal_diundangkan ? strftime('%d %B %Y', strtotime($r->tanggal_diundangkan)) : '' }}
                                                    </div>
                                                    <div class="product-title">Nomor {{ $r->nomor_peraturan }} Tahun
                                                        {{ $r->tahun }}</div>
                                                    <div class="product-meta">{{ $r->judul }}</div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="modern-card">
                        <div class="card-header-custom">
                            Produk Hukum yang sering dicari
                        </div>
                        <div class="card-body p-0">
                            <div class="splide slider-sering" role="group" aria-label="Produk Hukum Sering Dicari">
                                <div class="splide__track">
                                    <ul class="splide__list product-list">
                                        @foreach ($popular_item as $p)
                                            <li class="splide__slide product-item">
                                                <a href="/produk-hukum/{{ $p->kategori->nama_singkat }}/{{ $p->regulasi->id }}/{{ Str::slug($p->regulasi->judul) }}"
                                                    class="text-decoration-none">
                                                    <span class="product-badge">{{ $p->kategori->nama_singkat }}</span>
                                                    <div class="product-meta">
                                                        {{ $p->regulasi->tanggal_diundangkan ? strftime('%d %B %Y', strtotime($p->regulasi->tanggal_diundangkan)) : '' }}
                                                    </div>
                                                    <div class="product-title">Nomor {{ $p->regulasi->nomor_peraturan }} Tahun
                                                        {{ $p->regulasi->tahun }}</div>
                                                    <div class="product-meta">{{ $p->regulasi->judul }}</div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section animate-on-scroll fade-in-up">
        <div class="container">
            <h3 class="stats-title animate-on-scroll fade-in-up">{{ translateIt('STATISTIK PRODUK HUKUM') }}</h3>
            <div class="row">
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="stat-card animate-on-scroll scale-in delay-100">
                        <div class="stat-icon" style="background-color: #3498DB;">
                            <i class="mdi mdi-book-open-page-variant"></i>
                        </div>
                        <div class="stat-number" data-plugin="counterup">{{ $totalperda }}</div>
                        <div class="stat-label">{{ translateIt('Total') }} Perda</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #2ECC71;">
                            <i class="mdi mdi-book-open-page-variant"></i>
                        </div>
                        <div class="stat-number" data-plugin="counterup">{{ $totalperwal }}</div>
                        <div class="stat-label">{{ translateIt('Total') }} Perwal</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #F39C12;">
                            <i class="mdi mdi-bookshelf"></i>
                        </div>
                        <div class="stat-number" data-plugin="counterup">{{ $totalkepwal }}</div>
                        <div class="stat-label">{{ translateIt('Total Keputusan Wali Kota') }}</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #9B59B6;">
                            <i class="mdi mdi-book-open-variant"></i>
                        </div>
                        <div class="stat-number" data-plugin="counterup">{{ $totalpropemperda }}</div>
                        <div class="stat-label">{{ translateIt('Total') }} Propemperda</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #E74C3C;">
                            <i class="mdi mdi-book-multiple"></i>
                        </div>
                        <div class="stat-number" data-plugin="counterup">{{ $totalmonografihukum ?? 0 }}</div>
                        <div class="stat-label">{{ translateIt('Total') }} Monografi Hukum</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #1ABC9C;">
                            <i class="mdi mdi-gavel"></i>
                        </div>
                        <div class="stat-number" data-plugin="counterup">{{ $totalputusan ?? 0 }}</div>
                        <div class="stat-label">{{ translateIt('Total') }} Putusan</div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="row mt-4">
                <div class="col-lg-12 mb-4">
                    <div class="chart-container">
                        <div class="text-center mb-3">
                            <p class="text-muted">
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle"
                                        style="color: #3498DB"></i> Perda</span>
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle"
                                        style="color: #2ECC71"></i> Perwal</span>
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle"
                                        style="color: #F39C12"></i> Keputusan Wali Kota</span>
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle"
                                        style="color: #9B59B6"></i> Propemperda</span>
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle"
                                        style="color: #E74C3C"></i> Monografi Hukum</span>
                                <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle"
                                        style="color: #1ABC9C"></i> Putusan</span>
                            </p>
                        </div>
                        <div id="morris-bar-stacked" style="height: 250px;" class="morris-chart"
                            data-colors="#3498DB,#2ECC71,#F39C12,#9B59B6,#E74C3C,#1ABC9C"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="chart-container">
                        <h4 class="chart-title">{{ translateIt('Status Berlaku') }}</h4>
                        <div id="pie-chart-status" class="ct-chart" style="height: 250px"></div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="chart-container">
                        <h4 class="chart-title">{{ translateIt('Paling Banyak dicari') }}</h4>
                        <div id="pie-chart-pencarian" class="ct-chart" style="height: 250px"></div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="chart-container">
                        <h4 class="chart-title">{{ translateIt('Paling Banyak diunduh') }}</h4>
                        <div id="pie-chart-unduhan" class="ct-chart" style="height: 250px"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mb-4">
                    <div class="content-card">
                        <h4 class="content-title">{{ translateIt(strtoupper($pagedasarhukum->judul)) }}</h4>
                        <div>{!! translateIt($pagedasarhukum->konten) !!}</div>
                    </div>
                </div>
                <div class="col-lg-5 mb-4">
                    <div class="content-card">
                        <h4 class="content-title">{{ translateIt(strtoupper('Jadwal Harian Bagian Hukum')) }}</h4>
                        <h5 class="text-primary mb-3">
                            {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}</h5>
                        <div class="table-responsive">
                            <table class="schedule-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Acara</th>
                                        <th>Waktu</th>
                                        <th>Tempat</th>
                                        <th>Penyelenggara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->judul }}</td>
                                            <td>{{ strftime('%H:%M', strtotime($value->waktu)) }}</td>
                                            <td>{{ $value->tempat }}</td>
                                            <td>{{ $value->penyelenggara }}</td>
                                        </tr>
                                    @endforeach
                                    @if (!$jadwal->count())
                                        <tr>
                                            <td colspan="5">Belum ada Jadwal hari ini</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news-section animate-on-scroll fade-in-up">
        <div class="container">
            <h3 class="news-title animate-on-scroll fade-in-up">Berita Terbaru</h3>
            <div class="row">
                @foreach ($kegiatan as $k)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="/kegiatan/{{ $k->id }}/{{ strtolower(str_replace(' ', '-', $k->judul)) }}"
                            class="text-decoration-none">
                            <div class="news-card animate-on-scroll scale-in delay-{{ $loop->iteration }}">
                                <img class="news-img" src="{{ $k->gambar }}" alt="JDIH BANJARBARU">
                                <div class="news-content">
                                    <div class="news-date">{{ strftime('%d %B %Y', strtotime($k->tanggal)) }}</div>
                                    <div class="news-headline">{{ translateIt($k->judul) }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="/kegiatan" class="btn btn-light btn-lg rounded-pill px-4">Berita Lainnya</a>
            </div>
        </div>
    </section>

    <!-- Awards Section -->
    <section class="awards-section animate-on-scroll fade-in-up">
        <div class="container awards-container">
            <h3 class="awards-title animate-on-scroll fade-in-up">{{ translateIt('Penghargaan') }}</h3>

            @if (isset($penghargaan) && count($penghargaan) > 0)
                <div class="row penghargaan-list" id="penghargaan-list">
                    @foreach ($penghargaan as $award)
                        @php
                            $photos = is_string($award->foto) ? json_decode($award->foto, true) : $award->foto;
                            $firstPhoto = is_array($photos) && count($photos) > 0 ? $photos[0] : null;
                        @endphp
                        <div class="penghargaan-item animate-on-scroll scale-in delay-{{ $loop->iteration }}">
                            <a href="{{ asset('storage/' . $firstPhoto) }}" target="_blank">
                                <div class="penghargaan-img-wrapper">
                                    <img src="{{ asset('storage/' . $firstPhoto) }}" alt="{{ $award->nama }}"
                                        onerror="this.src='/assets/images/piagam.png'">
                                </div>
                                <span class="penghargaan-text">{{ $award->nama }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback when no awards -->
                <div class="text-center py-16">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-3xl p-12 max-w-2xl mx-auto">
                        <div class="text-6xl mb-6">🏆</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Menuju Prestasi Lebih Baik</h3>
                        <p class="text-gray-600 text-lg">Kami terus berupaya memberikan pelayanan terbaik dan meraih
                            prestasi untuk kemajuan bersama</p>
                    </div>
                </div>
            @endif
        </div>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="social-section">
        <div class="container">
            <h3 class="social-title">Sosial Media</h3>
            <div class="text-center">
                <!-- Elfsight Instagram Feed | JDIH Banjarbaru Instagram Feed -->
                <div class="elfsight-app-f5c95a62-512f-4563-b43b-d4100a0f0240" data-elfsight-app-lazy></div>
            </div>
        </div>
    </section>

    <!-- App Banner Section -->
    <section class="app-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="app-title">Warga Banjarbaru, Ini <strong>Idaman Publik</strong> Anda!</h1>
                    <p class="app-description">Satu aplikasi dari <strong>JDIH Kota Banjarbaru</strong> untuk akses
                        layanan publik yang efisien dan transparan.</p>
                    <div class="mt-4">
                        <a
                            href="https://play.google.com/store/apps/details?id=go.id.banjarbarukota.idaman_publik&hl=id">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/2560px-Google_Play_Store_badge_EN.svg.png"
                                class="app-badge" alt="Google Play Store">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="app-screenshots">
                        <img src="https://play-lh.googleusercontent.com/L3EK240gC9UIWjdJp-s8BWSLpb47-Xv4egVeUigXfhe5jns0LkyTr5pBDRQh-SPDTko=w526-h296-rw"
                            class="app-screenshot" alt="Android App Screenshot">
                        <img src="https://play-lh.googleusercontent.com/qJepK3idIyPuOnWAbXwLnNsl3RdZkSRc8Qfxn-bg2BP9Pk1UX3t9xPO8zM9OkcfFydY=w526-h296-rw"
                            class="app-screenshot" alt="Android App Screenshot">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <h3 class="contact-title">Kontak Kami</h3>
            <div class="map mb-4">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d995.6587315491789!2d114.83101809766961!3d-3.4386747501951818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de6817491bf1bfd%3A0x598d17189e3fd73d!2sPemerintah%20Kota%20Banjarbaru%20Balaikota!5e0!3m2!1sid!2sid!4v1636334355960!5m2!1sid!2sid"
                    width="100%" height="400" style="border:0; border-radius: 15px;" allowfullscreen=""
                    loading="lazy"></iframe>
            </div>
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <div class="contact-info">
                        <h3>Kontak Kami</h3>
                        <ul>
                            <li><i class="mdi mdi-phone"></i> (0511) 4772569</li>
                            <li><i class="mdi mdi-email-outline"></i> jdih@banjarbarukota.go.id</li>
                            <li><i class="mdi mdi-calendar-range"></i> Senin - Jum'at | 07.30 - 15.30</li>
                            <li><i class="mdi mdi-fax"></i> (0511) 4774269</li>
                            <li><i class="mdi mdi-map-marker-outline"></i> Jl. Panglima Batur No. 1 Banjarbaru.
                                Kalimantan Selatan</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 mb-4">
                    <div class="contact-form">
                        <h3>Kirim Pesan Anda</h3>
                        <form id="konsul" name="konsul" method="post">
                            <input type="text" name="nama" id="nama" class="form-control-custom"
                                placeholder="Nama Lengkap" required>
                            <input type="email" name="email" id="email" class="form-control-custom"
                                placeholder="Alamat Email" required>
                            <input type="text" name="subjek" id="subjek" class="form-control-custom"
                                placeholder="Subjek Pertanyaan anda" required>
                            <textarea name="pesan" id="pesan" rows="5" class="form-control-custom" placeholder="Pesan Anda"
                                required></textarea>
                            <button type="submit" class="btn-submit">KIRIM PESAN</button>
                            <small class="d-block mt-2 text-muted">* Pesan ini akan diteruskan menggunakan applikasi
                                Whatsapp</small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Survey Section -->
    <section class="survey-section">
        <div class="container survey-container">
            <h3 class="survey-title">{{ translateIt('Indeks Kepuasan Masyarakat') }}</h3>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 text-center">
                    <div id="pie-chart" class="ct-chart" style="height: 250px"></div>
                </div>
                <div class="col-lg-6">
                    <div class="text-left">
                        <p class="text-muted font-15 font-family-secondary mb-0">
                            <span class="d-block mb-2"><i class="mdi mdi-checkbox-blank-circle"
                                    style="color: #d70206"></i> {{ translateIt('Sangat Baik') }}</span>
                            <span class="d-block mb-2"><i class="mdi mdi-checkbox-blank-circle"
                                    style="color: #f05b4f"></i> {{ translateIt('Baik') }}</span>
                            <span class="d-block mb-2"><i class="mdi mdi-checkbox-blank-circle"
                                    style="color: #f4c63d"></i> {{ translateIt('Cukup Baik') }}</span>
                            <span class="d-block mb-2"><i class="mdi mdi-checkbox-blank-circle"
                                    style="color: #d17905"></i> {{ translateIt('Kurang Baik') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Links Section -->
    <section class="links-section animate-on-scroll fade-in-up">
        <div class="container links-container">
            <h3 class="links-title animate-on-scroll fade-in-up">{{ translateIt('Link Terkait') }}</h3>
            <div class="links-grid">
                @foreach ($linkTerkait as $item)
                    <div class="link-item animate-on-scroll scale-in delay-{{ $loop->iteration }}">
                        <a href="{{ $item['link'] }}" target="_blank"
                            class="text-decoration-none d-flex flex-column h-100 justify-content-between align-items-center">
                            <div class="text-center">
                                <img src="{{ $item['logo'] }}" alt="demo-img" class="img-fluid">
                            </div>
                            <span>{{ $item['nama'] }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Survey Modal -->
    <div class="modal fade" id="surveyPopup" tabindex="-1" role="dialog" aria-labelledby="surveyPopupLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="" class="modal-content" id="formskm">
                <div class="modal-header">
                    <h5 class="modal-title" id="surveyPopupLabel">{{ translateIt('Survey Kepuasan Masyarakat') }}
                    </h5>
                    <button id="surveyPopupClose" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="surveyThanks" class="modal-body d-none">
                    <div class="container w-50 h-50 text-center mb-4">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0"
                            viewBox="0 0 64 64" style="enable-background:new 0 0 64 64" xml:space="preserve">
                            <style>
                                .st13,
                                .st2,
                                .st5 {
                                    fill: #eceff1;
                                    stroke: #37474f;
                                    stroke-linecap: round;
                                    stroke-linejoin: round;
                                    stroke-miterlimit: 10
                                }

                                .st13,
                                .st5 {
                                    fill: none
                                }

                                .st13 {
                                    fill: #b0bec5
                                }
                            </style>
                            <path
                                d="M16 62.5h5c1.4 0 2.5-1.1 2.5-2.5V47c0-1.4-1.1-2.5-2.5-2.5h-5c-1.4 0-2.5 1.1-2.5 2.5v13c0 1.3 1.1 2.5 2.5 2.5z"
                                style="fill:#455a64;stroke:#37474f;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10" />
                            <path class="st2"
                                d="M54 47c0-1.4-1.1-2.5-2.5-2.5 1.4 0 2.5-1.1 2.5-2.5s-1.1-2.5-2.5-2.5h-11V32c0-1.4-1.1-2.5-2.5-2.5h-1c-.9 0-1.8.5-2.2 1.4L33 34.6c-1.6 3.2-4.2 5.7-7.5 7.1l-1.9.8v14l4.2 1.8c1.9.8 3.9 1.2 5.9 1.2h17.9c1.4 0 2.5-1.1 2.5-2.5s-1.1-2.5-2.5-2.5c1.4 0 2.5-1.1 2.5-2.5s-1.1-2.5-2.5-2.5c1.3 0 2.4-1.1 2.4-2.5z" />
                            <path d="M26.2 43.5c3.7-1.6 6.7-4.4 8.5-8l1.9-3.7"
                                style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10" />
                            <path class="st13"
                                d="M53 59c-.4.3-.9.5-1.5.5H33.6c-2 0-4-.4-5.9-1.2l-4.2-1.8v4l4.2 1.8c1.9.8 3.9 1.2 5.9 1.2h17.9c1.4 0 2.5-1.1 2.5-2.5 0-.8-.4-1.5-1-2z" />
                            <path
                                d="M16 58.5h5c1.4 0 2.5-1.1 2.5-2.5V43c0-1.4-1.1-2.5-2.5-2.5h-5c-1.4 0-2.5 1.1-2.5 2.5v13c0 1.3 1.1 2.5 2.5 2.5z"
                                style="fill:#78909c;stroke:#37474f;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10" />
                            <path class="st13" d="M51.5 44.5h-3M51.5 49.5h-3M51.5 54.5h-3" />
                            <circle class="st2" cx="18.5" cy="44.5" r="2" />
                            <path
                                d="M27.5 9.5v13c0 2.8 2.2 5 5 5h7c.6 0 1 .4 1 1v4.6c0 .9 1.1 1.3 1.7.7L47 29c.9-.9 2.2-1.5 3.5-1.5h7.9c2.8 0 5-2.2 5-5v-13c0-2.8-2.2-5-5-5h-26c-2.7 0-4.9 2.2-4.9 5z"
                                style="fill:#0097a7;stroke:#37474f;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10" />
                            <path
                                d="M27.5 5.5v13c0 2.8 2.2 5 5 5h7c.6 0 1 .4 1 1v4.6c0 .9 1.1 1.3 1.7.7L47 25c.9-.9 2.2-1.5 3.5-1.5h7.9c2.8 0 5-2.2 5-5v-13c0-2.8-2.2-5-5-5h-26c-2.7 0-4.9 2.2-4.9 5z"
                                style="fill:#26c6da;stroke:#37474f;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10" />
                            <path d="M29.5 9.5v-4c0-1.7 1.3-3 3-3h4"
                                style="fill:none;stroke:#80deea;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10" />
                            <path class="st5" d="M33.5 7.5h24M33.5 12h24M33.5 16.5h12" />
                            <circle cx="12" cy="16" r="11.5"
                                style="fill:#ffa000;stroke:#37474f;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10" />
                            <circle cx="12" cy="12" r="11.5"
                                style="fill:#ffca28;stroke:#37474f;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10" />
                            <path d="M2.5 12c0-5.2 4.3-9.5 9.5-9.5"
                                style="fill:none;stroke:#ffe082;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10" />
                            <g>
                                <path class="st2"
                                    d="M6.5 13.2 9.3 16c.6.6 1.5.6 2.1 0l6-6c.6-.6.6-1.5 0-2.1s-1.5-.6-2.1 0l-4.9 4.9L8.6 11c-.6-.6-1.5-.6-2.1 0-.6.7-.6 1.7 0 2.2z" />
                            </g>
                        </svg>
                    </div>
                    <h2 class="text-center">{{ translateIt('Terima kasih atas waktunya') }}</h2>
                </div>
                <div id="surveyBody" class="modal-body">
                    <h4 class="text-center">
                        {{ translateIt('Bagaimana pendapat anda judul pelayanan aplikasi JDIH Bagian Hukum Kota Banjarbaru ?') }}
                    </h4>

                    <div class="text-center btn-group btn-group-toggle mt-4">
                        <label class="col-sm" for="opsi4">
                            <input type="radio" name="jawab" id="opsi4" autocomplete="off"
                                value="Kurang Baik" class="send">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <defs>
                                    <style>
                                        .b {
                                            fill: #864e20
                                        }

                                        .c {
                                            fill: #e7c930
                                        }
                                    </style>
                                </defs>
                                <rect x="1" y="1" width="22" height="22" rx="7.656"
                                    style="fill:#f8de40" />
                                <path class="b"
                                    d="M7.055 7.313A1.747 1.747 0 1 0 8.8 9.059a1.747 1.747 0 0 0-1.745-1.746zM16.958 7.313A1.747 1.747 0 1 0 18.7 9.059a1.747 1.747 0 0 0-1.742-1.746z" />
                                <path class="c"
                                    d="M23 13.938a14.69 14.69 0 0 1-12.406 6.531c-5.542 0-6.563-1-9.142-2.529A7.66 7.66 0 0 0 8.656 23h6.688A7.656 7.656 0 0 0 23 15.344z" />
                                <ellipse class="b" cx="12" cy="13.375" rx="5.479"
                                    ry=".297" />
                                <ellipse class="c" cx="12" cy="14.646" rx="1.969"
                                    ry=".229" />
                            </svg>
                            <span>{{ translateIt('Kurang Baik') }}</span>
                        </label>

                        <label class="col-sm" for="opsi3">
                            <input type="radio" name="jawab" id="opsi3" autocomplete="off"
                                value="Cukup Baik" class="send">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <defs>
                                    <style>
                                        .b {
                                            fill: #864e20
                                        }

                                        .c {
                                            fill: #e7c930
                                        }
                                    </style>
                                </defs>
                                <rect x="1" y="1" width="22" height="22" rx="7.656"
                                    style="fill:#f8de40" />
                                <path class="b"
                                    d="M7.055 7.313A1.747 1.747 0 1 0 8.8 9.059a1.747 1.747 0 0 0-1.745-1.746zM16.958 7.313A1.747 1.747 0 1 0 18.7 9.059a1.747 1.747 0 0 0-1.742-1.746z" />
                                <path class="c"
                                    d="M23 13.938a14.69 14.69 0 0 1-12.406 6.531c-5.542 0-6.563-1-9.142-2.529A7.66 7.66 0 0 0 8.656 23h6.688A7.656 7.656 0 0 0 23 15.344z" />
                                <path class="b"
                                    d="M16.6 12.25a8.622 8.622 0 0 1-4.6 1.271 8.622 8.622 0 0 1-4.6-1.271s-.451-.273-.169.273 1.867.93 1.882 1.133a4.862 4.862 0 0 0 5.782 0c.015-.2 1.6-.586 1.882-1.133s-.177-.273-.177-.273z" />
                                <path class="c"
                                    d="M14.422 14.961a4.8 4.8 0 0 1-4.844 0c-.424-.228-.476.164.352.656a4.093 4.093 0 0 0 2.07.656 4.093 4.093 0 0 0 2.07-.656c.83-.492.776-.884.352-.656z" />
                            </svg>
                            <span>{{ translateIt('Cukup Baik') }}</span>
                        </label>

                        <label class="col-sm" for="opsi2">
                            <input type="radio" name="jawab" id="opsi2" autocomplete="off" value="Baik"
                                class="send">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <defs>
                                    <style>
                                        .b {
                                            fill: #864e20
                                        }

                                        .e {
                                            fill: #e6e7e8
                                        }
                                    </style>
                                </defs>
                                <rect x="1" y="1" width="22" height="22" rx="7.656"
                                    style="fill:#f8de40" />
                                <path class="b"
                                    d="M8.907 9.844a.182.182 0 0 1-.331.1 2.016 2.016 0 0 0-.569-.567 1.731 1.731 0 0 0-1.915 0 2.016 2.016 0 0 0-.571.569.182.182 0 0 1-.331-.1 1.632 1.632 0 0 1 .346-1.023 1.927 1.927 0 0 1 3.026 0 1.64 1.64 0 0 1 .345 1.021zM18.81 9.844a.182.182 0 0 1-.331.1 2.026 2.026 0 0 0-.568-.567 1.732 1.732 0 0 0-1.916 0 2.016 2.016 0 0 0-.571.569.182.182 0 0 1-.331-.1 1.632 1.632 0 0 1 .346-1.023 1.927 1.927 0 0 1 3.026 0 1.64 1.64 0 0 1 .345 1.021z" />
                                <path
                                    d="M23 13.938a14.69 14.69 0 0 1-12.406 6.531c-5.542 0-6.563-1-9.142-2.529A7.66 7.66 0 0 0 8.656 23h6.688A7.656 7.656 0 0 0 23 15.344z"
                                    style="fill:#e7c930" />
                                <path
                                    d="M7.127 12h9.746a1.937 1.937 0 0 1 1.937 1.937 1.938 1.938 0 0 1-1.937 1.938H7.127a1.937 1.937 0 0 1-1.937-1.937A1.937 1.937 0 0 1 7.127 12z"
                                    style="fill:#fff" />
                                <ellipse class="e" cx="12" cy="13.938" rx="6.188"
                                    ry=".25" />
                                <ellipse class="e" cx="7.257" cy="13.938" rx=".208"
                                    ry="1.438" />
                                <ellipse class="e" cx="9.628" cy="13.938" rx=".208"
                                    ry="1.438" />
                                <ellipse class="e" cx="12" cy="13.938" rx=".208"
                                    ry="1.438" />
                                <ellipse class="e" cx="14.372" cy="13.938" rx=".208"
                                    ry="1.438" />
                                <ellipse class="e" cx="16.743" cy="13.938" rx=".208"
                                    ry="1.438" />
                            </svg>
                            <span>{{ translateIt('Baik') }}</span>
                        </label>

                        <label class="col-sm" for="opsi1">
                            <input type="radio" name="jawab" id="opsi1" autocomplete="off"
                                value="Sangat Baik" class="send">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <defs>
                                    <style>
                                        .c {
                                            fill: #f06880
                                        }
                                    </style>
                                </defs>
                                <rect x="1" y="1" width="22" height="22" rx="7.656"
                                    style="fill:#f8de40" />
                                <path
                                    d="M23 13.938a14.69 14.69 0 0 1-12.406 6.531c-5.542 0-6.563-1-9.142-2.529A7.66 7.66 0 0 0 8.656 23h6.688A7.656 7.656 0 0 0 23 15.344z"
                                    style="fill:#e7c930" />
                                <path class="c"
                                    d="M9.58 6.983A1.528 1.528 0 0 0 7.5 7.1l-.449.45L6.6 7.1a1.529 1.529 0 0 0-2.083-.113 1.472 1.472 0 0 0-.058 2.136L6.68 11.34a.518.518 0 0 0 .737 0l2.22-2.221a1.471 1.471 0 0 0-.057-2.136zM19.483 6.983A1.528 1.528 0 0 0 17.4 7.1l-.449.45-.451-.45a1.529 1.529 0 0 0-2.083-.113 1.471 1.471 0 0 0-.057 2.136l2.221 2.221a.517.517 0 0 0 .736 0l2.221-2.221a1.472 1.472 0 0 0-.055-2.14z" />
                                <path
                                    d="M16.666 12.583H7.334a.493.493 0 0 0-.492.544c.123 1.175.875 3.842 5.158 3.842s5.035-2.667 5.158-3.842a.493.493 0 0 0-.492-.544z"
                                    style="fill:#864e20" />
                                <path class="c"
                                    d="M12 16.969a6.538 6.538 0 0 0 2.959-.6 1.979 1.979 0 0 0-1.209-.853c-1.344-.3-1.75.109-1.75.109s-.406-.406-1.75-.109a1.979 1.979 0 0 0-1.209.853 6.538 6.538 0 0 0 2.959.6z" />
                            </svg>
                            <span>{{ translateIt('Sangat Baik') }}</span>
                        </label>
                    </div>
                </div>
                <div id="surveyFooter" class="modal-footer">
                    <button type="button" class="btn btn-light btn-lg"
                        data-dismiss="modal">{{ translateIt('Nanti') }}</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="btnskm">
                        <i class=" fas fa-paper-plane mr-1"></i> {{ translateIt('Kirim') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('public.footer')

    <!-- Back to top -->
    <a href="#" class="back-to-top" id="back-to-top"> <i class="mdi mdi-chevron-up"> </i> </a>

    <!-- Comprehensive Accessibility Widget -->
    <div id="accessibilityWidget">
        <button id="accessibilityToggle" class="accessibility-toggle" aria-label="Accessibility Options">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="32" height="32">
                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9H15V22H13V16H11V22H9V9H3V7H21V9Z"/>
            </svg>
        </button>
        
        <div id="accessibilityPanel" class="accessibility-panel" role="dialog" aria-modal="true" aria-labelledby="a11y-title">
            <div class="accessibility-header">
                <h3 id="a11y-title">Accessibility Options</h3>
                <button class="close-panel" aria-label="Close accessibility panel">&times;</button>
            </div>
            
            <div class="accessibility-content">
                <!-- Font Size -->
                <div class="accessibility-group">
                    <label>Text Size</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="font-decrease" aria-label="Decrease font size">
                            <i class="mdi mdi-minus"></i>
                        </button>
                        <span class="control-value" id="fontSizeValue">100%</span>
                        <button class="btn-access" data-action="font-increase" aria-label="Increase font size">
                            <i class="mdi mdi-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- Text Spacing -->
                <div class="accessibility-group">
                    <label>Text Spacing</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="spacing-decrease" aria-label="Decrease text spacing">
                            <i class="mdi mdi-minus"></i>
                        </button>
                        <span class="control-value" id="spacingValue">Normal</span>
                        <button class="btn-access" data-action="spacing-increase" aria-label="Increase text spacing">
                            <i class="mdi mdi-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- Line Height -->
                <div class="accessibility-group">
                    <label>Line Height</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="line-decrease" aria-label="Decrease line height">
                            <i class="mdi mdi-minus"></i>
                        </button>
                        <span class="control-value" id="lineHeightValue">1.5</span>
                        <button class="btn-access" data-action="line-increase" aria-label="Increase line height">
                            <i class="mdi mdi-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- Contrast -->
                <div class="accessibility-group">
                    <label>Contrast</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="contrast-normal" aria-label="Normal contrast">Normal</button>
                        <button class="btn-access" data-action="contrast-high" aria-label="High contrast">High</button>
                        <button class="btn-access" data-action="contrast-inverted" aria-label="Inverted colors">Inverted</button>
                    </div>
                </div>

                <!-- Font -->
                <div class="accessibility-group">
                    <label>Font Type</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="font-default" aria-label="Default font">Default</button>
                        <button class="btn-access" data-action="font-dyslexic" aria-label="Dyslexia-friendly font" style="font-family: Arial, sans-serif;">Dyslexic</button>
                    </div>
                </div>

                <!-- Text to Speech -->
                <div class="accessibility-group">
                    <label>Text to Speech</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="tts-toggle" id="ttsToggle" aria-label="Toggle text to speech">
                            <i class="mdi mdi-volume-up"></i> <span>Start</span>
                        </button>
                        <button class="btn-access" data-action="tts-stop" id="ttsStop" aria-label="Stop text to speech">
                            <i class="mdi mdi-stop"></i>
                        </button>
                    </div>
                </div>

                <!-- Highlights -->
                <div class="accessibility-group">
                    <label>Highlights</label>
                    <div class="accessibility-controls">
                        <label class="accessibility-checkbox">
                            <input type="checkbox" id="highlightLinks">
                            <span>Highlight Links</span>
                        </label>
                        <label class="accessibility-checkbox">
                            <input type="checkbox" id="highlightHeadings">
                            <span>Highlight Headings</span>
                        </label>
                    </div>
                </div>

                <!-- Mouse Pointer -->
                <div class="accessibility-group">
                    <label>Mouse Pointer</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="pointer-default" aria-label="Default mouse pointer">Default</button>
                        <button class="btn-access" data-action="pointer-large" aria-label="Large mouse pointer">Large</button>
                    </div>
                </div>

                <!-- Stop Animations -->
                <div class="accessibility-group">
                    <label>Motion</label>
                    <div class="accessibility-controls">
                        <label class="accessibility-checkbox">
                            <input type="checkbox" id="stopAnimations">
                            <span>Stop Animations</span>
                        </label>
                    </div>
                </div>

                <!-- Reset -->
                <div class="accessibility-group">
                    <button class="btn-reset" data-action="reset" aria-label="Reset all accessibility settings">
                        <i class="mdi mdi-refresh"></i> Reset All
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Accessibility Widget Styles */
        #accessibilityWidget * {
            box-sizing: border-box;
        }

        .accessibility-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            z-index: 999999;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: 3px solid white;
            outline: none;
        }

        .accessibility-toggle:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        }

        .accessibility-toggle:focus {
            outline: 2px solid #6366f1;
            outline-offset: 2px;
        }

        .accessibility-panel {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            background: white;
            border-radius: 16px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            z-index: 1000000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            min-width: 400px;
            max-width: 90vw;
            max-height: 85vh;
            overflow-y: auto;
        }

        .accessibility-panel.active {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        .accessibility-header {
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
        }

        .accessibility-header h3 {
            margin: 0;
            color: #333;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .close-panel {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #666;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            outline: none;
        }

        .close-panel:hover {
            background: #f3f4f6;
            color: #333;
        }

        .close-panel:focus {
            outline: 2px solid #6366f1;
            outline-offset: 2px;
        }

        .accessibility-content {
            padding: 24px;
        }

        .accessibility-group {
            margin-bottom: 24px;
        }

        .accessibility-group:last-child {
            margin-bottom: 0;
        }

        .accessibility-group label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 12px;
            font-size: 0.95rem;
        }

        .accessibility-controls {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-access {
            flex: 1;
            min-width: 80px;
            padding: 12px 16px;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            outline: none;
        }

        .btn-access:hover {
            background: #6366f1;
            border-color: #6366f1;
            color: white;
        }

        .btn-access.active {
            background: #6366f1;
            border-color: #6366f1;
            color: white;
        }

        .btn-access:focus {
            outline: 2px solid #6366f1;
            outline-offset: 2px;
        }

        .control-value {
            min-width: 70px;
            text-align: center;
            font-weight: 600;
            color: #6366f1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .accessibility-checkbox {
            flex: 1;
            min-width: 150px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 12px 16px;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            transition: all 0.2s ease;
            user-select: none;
        }

        .accessibility-checkbox:hover {
            border-color: #6366f1;
            background: #f3f4f6;
        }

        .accessibility-checkbox input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #6366f1;
        }

        .accessibility-checkbox span {
            font-size: 0.9rem;
            font-weight: 500;
            color: #374151;
        }

        .btn-reset {
            width: 100%;
            padding: 14px 20px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            outline: none;
        }

        .btn-reset:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-reset:focus {
            outline: 2px solid #ef4444;
            outline-offset: 2px;
        }

        /* Accessibility Effects */
        body.accessibility-high-contrast {
            filter: contrast(1.5) saturate(0.5);
        }

        body.accessibility-inverted {
            filter: invert(1);
        }

        body.accessibility-dyslexic {
            font-family: Arial, sans-serif !important;
            letter-spacing: 0.5px;
        }

        body.accessibility-large-pointer * {
            cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='64' height='64' viewport='0 0 64 64' style='fill:black;font-size:64px;'><text y='50%'>👆</text></svg>"), auto !important;
        }

        body.accessibility-stop-animations *,
        body.accessibility-stop-animations *::before,
        body.accessibility-stop-animations *::after {
            animation-duration: 0s !important;
            animation-delay: 0s !important;
            transition-duration: 0s !important;
            transition-delay: 0s !important;
        }

        body.accessibility-highlight-links a {
            background: #fef08a;
            padding: 2px 4px;
            border-radius: 3px;
            border: 2px solid #eab308;
        }

        body.accessibility-highlight-headings h1,
        body.accessibility-highlight-headings h2,
        body.accessibility-highlight-headings h3,
        body.accessibility-highlight-headings h4,
        body.accessibility-highlight-headings h5,
        body.accessibility-highlight-headings h6 {
            background: #bbf7d0;
            padding: 4px 8px;
            border-radius: 4px;
            border: 2px solid #22c55e;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .accessibility-toggle {
                bottom: 80px;
                right: 20px;
                width: 50px;
                height: 50px;
            }

            .accessibility-toggle svg {
                width: 24px;
                height: 24px;
            }

            .accessibility-panel {
                min-width: 320px;
                width: 90vw;
            }

            .btn-access {
                font-size: 0.85rem;
                padding: 10px 12px;
            }
        }
    </style>

    <script>
    (function() {
        'use strict';

        var accessibilityToggle = document.getElementById('accessibilityToggle');
        var accessibilityPanel = document.getElementById('accessibilityPanel');
        var closePanel = document.querySelector('.close-panel');
        var body = document.body;

        // State
        var state = {
            fontSize: 100,
            letterSpacing: 0,
            lineHeight: 1.5,
            contrast: 'normal',
            font: 'default',
            pointer: 'default',
            highlightLinks: false,
            highlightHeadings: false,
            stopAnimations: false,
            ttsEnabled: false
        };

        // Toggle panel
        accessibilityToggle.addEventListener('click', function() {
            accessibilityPanel.classList.toggle('active');
            if (accessibilityPanel.classList.contains('active')) {
                closePanel.focus();
            }
        });

        // Close panel
        closePanel.addEventListener('click', function() {
            accessibilityPanel.classList.remove('active');
            accessibilityToggle.focus();
        });

        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!accessibilityPanel.contains(e.target) && e.target !== accessibilityToggle) {
                accessibilityPanel.classList.remove('active');
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                accessibilityPanel.classList.remove('active');
                accessibilityToggle.focus();
            }
        });

        // Font Size
        function updateFontSize(value) {
            state.fontSize = value;
            document.documentElement.style.fontSize = value + '%';
            document.getElementById('fontSizeValue').textContent = value + '%';
        }

        document.querySelector('[data-action="font-increase"]').addEventListener('click', function() {
            var newVal = Math.min(state.fontSize + 10, 150);
            updateFontSize(newVal);
        });

        document.querySelector('[data-action="font-decrease"]').addEventListener('click', function() {
            var newVal = Math.max(state.fontSize - 10, 70);
            updateFontSize(newVal);
        });

        // Text Spacing
        function updateLetterSpacing(value) {
            state.letterSpacing = value;
            document.documentElement.style.letterSpacing = value + 'px';
            var label = value === 0 ? 'Normal' : value + 'px';
            document.getElementById('spacingValue').textContent = label;
        }

        document.querySelector('[data-action="spacing-increase"]').addEventListener('click', function() {
            var newVal = Math.min(state.letterSpacing + 1, 5);
            updateLetterSpacing(newVal);
        });

        document.querySelector('[data-action="spacing-decrease"]').addEventListener('click', function() {
            var newVal = Math.max(state.letterSpacing - 1, 0);
            updateLetterSpacing(newVal);
        });

        // Line Height
        function updateLineHeight(value) {
            state.lineHeight = value;
            document.documentElement.style.lineHeight = value;
            document.getElementById('lineHeightValue').textContent = value.toFixed(1);
        }

        document.querySelector('[data-action="line-increase"]').addEventListener('click', function() {
            var newVal = Math.min(state.lineHeight + 0.3, 2.4);
            updateLineHeight(newVal);
        });

        document.querySelector('[data-action="line-decrease"]').addEventListener('click', function() {
            var newVal = Math.max(state.lineHeight - 0.3, 1.2);
            updateLineHeight(newVal);
        });

        // Contrast
        function setContrast(type) {
            body.classList.remove('accessibility-high-contrast', 'accessibility-inverted');
            state.contrast = type;

            if (type === 'high') {
                body.classList.add('accessibility-high-contrast');
            } else if (type === 'inverted') {
                body.classList.add('accessibility-inverted');
            }

            // Update button states
            document.querySelectorAll('[data-action^="contrast-"]').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector('[data-action="contrast-' + type + '"]').classList.add('active');
        }

        document.querySelector('[data-action="contrast-normal"]').addEventListener('click', function() {
            setContrast('normal');
        });

        document.querySelector('[data-action="contrast-high"]').addEventListener('click', function() {
            setContrast('high');
        });

        document.querySelector('[data-action="contrast-inverted"]').addEventListener('click', function() {
            setContrast('inverted');
        });

        // Font Type
        function setFont(type) {
            body.classList.remove('accessibility-dyslexic');
            state.font = type;

            if (type === 'dyslexic') {
                body.classList.add('accessibility-dyslexic');
            }

            // Update button states
            document.querySelectorAll('[data-action^="font-"]').forEach(btn => {
                if (!btn.hasAttribute('data-action', 'reset')) {
                    btn.classList.remove('active');
                }
            });
            document.querySelector('[data-action="font-' + type + '"]').classList.add('active');
        }

        document.querySelector('[data-action="font-default"]').addEventListener('click', function() {
            setFont('default');
        });

        document.querySelector('[data-action="font-dyslexic"]').addEventListener('click', function() {
            setFont('dyslexic');
        });

        // Text to Speech
        var synthesis = window.speechSynthesis;
        var currentUtterance = null;

        document.getElementById('ttsToggle').addEventListener('click', function() {
            var btn = this;
            var span = btn.querySelector('span');

            if (!state.ttsEnabled) {
                state.ttsEnabled = true;
                span.textContent = 'Reading';
                btn.classList.add('active');

                var text = document.body.innerText;
                currentUtterance = new SpeechSynthesisUtterance(text);
                currentUtterance.rate = 0.9;
                currentUtterance.pitch = 1;

                synthesis.speak(currentUtterance);

                currentUtterance.onend = function() {
                    state.ttsEnabled = false;
                    span.textContent = 'Start';
                    btn.classList.remove('active');
                };
            } else {
                synthesis.cancel();
                state.ttsEnabled = false;
                span.textContent = 'Start';
                btn.classList.remove('active');
            }
        });

        document.getElementById('ttsStop').addEventListener('click', function() {
            synthesis.cancel();
            state.ttsEnabled = false;
            var btn = document.getElementById('ttsToggle');
            btn.querySelector('span').textContent = 'Start';
            btn.classList.remove('active');
        });

        // Highlights
        document.getElementById('highlightLinks').addEventListener('change', function() {
            state.highlightLinks = this.checked;
            if (this.checked) {
                body.classList.add('accessibility-highlight-links');
            } else {
                body.classList.remove('accessibility-highlight-links');
            }
        });

        document.getElementById('highlightHeadings').addEventListener('change', function() {
            state.highlightHeadings = this.checked;
            if (this.checked) {
                body.classList.add('accessibility-highlight-headings');
            } else {
                body.classList.remove('accessibility-highlight-headings');
            }
        });

        // Mouse Pointer
        function setPointer(type) {
            body.classList.remove('accessibility-large-pointer');
            state.pointer = type;

            if (type === 'large') {
                body.classList.add('accessibility-large-pointer');
            }

            // Update button states
            document.querySelectorAll('[data-action^="pointer-"]').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector('[data-action="pointer-' + type + '"]').classList.add('active');
        }

        document.querySelector('[data-action="pointer-default"]').addEventListener('click', function() {
            setPointer('default');
        });

        document.querySelector('[data-action="pointer-large"]').addEventListener('click', function() {
            setPointer('large');
        });

        // Stop Animations
        document.getElementById('stopAnimations').addEventListener('change', function() {
            state.stopAnimations = this.checked;
            if (this.checked) {
                body.classList.add('accessibility-stop-animations');
            } else {
                body.classList.remove('accessibility-stop-animations');
            }
        });

        // Reset
        document.querySelector('[data-action="reset"]').addEventListener('click', function() {
            updateFontSize(100);
            updateLetterSpacing(0);
            updateLineHeight(1.5);
            setContrast('normal');
            setFont('default');
            setPointer('default');

            document.getElementById('highlightLinks').checked = false;
            state.highlightLinks = false;
            body.classList.remove('accessibility-highlight-links');

            document.getElementById('highlightHeadings').checked = false;
            state.highlightHeadings = false;
            body.classList.remove('accessibility-highlight-headings');

            document.getElementById('stopAnimations').checked = false;
            state.stopAnimations = false;
            body.classList.remove('accessibility-stop-animations');

            synthesis.cancel();
            state.ttsEnabled = false;
            var btn = document.getElementById('ttsToggle');
            btn.querySelector('span').textContent = 'Start';
            btn.classList.remove('active');

            accessibilityPanel.classList.remove('active');
        });

        // Initialize
        setContrast('normal');
        setFont('default');
        setPointer('default');
    })();
    </script>

    <!-- javascript -->
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/headline.js') }}"></script>
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/morris.js06/morris.js06.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltips.min.js') }}"></script>
    <script src="{{ asset('assets/libs/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('assets/libs/cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('assets/libs/splide/splide.min.js') }}"></script>
    <script src="{{ asset('assets/js/pact.js') }}"></script>

    <!-- custom js -->
    <script>
        // ==========================================
        // ANIMATION INITIALIZATION
        // ==========================================
        
        // Page Loader
        initPageLoader();
        
        // Scroll Progress Indicator
        initScrollProgress();
        
        // Scroll Animations
        initScrollAnimations();
        
        // Counter Animations
        initCounterAnimations();
        
        // Parallax Effects
        initParallaxEffects();
        
        $(document).ready(function() {
            // Custom Hero Slider with Dynamic Motion
            initCustomHeroSlider();
            
            // Initialize Splide carousels as replacement for Slick
            new Splide('.slider-sering', {
                type: 'loop',
                direction: 'ttb',
                perPage: 5,
                height: '400px',
                autoplay: true,
                interval: 3000,
                pauseOnHover: true,
                arrows: false,
                pagination: false,
                wheel: false,
                drag: true,
                speed: 300
            }).mount();

            new Splide('.slider-terbaru', {
                type: 'loop',
                direction: 'ttb',
                perPage: 5,
                height: '400px',
                autoplay: true,
                interval: 3000,
                pauseOnHover: true,
                arrows: false,
                pagination: false,
                wheel: false,
                drag: true,
                speed: 300
            }).mount();
        });

        // ==========================================
        // PAGE LOADER
        // ==========================================
        function initPageLoader() {
            const pageLoader = document.getElementById('pageLoader');
            const body = document.body;
            
            window.addEventListener('load', function() {
                setTimeout(function() {
                    pageLoader.classList.add('hidden');
                    body.classList.remove('loading');
                }, 500);
            });
        }

        // ==========================================
        // SCROLL PROGRESS INDICATOR
        // ==========================================
        function initScrollProgress() {
            const scrollProgress = document.getElementById('scrollProgress');
            
            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrollPercent = (scrollTop / docHeight) * 100;
                scrollProgress.style.width = scrollPercent + '%';
            });
        }

        // ==========================================
        // SCROLL ANIMATIONS
        // ==========================================
        function initScrollAnimations() {
            const animatedElements = document.querySelectorAll('.animate-on-scroll');
            
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        
                        // Add small delay for better visual effect
                        requestAnimationFrame(function() {
                            element.classList.add('is-visible');
                        });
                        
                        // Stop observing after animation
                        observer.unobserve(element);
                    }
                });
            }, observerOptions);

            animatedElements.forEach(function(element) {
                observer.observe(element);
            });
        }

        // ==========================================
        // COUNTER ANIMATIONS
        // ==========================================
        function initCounterAnimations() {
            const counters = document.querySelectorAll('.stat-number');
            
            const counterObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = parseInt(counter.textContent.replace(/,/g, ''));
                        animateCounter(counter, target);
                        counterObserver.unobserve(counter);
                    }
                });
            }, {
                threshold: 0.5
            });

            counters.forEach(function(counter) {
                counterObserver.observe(counter);
            });
        }

        function animateCounter(element, target) {
            const duration = 2000;
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;
            
            const timer = setInterval(function() {
                current += increment;
                
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // ==========================================
        // PARALLAX EFFECTS
        // ==========================================
        function initParallaxEffects() {
            const parallaxElements = document.querySelectorAll('.parallax-element');
            
            function updateParallax() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                parallaxElements.forEach(function(element) {
                    const speed = parseFloat(element.dataset.parallaxSpeed) || 0.3;
                    const yPos = -(scrollTop * speed);
                    
                    // Apply parallax transform directly for better performance
                    if (element.classList.contains('hero-background')) {
                        element.style.transform = `translateY(${yPos}px) scale(1)`;
                    } else if (element.classList.contains('hero-slider')) {
                        element.style.transform = `translateY(${yPos}px)`;
                    } else {
                        element.style.setProperty('--parallax-offset', yPos + 'px');
                    }
                });
            }
            
            // Initial update
            updateParallax();
            
            // Update on scroll with requestAnimationFrame for smooth performance
            let ticking = false;
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        updateParallax();
                        ticking = false;
                    });
                    ticking = true;
                }
            }, {
                passive: true
            });
        }

        // Custom Beautiful Hero Slider
        function initCustomHeroSlider() {
            const slider = {
                currentSlide: 0,
                slides: document.querySelectorAll('.hero-slide'),
                totalSlides: document.querySelectorAll('.hero-slide').length,
                progressBar: document.getElementById('heroProgress'),
                indicators: document.getElementById('heroIndicators'),
                prevBtn: document.getElementById('heroPrev'),
                nextBtn: document.getElementById('heroNext'),
                autoplayInterval: null,
                autoplayDelay: 5000,
                isPaused: false
            };

            // Initialize indicators
            function createIndicators() {
                slider.indicators.innerHTML = '';
                for (let i = 0; i < slider.totalSlides; i++) {
                    const indicator = document.createElement('div');
                    indicator.className = 'hero-indicator';
                    if (i === 0) indicator.classList.add('active');
                    indicator.addEventListener('click', () => goToSlide(i));
                    slider.indicators.appendChild(indicator);
                }
            }

            // Update slide display
            function updateSlide() {
                // Hide all slides
                slider.slides.forEach((slide, index) => {
                    slide.classList.remove('active');
                    if (slider.indicators.children[index]) {
                        slider.indicators.children[index].classList.remove('active');
                    }
                });

                // Show current slide
                slider.slides[slider.currentSlide].classList.add('active');
                if (slider.indicators.children[slider.currentSlide]) {
                    slider.indicators.children[slider.currentSlide].classList.add('active');
                }

                // Reset and restart progress bar
                slider.progressBar.style.transition = 'none';
                slider.progressBar.style.width = '0%';
                setTimeout(() => {
                    slider.progressBar.style.transition = `width ${slider.autoplayDelay}ms linear`;
                    slider.progressBar.style.width = '100%';
                }, 50);
            }

            // Go to specific slide
            function goToSlide(slideIndex) {
                slider.currentSlide = slideIndex;
                updateSlide();
                resetAutoplay();
            }

            // Next slide
            function nextSlide() {
                slider.currentSlide = (slider.currentSlide + 1) % slider.totalSlides;
                updateSlide();
                resetAutoplay();
            }

            // Previous slide
            function prevSlide() {
                slider.currentSlide = (slider.currentSlide - 1 + slider.totalSlides) % slider.totalSlides;
                updateSlide();
                resetAutoplay();
            }

            // Start autoplay
            function startAutoplay() {
                if (!slider.isPaused) {
                    slider.autoplayInterval = setInterval(nextSlide, slider.autoplayDelay);
                }
            }

            // Stop autoplay
            function stopAutoplay() {
                if (slider.autoplayInterval) {
                    clearInterval(slider.autoplayInterval);
                    slider.autoplayInterval = null;
                }
            }

            // Reset autoplay
            function resetAutoplay() {
                stopAutoplay();
                startAutoplay();
            }

            // Event listeners
            slider.prevBtn.addEventListener('click', () => {
                prevSlide();
            });

            slider.nextBtn.addEventListener('click', () => {
                nextSlide();
            });

            // Pause on hover
            const heroSlider = document.getElementById('heroSlider');
            heroSlider.addEventListener('mouseenter', () => {
                slider.isPaused = true;
                stopAutoplay();
            });

            heroSlider.addEventListener('mouseleave', () => {
                slider.isPaused = false;
                startAutoplay();
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') prevSlide();
                if (e.key === 'ArrowRight') nextSlide();
            });

            // Touch/swipe support
            let touchStartX = 0;
            let touchEndX = 0;

            heroSlider.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            });

            heroSlider.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        nextSlide(); // Swipe left
                    } else {
                        prevSlide(); // Swipe right
                    }
                }
            }

            // Initialize
            createIndicators();
            updateSlide();
            startAutoplay();

            // Add parallax effect on mouse move
            heroSlider.addEventListener('mousemove', (e) => {
                const { clientX, clientY } = e;
                const { left, top, width, height } = heroSlider.getBoundingClientRect();
                const x = (clientX - left) / width;
                const y = (clientY - top) / height;

                const currentSlideEl = slider.slides[slider.currentSlide];
                const backgroundEl = currentSlideEl.querySelector('.hero-background');
                
                if (backgroundEl) {
                    const offsetX = (x - 0.5) * 20;
                    const offsetY = (y - 0.5) * 20;
                    backgroundEl.style.transform = `scale(1) translate(${offsetX}px, ${offsetY}px)`;
                }
            });

            // Reset transform on mouse leave
            heroSlider.addEventListener('mouseleave', () => {
                const currentSlideEl = slider.slides[slider.currentSlide];
                const backgroundEl = currentSlideEl.querySelector('.hero-background');
                if (backgroundEl) {
                    backgroundEl.style.transform = 'scale(1)';
                }
            });
        }

        $(document).on('submit', 'form.async', function(event) {
            event.preventDefault();
            // Form SKM
            if ($(this).attr('id') == 'formskm') {
                option = {
                    'module': 'skm',
                    'success': {
                        'request': 'thanksskm',
                        'target': 'body-q'
                    }
                }
                sentData('/api/skm', option);
            }
        });

        $(document).on('click', '#btnsearch', function() {
            var status = $('#status').val() ?? 'ALL';
            if ($('#tipe').val() != '') {
                var link = "/" + $('#tipe').val();
                if (($('#textsearch').val() != '') || ($('#tahun').val() != 'ALL')) {
                    link += '?';
                    if ($('#textsearch').val() != '') {
                        link += 's=' + $('#textsearch').val() + '&';
                    }
                    if ($('#tahun').val() != '') {
                        link += 'tahun=' + $('#tahun').val() + '&';
                    }
                    link = link.slice(0, -1);
                    link += '&status=' + status;
                }
                window.location.href = link;
            }
        });

        // Quick tags functionality
        $(document).on('click', '.quick-tag', function() {
            var $this = $(this);
            var type = $this.data('type');
            var status = $this.data('status');
            var year = $this.data('year');

            // Toggle active state
            $('.quick-tag').removeClass('active');
            $this.addClass('active');

            // Set filter values based on quick tag
            if (type) {
                $('#tipe').val(type);
            }
            if (status) {
                $('#status').val(status);
            }
            if (year) {
                $('#tahun').val(year);
            }

            // Trigger search automatically after selecting a quick tag
            $('#btnsearch').trigger('click');
        });

        $(document).on('click', '.slide_link', function() {
            url = $(this).attr('data-url');
            window.open(window.location.origin + '/kegiatan/' + url, '_blank');
        });

        function setDounatChart(el, data, colors) {
            new Morris.Donut({
                element: el,
                data: data,
                labelColor: '#34495E',
                colors: colors,
            });
        }

        $(function() {
            $.get("/api/skm", function(data, status) {
                var sangat_baik = 0;
                var baik = 0;
                var cukup_baik = 0;
                var kurang_baik = 0;
                $.each(data, function(i, v) {
                    if (v.jawab == 'Sangat Baik') {
                        sangat_baik = parseFloat(v.jumlah);
                    }
                    if (v.jawab == 'Baik') {
                        baik = parseFloat(v.jumlah);
                    }
                    if (v.jawab == 'Cukup Baik') {
                        cukup_baik = parseFloat(v.jumlah);
                    }
                    if (v.jawab == 'Kurang Baik') {
                        kurang_baik = parseFloat(v.jumlah);
                    }
                    var data = {
                        series: [sangat_baik, baik, cukup_baik, kurang_baik]
                    };
                    var sum = function(a, b) {
                        return a + b
                    };
                    var options = {};
                    var responsiveOptions = [
                        ['screen and (min-width: 640px)', {
                            chartPadding: 30,
                            labelOffset: 100,
                            labelDirection: 'explode',
                            showLabel: true,
                            labelInterpolationFnc: function(value) {
                                return Math.round(value / data.series.reduce(sum) *
                                    100) + '%';
                            }
                        }],
                        ['screen and (min-width: 1024px)', {
                            showLabel: true,
                            labelOffset: 60,
                            chartPadding: 20
                        }]
                    ];
                    new Chartist.Pie('#pie-chart', data, options, responsiveOptions);
                })
            });

            setDounatChart('pie-chart-status', [{
                    value: {{ $berlakudantidak->berlaku }},
                    label: "Berlaku"
                },
                {
                    value: {{ $berlakudantidak->tidak_berkalu }},
                    label: "Tidak Berlaku"
                }
            ], [
                '#3498db',
                '#E74C3C'
            ]);
            setDounatChart('pie-chart-pencarian', {!! $palingDicari !!}, [
                '#3498db',
                '#2ecc71',
                '#f39c12',
                '#9b59b6'
            ]);
            setDounatChart('pie-chart-unduhan', {!! $palingDiunduh !!}, [
                '#3498db',
                '#2ecc71',
                '#f39c12',
                '#9b59b6'
            ]);
        });

        (function($) {
            $.fn.clickToggle = function(func1, func2) {
                var funcs = [func1, func2];
                this.data('toggleclicked', 0);
                this.click(function() {
                    var data = $(this).data();
                    var tc = data.toggleclicked;
                    $.proxy(funcs[tc], this)();
                    data.toggleclicked = (tc + 1) % 2;
                });
                return this;
            };
            $.fn.inputFilter = function(inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = "";
                    }
                });
            };
        }(jQuery));

        $(".intTextBox").inputFilter(function(value) {
            return /^-?d*$/.test(value);
        });
        $(".uintTextBox").inputFilter(function(value) {
            return /^d*$/.test(value);
        });
        $(".intLimitTextBox").inputFilter(function(value) {
            return /^d*$/.test(value) && (value === "" || parseInt(value) <= 500);
        });
        $(".floatTextBox").inputFilter(function(value) {
            return /^-?d*[.,]?d*$/.test(value);
        });
        $(".currencyTextBox").inputFilter(function(value) {
            return /^-?d*[.,]?d{0,2}$/.test(value);
        });
        $(".latinTextBox").inputFilter(function(value) {
            return /^[a-z]*$/i.test(value);
        });
        $(".hexTextBox").inputFilter(function(value) {
            return /^[0-9a-f]*$/i.test(value);
        });

        // Splide initialization removed as #image-slider element doesn't exist
        // This prevents the "[splide] null is invalid" error

        ! function($) {
            "use strict";

            var Ubold = function() {};

            Ubold.prototype.initStickyMenu = function() {
                    $(window).scroll(function() {
                        var scroll = $(window).scrollTop();

                        if (scroll >= 50) {
                            $(".sticky").addClass("nav-sticky");
                        } else {
                            $(".sticky").removeClass("nav-sticky");
                        }
                    });
                },

                Ubold.prototype.initSmoothLink = function() {
                    $('.navbar-nav a').on('click', function(event) {
                        var $anchor = $(this);
                        $('html, body').stop().animate({
                            scrollTop: $($anchor.attr('href')).offset().top - 50
                        }, 1500);
                        event.preventDefault();
                    });

                    // general
                    $("a.smooth-scroll").on('click', function(e) {
                        e.preventDefault();
                        var dest = $(this).attr('href');
                        $('html,body').animate({
                            scrollTop: $(dest).offset().top
                        }, 'slow');
                    });
                },

                Ubold.prototype.initBacktoTop = function() {
                    $(window).scroll(function() {
                        if ($(this).scrollTop() > 100) {
                            $('.back-to-top').fadeIn();
                        } else {
                            $('.back-to-top').fadeOut();
                        }
                    });
                    $('.back-to-top').click(function() {
                        $("html, body").animate({
                            scrollTop: 0
                        }, 1000);
                        return false;
                    });
                },

                Ubold.prototype.init = function() {
                    this.initStickyMenu();
                    this.initSmoothLink();
                    this.initBacktoTop();
                },
                //init
                $.Ubold = new Ubold, $.Ubold.Constructor = Ubold

            // Morris
            var MorrisCharts = function() {};

            //creates Stacked chart
            MorrisCharts.prototype.createStackedChart = function(element, data, xkey, ykeys, labels, lineColors) {
                    Morris.Bar({
                        element: element,
                        data: data,
                        xkey: xkey,
                        ykeys: ykeys,
                        stacked: true,
                        labels: labels,
                        hideHover: 'auto',
                        dataLabels: false,
                        resize: true, //defaulted to true
                        gridLineColor: 'rgba(65, 80, 95, 0.07)',
                        barColors: lineColors
                    });
                },
                MorrisCharts.prototype.init = function() {

                    //creating Stacked chart
                    var $stckedData = [
                        @for ($i = $mintahun; $i <= $maxtahun; $i++)
                            {
                                y: '{{ $i }}',
                                a: '{{ isset($tahunanperda[$i]) ? $tahunanperda[$i] : 0 }}',
                                b: '{{ isset($tahunanperwal[$i]) ? $tahunanperwal[$i] : 0 }}',
                                c: '{{ isset($tahunankepwal[$i]) ? $tahunankepwal[$i] : 0 }}',
                                d: '{{ isset($tahunanpropemperda[$i]) ? $tahunanpropemperda[$i] : 0 }}',
                                e: '{{ isset($tahunanbuku[$i]) ? $tahunanbuku[$i] : 0 }}',
                                f: '{{ isset($tahunanputusan[$i]) ? $tahunanputusan[$i] : 0 }}'
                            },
                        @endfor
                    ];
                    var colors = ['#3498DB', '#2ECC71', '#F39C12', '#9B59B6', '#E74C3C', '#1ABC9C'];
                    var dataColors = $("#morris-bar-stacked").data('colors');
                    if (dataColors) {
                        colors = dataColors.split(",");
                    }
                    this.createStackedChart('morris-bar-stacked', $stckedData, 'y', ['a', 'b', 'c', 'd', 'e', 'f'], ["Perda",
                        "Perwal", "Kepwal",
                        "Propemperda",
                        "Monografi Hukum",
                        "Putusan"
                    ], colors);

                },
                //init
                $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts

            var NotificationApp = function() {};
            NotificationApp.prototype.send = function(heading, body, position, loaderBgColor, icon, hideAfter, stack,
                    showHideTransition) {
                    // default
                    if (!hideAfter)
                        hideAfter = 3000;
                    if (!stack)
                        stack = 1;

                    var options = {
                        heading: heading,
                        text: body,
                        position: position,
                        loaderBg: loaderBgColor,
                        icon: icon,
                        hideAfter: hideAfter,
                        stack: stack
                    };

                    if (showHideTransition)
                        options.showHideTransition = showHideTransition;

                    console.log(options);
                    $.toast().reset('all');
                    $.toast(options);
                },

                $.NotificationApp = new NotificationApp, $.NotificationApp.Constructor = NotificationApp
        }(window.jQuery),
        //initializing
        function($) {
            "use strict";
            Waves.init();
            $.Ubold.init();
            $.MorrisCharts.init();
            // HERO SLIDER with Slick Carousel
            var sliderBgSetting = $(".slide-bg-image");
            sliderBgSetting.each(function(indx) {
                if ($(this).attr("data-background")) {
                    $(this).css("background-image", "url(" + $(this).data("background") + ")");
                }
            });

            $(document).on('submit', 'form#konsul', function(event) {
                event.preventDefault();
                var nama = $('form#konsul #nama').val();
                var email = $('form#konsul #email').val();
                var subjek = $('form#konsul #subjek').val();
                var pesan = $('form#konsul #pesan').val();
                var send = '*Nama :* ' + nama + '\n' + '*Email :* ' + email + '\n' + '*Subjek :* ' + subjek +
                    '\n\n' + '*Pesan :*' + '\n' + pesan;
                var nom = '6282155720388';
                var url = 'https://api.whatsapp.com/send/?phone=' + nom + '&text=' + encodeURIComponent(send) +
                    '&app_absent=0'
                window.open(url, '_blank').focus();
            });
        }(window.jQuery);

        $(document).ready(function() {
            // Memuat tema dokumen untuk homepage
            loadTemaDokumenHomepage();

            function loadTemaDokumenHomepage() {
                $.ajax({
                    url: '/api/tema-dokumen',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var temaContainer = $('#tema-dokumen-container');
                        temaContainer.empty();

                        if (response.data && response.data.length > 0) {
                            $.each(response.data, function(index, tema) {
                                if (tema.status) {
                                    var jumlahPeraturan = tema.jumlah_peraturan || 0;
                                    var iconSrc = tema.icon ? tema.icon : '/assets/images/' +
                                        tema.slug + '.png';
                                    var temaHtml = `
                                        <div class="theme-item">
                                            <a href="/tema-dokumen/${tema.id}/${tema.slug}" class="text-decoration-none">
                                                <img src="${iconSrc}" width="80" onerror="this.src='/assets/images/default-tema.png'" />
                                                <span>${tema.nama}</span>
                                                <small>${jumlahPeraturan} Peraturan</small>
                                            </a>
                                        </div>`;
                                    temaContainer.append(temaHtml);
                                }
                            });
                        } else {
                            temaContainer.html(
                                '<p class="text-center">Belum ada tema dokumen yang tersedia</p>');
                        }
                    },
                    error: function(error) {
                        console.error('Error loading tema dokumen:', error);
                        $('#tema-dokumen-container').html(
                            '<p class="text-center">Gagal memuat data tema dokumen</p>');
                    }
                });
            }
        });
    </script>
</body>

</html>
