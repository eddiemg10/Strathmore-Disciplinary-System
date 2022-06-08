<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Parents</title>
</head>

<body>


    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">


        <div
            class="w-[90%] sm:max-w-md mt-6 px-6 py-8 flex flex-col items-center gap-y-4 bg-white shadow-md overflow-hidden rounded-lg">

            <div>
                <h1 class="text-2xl text-zinc-700">Select account</h1>

            </div>

            <div class="w-[90%] h-[1.5px] bg-slate-200 rounded-full mb-5"></div>

            @foreach($roles as $role)
            <a href="{{route($role->userType->type)}}"
                class="border-solid border rounded-lg hover:cursor-pointer hover:bg-slate-50 transition border-gray-400 py-2 px-10">
                {{$role->userType->type}} account
            </a>
            @endforeach
        </div>
    </div>
</body>

</html>