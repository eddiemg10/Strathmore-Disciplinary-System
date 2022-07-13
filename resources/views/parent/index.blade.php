@extends("layouts.master")

@section('layout_content')

<div class="bg-slate-50 pb-40 px-5 md:px-20">
    <div class="flex flex-col items-center gap-y-20 w-full">
        <div
            class="bg-white drop-shadow-md px-10 py-10 md:py-20  mt-10 w-full rounded-md flex flex-col items-center gap-y-8">
            <h1 class="text-zinc-700 md:text-4xl text-2xl font-semibold">Parent Dashboard</h1>

        </div>

        <div class="flex flex-col items-center py-20 px-10 md:px-20 w-full bg-white rounded-md drop-shadow">

            <h1 class="text-3xl text-zinc-600 text-center">Students registered under you</h1>
            <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>

            <div class="flex flex-wrap mt-20 justify-center md:gap-10 gap-y-10 w-full">
                @forelse(Auth::User()->children as $student)

                <div
                    class="drop-shadow-md grow max-w-[400px] min-w-[300px] basis-1/2 md:basis-1/3 lg:basis-1/4 bg-slate-50 p-5 lg:p-10 rounded-md">
                    <div class="flex lg:flex-col flex-row gap-5 items-center">
                        <a class="w-full" href={{route('parent.records', ['id'=>$student->id])}}>
                            <div class="w-full">
                                <img class="rounded-md shadow-lg object-cover"
                                    src={{asset('assets/profile_pictures/'.$student->profile_photo)}}
                                alt="">
                            </div>
                        </a>

                        <div class="w-full flex flex-col gap-y-5 items-center">

                            <div class="bg-white shadow-md  text-start pl-5 w-full rounded-md py-5">
                                <p class="text-zinc-700 text-xs lg:text-xl"> <span class="font-bold">Name: </span>
                                    <span>{{$student->first_name." ".$student->last_name}}</span>
                                </p>

                                <p class="text-zinc-700 text-xs lg:text-xl"> <span class="font-bold">Class: </span>
                                    <span>{{$student->classroom->name}}</span>
                                </p>


                            </div>


                        </div>


                    </div>
                </div>
                @empty
                <div>
                    <h1 class="text-zinc-500 animate-pulse md:text-2xl text-xl font-thin">No students found under this
                        account <i class="fa-solid fa-triangle-exclamation ml-3"></i></h1>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


@endsection