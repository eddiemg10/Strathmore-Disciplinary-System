@extends('layouts.cardLayout')
@section('modal_content')

<div class="p-10 overflow-y-scroll">


    <form id="booking-form" method="POST" action="#" class="flex flex-col">

        <div id="success"
            class="hidden my-5 text-center font-bold text-green-900 bg-green-50 border-2 border-green-600 rounded-md w-full py-5">
            Successfully added booking
        </div>

        <div id="error"
            class=" hidden my-5 text-center font-bold text-red-900 bg-red-50 border-2 border-red-700 rounded-md w-full py-5">
            An error occured in adding the booking. Please try again later
        </div>

        <label for="search" class="mb-2"> Search Student</label>
        <div class="flex items-center text-zinc-700 w-full">

            <i class="fa-solid fa-magnifying-glass fa-xl mr-4"></i>
            <input type="search" name="search" id="search"
                class="p-4 pl-10  w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 " autofocus
                autocomplete="off">


        </div>

        <div class="flex flex-col items-center">
            <table class="table mt-5 mb-7 table-fixed table-striped table-hover w-full md:w-[70%] text-sm rounded"
                id="students-table">
                <thead class="w-full rounded bg-zinc-700 text-white text-xs">
                    <tr>
                        <th class="px-4 py-2 text-center w-1/3">ID</th>
                        <th class="px-4 py-2 text-center w-1/3">Name</th>
                        <th class="px-4 py-2 text-center w-1/3">Class</th>
                    </tr>
                </thead>
                <tbody id="students-table-body">

                </tbody>
            </table>

            <div id="added-students"
                class="my-4 flex flex-wrap gap-5 bg-sky-50 border-2 border-sky-800 p-3 rounded-md w-full">

            </div>

            <div class="bg-slate-100 w-full h-[2px] mt-5"></div>

        </div>


        <div class="my-6">
            <label for="period" class="block mb-2  font-medium text-zinc-700">Period</label>
            <input type="text" id="period" name="period"
                class="bg-gray-50 border border-gray-300 text-zinc-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                required>
        </div>

        <label for="comments" class="block mb-2  font-medium text-gray-900 dark:text-gray-400">Comments</label>
        <textarea id="comments" name="comments" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Enter details about the booking" required></textarea>


        <button id="submit-btn"
            class=" w-full bg-blue-strath rounded hover:bg-sky-900 transition md:text-base text-sm text-white py-3 px-3 md:px-5 mt-10">
            Submit Booking
        </button>

        <input type="hidden" id="classroom" value='0'>


    </form>
</div>


<script>
    //Add student to booking list

        var students = [];

        $("#students-table").on('click','tr', function(){
            var id = parseInt($(this).attr('id'));

            var studentClassroom = $(this).data('classroom');

            //-1 if not exists, else = index
            var index = students.findIndex((x) => x.student === id);

            if(index === -1){

            
                $.ajax({
                url:"{{ route('student.name') }}",
                method:'GET',
                data:{student:id},
                dataType:'json',
                success:function(data)
                {

                        $('#added-students').append(data.name);
                        students.push({student:id, classroom:studentClassroom});

                        $(".remove-student").on('click', function(){
                            var id = $(this).data('id');
                            const index = students.findIndex((x) => x.student === id);
                            
                            if (index > -1) {
                            students.splice(index, 1); // 2nd parameter means remove one item only
                            }
                            $(this).parent().remove();


                        });
                    
                }
                });
            }
        });

        $("#submit-btn").click(function(e){
            e.preventDefault();

            if($("#booking-form").valid()){

                $.ajax({
                    url: "{{route('book')}}",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        students:JSON.stringify(students),
                        period:$('#period').val(),
                        comments:$('#comments').val(),
                    },
                    success:function(response){
                        // $('#successMsg').show();

                        if(response.success){
                            $("#success").show();
                        }

                        if(response.error){
                            $("#error").show();

                        }
                        clearForm();

                    },
                    error: function(response) {
                        $('#nameErrorMsg').text(response.responseJSON.errors.name);
                        $('#emailErrorMsg').text(response.responseJSON.errors.email);
                        $('#mobileErrorMsg').text(response.responseJSON.errors.mobile);
                        $('#messageErrorMsg').text(response.responseJSON.errors.message);
                    },
                });
            }

        });

        function clearForm(){
            $('#period').val("");
            $('#comments').val("");
            $('#added-students').html("");
            students = [];

        }

        
</script>

@endsection