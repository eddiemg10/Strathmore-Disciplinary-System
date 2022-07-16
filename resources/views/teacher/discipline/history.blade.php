@extends("layouts.adminLayout")
@section('sidebar')
<x-teacher-sidebar focus="discipline" />
@endsection
@section('content')

<div class="flex flex-col items-center pb-40 px-5 md:px-20 gap-y-20">

    <div class="bg-white px-10 py-4 drop-shadow-md mt-10 w-full rounded-md flex flex-col items-center gap-y-8">
        <h1 class="text-zinc-700 md:text-3xl text-2xl font-semibold">Discipline Management</h1>
        <x-discipline-sliding-tab focus="history" />
        <div class="w-full">
            <x-session-messages />
        </div>
    </div>

    <div class="bg-white flex flex-col items-center pt-10 drop-shadow-md pb-40 w-full">
        <h1 class="text-3xl text-zinc-600">Detention</h1>

        <div class="bg-slate-100 w-[90%] h-[3px] mt-5"></div>







    </div>

</div>

@endsection