@extends("layouts.adminLayout")
@section('sidebar')
<x-admin-sidebar focus="teacher"/>
@endsection
@section('content')

<div class="flex flex-col items-center pb-40 px-5 md:px-20 gap-y-20">

    <x-teacher-registration-card title="Teacher Registration" :classrooms="$classrooms" />

    <div class="bg-white px-10 py-5 shadow-md mt-10 w-full rounded-md flex flex-col items-center gap-y-8">
        <h1 class="text-zinc-700 md:text-3xl text-2xl font-semibold">Teacher Management</h1>
        <button id="add-teacher"
            class="w-full md:w-[70%] bg-blue-strath rounded hover:bg-sky-900 transition md:text-md text-sm text-white py-2 px-3 md:px-10">Register
            New Teachers to the System</button>
        <div class="w-full">
            <x-session-messages />
        </div>
    </div>

    <div class="flex gap-x-5 w-full">

        <x-admin-searchbar title="Find Teacher" title2="Staff Number" type="teacher"/>

        <div class="w-[70%] bg-white py-20">
            Teacher Results Component
        </div>
    </div>

</div>


<script>
    $( document ).ready(function() {

        $("#add-teacher").click(function(e){
            $("#modal-card").removeClass('hidden');
            $("#modal-card").addClass('flex');
            stopScroll();
        })

        $("#close-modal").click(function(e){
            $("#modal-card").removeClass('flex');
            $("#modal-card").addClass('hidden');
            resumeScroll();
        });

     });
</script>
@endsection