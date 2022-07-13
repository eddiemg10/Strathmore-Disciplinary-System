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

    <div class="w-full lg:w-[50%] flex justify-center mt-10">
        <a class="w-[60%] bg-red-strath rounded hover:bg-red-800 transition md:text-base text-sm text-center text-white py-2 px-3 md:px-5 mt-10"
            href={{route('detentionPDF', ['startDate'=>$startDate, 'endDate'=>$endDate])}}><i
                class="fa-solid fa-file-pdf pr-4"></i>Download PDF</a>
    </div>

</div>