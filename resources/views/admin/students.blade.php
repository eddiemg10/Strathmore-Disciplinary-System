@extends("layouts.adminLayout")
@section('content')

<div class="flex flex-col items-center pb-40 px-5 md:px-20 gap-y-20">

    <x-student-registration-card title="Student Registration" :classrooms="$classrooms" />

    <div class="bg-white px-10 py-5 shadow-md mt-10 w-full rounded-md flex flex-col items-center gap-y-8">
        <h1 class="text-zinc-700 md:text-3xl text-2xl font-semibold">Student Management</h1>
        <button id="add-student"
            class="w-full md:w-[70%] bg-blue-strath rounded hover:bg-sky-900 transition md:text-md text-sm text-white py-2 px-3 md:px-10">Register
            New
            Students to the System</button>
        <div class="w-full">
            <x-session-messages />
        </div>
    </div>

    <div class="flex flex-wrap lg:flex-nowrap gap-x-5 sm:gap-y-10 w-full">

        <x-admin-searchbar title="Find Student" title2="Admission Number" :classrooms="$classrooms" type="student"/>


        {{-- search results --}}
        <div id="search-result" class="flex grow-[3] basis-[532px]  flex-col items-center bg-white py-10">

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

                            <button id="edit-student" data-id="{{$student->id}}"
                                class="bg-slate-100 shadow-md py-5 px-3 w-full text-white rounded-md mt-6 mb-2 flex justify-center relative items-center gap-x-5 hover:shadow-md hover:cursor-pointer"></button>

                            <button id="delete-student" data-id="{{$student->id}}"
                                class="bg-slate-100 shadow-md py-5 px-3 w-full text-white rounded-md flex justify-center relative items-center gap-x-5 hover:shadow-md hover:cursor-pointer">
                            </button>



                        </div>


                    </div>
                </div>

                <div class="bg-slate-100 w-[90%] h-[2px] mt-16"></div>

                <div class="w-full px-10">
                    <div class="w-full bg-slate-100 shadow-md h-32 px-5 mt-24 flex justify-center">

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

</div>


<script>
    $( document ).ready(function() {

        $("#add-student").click(function(e){
            $("#modal-card").removeClass('hidden');
            $("#modal-card").addClass('flex');
            stopScroll();
        })

        $("#close-modal").click(function(e){
            $("#modal-card").removeClass('flex');
            $("#modal-card").addClass('hidden');
            resumeScroll();
        });

        $(".student").click(function(e){

            $.get("/admin/students/"+$(this).attr('id'), function(data, status){
                $("#search-result").html(data);
                location.href = "#search-result"; 
            });
        })

     });
</script>
@endsection