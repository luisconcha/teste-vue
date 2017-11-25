<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <style type="text/css">
        @media print {
            .hidden-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<div id="app">

    @php

        $navBar = Navbar::withBrand(config('app.name'), route('admin.dashboard'))->inverse() ;
        
        if(Auth::check()){
            if(\Gate::allows('admin')){
                $arrayLinks = [
                  ['link'=>route('admin.users.index'), 'title'=>'User'],
                  ['link'=>route('admin.class_informations.index'), 'title'=>'Class'],
                  ['link'=>route('admin.subjects.index'), 'title'=>'Subjects']
                ];

                 $navBar->withContent(Navigation::links($arrayLinks));
            }

            $arrayLinksRight = [
                [
                    Auth::user()->name,
                    [
                       [
                         'link'=> route('admin.users.settings.edit'),
                         'title' => 'Configurations'
                       ],
                       [
                        'link'=>route('logout'),
                        'title'=>'Logout',
                        'linkAttributes'=> [
                            'onClick' => "event.preventDefault();document.getElementById(\"form-logout\").submit();"
                        ]
                       ]
                    ]
                ]
            ];

            $navBar
                ->withContent(Navigation::links($arrayLinksRight)->right());

            $formDelete = FormBuilder::plain([
                   'id'=>'form-logout',
                   'url'=> route('logout'),
                   'method'=>'POST',
                   'style'=>'display:none'
                ]);
        }
    @endphp
    {!! $navBar !!}

    @if(Auth::check())
        {!! form($formDelete) !!}
    @endif

    @if(Session::has('message'))
        <div class="container hidden-print">
            {!! Alert::success(Session::get('message'))->close() !!}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="container hidden-print">
            {!! Alert::danger(Session::get('message'))->close() !!}
        </div>
    @endif

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
