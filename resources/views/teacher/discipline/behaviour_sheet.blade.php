@extends("layouts.adminLayout")
@section('sidebar')
<x-teacher-sidebar focus="discipline" />
@endsection
@section('content')

<x-booking-form title="Add Booking" width="[80vw]" />

<div class="flex flex-col items-center pb-40 px-5 md:px-20 gap-y-20">

    <div class="bg-white drop-shadow-md px-10 py-4  mt-10 w-full rounded-md flex flex-col items-center gap-y-8">
        <h1 class="text-zinc-700 md:text-3xl text-2xl font-semibold">Discipline Management</h1>
        <x-discipline-sliding-tab focus="bs" />
        <div class="w-full">
            <x-session-messages />
        </div>
    </div>

    <div class="flex flex-wrap lg:flex-nowrap gap-5  sm:gap-y-10 w-full">

        {{-- <div class="flex grow min-w-[16rem] table-fixed flex-col bg-white drop-shadow-md py-10"> --}}
            <x-admin-find-classroom type="booking" :classrooms="$classrooms" />
            {{--
        </div> --}}

        {{-- search results --}}
        <div id="search-result"
            class="flex grow-[4] basis-[800px]  flex-col items-center drop-shadow-md bg-white pb-40 py-10">

            <div class="animate-pulse w-full">
                <div class="w-full flex flex-col items-center">
                    <h1 class="text-3xl text-zinc-600">No Behaviour Sheet Selected</h1>

                    <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>

                    <div class="flex w-full px-10 justify-around mt-10">

                        <div class="bg-slate-100 rounded-full px-20 py-5 text-slate-100 text-bg-slate-50">

                        </div>

                        <div class="bg-slate-100 rounded-full px-20 py-5 text-slate-100">

                        </div>

                    </div>

                    <div class="w-[60%] bg-slate-100  py-5 px-3 md:px-5 mt-10"></div>


                    <div class="w-full px-5 mt-10">
                        <table class="border-collaps border border-slate-200 w-full text-sm">
                            <thead>
                                <tr class="bg-zinc-200 text-base text-white">
                                    <th class="border border-slate-200 px-4 py-4"></th>
                                    <th class="border border-slate-200 px-4 py-4"></th>
                                    <th class="border border-slate-200 px-4 py-4"></th>
                                    <th class="border border-slate-200 px-4 py-4"></th>


                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd:bg-white even:bg-slate-50">
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>
                                    <td class="border border-slate-200 px-3 py-4 ...">
                                    </td>
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>

                                </tr>
                                <tr class="odd:bg-white even:bg-slate-50">
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>

                                </tr>
                                <tr class="odd:bg-white even:bg-slate-50">
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>
                                    <td class="border border-slate-200 px-3 py-4 ..."></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


            </div>

        </div>

    </div>
</div>

</div>


<script>
    $( document ).ready(function() {
       
        $('select').on('change', function() {
            var id = $("#classroom_id").val();

            $.get("/teacher/behavioursheet/"+id, function(data, status){
                $("#search-result").html(data);

                //Change the classroom input to the clicked classroom
                $("#classroom").val(id);
            });
        });

        $('#general-bs').click(function(e){
            $("#modal-card").removeClass('hidden');
            $("#modal-card").addClass('flex');
            //For general bs, search students from all classes
            $("#classroom").val('all');
            stopScroll();
            console.log(students);
        });


        $("#close-modal").click(function(e){

            if(checkInput()){

                if (confirm('You have some unsubmitted input. Closing this form will discard all changes')) {
                    closeBookingForm();
                }  
            }

            else{
                closeBookingForm();
            }
             
            
        });

        $(document).on('keyup', '#search', function(){
            var query = $(this).val();
            var classroom = $('#classroom').val();
            // console.log(query+" on class "+classroom);
            fetch_students(query, classroom);
        });

        function fetch_students(query = '', classroom = '')
        {
            $.ajax({
            url:"{{ route('student.action') }}",
            method:'GET',
            data:{query:query, classroom:classroom, paginate:4},
            dataType:'json',
            success:function(data)
            {
                $('#students-table-body').html(data.table_data);
            }
            });
        }    

        function checkInput(){
            //Checks whether the user has entered some input
            if($('#period').val() || $('#comments').val() || students.length > 0){
                return true;
            }
            else{
                return false;
            }
        }
        
        function closeBookingForm(){
            $("#modal-card").removeClass('flex');
            $("#modal-card").addClass('hidden');
            resumeScroll();
            //Flush the added students state
            students = [];
            $('#added-students').html('');

            //Flush all messages and states
            $('#search').val('');
            $('#error').hide();
            $('#success').hide();
            $('#students-table-body').html('');
        }

     });
</script>
@endsection