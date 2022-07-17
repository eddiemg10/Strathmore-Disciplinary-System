<div class="w-full px-5">

    <div>


        <h1 class="text-2xl text-zinc-600 font-semibold mb-3">Verbal Warnings</h1>

        <table class="border-collaps border border-black w-full text-sm">
            <thead>
                <tr class="bg-zinc-500 text-base text-white">
                    <th class="border border-black px-4 py-2">Fist name</th>
                    <th class="border border-black px-4 py-2">Last name</th>
                    <th class="border border-black px-4 py-2">Class</th>
                    <th class="border border-black px-4 py-2">Warning type</th>
                    <th class="border border-black px-4 py-2">Bookings</th>
                    <th class="border border-black px-4 py-2">Date</th>



                </tr>
            </thead>
            <tbody>

                @forelse($verbals as $warning)
                <tr class="odd:bg-white even:bg-slate-50">
                    <td class="border border-black px-3 py-2 ...">{{$warning->student->first_name}}</td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->student->last_name}}</td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->student->classroom->name}}
                    </td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->type}}</td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->bookings}}</td>
                    <td class="border border-black px-3 py-2 ...">{{date('jS F Y',strtotime($warning->updated_at))}}
                    </td>
                </tr>
                @empty
                <tr class="bg-white">
                    <td colspan="6" class="text-center py-2">No verbal warnings issued in this year</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div class="mt-10">


        <h1 class="text-2xl text-zinc-600 font-semibold mb-3">Warning Letters</h1>

        <table class="border-collaps border border-black w-full text-sm">
            <thead>
                <tr class="bg-zinc-500 text-base text-white">
                    <th class="border border-black px-4 py-2">Fist name</th>
                    <th class="border border-black px-4 py-2">Last name</th>
                    <th class="border border-black px-4 py-2">Class</th>
                    <th class="border border-black px-4 py-2">Warning type</th>
                    <th class="border border-black px-4 py-2">Bookings</th>
                    <th class="border border-black px-4 py-2">Date</th>



                </tr>
            </thead>
            <tbody>

                @forelse($letters as $warning)
                <tr class="odd:bg-white even:bg-slate-50">
                    <td class="border border-black px-3 py-2 ...">{{$warning->student->first_name}}</td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->student->last_name}}</td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->student->classroom->name}}
                    </td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->type}}</td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->bookings}}</td>
                    <td class="border border-black px-3 py-2 ...">{{date('jS F Y',strtotime($warning->updated_at))}}
                    </td>
                </tr>
                @empty
                <tr class="bg-white">
                    <td colspan="6" class="text-center py-2">No warning letters issued in this year</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div class="mt-10">

        <h1 class="text-2xl text-zinc-600 font-semibold mb-3">Suspensions</h1>

        <table class="border-collaps border border-black w-full text-sm">
            <thead>
                <tr class="bg-zinc-500 text-base text-white">
                    <th class="border border-black px-4 py-2">Fist name</th>
                    <th class="border border-black px-4 py-2">Last name</th>
                    <th class="border border-black px-4 py-2">Class</th>
                    <th class="border border-black px-4 py-2">Warning type</th>
                    <th class="border border-black px-4 py-2">Bookings</th>
                    <th class="border border-black px-4 py-2">Date</th>



                </tr>
            </thead>
            <tbody>

                @forelse($suspensions as $warning)
                <tr class="odd:bg-white even:bg-slate-50">
                    <td class="border border-black px-3 py-2 ...">{{$warning->student->first_name}}</td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->student->last_name}}</td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->student->classroom->name}}
                    </td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->type}}</td>
                    <td class="border border-black px-3 py-2 ...">{{$warning->bookings}}</td>
                    <td class="border border-black px-3 py-2 ...">{{date('jS F Y',strtotime($warning->updated_at))}}
                    </td>
                </tr>
                @empty
                <tr class="bg-white">
                    <td colspan="6" class="text-center py-2">No suspensions issued in this year</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>


</div>