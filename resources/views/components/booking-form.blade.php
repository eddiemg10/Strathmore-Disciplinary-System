@extends('layouts.cardLayout')
@section('modal_content')

<div class="p-10 overflow-y-scroll">


    <form id="booking-form" method="POST" action="#" class="flex flex-col">

        <label for="search"> Search Student</label>
        <div class="flex items-center text-zinc-700 w-full">

            <i class="fa-solid fa-magnifying-glass fa-xl mr-4"></i>
            <input type="search" name="search" id="search"
                class="p-4 pl-10  w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 " autofocus>


        </div>

        <div class="flex flex-col items-center">
            <table class="table mt-5 mb-7 table-fixed table-striped table-hover w-[70%] text-sm rounded"
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

            <div id="added-students" class="my-4 flex gap-5 bg-sky-200 p-3 w-full">

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

        <input type="hidden" id="classroom_id" value='1'>


    </form>
</div>


<script>
    //Add student to booking list

        var students = [];

        $("#students-table").on('click','tr', function(){
            var id = $(this).attr('id');

            if(!students.includes(id)){

            
                $.ajax({
                url:"{{ route('student.name') }}",
                method:'GET',
                data:{student:id},
                dataType:'json',
                success:function(data)
                {

                        $('#added-students').append(data.name);
                        students.push(id);

                        $(".remove-student").on('click', function(){
                            var id = $(this).data('id');
                            const index = students.indexOf(String(id));
                            
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
            $("#booking-form").validate();
            e.preventDefault();


            $.ajax({
                url: "{{route('book')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    students:JSON.stringify(students),
                    period:$('#period').val(),
                    comments:$('#comments').val(),
                    classroom:$('#classroom_id').val(),
                },
                success:function(response){
                    // $('#successMsg').show();
                    console.log(response);
                },
                error: function(response) {
                    $('#nameErrorMsg').text(response.responseJSON.errors.name);
                    $('#emailErrorMsg').text(response.responseJSON.errors.email);
                    $('#mobileErrorMsg').text(response.responseJSON.errors.mobile);
                    $('#messageErrorMsg').text(response.responseJSON.errors.message);
                },
            });

        });

        
</script>

@endsection