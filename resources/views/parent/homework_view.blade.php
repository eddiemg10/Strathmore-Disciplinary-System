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

                        @forelse($assignments as $assignment)
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

                        @empty
                        <tr>
                            <td class="py-3 text-center" colspan="3">No homework</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>


    </div>
</div>