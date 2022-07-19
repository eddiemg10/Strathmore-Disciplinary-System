@extends('layouts.cardLayout')
@section('modal_content')

<div class="p-10 overflow-y-scroll">


    <form id="assignment-form" method="POST" action="{{route('homework.add')}}" class="flex flex-col"
        enctype="multipart/form-data">
        @csrf

        <div id="success"
            class="hidden my-5 text-center font-bold text-green-900 bg-green-50 border-2 border-green-600 rounded-md w-full py-5">
            Successfully added homework
        </div>

        <div id="error"
            class=" hidden my-5 text-center font-bold text-red-900 bg-red-50 border-2 border-red-700 rounded-md w-full py-5">
            An error occured in adding the homework. Please try again later
        </div>


        <div class="mb-6">
            <label for="period" class="block mb-2  font-medium text-zinc-700">Subject</label>
            <input type="text" id="period" name="period"
                class="bg-gray-50 border border-gray-300 text-zinc-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                required>
        </div>

        <label for="comments" class="block mb-2  font-medium text-gray-900 dark:text-gray-400">Comments</label>
        <textarea id="comments" name="comments" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Enter description about the homework" required></textarea>

        <label for="file" class="block mt-6 mb-2  font-medium text-gray-900 dark:text-gray-400">File <span
                class="text-sm text-zinc-500">(Optional)</span></label>
        <input id="file"
            class="text-sm text-gray-900 bg-white rounded-md border border-gray-300 cursor-pointer file:p-2 w-full focus:outline-none"
            type="file" name="file">


        <input id="submit-btn" type="submit"
            class=" w-full bg-[#00447D] rounded hover:bg-sky-900 transition md:text-base text-sm text-white py-3 px-3 md:px-5 mt-10"
            value="Assign Homework" />

        <input type="hidden" id="classroom" name="classroom" value='0'>


    </form>
</div>


<script>
    $("#assignment-form").submit(function(e){


           $("#assignment-form").validate()

    });

        function clearForm(){
            $('#period').val("");
            $('#comments').val("");
            $('#file').val("");

        }

        
</script>

@endsection