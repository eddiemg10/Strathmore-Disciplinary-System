<div class="w-full">


    <div class="flex w-full px-10 justify-around mt-10">

        <div class="bg-slate-50 rounded-full px-4 py-2">
            <span>From: {{$startDate}}</span>
        </div>

        <div class="bg-slate-50 rounded-full px-4 py-2">
            <span>To: {{$endDate}}</span>
        </div>

    </div>

    <div class="w-full px-5 mt-10">

        <div class="w-full flex flex-col items-center my-10">
            <div id="loading-refresh" class="mt-16 hidden">
                <x-loading-button />
            </div>

            <div id="loading-done" class="mt-16">
                <button id="refresh-assessments"
                    class=" text-blue-strath bg-none hover:bg-blue-50 font-medium rounded-full text-sm border border-[#00447D] px-5 py-1 text-center mr-2 inline-flex items-center">
                    <i class="fa-solid fa-arrows-rotate mr-4"></i> refresh
                </button>
            </div>
        </div>

        <table class="border-collapse border border-black w-full text-sm">
            <thead>
                <tr class="bg-zinc-500 text-base text-white">
                    <th class="border-x border-t border-black px-4 py-2"></th>
                    <th class="border-x border-t border-black px-4 py-2">Name</th>
                    <th class="border-x border-t border-black px-4 py-2">Period</th>
                    <th class="border-x border-t border-black px-4 py-2">Comments</th>
                    <th class="border-x border-t border-black px-4 py-2">Teacher</th>
                    <th class="border-x border-t border-black px-4 py-2" colspan="3">Assessment</th>
                    <th class="border-x border-t border-black px-4 py-2" colspan="2">Action</th>

                </tr>

                <tr class="bg-zinc-500 text-base text-white">
                    <th class="border-x border-b border-black"></th>
                    <th class="border-x border-b border-black"></th>
                    <th class="border-x border-b border-black"></th>
                    <th class="border-x border-b border-black"></th>
                    <th class="border-x border-b border-black"></th>
                    <th class="border border-black">0</th>
                    <th class="border border-black">1</th>
                    <th class="border border-black">2</th>
                    <th class="border border-black">Edit</th>
                    <th class="border border-black">Delete</th>

                </tr>

            </thead>
            <tbody>

                @forelse($bookings as $i=>$booking)
                <tr class="odd:bg-white even:bg-slate-50">
                    <td class="border border-black px-3 py-2">{{($i+1)}}</td>
                    <td class="border border-black px-3 py-2">{{$booking->student->last_name.".
                        ".substr($booking->student->first_name, 0, 1)}}</td>
                    <td class="border border-black px-3 py-2">{{$booking->period}}</td>
                    <td class="border border-black px-3 py-2">{{$booking->offence}}
                    </td>
                    <td class="border border-black px-3 py-2">{{$booking->teacher->last_name.".
                        ".substr($booking->teacher->first_name, 0, 1)}}</td>

                    <td class="border border-black px-3 py-2">
                        <input type="radio" value="0" name="assess{{$booking->id}}" data-booking="{{$booking->id}}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                    </td>
                    <td class="border border-black px-3 py-2">
                        <input type="radio" value="1" name="assess{{$booking->id}}" data-booking="{{$booking->id}}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                    </td>
                    <td class="border border-black px-3 py-2">
                        <input type="radio" value="2" name="assess{{$booking->id}}" data-booking="{{$booking->id}}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                    </td>

                    <td class="border border-black px-3 py-2 text-center">
                        <i class="fa-solid fa-pen text-blue-strath hover:cursor-pointer edit-booking"
                            data-booking={{$booking->id}}></i>
                    </td>
                    <td class="border border-black px-3 py-2 text-center ">
                        <i class="fa-solid fa-trash-can text-red-strath hover:cursor-pointer"></i>
                    </td>


                </tr>

                @empty
                <tr>
                    <td colspan="10" class="border border-black px-3 py-2 text-center ">
                        No unassessed bookings are available for the specified time span
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

        <div class="w-full my-10">
            <div id="success"
                class="hidden relative my-5 text-center font-bold text-green-900 bg-green-50 border-2 border-green-600 rounded-md w-full py-5">
                Bookings Successfully assessed

                <span class="absolute font-light text-2xl right-10 close-notification hover:cursor-pointer">X</span>
            </div>

            <div id="error"
                class=" hidden my-5 text-center font-bold text-red-900 bg-red-50 border-2 border-red-700 rounded-md w-full py-5">
                An error occured in assessing bookings. Please try again later

                <span class="absolute font-light text-2xl right-10 close-notification hover:cursor-pointer">X</span>

            </div>
        </div>


        @if($bookings->count() > 0)
        <div class="w-full flex flex-col items-center">
            <button id="submit-assessments"
                class="w-[60%] bg-blue-strath rounded hover:bg-sky-900 transition md:text-base text-sm text-white py-2 px-3 md:px-5 mt-10">Submit
                Assessments</button>
        </div>
        @endif

    </div>

</div>

<script>
    $( document ).ready(function() {


        $("#submit-assessments").click(function(e){
            var assessments = [];

            $(':radio:checked').each(function(){
                assessments.push({booking:$(this).data('booking'), assessment:$(this).val()});
          

            });

            console.log(assessments);

            $.ajax({
                url: "{{route('assess.bookings')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    assessments:JSON.stringify(assessments),

                },
                success:function(response){

                    refresh(response);         

                }
            });
        });

        $("#refresh-assessments").click(function(e){

            $("#loading-done").hide();
            $("#loading-refresh").show();

            refresh();
    

        });


        $(".close-notification").click(function(e){
            $(this).parent().hide();
        });

        $('.edit-booking').click(function(e){
            let booking = $(this).data('booking');
            let row = $(this).parent().parent();

            $.ajax({
                type: 'get',
                url: '/admin/bookings/edit/'+booking,
                success: function(data) {

                    $row.html(data);

                }
            });

        });

        async function refresh(response = null){
            await $.ajax({
                type: 'get',
                url: '/admin/bookings/unassessed',
                data: {startDate: "{{$startDate}}", endDate: "{{$endDate}}"},
                success: function(data) {

                    $("#booking-results").html(data);
                    $("#loading-refresh").hide();
                    $("#loading-done").show();

                }
            });

            if(response !== null){
                if(response.success){
                    $("#success").show();
                }

                if(response.error){
                    $("#error").show();

                }
            }


        }

    });
</script>