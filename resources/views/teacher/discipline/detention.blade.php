@extends("layouts.adminLayout")
@section('sidebar')
<x-teacher-sidebar focus="discipline" />
@endsection
@section('content')


<x-detention-notification-card title="Detention notification" id="notify-parents-modal" />


<div class="flex flex-col items-center pb-40 px-5 md:px-20 gap-y-20">

    <div class="bg-white px-10 py-4 drop-shadow-md mt-10 w-full rounded-md flex flex-col items-center gap-y-8">
        <h1 class="text-zinc-700 md:text-3xl text-2xl font-semibold">Discipline Management</h1>
        <x-discipline-sliding-tab focus="detention" />
        <div class="w-full">
            <x-session-messages />
        </div>
    </div>

    <div class="bg-white flex flex-col items-center pt-10 drop-shadow-md pb-40 w-full">
        <h1 class="text-3xl text-zinc-600">Detention</h1>

        <div class="bg-slate-100 w-[90%] h-[3px] mt-5"></div>


        <div date-rangepicker class="flex items-center justify-evenly  w-full mt-20 mb-10">


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


            {{-- <span class="mx-4 text-gray-500 mt-4">to</span> --}}


            <div class="flex flex-col items-center w-[50%]">
                <p class="text-zinc-700 mb-4">Pick end date</p>

                <div class="relative w-[80%] md:w-[60%]">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input name="end" type="text" readonly id="end-date"
                        class="date bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="YYYY/MM/DD">
                </div>

                <p id="end-error" class="text-red-700 mt-2 text-sm hidden">Please enter an end date</p>

            </div>
        </div>


        <div class="flex flex-col w-full lg:w-[50%] items-center">

            <button id="get-bookings"
                class="w-[60%] bg-blue-strath rounded hover:bg-sky-900 transition md:text-base text-sm text-white py-2 px-3 md:px-5 mt-10"><i
                    class=" mr-4 fa-solid fa-file-pen"></i>Get
                Unassessed Bookings</button>

            <button id="generate-detention-list"
                class="w-[60%] bg-green-800 rounded hover:bg-green-900 transition md:text-base text-sm text-white py-2 px-3 md:px-5 mt-8"><i
                    class=" mr-4 fa-solid fa-file-lines"></i>Generate
                Detention List</button>
        </div>

        <div class="bg-slate-100 w-[90%] h-[3px] mt-20"></div>



        <div id="booking-results" class="mt-10 w-full">

        </div>


    </div>

</div>




<script>
    $( document ).ready(function() {

    $("#get-bookings").click(function(e){

        if(validateDates()){
            var startDate = $("#start-date").val();
            var endDate = $("#end-date").val();

            $.ajax({
                type: 'get',
                url: '/teacher/bookings/unassessed',
                data: {startDate: startDate, endDate: endDate},
                success: function(data) {

                    $("#booking-results").html(data);

                }
            });

            
        }
       
        

    });

    $("#generate-detention-list").click(function(e){

        if(validateDates()){
            var startDate = $("#start-date").val();
            var endDate = $("#end-date").val();

            $.ajax({
                type: 'get',
                url: '/teacher/bookings/assessed',
                data: {startDate: startDate, endDate: endDate},
                success: function(data) {

                    $("#booking-results").html(data);

                }
            });

            
        }
       
        

    });

    function validateDates(){
        var flag = true;

        if(!$("#end-date").val()){
            $("#end-error").show();
            flag = false;
        }
        else{
            $("#end-error").hide();
        }

        if(!$("#start-date").val()){
            $("#start-error").show();
            flag = false;
        }
        else{
            $("#start-error").hide();
        }

        if(new Date($("#start-date").val()) > new Date($("#end-date").val())){
            $("#start-error").html('Start date must be before end date');
            $("#start-error").show();
            flag = false;
        }

        return flag;
    }

    function removeErrors(){
        $("#start-error").show();
        $("#end-error").show();
    }

});
</script>

@endsection