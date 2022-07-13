@extends("layouts.adminLayout")
@section('sidebar')
<x-admin-sidebar focus="parent" />
@endsection
@section('content')

<div class="flex flex-col items-center pb-40 px-5 md:px-20 gap-y-20">

    <x-parent-registration-card title="Parent Registration" />

    <div class="bg-white px-10 py-5 shadow-md mt-10 w-full rounded-md flex flex-col items-center gap-y-8">
        <h1 class="text-zinc-700 md:text-3xl text-2xl font-semibold">Parent Management</h1>
        <button id="add-parent"
            class="w-full md:w-[70%] bg-blue-strath rounded hover:bg-sky-900 transition md:text-md text-sm text-white py-2 px-3 md:px-10">Register
            New Parent to the System</button>
        <div class="w-full">
            <x-session-messages />
        </div>

        <div class="flex flex-col items-center w-[50%] ">
            <p class="text-zinc-700 mb-4">Pick start date</p>

            <div class="relative w-[80%] md:w-[60%]">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input name="start" type="text" readonly id="start-date"
                    class="date bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="YYYY/MM/DD">
            </div>

            <p id="start-error" class="text-red-700 mt-2 text-sm hidden">Please enter a start date</p>

        </div>
    </div>

    <div class="flex flex-wrap lg:flex-nowrap gap-x-5  sm:gap-y-10 w-full">

        <x-admin-searchbar title="Find Parent" title-2="User ID" type="parent" />


        <div id="search-result"
            class="flex grow-[3] basis-[532px]  flex-col items-center drop-shadow-md bg-white py-10">

            <div class="animate-pulse w-full">
                <div class="flex flex-col items-center w-full">
                    <h1 class="text-3xl text-zinc-600">No search results</h1>

                    <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>

                    <div class="mt-20 w-full flex flex-col lg:flex-row gap-y-5 lg:items-center">
                        <div class="w-full lg:w-[50%] px-8">
                            <div class="w-60 rounded-md shadow-lg h-48 bg-slate-100">

                            </div>
                        </div>

                        <div class="w-full lg:w-[50%] px-5 flex flex-col gap-y-5 items-center">

                            <div class="bg-slate-100 shadow-xl  text-center w-full h-28 rounded-md py-5">


                            </div>

                            <button
                                class="bg-slate-100 shadow-md py-5 px-3 w-full text-white rounded-md mt-6 mb-2 flex justify-center relative items-center gap-x-5 hover:shadow-md hover:cursor-pointer"></button>

                            <button
                                class="bg-slate-100 shadow-md py-5 px-3 w-full text-white rounded-md flex justify-center relative items-center gap-x-5 hover:shadow-md hover:cursor-pointer">
                            </button>



                        </div>


                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="bg-slate-100 w-[90%] h-[2px] mt-16"></div>

                </div>

                <div class="w-full px-10">
                    <div class="w-full bg-slate-100 shadow-md h-32 px-5 mt-24 flex justify-center">

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


<script>
    $( document ).ready(function() {

        $("#add-parent").click(function(e){
            $("#modal-card").removeClass('hidden');
            $("#modal-card").addClass('flex');
            stopScroll();
        })

        $("#close-modal").click(function(e){
            $("#modal-card").removeClass('flex');
            $("#modal-card").addClass('hidden');
            resumeScroll();
        });

        $("#parents-table").on('click','tr', function(){

            var id = $(this).attr('id');
            console.log(id)

            $.get("/admin/parents/"+id, function(data, status){
                $("#search-result").html(data);
                location.href = "#search-result"; 
            });
        });

     });
</script>
@endsection