<div id="refresh-result" class="w-full">
    <div class="animate-pulsex w-full">
        <div class="w-full flex flex-col items-center">
            <h1 class="text-3xl text-zinc-600">Homework</h1>

            <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>

            <div class="flex w-full px-10 justify-around mt-10">

                <div class="bg-slate-50 rounded-full px-3 py-2">
                    <span>Date: </span> <span>{{$date}}</span>
                </div>

                <div class="bg-slate-50 rounded-full px-3 py-2">
                    <span>Classroom: </span> <span>{{$classroom->name}}</span>
                </div>

            </div>

            <button id="add-assignment"
                class="w-[60%] bg-blue-strath rounded hover:bg-sky-900 transition md:text-base text-sm text-white py-2 px-3 md:px-5 mt-10">Add
                Homework
            </button>

            <div id="loading-refresh" class="mt-16 hidden">
                <x-loading-button />
            </div>

            <div id="loading-done" class="mt-16">
                <button id="refresh-behaviour-sheet"
                    class=" text-blue-strath bg-none hover:bg-blue-50 font-medium rounded-full text-sm border border-[#00447D] px-5 py-1 text-center mr-2 inline-flex items-center">
                    <i class="fa-solid fa-arrows-rotate mr-4"></i> refresh
                </button>
            </div>


            <div class="w-full px-5 mt-10">
                <table class="border-collaps border border-black w-full text-sm">
                    <thead>
                        <tr class="bg-zinc-500 text-base text-white">
                            <th class="border border-black px-4 py-2">Subject</th>
                            <th class="border border-black px-4 py-2">Homework Description</th>
                            <th class="border border-black px-4 py-2">Teacher</th>


                        </tr>
                    </thead>
                    <tbody>

                        @foreach($assignments as $assignment)
                        <tr class="odd:bg-white even:bg-slate-50">

                            <td class="border border-black px-3 py-2 ...">{{$assignment->subject}}</td>
                            <td class="border border-black px-3 py-2 flex flex-col">
                                <pre class="font-nunito">{{$assignment->description}}</pre>
                                @if(isset($assignment->resource))
                                <a class="bg-blue-100 p-2 w-full pl-5 mt-2" target="_blank"
                                    href="{{asset('assets/homework/'.$assignment->resource)}}">Download File <i
                                        class="fa-solid fa-file-arrow-down ml-5"></i></a>
                                @endif

                            </td>
                            <td class="border border-black px-3 py-2 ...">{{$assignment->last_name.".
                                ".substr($assignment->first_name, 0, 1)}}</td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>


    </div>
</div>
<script>
    $( document ).ready(function() {

        $("#add-assignment").click(function(e){
            $("#modal-card").removeClass('hidden');
            $("#modal-card").addClass('flex');
            stopScroll();
        })

   

        $("#refresh-behaviour-sheet").click(function(e){

            $("#loading-done").hide();
            $("#loading-refresh").show();



            var id = $("#classroom").val();

            $.get("/teacher/homework/"+id, function(data, status){
                $("#refresh-result").html(data);

                $("#loading-refresh").hide();
                $("#loading-done").show();
            });
        });




        // $("#close-modal").click(function(e){
        //     $("#modal-card").removeClass('flex');
        //     $("#modal-card").addClass('hidden');
        //     resumeScroll();
        //     //Flush the added students state
        //     students = [];
        //     $('#added-students').html('');
        //     $('#error').hide();
        //     $('#success').hide();
        //     $('#students-table-body').html('');

        // });

        // $(document).on('keyup', '#search', function(){
        //     var query = $(this).val();
        //     var classroom = $('#classroom').val();
        //     // console.log(query+" on class "+classroom);
        //     fetch_students(query, classroom);
        // });

        // function fetch_students(query = '', classroom = '')
        // {
        //     $.ajax({
        //     url:"{{ route('student.action') }}",
        //     method:'GET',
        //     data:{query:query, classroom:classroom, paginate:4},
        //     dataType:'json',
        //     success:function(data)
        //     {
        //         $('#students-table-body').html(data.table_data);
        //     }
        //     });
        // }


        

     });
</script>