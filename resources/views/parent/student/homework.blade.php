@extends("layouts.master")

@section('layout_content')

<div class="bg-slate-50 flex flex-col items-center pb-40 px-5 md:px-20 gap-y-20">

    <div
        class="bg-white px-5 md:px-20 py-4 pb-10 drop-shadow-md mt-10 w-full rounded-md flex flex-col items-center gap-y-8">

        <div class="flex gap-5 items-center">
            <div class="w-20">
                <img class="rounded-full shadow-lg object-contain"
                    src={{asset('assets/profile_pictures/'.$student->profile_photo)}}
                alt="">
            </div>
            <h1 class="text-zinc-700 md:text-3xl text-2xl font-semibold">{{$student->first_name."
                ".$student->last_name}}</h1>
        </div>

        <div class='mt-8 flex justify-center md:w-[70%] w-full border-b-2 md:text-2xl text-base'>

            <!-- Active for now, I will sort nav bar logic later on. -->
            <div class=" w-[50%] flex flex-col
                items-center">
                <a href={{route('parent.records', ['id'=>$student->id])}} class="hover: cursor-pointer">Disipline
                    Record</a>
            </div>
            <div class="text-blue-strath font-bold border-b-4 border-[#00447D] w-[50%] flex flex-col items-center">
                <a class="hover: cursor-pointer">Homework</a>
            </div>

        </div>

    </div>

    <div class="bg-white flex py-40 flex-col items-center px-5 md:px-10 pt-10 drop-shadow-md pb-40 w-full">

        <div class="flex flex-col items-center mt-10 w-[50%] ">
            <p class="text-zinc-700 mb-4">Pick date</p>

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

            <p id="start-error" class="text-red-700 mt-2 text-sm hidden">Please enter date</p>

        </div>


        <div id="search-result" class="w-full px-20 mt-20">

        </div>

    </div>

</div>

<script>
    $('#start-date').on('change', function() {
            var classroom = "{{$student->classroom->id}}";

            $.ajax({
            url:"{{ route('parent.showHomework') }}",
            method:'GET',
            data:{date: $("#start-date").val(), classroom: classroom},
            dataType:'html',
            success:function(data)
            {
                $("#search-result").html(data);
                if(data.success){
                    $('#success').html(data.message);
                    $('#success').show();
                }
                else{
                    $('#error').html(data.message);
                    $('#error').show();
                }
            }
        });
    });
</script>

@endsection