{{-- <div class="flex grow-[3] basis-[532px] flex-col items-center bg-white py-10"> --}}

    <div>
        <div class="flex flex-col items-center">
            <h1 class="text-3xl text-zinc-600">Parent Details</h1>
            <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>

            <div class="mt-20 flex flex-col lg:flex-row gap-y-5 lg:items-center">
                <div class="w-full lg:w-[50%] px-8">
                    <div class="w-full">
                        <img class="rounded-md shadow-lg object-cover"
                            src={{asset('assets/profile_pictures/'.$parent->profile_photo)}}
                        alt="">
                    </div>
                </div>

                <div class="w-full lg:w-[50%] px-5 flex flex-col gap-y-5 items-center">

                    <div
                        class="bg-white shadow-xl border border-solid border-slate-200 text-center w-full rounded-md py-5">
                        <p class="text-zinc-700 text-xl">Children registered: <span
                                class="font-bold">({{count($parent->children)}})</span> </p>
                        <ul>

                            @forelse($parent->children as $i => $child)
                            <li class="text-blue-strath underline my-3"><a href="#">{{($i+1).". ".$child->first_name."
                                    ".$child->last_name}}</a></li>
                            @empty
                            <div class="w-full flex justify-center">
                                <div
                                    class="border border-solid border-red-800 bg-red-50 text-red-800 font-bold px-3 py-2 mt-4 w-[80%]">
                                    <p>No Children registered</p>
                                </div>
                            </div>
                            @endforelse
                        </ul>
                    </div>

                    <button id="edit-parent" data-id="{{$parent->id}}"
                        class="bg-blue-strath py-2 px-3 w-full text-white rounded-md mt-6 mb-2 flex justify-center relative items-center gap-x-5 hover:shadow-md hover:cursor-pointer"><i
                            class="fa-solid fa-pen "></i>Edit parent
                        Details</button>

                    <button id="delete-parent" data-id="{{$parent->id}}"
                        class="bg-red-strath py-2 px-3 w-full text-white rounded-md flex justify-center relative items-center gap-x-5 hover:shadow-md hover:cursor-pointer"><i
                            class="fa-solid fa-trash-can "></i>Delete parent
                        Record</button>



                </div>


            </div>


        </div>

        <div class="flex flex-col items-center">
            <div class="bg-slate-100 w-[90%] h-[2px] mt-16"></div>

        </div>

        <div class="w-full px-5 mt-24 flex justify-center">

            <table class="w-full">
                <thead class="bg-blue-strath text-white text-bold ">
                    <tr>
                        <th class="py-4 px-2 md:text-md text-center">First Name</th>
                        <th class="py-4 px-2 md:text-md text-center">Surname</th>
                        <th class="py-4 px-2 md:text-md text-center">Email</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 bg-slate-100 text-center px-3">{{$parent->first_name}}</td>
                        <td class="py-2 bg-slate-100 text-center px-3">{{$parent->last_name}}</td>
                        <td class="py-2 bg-slate-100 text-center px-3">{{$parent->email}}</td>

                    </tr>

                </tbody>
            </table>
        </div>

    </div>