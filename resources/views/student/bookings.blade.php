<div class="w-full px-5">

    <table class="border-collaps border border-black w-full text-sm">
        <thead>
            <tr class="bg-zinc-500 text-base text-white">
                <th class="border border-black px-4 py-2">Name</th>
                <th class="border border-black px-4 py-2">Period</th>
                <th class="border border-black px-4 py-2">Comments</th>
                <th class="border border-black px-4 py-2">Teacher</th>
                <th class="border border-black px-4 py-2">Date</th>



            </tr>
        </thead>
        <tbody>

            @foreach($bookings as $booking)
            <tr class="odd:bg-white even:bg-slate-50">
                <td class="border border-black px-3 py-2 ...">{{$booking->student->first_name."
                    ".$booking->student->last_name}}</td>
                <td class="border border-black px-3 py-2 ...">{{$booking->period}}</td>
                <td class="border border-black px-3 py-2 ...">{{$booking->offence}}
                </td>
                <td class="border border-black px-3 py-2 ...">{{$booking->teacher->last_name.".
                    ".substr($booking->teacher->first_name, 0, 1)}}</td>
                <td class="border border-black px-3 py-2 ...">{{date('jS F Y',strtotime($booking->created_at))}}</td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>