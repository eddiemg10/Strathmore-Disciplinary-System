{{-- <div class="flex grow-[3] basis-[532px] flex-col items-center bg-white py-10"> --}}

    <div>
        <div class="flex flex-col items-center">
            <h1 class="text-3xl text-zinc-600 ">Parent Details</h1>
            <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>

            <div class="mt-20 flex flex-col lg:flex-row gap-y-5 lg:items-center">
                <div class="w-full lg:w-[50%] px-8">
                    <div class="w-full">
                        <img class="rounded-md shadow-lg object-cover"
                            src={{asset('assets/profile_pictures/'.$parent->profile_photo)}}
                        alt="">
                    </div>
                </div>

                <div class="w-full lg:w-[50%] px-5 flex flex-col gap-y-5 items-center">

                    <div
                        class="bg-white shadow-xl border border-solid border-slate-200 text-center w-full rounded-md py-5">
                        <p class="text-zinc-700 text-xl">Children registered: <span
                                class="font-bold">({{count($parent->children)}})</span> </p>
                        <ul>

                            @forelse($parent->children as $i => $child)
                            <li class="text-blue-strath underline my-3"><a href="#">{{($i+1).". ".$child->first_name."
                                    ".$child->last_name}}</a></li>

                            @empty
                            <div class="w-full flex justify-center">
                                <div
                                    class="border border-solid border-red-800 bg-red-50 text-red-800 font-bold px-3 py-2 mt-4 w-[80%]">
                                    <p>No Children registered</p>
                                </div>
                            </div>
                            @endforelse
                        </ul>
                    </div>

                    <button id="edit-parent" data-id="{{$parent->id}}"
                        class="bg-blue-strath py-2 px-3 w-full text-white rounded-md mt-6 mb-2 flex justify-center relative items-center gap-x-5 hover:shadow-md hover:cursor-pointer"><i
                            class="fa-solid fa-pen "></i>Edit parent
                        Details</button>

                    <button id="delete-parent" data-id="{{$parent->id}}"
                        class="bg-red-strath py-2 px-3 w-full text-white rounded-md flex justify-center relative items-center gap-x-5 hover:shadow-md hover:cursor-pointer"><i
                            class="fa-solid fa-trash-can "></i>Delete parent
                        Record</button>



                </div>


            </div>


        </div>

        <div class="flex flex-col items-center">
            <div class="bg-slate-100 w-[90%] h-[2px] mt-16"></div>

        </div>

        <div class="w-full px-5 mt-24 flex flex-col items-center">

            <table class="w-full">
                <thead class="bg-blue-strath text-white text-bold ">
                    <tr>
                        <th class="py-4 px-2 md:text-md text-center">First Name</th>
                        <th class="py-4 px-2 md:text-md text-center">Surname</th>
                        <th class="py-4 px-2 md:text-md text-center">Email</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 bg-slate-100 text-center px-3">{{$parent->first_name}}</td>
                        <td class="py-2 bg-slate-100 text-center px-3">{{$parent->last_name}}</td>
                        <td class="py-2 bg-slate-100 text-center px-3">{{$parent->email}}</td>

                    </tr>

                </tbody>
            </table>

            <div class="w-[90%] mt-20 bg-slate-50 px-2 lg:px-10 drop-shadow-md flex flex-col items-center">

                <h1 class="text-2xl text-zinc-600 my-8">Add Students</h1>
                <form id="booking-form" method="POST" action="#" class="flex flex-col pb-20">

                    <div id="success"
                        class="hidden my-5 text-center font-bold text-green-900 bg-green-50 border-2 border-green-600 rounded-md w-full py-5">
                        Successfully added students to this parent.
                    </div>

                    <div id="error"
                        class=" hidden my-5 text-center font-bold text-red-900 bg-red-50 border-2 border-red-700 rounded-md w-full py-5">
                        An error occured in adding students to this parent. Please try again later
                    </div>

                    <label for="search" class="mb-2"> Search Student</label>
                    <div class="flex items-center text-zinc-700 w-full">

                        <i class="fa-solid fa-magnifying-glass fa-xl mr-4"></i>
                        <input type="search" name="search" id="search-student"
                            class="p-2 pl-10  w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 "
                            autofocus autocomplete="off">


                    </div>

                    <div class="flex flex-col items-center">
                        <table
                            class="table mt-5 mb-7 table-fixed table-striped table-hover w-full md:w-[70%] text-sm rounded"
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

                    <div class="w-full flex flex-col items-center">
                        <button id="submit-btn"
                            class=" w-[80%] bg-zinc-700 rounded hover:bg-zinc-800 transition md:text-base text-sm text-white py-2 px-3 md:px-5 mt-10">Add
                            Students
                        </button>
                    </div>
                    <input type="hidden" id="parent" value='{{$parent->id}}'>


                </form>
            </div>


        </div>

    </div>


    <script>
        var students = [];

$("#students-table").on('click','tr', function(){
    var id = parseInt($(this).attr('id'));



    var exists = students.includes(id);

    if(!exists){
    
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
                    const index = students.indexOf(id);
                    
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
        url: "{{route('parent-student')}}",
        type:"POST",
        data:{
            "_token": "{{ csrf_token() }}",
            students:JSON.stringify(students),
            parent:$('#parent').val(),
        },
        success:function(response){
            // $('#successMsg').show();

            

            if(response.success){
                clearForm();
                $.get("/admin/parents/"+$('#parent').val(), function(data, status){
                $("#search-result").html(data);
         
                $("#success").show();

            });
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

});



function clearForm(){

    $('#added-students').html("");
    students = [];

}
    </script>