<div class="animate-pulsex w-full">
    <div class="w-full flex flex-col items-center">
        <h1 class="text-3xl text-zinc-600">Behaviour Sheet</h1>

        <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>

        <div class="flex w-full px-10 justify-around mt-10">

            <div class="bg-slate-50 rounded-full px-3 py-2">
                <span>Date: </span> <span>{{$date}}</span>
            </div>

            <div class="bg-slate-50 rounded-full px-3 py-2">
                <span>Classroom: </span> <span>{{$classroom->name}}</span>
            </div>

        </div>

        <button id="add-booking"
            class="w-[60%] bg-blue-strath rounded hover:bg-sky-900 transition md:text-base text-sm text-white py-2 px-3 md:px-5 mt-10">Add
            booking</button>


        <div class="w-full px-5 mt-10">
            <table class="border-collaps border border-black w-full text-sm">
                <thead>
                    <tr class="bg-zinc-500 text-base text-white">
                        <th class="border border-black px-4 py-2">Name</th>
                        <th class="border border-black px-4 py-2">Period</th>
                        <th class="border border-black px-4 py-2">Comments</th>
                        <th class="border border-black px-4 py-2">Teacher</th>


                    </tr>
                </thead>
                <tbody>

                    @foreach($bookings as $booking)
                    <tr class="odd:bg-white even:bg-slate-50">
                        <td class="border border-black px-3 py-2 ...">{{$booking->last_name.".
                            ".substr($booking->first_name, 0, 1)}}</td>
                        <td class="border border-black px-3 py-2 ...">{{$booking->period}}</td>
                        <td class="border border-black px-3 py-2 ...">{{$booking->offence}}
                        </td>
                        <td class="border border-black px-3 py-2 ...">{{$booking->trlname.".
                            ".substr($booking->trfname, 0, 1)}}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>


</div>

<script>
    $( document ).ready(function() {

        $("#add-booking").click(function(e){
            $("#modal-card").removeClass('hidden');
            $("#modal-card").addClass('flex');
            stopScroll();
            console.log(students)
        })

        $("#close-modal").click(function(e){
            $("#modal-card").removeClass('flex');
            $("#modal-card").addClass('hidden');
            resumeScroll();
            //Flush the added students state
            students = [];
            $('#added-students').html('');

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


        

     });
</script>