@extends("layouts.adminLayout")
@section('sidebar')
<x-admin-sidebar focus="discipline" />
@endsection
@section('content')

<x-booking-form title="Add Booking" width="[80vw]" />

<div class="flex flex-col items-center pb-40 px-5 md:px-20 gap-y-20">

    <div class="bg-white px-10 py-5 shadow-md mt-10 w-full rounded-md flex flex-col items-center gap-y-8">
        <h1 class="text-zinc-700 md:text-3xl text-2xl font-semibold">Discipline Management</h1>
        <x-discipline-sliding-tab />
        <div class="w-full">
            <x-session-messages />
        </div>
    </div>

    <div class="flex flex-wrap lg:flex-nowrap gap-x-5  sm:gap-y-10 w-full">

        {{-- <div class="flex grow min-w-[16rem] table-fixed flex-col bg-white drop-shadow-md py-10"> --}}
            <x-admin-find-classroom type="booking" :classrooms="$classrooms" />
            {{--
        </div> --}}

        {{-- search results --}}
        <div id="search-result"
            class="flex grow-[3] basis-[532px]  flex-col items-center drop-shadow-md bg-white py-10">

            <div class="animate-pulsex w-full">
                <div class="w-full flex flex-col items-center">
                    <h1 class="text-3xl text-zinc-600">Behaviour Sheet</h1>

                    <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>

                    <div class="flex w-full px-10 justify-around mt-10">

                        <div class="bg-slate-50 rounded-full px-3 py-2">
                            <span>Date: </span> <span>28/06/2022</span>
                        </div>

                        <div class="bg-slate-50 rounded-full px-3 py-2">
                            <span>Classroom: </span> <span>Form 1A</span>
                        </div>

                    </div>

                    <button id="add-booking"
                        class="w-[60%] bg-blue-strath rounded hover:bg-sky-900 transition md:text-base text-sm text-white py-2 px-3 md:px-5 mt-10">Add
                        booking</button>


                </div>


            </div>

        </div>

    </div>
</div>

</div>


<script>
    $( document ).ready(function() {

        $("#add-booking").click(function(e){
            $("#modal-card").removeClass('hidden');
            $("#modal-card").addClass('flex');
            stopScroll();
        })

        $("#close-modal").click(function(e){
            $("#modal-card").removeClass('flex');
            $("#modal-card").addClass('hidden');
            resumeScroll();
        });

        $(document).on('keyup', '#search', function(){
            var query = $(this).val();
            var classroom = $('#classroom_id').val();
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

     });
</script>
@endsection