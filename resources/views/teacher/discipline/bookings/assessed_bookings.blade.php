<div class="w-full px-10 flex flex-col items-center">

    @foreach ($detention_list as $classBookings)


    <table class="border-collapse border border-black w-full text-sm my-10">
        <thead>
            <tr class="bg-zinc-600 text-base text-white font-black">
                <th class="border border-black px-4 py-2 text-center" colspan="5">
                    {{strtoupper($classBookings['classroom']->classroom->name)}} DETENTION LIST FOR: {{$endDateHuman}}
                </th>

            </tr>

            <tr class="bg-zinc-200 text-base text-black font-bold">
                <th class="border-x border-b border-black">First name</th>
                <th class="border-x border-b border-black">Surname</th>
                <th class="border-x border-b border-black">Subject</th>
                <th class="border-x border-b border-black">Booking</th>
                <th class="border-x border-b border-black">Remarks</th>

            </tr>

        </thead>
        <tbody>

            @forelse($classBookings['bookings'] as $booking)
            <tr class="odd:bg-white even:bg-slate-50">

                <td class="border border-black px-3 py-2">{{$booking->student->first_name}}</td>
                <td class="border border-black px-3 py-2">{{$booking->student->last_name}}</td>
                <td class="border border-black px-3 py-2">{{$booking->period}}</td>
                <td class="border border-black px-3 py-2">{{$booking->offence}}</td>
                <td class="border border-black px-3 py-2"></td>
            </tr>

            @empty
            <tr>
                <td colspan="5" class="border border-black px-3 py-2 text-center ">
                    No assessed bookings are available for the specified time span
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>

    @endforeach

    @if(count($detention_list) > 0)

    <div class="w-full flex flex-wrap gap-y-8  justify-center items-center mt-10">
        <div class="w-full lg:w-[50%] flex justify-center">
            <a class="w-[80%] bg-red-strath rounded hover:bg-red-800 transition md:text-base text-sm text-center text-white py-2 px-3 md:px-5 "
                href={{route('detentionPDF', ['startDate'=>$startDate, 'endDate'=>$endDate])}}><i
                    class="fa-solid fa-file-pdf pr-4"></i>Download PDF</a>
        </div>

        <div class="w-full lg:w-[50%] flex justify-center">
            <a id="notify"
                class="w-[80%] bg-teal-600 rounded hover:bg-teal-700 transition md:text-base text-sm text-center text-white py-2 px-3 md:px-5 "><i
                    class="fa-solid fa-envelopes-bulk pr-4"></i>Send out Notification</a>
        </div>
        {{-- {{route('notify.detention', ['startDate'=>$startDate, 'endDate'=>$endDate])}} --}}

    </div>

    <div id="success"
        class="hidden my-5 text-center font-bold text-green-900 bg-green-50 border-2 border-green-600 rounded-md w-full py-5">

    </div>

    <div id="error"
        class=" hidden my-5 text-center font-bold text-red-900 bg-red-50 border-2 border-red-700 rounded-md w-full py-5">

    </div>

    @endif

</div>

<script>
    $( document ).ready(function() {

    $('#notify').click(function(e){
        
        $.ajax({
            url:"{{ route('notify.detention')}}",
            method:'GET',
            data:{startDate:"{{$startDate}}", endDate:"{{$endDate}}"},
            dataType:'json',
            success:function(data)
            {
                // data = JSON.parse(data);
                console.log(data)
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

});
</script>