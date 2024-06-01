<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7fafc;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        #app {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

}

        .btn-back {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #4299e1;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #2c5282;
        }

        .btn-home {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #4299e1;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-home:hover {
            background-color: #2c5282;
        }
    </style>
</head>
<body>
    <div id="app">
        <button onclick="window.history.back()" class="btn-back">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <a href="/" class="btn-home">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7 7 7-7 7z"></path>
            </svg>
        </a>

        @yield('content')
    </div>
</body>
</html>
