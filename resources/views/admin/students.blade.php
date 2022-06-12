@extends("layouts.adminLayout")
@section('content')

<div class="flex flex-col items-center pb-40 px-20 gap-y-20">

    <div class="bg-white px-10 py-5 shadow-md mt-10 w-full rounded-md flex flex-col items-center gap-y-8">
        <h1 class="text-zinc-700 text-3xl font-semibold">Student Management</h1>
        <button
            class=" w-full md:w-[70%] bg-blue-strath rounded hover:bg-sky-900 transition text-white py-2 px-10">Register
            New
            Students to the System</button>
    </div>

    <div class="flex gap-x-5 w-full">
        <div class="w-[30%] bg-white py-40">
            Find Students Component
        </div>

        <div class="w-[70%] bg-white py-40">
            Student Results Component
        </div>
    </div>
</div>
@endsection