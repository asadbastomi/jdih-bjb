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

        /* Statistics Section - Symmetrical Grid Design */
        .stats-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            position: relative;
            overflow: hidden;
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
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 4rem;
            text-align: center;
            position: relative;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stats-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: #fff;
            border-radius: var(--border-radius-xl);
            padding: 0;
            box-shadow: var(--shadow-xl);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--card-color, var(--gradient-primary));
        }

        .stat-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-color: var(--card-color, #6366f1);
        }

        .stat-icon-wrapper {
            padding: 32px 24px 20px;
            text-align: center;
        }

        .stat-icon {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-icon::after {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            background: inherit;
            opacity: 0.15;
            z-index: -1;
            filter: blur(8px);
        }

        .stat-icon i {
            font-size: 2.5rem;
            color: #fff;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .stat-content {
            padding: 0 24px 32px;
            text-align: center;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 8px;
            line-height: 1;
            background: var(--card-color, var(--gradient-primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: inline-block;
        }

        .stat-label {
            font-size: 1.1rem;
            color: var(--gray-600);
            font-weight: 700;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-trend {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.9rem;
            color: var(--success-color);
            font-weight: 600;
            padding: 8px 16px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
            border-radius: 20px;
            margin-top: 8px;
        }

        .stat-trend i {
            font-size: 1.2rem;
        }

        .stat-trend span {
            color: var(--gray-700);
        }

        /* Gallery Section */
        .gallery-section {
            padding: 100px 0;
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        .gallery-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--gradient-primary);
        }

        .gallery-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 1rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .gallery-subtitle {
            font-size: 1.2rem;
            color: var(--gray-600);
            text-align: center;
            margin-bottom: 3rem;
            font-weight: 500;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
            min-height: 200px;
        }

        .gallery-item {
            position: relative;
            border-radius: var(--border-radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            aspect-ratio: 4/3;
            width: 100%;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .gallery-item:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.9) 0%, rgba(139, 92, 246, 0.9) 100%);
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.4s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .gallery-loader {
            padding: 60px;
            text-align: center;
        }

        .charts-section {
            margin-top: 40px;
        }

        .chart-legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--gray-700);
            padding: 8px 16px;
            background: var(--gray-50);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .legend-item:hover {
            background: var(--gradient-primary);
            color: #fff;
            transform: translateY(-2px);
        }

        .legend-item i {
            font-size: 0.8rem;
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
            
            <!-- Symmetrical Statistics Grid -->
            <div class="stats-grid">
                <div class="stat-card animate-on-scroll scale-in delay-100" data-color="#3498DB">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #3498DB 0%, #2980b9 100%);">
                            <i class="mdi mdi-book-open-page-variant"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-plugin="counterup">{{ $totalperda }}</div>
                        <div class="stat-label">{{ translateIt('Total Perda') }}</div>
                        <div class="stat-trend">
                            <i class="mdi mdi-trending-up"></i>
                            <span>Dokumen Resmi</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card animate-on-scroll scale-in delay-200" data-color="#2ECC71">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #2ECC71 0%, #27ae60 100%);">
                            <i class="mdi mdi-file-document"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-plugin="counterup">{{ $totalperwal }}</div>
                        <div class="stat-label">{{ translateIt('Total Perwal') }}</div>
                        <div class="stat-trend">
                            <i class="mdi mdi-trending-up"></i>
                            <span>Peraturan Walikota</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card animate-on-scroll scale-in delay-300" data-color="#F39C12">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #F39C12 0%, #f39c12 100%);">
                            <i class="mdi mdi-gavel"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-plugin="counterup">{{ $totalkepwal }}</div>
                        <div class="stat-label">{{ translateIt('Keputusan Wali Kota') }}</div>
                        <div class="stat-trend">
                            <i class="mdi mdi-trending-up"></i>
                            <span>SK Wali Kota</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card animate-on-scroll scale-in delay-400" data-color="#9B59B6">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #9B59B6 0%, #8e44ad 100%);">
                            <i class="mdi mdi-clipboard-list"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-plugin="counterup">{{ $totalpropemperda }}</div>
                        <div class="stat-label">{{ translateIt('Propemperda') }}</div>
                        <div class="stat-trend">
                            <i class="mdi mdi-trending-up"></i>
                            <span>Program Pembentukan</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card animate-on-scroll scale-in delay-500" data-color="#E74C3C">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #E74C3C 0%, #c0392b 100%);">
                            <i class="mdi mdi-book-multiple"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-plugin="counterup">{{ $totalmonografihukum ?? 0 }}</div>
                        <div class="stat-label">{{ translateIt('Monografi Hukum') }}</div>
                        <div class="stat-trend">
                            <i class="mdi mdi-trending-up"></i>
                            <span>Pustaka Hukum</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card animate-on-scroll scale-in delay-600" data-color="#1ABC9C">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #1ABC9C 0%, #16a085 100%);">
                            <i class="mdi mdi-scale-balance"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" data-plugin="counterup">{{ $totalputusan ?? 0 }}</div>
                        <div class="stat-label">{{ translateIt('Putusan') }}</div>
                        <div class="stat-trend">
                            <i class="mdi mdi-trending-up"></i>
                            <span>Putusan Pengadilan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section mt-5">
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="chart-container">
                            <h4 class="chart-title">{{ translateIt('Tren Produk Hukum per Tahun') }}</h4>
                            <div class="chart-legend mb-3">
                                <span class="legend-item"><i class="mdi mdi-circle" style="color: #3498DB"></i> Perda</span>
                                <span class="legend-item"><i class="mdi mdi-circle" style="color: #2ECC71"></i> Perwal</span>
                                <span class="legend-item"><i class="mdi mdi-circle" style="color: #F39C12"></i> Keputusan</span>
                                <span class="legend-item"><i class="mdi mdi-circle" style="color: #9B59B6"></i> Propemperda</span>
                                <span class="legend-item"><i class="mdi mdi-circle" style="color: #E74C3C"></i> Monografi</span>
                                <span class="legend-item"><i class="mdi mdi-circle" style="color: #1ABC9C"></i> Putusan</span>
                            </div>
                            <div id="morris-bar-stacked" style="height: 300px;" class="morris-chart"
                                data-colors="#3498DB,#2ECC71,#F39C12,#9B59B6,#E74C3C,#1ABC9C"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="chart-container h-100">
                            <h4 class="chart-title">{{ translateIt('Status Berlaku') }}</h4>
                            <div id="pie-chart-status" class="ct-chart" style="height: 280px;"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="chart-container">
                            <h4 class="chart-title">{{ translateIt('Paling Banyak Dicari') }}</h4>
                            <div id="pie-chart-pencarian" class="ct-chart" style="height: 280px;"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="chart-container">
                            <h4 class="chart-title">{{ translateIt('Paling Banyak Diunduh') }}</h4>
                            <div id="pie-chart-unduhan" class="ct-chart" style="height: 280px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leaflet CSS and JS for Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="content-card">
                        <h4 class="content-title">KELURAHAN SADAR HUKUM</h4>
                        
                        <!-- Search/Filter Section -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold">Cari Kelurahan</label>
                                    <input type="text" id="searchKelurahan" class="form-control" placeholder="Ketik nama kelurahan...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold">Filter Kecamatan</label>
                                    <select id="filterKecamatan" class="form-control">
                                        <option value="">Semua Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold">Filter Status</label>
                                    <select id="filterStatus" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Leaflet Map for Kelurahan Sadar Hukum -->
                        <div id="kelurahanMap" style="height: 450px; width: 100%; border-radius: 10px; margin-bottom: 15px;"></div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p class="text-muted small mb-0">
                                    <i class="mdi mdi-information-outline"></i> Klik pada marker untuk melihat detail kelurahan sadar hukum
                                </p>
                            </div>
                            <div class="col-md-6 text-right">
                                <div id="kelurahanStats" class="text-primary">
                                    <i class="mdi mdi-counter"></i> Total: <span id="totalKelurahan">0</span> | 
                                    <i class="mdi mdi-check-circle"></i> Aktif: <span id="aktifKelurahan">0</span>
                                </div>
                            </div>
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

    <!-- Gallery Section -->
    <section class="gallery-section animate-on-scroll fade-in-up">
        <div class="container">
            <h3 class="gallery-title animate-on-scroll fade-in-up">{{ translateIt('Galeri Kegiatan') }}</h3>
            <p class="gallery-subtitle">{{ translateIt('Dokumentasi kegiatan dan aktivitas JDIH Kota Banjarbaru') }}</p>
            
            <div class="gallery-grid" id="gallery-container">
                <div class="text-center w-100">
                    <div class="gallery-loader">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Memuat galeri...</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="/galeri" class="btn btn-primary btn-lg rounded-pill px-5">
                    <i class="mdi mdi-images mr-2"></i> {{ translateIt('Lihat Semua Galeri') }}
                </a>
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

    <!-- Accessibility Widget -->
    <div id="accessibilityWidget" style="position: fixed !important; bottom: 0 !important; right: 0 !important; z-index: 2147483647 !important; display: block !important; opacity: 1 !important; visibility: visible !important; pointer-events: none !important;">
        <button id="accessibilityToggle" class="accessibility-toggle" aria-label="Opsi Aksesibilitas" style="position: fixed !important; bottom: 30px !important; right: 30px !important; width: 70px !important; height: 70px !important; display: flex !important; align-items: center !important; justify-content: center !important; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%) !important; border-radius: 50% !important; border: 4px solid white !important; box-shadow: 0 8px 30px rgba(99, 102, 241, 0.4), 0 4px 15px rgba(139, 92, 246, 0.3) !important; z-index: 2147483648 !important; cursor: pointer !important; pointer-events: auto !important; opacity: 1 !important; visibility: visible !important; margin: 0 !important; padding: 0 !important; left: auto !important; top: auto !important; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important; outline: none !important;">
            <div class="accessibility-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="32" height="32">
                    <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9H15V22H13V16H11V22H9V9H3V7H21V9Z"/>
                </svg>
            </div>
        </button>
        
        <div id="accessibilityPanel" class="accessibility-panel" role="dialog" aria-modal="true" aria-labelledby="a11y-title">
            <div class="accessibility-header">
                <h3 id="a11y-title">Opsi Aksesibilitas</h3>
                <button class="close-panel" aria-label="Tutup panel aksesibilitas">&times;</button>
            </div>
            
            <div class="accessibility-content">
                <!-- Font Size -->
                <div class="accessibility-group">
                    <label>Ukuran Font</label>
                    <div class="accessibility-controls">
                        <button class="btn-access btn-access-sm" data-action="font-size-decrease" aria-label="Perkecil font">
                            <i class="mdi mdi-minus"></i>
                        </button>
                        <span class="font-size-display" id="fontSizeDisplay">100%</span>
                        <button class="btn-access btn-access-sm" data-action="font-size-increase" aria-label="Perbesar font">
                            <i class="mdi mdi-plus"></i>
                        </button>
                        <button class="btn-access btn-access-sm" data-action="font-size-reset" aria-label="Reset ukuran font">
                            <i class="mdi mdi-undo"></i>
                        </button>
                    </div>
                </div>

                <!-- Contrast -->
                <div class="accessibility-group">
                    <label>Kontras</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="contrast-normal" aria-label="Kontras normal">
                            <i class="mdi mdi-circle"></i> Normal
                        </button>
                        <button class="btn-access" data-action="contrast-high" aria-label="Kontras tinggi">
                            <i class="mdi mdi-circle-outline"></i> Tinggi
                        </button>
                        <button class="btn-access" data-action="contrast-dark" aria-label="Mode gelap">
                            <i class="mdi mdi-weather-night"></i> Gelap
                        </button>
                    </div>
                </div>

                <!-- Saturation -->
                <div class="accessibility-group">
                    <label>Saturasi</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="saturation-color" aria-label="Warna penuh">
                            <i class="mdi mdi-palette"></i> Warna
                        </button>
                        <button class="btn-access" data-action="saturation-grayscale" aria-label="Skala abu-abu">
                            <i class="mdi mdi-format-color-reset"></i> Abu-abu
                        </button>
                    </div>
                </div>

                <!-- Text Position -->
                <div class="accessibility-group">
                    <label>Posisi Teks</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="text-left" aria-label="Rata kiri">
                            <i class="mdi mdi-format-align-left"></i>
                        </button>
                        <button class="btn-access" data-action="text-center" aria-label="Rata tengah">
                            <i class="mdi mdi-format-align-center"></i>
                        </button>
                        <button class="btn-access" data-action="text-justify" aria-label="Rata kanan-kiri">
                            <i class="mdi mdi-format-align-justify"></i>
                        </button>
                    </div>
                </div>

                <!-- Font Style -->
                <div class="accessibility-group">
                    <label>Font Mudah Dibaca</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="font-default" aria-label="Font default">
                            <i class="mdi mdi-format-text"></i> Default
                        </button>
                        <button class="btn-access" data-action="font-readable" aria-label="Font mudah dibaca">
                            <i class="mdi mdi-text"></i> Sans-serif
                        </button>
                    </div>
                </div>

                <!-- Highlight Headings -->
                <div class="accessibility-group">
                    <label>Sorotan Judul</label>
                    <div class="accessibility-controls">
                        <label class="accessibility-checkbox">
                            <input type="checkbox" id="highlightHeadings">
                            <span>Sorot Judul</span>
                        </label>
                    </div>
                </div>

                <!-- Highlight Links -->
                <div class="accessibility-group">
                    <label>Sorotan Tautan</label>
                    <div class="accessibility-controls">
                        <label class="accessibility-checkbox">
                            <input type="checkbox" id="highlightLinks">
                            <span>Sorot Tautan</span>
                        </label>
                    </div>
                </div>

                <!-- Text to Speech -->
                <div class="accessibility-group">
                    <label>Teks ke Suara</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="tts-toggle" id="ttsToggle" aria-label="Toggle teks ke suara">
                            <i class="mdi mdi-volume-up"></i> <span>Mulai</span>
                        </button>
                        <button class="btn-access" data-action="tts-stop" id="ttsStop" aria-label="Hentikan teks ke suara">
                            <i class="mdi mdi-stop"></i>
                        </button>
                    </div>
                </div>

                <!-- Stop Animations -->
                <div class="accessibility-group">
                    <label>Gerakan</label>
                    <div class="accessibility-controls">
                        <label class="accessibility-checkbox">
                            <input type="checkbox" id="stopAnimations">
                            <span>Hentikan Animasi</span>
                        </label>
                    </div>
                </div>

                <!-- Reset All -->
                <div class="accessibility-group">
                    <label>Reset</label>
                    <div class="accessibility-controls">
                        <button class="btn-access" data-action="reset-all" aria-label="Reset semua pengaturan aksesibilitas">
                            <i class="mdi mdi-restore"></i> Reset Semua
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Accessibility Widget Styles - Matching Chat Widget Design */

        /* Widget Container */
        #accessibilityWidget {
            position: fixed !important;
            bottom: 0 !important;
            right: 0 !important;
            z-index: 2147483647 !important;
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
            width: auto !important;
            height: auto !important;
        }

        /* Floating Button - MATCH CHAT WIDGET STYLE */
        .accessibility-toggle {
            position: fixed !important;
            bottom: 30px !important;
            right: 30px !important;
            width: 70px !important;
            height: 70px !important;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%) !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.4),
                        0 4px 15px rgba(139, 92, 246, 0.3) !important;
            z-index: 2147483648 !important;
            cursor: pointer !important;
            border: 4px solid white !important;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
            outline: none !important;
            pointer-events: auto !important;
            opacity: 1 !important;
            visibility: visible !important;
            margin: 0 !important;
            padding: 0 !important;
            max-width: none !important;
            max-height: none !important;
            clip: none !important;
            clip-path: none !important;
            left: auto !important;
            top: auto !important;
            right: 30px !important;
            bottom: 30px !important;
            min-width: 70px !important;
            min-height: 70px !important;
        }

        .accessibility-toggle:hover {
            transform: translateY(-4px) scale(1.08);
            box-shadow: 0 12px 40px rgba(99, 102, 241, 0.5),
                        0 6px 20px rgba(139, 92, 246, 0.4);
        }

        .accessibility-toggle:active {
            transform: translateY(-2px) scale(1.02);
        }

        .accessibility-toggle:focus {
            outline: 3px solid rgba(99, 102, 241, 0.5);
            outline-offset: 3px;
        }

        .accessibility-icon {
            color: white;
            transition: all 0.3s ease;
        }

        .accessibility-icon svg {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        /* Accessibility Menu Panel - MATCH CHAT WIDGET HEIGHT */
        .accessibility-panel {
            position: fixed !important;
            bottom: 110px !important;
            right: 30px !important;
            width: 400px !important;
            max-width: calc(100vw - 80px) !important;
            background: white;
            border-radius: 24px;
            box-shadow: 0 30px 100px rgba(0, 0, 0, 0.35),
                        0 15px 40px rgba(0, 0, 0, 0.25);
            z-index: 2147483647 !important;
            opacity: 0 !important;
            visibility: hidden !important;
            transform: translateY(30px) scale(0.95) !important;
            transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        visibility 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
            display: flex !important;
            flex-direction: column !important;
            overflow: hidden !important;
            pointer-events: none !important;
            border: 1px solid rgba(99, 102, 241, 0.15);
            max-height: 85vh;
            left: auto !important;
            top: auto !important;
        }

        .accessibility-panel.active {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) scale(1) !important;
            pointer-events: auto !important;
        }

        .accessibility-header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .accessibility-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: header-shine 8s linear infinite;
        }

        @keyframes header-shine {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .accessibility-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin: 0;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .close-panel {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: white;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            outline: none;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 24px;
            position: relative;
            z-index: 1;
        }

        .close-panel:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: rotate(90deg) scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .close-panel:focus {
            outline: 2px solid white;
            outline-offset: 2px;
        }

        .accessibility-content {
            flex: 1;
            overflow-y: auto;
            padding: 28px 32px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            min-height: 0;
        }

        .accessibility-content::-webkit-scrollbar {
            width: 6px;
        }

        .accessibility-content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .accessibility-content::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        .accessibility-group {
            margin-bottom: 0;
        }

        .accessibility-group label {
            display: block;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
            font-size: 15px;
            letter-spacing: 0.3px;
        }

        .accessibility-controls {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-access {
            flex: 1;
            min-width: calc(50% - 6px);
            padding: 16px 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            cursor: pointer;
            text-align: center;
            font-size: 15px;
            font-weight: 600;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .btn-access:hover {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-color: #6366f1;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-access.active {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border-color: #6366f1;
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-access:focus {
            outline: 3px solid rgba(99, 102, 241, 0.4);
            outline-offset: 2px;
        }

        .btn-access i {
            font-size: 20px;
            color: #6366f1;
            transition: all 0.3s ease;
        }

        .btn-access:hover i,
        .btn-access.active i {
            color: white;
        }

        .accessibility-checkbox {
            flex: 1;
            min-width: calc(50% - 6px);
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 16px 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            user-select: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            font-weight: 600;
            color: #475569;
            font-size: 15px;
        }

        .accessibility-checkbox:hover {
            border-color: #6366f1;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
        }

        .accessibility-checkbox input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #6366f1;
            flex-shrink: 0;
        }

        .accessibility-checkbox input:checked + span {
            color: white;
        }

        .accessibility-checkbox span {
            font-size: 15px;
            font-weight: 600;
            color: inherit;
        }

        /* Stop Animations Effect */
        body.accessibility-stop-animations *,
        body.accessibility-stop-animations *::before,
        body.accessibility-stop-animations *::after {
            animation: none !important;
            transition: none !important;
            transform: none !important;
        }

        body.accessibility-stop-animations .page-loader {
            display: none !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .accessibility-toggle {
                bottom: 20px;
                right: 20px;
                width: 60px;
                height: 60px;
            }

            .accessibility-panel {
                bottom: 90px;
                right: 15px;
                left: 15px;
                width: auto;
                max-width: calc(100vw - 30px);
                max-height: calc(100vh - 130px);
                border-radius: 20px;
            }

            .accessibility-header {
                padding: 20px 24px;
            }

            .accessibility-header h3 {
                font-size: 16px;
            }

            .accessibility-content {
                padding: 20px 24px;
                gap: 16px;
            }

            .btn-access {
                padding: 14px 16px;
                font-size: 14px;
            }

            .accessibility-checkbox {
                padding: 14px 16px;
                font-size: 14px;
            }
        }

        /* Reduced Motion for Accessibility */
        @media (prefers-reduced-motion: reduce) {
            .accessibility-toggle,
            .accessibility-panel {
                transition: none !important;
            }
            
            .accessibility-toggle:hover {
                transform: none !important;
            }
        }

        /* Force widget to be visible during page load */
        body.loading #accessibilityWidget,
        body.loading #accessibilityWidget *,
        body.loading .accessibility-toggle {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        'use strict';

        var accessibilityToggle = document.getElementById('accessibilityToggle');
        var accessibilityPanel = document.getElementById('accessibilityPanel');
        var closePanel = document.querySelector('.close-panel');
        var body = document.body;

        // Check if elements exist
        if (!accessibilityToggle || !accessibilityPanel) {
            console.error('Accessibility widget elements not found');
            console.log('accessibilityToggle:', accessibilityToggle);
            console.log('accessibilityPanel:', accessibilityPanel);
            return;
        }

        // Ensure panel is properly initialized
        console.log('Accessibility widget initializing...');
        console.log('Toggle button found:', !!accessibilityToggle);
        console.log('Panel found:', !!accessibilityPanel);
        console.log('Panel classes:', accessibilityPanel.className);

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
            console.log('Toggle clicked');
            accessibilityPanel.classList.toggle('active');
            if (accessibilityPanel.classList.contains('active')) {
                closePanel.focus();
            }
        });

        // Close panel
        if (closePanel) {
            closePanel.addEventListener('click', function() {
                accessibilityPanel.classList.remove('active');
                accessibilityToggle.focus();
            });
        }

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


        // Text to Speech
        var synthesis = window.speechSynthesis;
        var currentUtterance = null;

        var ttsToggleBtn = document.getElementById('ttsToggle');
        var ttsStopBtn = document.getElementById('ttsStop');
        
        // Set Indonesian voice
        function getIndonesianVoice() {
            var voices = synthesis.getVoices();
            var indonesianVoice = voices.find(function(voice) {
                return voice.lang.toLowerCase() === 'id-id' || voice.lang.toLowerCase() === 'indonesian';
            });
            return indonesianVoice || null;
        }

        // Load voices (needed for some browsers)
        if (synthesis.onvoiceschanged !== undefined) {
            synthesis.onvoiceschanged = function() {
                var voices = synthesis.getVoices();
                console.log('Available voices:', voices.length);
            };
        }

        if (ttsToggleBtn) {
            ttsToggleBtn.addEventListener('click', function() {
                var btn = this;
                var span = btn.querySelector('span');

                if (!state.ttsEnabled) {
                    state.ttsEnabled = true;
                    span.textContent = 'Membaca';
                    btn.classList.add('active');

                    var text = document.body.innerText;
                    currentUtterance = new SpeechSynthesisUtterance(text);
                    currentUtterance.rate = 0.9;
                    currentUtterance.pitch = 1;
                    currentUtterance.lang = 'id-ID';
                    
                    // Try to use Indonesian voice
                    var indonesianVoice = getIndonesianVoice();
                    if (indonesianVoice) {
                        currentUtterance.voice = indonesianVoice;
                        console.log('Using Indonesian voice:', indonesianVoice.name);
                    }

                    synthesis.speak(currentUtterance);

                    currentUtterance.onend = function() {
                        state.ttsEnabled = false;
                        span.textContent = 'Mulai';
                        btn.classList.remove('active');
                    };

                    currentUtterance.onerror = function(event) {
                        console.error('TTS Error:', event.error);
                        state.ttsEnabled = false;
                        span.textContent = 'Mulai';
                        btn.classList.remove('active');
                    };
                } else {
                    synthesis.cancel();
                    state.ttsEnabled = false;
                    span.textContent = 'Mulai';
                    btn.classList.remove('active');
                }
            });
        }
        
        if (ttsStopBtn) {
            ttsStopBtn.addEventListener('click', function() {
                synthesis.cancel();
                state.ttsEnabled = false;
                var btn = document.getElementById('ttsToggle');
                if (btn) {
                    btn.querySelector('span').textContent = 'Mulai';
                    btn.classList.remove('active');
                }
            });
        }

        // Font Size Controls
        var fontSizeDisplay = document.getElementById('fontSizeDisplay');
        
        function updateFontSizeDisplay() {
            if (fontSizeDisplay) {
                fontSizeDisplay.textContent = state.fontSize + '%';
            }
        }

        document.addEventListener('click', function(e) {
            var action = e.target.closest('[data-action]');
            if (!action) return;

            switch(action.dataset.action) {
                case 'font-size-decrease':
                    if (state.fontSize > 80) {
                        state.fontSize -= 10;
                        body.style.fontSize = state.fontSize + '%';
                        updateFontSizeDisplay();
                    }
                    break;

                case 'font-size-increase':
                    if (state.fontSize < 150) {
                        state.fontSize += 10;
                        body.style.fontSize = state.fontSize + '%';
                        updateFontSizeDisplay();
                    }
                    break;

                case 'font-size-reset':
                    state.fontSize = 100;
                    body.style.fontSize = '100%';
                    updateFontSizeDisplay();
                    break;

                case 'contrast-normal':
                    body.style.filter = '';
                    body.style.backgroundColor = '';
                    body.style.color = '';
                    state.contrast = 'normal';
                    break;

                case 'contrast-high':
                    body.style.filter = 'contrast(1.5) brightness(1.1)';
                    body.style.backgroundColor = '#ffffff';
                    body.style.color = '#000000';
                    state.contrast = 'high';
                    break;

                case 'contrast-dark':
                    body.style.filter = 'invert(0.9) hue-rotate(180deg)';
                    body.style.backgroundColor = '#1a1a1a';
                    body.style.color = '#ffffff';
                    state.contrast = 'dark';
                    break;

                case 'saturation-color':
                    body.style.filter = body.style.filter.replace('grayscale(100%)', '').replace('saturate(0%)', '');
                    break;

                case 'saturation-grayscale':
                    body.style.filter = 'grayscale(100%)';
                    break;

                case 'text-left':
                    body.style.textAlign = 'left';
                    break;

                case 'text-center':
                    body.style.textAlign = 'center';
                    break;

                case 'text-justify':
                    body.style.textAlign = 'justify';
                    break;

                case 'font-default':
                    body.style.fontFamily = '';
                    state.font = 'default';
                    break;

                case 'font-readable':
                    body.style.fontFamily = 'Arial, Helvetica, sans-serif';
                    state.font = 'readable';
                    break;

                case 'reset-all':
                    resetAllAccessibility();
                    break;
            }
        });

        // Highlight Headings
        var highlightHeadingsCheckbox = document.getElementById('highlightHeadings');
        
        if (highlightHeadingsCheckbox) {
            highlightHeadingsCheckbox.addEventListener('change', function() {
                state.highlightHeadings = this.checked;
                var headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
                
                headings.forEach(function(heading) {
                    if (state.highlightHeadings) {
                        heading.style.backgroundColor = '#fffacd';
                        heading.style.padding = '8px';
                        heading.style.borderLeft = '4px solid #6366f1';
                        heading.style.borderRadius = '4px';
                    } else {
                        heading.style.backgroundColor = '';
                        heading.style.padding = '';
                        heading.style.borderLeft = '';
                        heading.style.borderRadius = '';
                    }
                });
            });
        }

        // Highlight Links
        var highlightLinksCheckbox = document.getElementById('highlightLinks');
        
        if (highlightLinksCheckbox) {
            highlightLinksCheckbox.addEventListener('change', function() {
                state.highlightLinks = this.checked;
                var links = document.querySelectorAll('a');
                
                links.forEach(function(link) {
                    if (state.highlightLinks) {
                        link.style.backgroundColor = '#ffeb3b';
                        link.style.color = '#000';
                        link.style.padding = '2px 4px';
                        link.style.borderRadius = '3px';
                        link.style.textDecoration = 'underline';
                    } else {
                        link.style.backgroundColor = '';
                        link.style.color = '';
                        link.style.padding = '';
                        link.style.borderRadius = '';
                        link.style.textDecoration = '';
                    }
                });
            });
        }

        // Stop Animations
        var stopAnimationsCheckbox = document.getElementById('stopAnimations');
        
        if (stopAnimationsCheckbox) {
            stopAnimationsCheckbox.addEventListener('change', function() {
                state.stopAnimations = this.checked;
                if (this.checked) {
                    body.classList.add('accessibility-stop-animations');
                } else {
                    body.classList.remove('accessibility-stop-animations');
                }
            });
        }

        // Reset All Function
        function resetAllAccessibility() {
            // Reset font size
            state.fontSize = 100;
            body.style.fontSize = '100%';
            updateFontSizeDisplay();

            // Reset contrast
            body.style.filter = '';
            body.style.backgroundColor = '';
            body.style.color = '';
            state.contrast = 'normal';

            // Reset text alignment
            body.style.textAlign = '';

            // Reset font
            body.style.fontFamily = '';
            state.font = 'default';

            // Reset headings highlight
            state.highlightHeadings = false;
            if (highlightHeadingsCheckbox) {
                highlightHeadingsCheckbox.checked = false;
            }
            var headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
            headings.forEach(function(heading) {
                heading.style.backgroundColor = '';
                heading.style.padding = '';
                heading.style.borderLeft = '';
                heading.style.borderRadius = '';
            });

            // Reset links highlight
            state.highlightLinks = false;
            if (highlightLinksCheckbox) {
                highlightLinksCheckbox.checked = false;
            }
            var links = document.querySelectorAll('a');
            links.forEach(function(link) {
                link.style.backgroundColor = '';
                link.style.color = '';
                link.style.padding = '';
                link.style.borderRadius = '';
                link.style.textDecoration = '';
            });

            // Reset animations
            state.stopAnimations = false;
            if (stopAnimationsCheckbox) {
                stopAnimationsCheckbox.checked = false;
            }
            body.classList.remove('accessibility-stop-animations');

            // Stop TTS
            synthesis.cancel();
            state.ttsEnabled = false;
            var ttsToggleBtn = document.getElementById('ttsToggle');
            if (ttsToggleBtn) {
                ttsToggleBtn.querySelector('span').textContent = 'Mulai';
                ttsToggleBtn.classList.remove('active');
            }

            console.log('All accessibility settings reset');
        }

        // Initialize
        if (stopAnimationsCheckbox) {
            stopAnimationsCheckbox.checked = false;
        }
        if (highlightHeadingsCheckbox) {
            highlightHeadingsCheckbox.checked = false;
        }
        if (highlightLinksCheckbox) {
            highlightLinksCheckbox.checked = false;
        }
        updateFontSizeDisplay();
        
        console.log('Accessibility widget initialized successfully');
        
        // Ensure panel starts hidden
        accessibilityPanel.classList.remove('active');
        
        // Force reflow to ensure CSS is applied
        void accessibilityPanel.offsetWidth;
        
        console.log('Panel initial state:', {
            opacity: getComputedStyle(accessibilityPanel).opacity,
            visibility: getComputedStyle(accessibilityPanel).visibility,
            transform: getComputedStyle(accessibilityPanel).transform,
            hasActiveClass: accessibilityPanel.classList.contains('active')
        });
        
        // Force visibility after page load
        setTimeout(function() {
            body.classList.remove('loading');
            accessibilityToggle.style.display = 'flex';
            accessibilityToggle.style.opacity = '1';
            accessibilityToggle.style.visibility = 'visible';
            console.log('Accessibility widget forced to be visible');
        }, 100);
    });
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
                slider.slides.forEach(function(slide, index) {
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
                setTimeout(function() {
                    slider.progressBar.style.transition = 'width ' + slider.autoplayDelay + 'ms linear';
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
            slider.prevBtn.addEventListener('click', function() {
                prevSlide();
            });

            slider.nextBtn.addEventListener('click', function() {
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
            document.addEventListener('keydown', function(e) {
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
                    var skmData = {
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
                                return Math.round(value / skmData.series.reduce(sum) *
                                    100) + '%';
                            }
                        }],
                        ['screen and (min-width: 1024px)', {
                            showLabel: true,
                            labelOffset: 60,
                            chartPadding: 20
                        }]
                    ];
                    new Chartist.Pie('#pie-chart', skmData, options, responsiveOptions);
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
            
            // Memuat galeri untuk homepage
            loadGalleryHomepage();
            
            // Initialize Kelurahan Sadar Hukum Map
            initKelurahanMap();
            
            function initKelurahanMap() {
                // Initialize map centered on Banjarbaru
                var map = L.map('kelurahanMap').setView([-3.4333, 114.8167], 12);
                
                // Add OpenStreetMap tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                
                // Store all markers for filtering
                var allMarkers = [];
                var allKelurahanData = [];
                
                // Custom icon for kelurahan markers
                function getKelurahanIcon(status) {
                    var color = status ? '#10b981' : '#ef4444'; // Green for active, Red for inactive
                    return L.divIcon({
                        className: 'custom-div-icon',
                        html: "<div style='background-color: " + color + "; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;'><i style='color: white; font-size: 16px;' class='mdi mdi-home'></i></div>",
                        iconSize: [30, 30],
                        iconAnchor: [15, 15],
                        popupAnchor: [0, -15]
                    });
                }
                
                // Create popup content
                function createPopupContent(kelurahan) {
                    var statusColor = kelurahan.is_active ? '#10b981' : '#ef4444';
                    var statusText = kelurahan.is_active ? 'Aktif' : 'Tidak Aktif';
                    
                    // Helper function to safely extract kecamatan name
                    function getKecamatanName(kelurahan) {
                        // Priority 1: Check if nama_kecamatan is a string
                        if (kelurahan.nama_kecamatan && typeof kelurahan.nama_kecamatan === 'string' && kelurahan.nama_kecamatan.trim() !== '') {
                            return kelurahan.nama_kecamatan.trim();
                        }
                        
                        // Priority 2: Check if nama_kecamatan is an object with nama_kecamatan property
                        if (kelurahan.nama_kecamatan && typeof kelurahan.nama_kecamatan === 'object') {
                            if (kelurahan.nama_kecamatan.nama_kecamatan && typeof kelurahan.nama_kecamatan.nama_kecamatan === 'string') {
                                return kelurahan.nama_kecamatan.nama_kecamatan.trim();
                            }
                        }
                        
                        // Priority 3: Check if kecamatan is a string
                        if (kelurahan.kecamatan && typeof kelurahan.kecamatan === 'string' && kelurahan.kecamatan.trim() !== '') {
                            return kelurahan.kecamatan.trim();
                        }
                        
                        // Priority 4: Check if kecamatan is an object with nama_kecamatan property
                        if (kelurahan.kecamatan && typeof kelurahan.kecamatan === 'object') {
                            if (kelurahan.kecamatan.nama_kecamatan && typeof kelurahan.kecamatan.nama_kecamatan === 'string') {
                                return kelurahan.kecamatan.nama_kecamatan.trim();
                            }
                        }
                        
                        // Priority 5: Check nested structures
                        if (kelurahan.kecamatan && kelurahan.kecamatan.kecamatan && typeof kelurahan.kecamatan.kecamatan.nama_kecamatan === 'string') {
                            return kelurahan.kecamatan.kecamatan.nama_kecamatan.trim();
                        }
                        
                        // Default fallback
                        return 'N/A';
                    }
                    
                    var namaKecamatan = getKecamatanName(kelurahan);
                    
                    return `
                        <div style="min-width: 200px;">
                            <h6 style="margin: 0 0 10px 0; color: #6366f1; font-weight: 700;">${kelurahan.nama_kelurahan || 'N/A'}</h6>
                            <div style="margin-bottom: 8px;">
                                <strong>Kecamatan:</strong> ${namaKecamatan}
                            </div>
                            <div style="margin-bottom: 8px;">
                                <strong>Status Sadar Hukum:</strong> 
                                <span style="color: ${statusColor}; font-weight: 600;">
                                    ${kelurahan.is_active ? 'Aktif' : 'Tidak Aktif'}
                                </span>
                            </div>
                            ${kelurahan.pos_bankum ? `
                            <div style="margin-bottom: 8px;">
                                <strong>POS BANTUAN HUKUM:</strong><br>
                                ${kelurahan.pos_bankum}
                            </div>
                            ` : ''}
                            ${kelurahan.jumlah_pos ? `
                            <div style="margin-bottom: 8px;">
                                <strong>Jumlah POS:</strong> ${kelurahan.jumlah_pos}
                            </div>
                            ` : ''}
                            ${kelurahan.keterangan ? `
                            <div style="margin-bottom: 8px;">
                                <strong>Keterangan:</strong><br>
                                <small>${kelurahan.keterangan}</small>
                            </div>
                            ` : ''}
                            <div style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #e5e7eb;">
                                <a href="/kelurahan-sadar-hukum/${kelurahan.id}" target="_blank" style="color: #6366f1; text-decoration: none; font-weight: 600;">
                                    Lihat Detail <i class="mdi mdi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    `;
                }
                
                // Add marker to map and track it
                function addMarker(kelurahan) {
                    if (kelurahan.latitude && kelurahan.longitude) {
                        var marker = L.marker([kelurahan.latitude, kelurahan.longitude], {
                            icon: getKelurahanIcon(kelurahan.is_active)
                        }).addTo(map);
                        
                        marker.bindPopup(createPopupContent(kelurahan));
                        
                        // Store marker and data for filtering
                        allMarkers.push({
                            marker: marker,
                            data: kelurahan
                        });
                        
                        return marker;
                    }
                    return null;
                }
                
                // Load kelurahan data from API
                $.ajax({
                    url: '/api/kelurahan-sadar-hukum',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log('Kelurahan data loaded:', response);
                        
                        // Clear existing markers
                        allMarkers.forEach(function(item) {
                            map.removeLayer(item.marker);
                        });
                        allMarkers = [];
                        allKelurahanData = [];
                        
                            // Populate kecamatan filter
                            var kecamatans = new Set();
                            
                            if (response && response.data && response.data.length > 0) {
                                allKelurahanData = response.data;
                                
                                // Add markers and collect kecamatans
                                response.data.forEach(function(kelurahan) {
                                    addMarker(kelurahan);
                                    // Use nama_kecamatan (string) instead of kecamatan (object)
                                    if (kelurahan.nama_kecamatan) {
                                        kecamatans.add(kelurahan.nama_kecamatan);
                                    }
                                });
                                
                                // Update kecamatan filter options
                                var selectKecamatan = $('#filterKecamatan');
                                selectKecamatan.find('option:not(:first)').remove();
                                // Sort kecamatans alphabetically
                                var sortedKecamatans = Array.from(kecamatans).sort();
                                sortedKecamatans.forEach(function(kecamatan) {
                                    selectKecamatan.append('<option value="' + kecamatan + '">' + kecamatan + '</option>');
                                });
                            
                            // Update stats
                            var total = response.data.length;
                            var aktif = response.data.filter(function(k) { return k.is_active; }).length;
                            $('#totalKelurahan').text(total);
                            $('#aktifKelurahan').text(aktif);
                            
                            // Fit bounds to show all markers
                            if (allMarkers.length > 0) {
                                var group = new L.featureGroup(allMarkers.map(function(item) { return item.marker; }));
                                map.fitBounds(group.getBounds(), { padding: [50, 50] });
                            }
                        } else {
                            console.log('No kelurahan data found');
                            $('#totalKelurahan').text('0');
                            $('#aktifKelurahan').text('0');
                            
                            // Show message if no kelurahan data
                            L.marker([-3.4333, 114.8167])
                                .addTo(map)
                                .bindPopup('Belum ada data Kelurahan Sadar Hukum')
                                .openPopup();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading kelurahan data:', error);
                        console.error('Status:', status);
                        console.error('XHR:', xhr);
                        console.error('Response:', xhr.responseText);
                        
                        $('#totalKelurahan').text('0');
                        $('#aktifKelurahan').text('0');
                        
                        L.marker([-3.4333, 114.8167])
                            .addTo(map)
                            .bindPopup('Gagal memuat data Kelurahan Sadar Hukum')
                            .openPopup();
                    }
                });
                
                // Filter function
                function filterMarkers() {
                    var searchValue = $('#searchKelurahan').val().toLowerCase();
                    var kecamatanValue = $('#filterKecamatan').val();
                    var statusValue = $('#filterStatus').val();
                    
                    var visibleCount = 0;
                    var aktifCount = 0;
                    var visibleMarkers = [];
                    
                    allMarkers.forEach(function(item) {
                        var kelurahan = item.data;
                        var visible = true;
                        
                        // Filter by search (kelurahan name)
                        if (searchValue && kelurahan.nama_kelurahan) {
                            if (kelurahan.nama_kelurahan.toLowerCase().indexOf(searchValue) === -1) {
                                visible = false;
                            }
                        }
                        
                        // Filter by kecamatan
                        if (kecamatanValue && kelurahan.nama_kecamatan !== kecamatanValue) {
                            visible = false;
                        }
                        
                        // Filter by status
                        if (statusValue !== '') {
                            var isAktif = kelurahan.is_active ? 1 : 0;
                            if (parseInt(statusValue) !== isAktif) {
                                visible = false;
                            }
                        }
                        
                        // Show/hide marker
                        if (visible) {
                            if (!map.hasLayer(item.marker)) {
                                item.marker.addTo(map);
                            }
                            visibleCount++;
                            if (kelurahan.is_active) {
                                aktifCount++;
                            }
                            visibleMarkers.push(item.marker);
                        } else {
                            if (map.hasLayer(item.marker)) {
                                map.removeLayer(item.marker);
                            }
                        }
                    });
                    
                    // Update stats
                    $('#totalKelurahan').text(visibleCount);
                    $('#aktifKelurahan').text(aktifCount);
                    
                    // Fit bounds if there are visible markers
                    if (visibleMarkers.length > 0) {
                        var group = new L.featureGroup(visibleMarkers);
                        map.fitBounds(group.getBounds(), { padding: [50, 50] });
                    }
                }
                
                // Bind filter events
                $('#searchKelurahan').on('input', filterMarkers);
                $('#filterKecamatan').on('change', filterMarkers);
                $('#filterStatus').on('change', filterMarkers);
            }

            function loadTemaDokumenHomepage() {
                console.log('Loading tema dokumen...');
                $.ajax({
                    url: '/api/tema-dokumen',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log('Tema dokumen response:', response);
                        var temaContainer = $('#tema-dokumen-container');
                        temaContainer.empty();

                        // Access actual data array from paginated response
                        var temaList = response.data ? (response.data.data || response.data) : [];
                        console.log('Tema list:', temaList);

                        if (temaList && temaList.length > 0) {
                            $.each(temaList, function(index, tema) {
                                console.log('Processing tema:', tema);
                                // Check if status is active (true or 'aktif')
                                var isStatusActive = tema.status === true || tema.status === 'aktif' || tema.status === 1;
                                
                                if (isStatusActive) {
                                    // Use regulasi_count from withCount relationship
                                    var jumlahPeraturan = tema.regulasi_count || 0;
                                    
                                    // Use icon image from database
                                    var iconUrl = tema.icon ? asset('storage/' + tema.icon) : asset('assets/images/default-icon.png');
                                    
                                    console.log('Icon URL:', iconUrl);
                                    
                                    var temaHtml = `
                                        <div class="theme-item animate-on-scroll scale-in delay-${(index % 6) + 1}">
                                            <a href="/dokumen?tema=${tema.id}" class="text-decoration-none">
                                                <img src="${iconUrl}" alt="${tema.nama}" style="width: 80px; height: 80px; object-fit: contain; margin-bottom: 10px;">
                                                <span>${tema.nama}</span>
                                                <small>${jumlahPeraturan} Peraturan</small>
                                            </a>
                                        </div>`;
                                    temaContainer.append(temaHtml);
                                }
                            });
                        } else {
                            temaContainer.html(
                                '<p class="text-center text-muted">Belum ada tema dokumen yang tersedia</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading tema dokumen:', error);
                        console.error('Status:', status);
                        console.error('XHR:', xhr);
                        console.error('Response:', xhr.responseText);
                        $('#tema-dokumen-container').html(
                            '<p class="text-center text-danger">Gagal memuat data tema dokumen</p>');
                    }
                });
            }

            function loadGalleryHomepage() {
                $.ajax({
                    url: '/api/galeri',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var galleryContainer = $('#gallery-container');
                        galleryContainer.empty();

                        // Access data array from pagination response.data.data
                        if (response.data && response.data.data && response.data.data.length > 0) {
                            // Tampilkan maksimal 6 galeri terbaru
                            var galleryItems = response.data.data.slice(0, 6);
                            
                            $.each(galleryItems, function(index, galeri) {
                                var images = typeof galeri.foto_kegiatan === 'string' ? JSON.parse(galeri.foto_kegiatan) : galeri.foto_kegiatan;
                                var firstImage = Array.isArray(images) && images.length > 0 ? images[0] : null;
                                
                                if (firstImage) {
                                    // Use the path directly - it already includes /storage/ prefix from API
                                    var imageUrl = typeof firstImage === 'string' ? firstImage : '';
                                    var galleryHtml = `
                                        <div class="gallery-item">
                                            <img src="${imageUrl}" alt="${galeri.nama_kegiatan || 'Galeri'}" />
                                            <div class="gallery-overlay">
                                                <div class="gallery-icon">
                                                    <i class="mdi mdi-magnify-plus-outline"></i>
                                                </div>
                                            </div>
                                        </div>`;
                                    galleryContainer.append(galleryHtml);
                                }
                            });
                        } else {
                            galleryContainer.html(`
                                <div class="col-12 text-center py-5">
                                    <div class="text-muted">
                                        <i class="mdi mdi-image-off" style="font-size: 3rem;"></i>
                                        <p class="mt-3">Belum ada galeri yang tersedia</p>
                                    </div>
                                </div>
                            `);
                        }
                    },
                    error: function(error) {
                        console.error('Error loading gallery:', error);
                        $('#gallery-container').html(`
                            <div class="col-12 text-center py-5">
                                <div class="text-danger">
                                    <i class="mdi mdi-alert-circle-outline" style="font-size: 3rem;"></i>
                                    <p class="mt-3">Gagal memuat galeri</p>
                                </div>
                            </div>
                        `);
                    }
                });
            }
        });
    </script>
</body>

</html>
