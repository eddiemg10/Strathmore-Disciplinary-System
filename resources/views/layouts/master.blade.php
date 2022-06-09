<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6d51c26809.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
        integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"> </script>
    <script src="https://kit.fontawesome.com/347b9e054d.js" crossorigin="anonymous"></script>

    <title>{{$title ?? 'Strathmore School'}}</title>
</head>

<body class="font-nunito">

    @php
    $user = Illuminate\Support\Facades\Auth::User();
    @endphp
    <nav class="fixed flex top-0 w-full bg-blue-strath h-16 z-50">
        <div class="h-full w-24 flex justify-center">
            <img class="object-contain w-12" src="{{asset('assets/Starthmore-Logo-Colour-new.gif')}}" alt="">
        </div>

        <div class="text-white ml-5 md:flex flex-col justify-center hidden">
            <p class="font-semibold text-center">STRATHMORE SCHOOL</p>
            <P class="font-thin text-sm text-center">DISCIPLINARY SYSTEM</P>
        </div>

        <div class="flex items-center gap-x-3 absolute right-8 h-full">
            <div class="w-10 ">
                <img class="rounded-full object-cover border-solid border-2 border-green-400"
                    src={{asset('assets/profile_pictures/'.$user->profile_photo)}} alt="">
            </div>

            <span class="text-white mr-3 text-sm font-light">{{$user->first_name. " ".$user->last_name}}</span>

            <x-hamburger-menu />

        </div>


    </nav>

    @yield('layout_content')
</body>

</html>