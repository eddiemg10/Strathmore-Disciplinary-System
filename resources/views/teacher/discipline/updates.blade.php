@extends("layouts.adminLayout")
@section('sidebar')
<x-teacher-sidebar focus="discipline" />
@endsection
@section('content')

<div class="flex flex-col items-center pb-40 px-5 md:px-20 gap-y-20">

    <div class="bg-white px-10 py-4 drop-shadow-md mt-10 w-full rounded-md flex flex-col items-center gap-y-8">
        <h1 class="text-zinc-700 md:text-3xl text-2xl font-semibold">Discipline Management</h1>
        <x-discipline-sliding-tab focus="updates" />
        <div class="w-full">
            <x-session-messages />
        </div>
    </div>

    <div class="bg-white flex flex-col items-center pt-10 px-10 drop-shadow-md pb-40 w-full">

        <div class="flex gap-5 mb-10">
            <a class="text-blue-strath hover:cursor-pointer border-b-4 border-[#00447D] font-semibold">Unresolved
                Warnings</a>
            <a href="{{route('updates.resolved')}}">Resolved Warnings</a>
        </div>

        <div class="flex flex-col items-start w-full px-20 mt-20">

            <h1 class="text-3xl text-zinc-600 font-semibold">Verbal Warning</h1>
            <p class="mt-5 text-zinc-600">The following students have a total of at least 4 disciplinary bookings and
                are due a
                verbal warning</p>

            <div class="mt-10 ml-10 flex flex-col gap-y-4">
                @foreach($verbals as $i=>$verbal)
                <div class="display-flex items-center">
                    {{($i+1).'. '}}
                    <a href="{{route('discipline.history', ['student'=>$verbal->student->id])}}"
                        class="text-blue-strath underline">{{$verbal->student->first_name.'
                        '.$verbal->student->last_name.'
                        ('.$verbal->student->classroom->name.')'}}</a>

                    <form method="POST" action="{{route('discipline.resolve')}}" class="inline-flex  resolve-form">
                        @csrf

                        <input type="hidden" name="warning" value={{$verbal->id}}>
                        <button data-type="verbal" class="bg-emerald-100 text-sm text-black font-light ml-8 py-[2px] px-3 rounded-full
                            resolve-warning">Resolve</button>
                    </form>
                </div>
                @endforeach
            </div>

        </div>

        <div class="bg-slate-100 w-[90%] h-[3px] mt-10"></div>


        <div class="flex flex-col items-start w-full px-20 mt-20">

            <h1 class="text-3xl text-zinc-600 font-semibold">Warning Letter</h1>
            <p class="mt-5 text-zinc-600">The following students have a total of at least 8 disciplinary bookings and
                are due a
                warning letter</p>

            <div class="mt-10 ml-10 flex flex-col gap-y-4">
                @foreach($letters as $i=>$letter)
                <div class="display-flex items-center">
                    {{($i+1).'. '}}
                    <a href="{{route('discipline.history', ['student'=>$letter->student->id])}}"
                        class="text-blue-strath underline">{{$letter->student->first_name.'
                        '.$letter->student->last_name.'
                        ('.$letter->student->classroom->name.')'}}</a>

                    <form method="POST" action="{{route('discipline.resolve')}}" class="inline-flex  resolve-form">
                        @csrf

                        <input type="hidden" name="warning" value={{$letter->id}}>
                        <button data-type="letter" id={{$letter->id}}
                            class="bg-emerald-100 text-sm text-black font-light ml-8 py-[2px] px-3 rounded-full
                            resolve-warning">Resolve</button>
                    </form>
                </div>
                @endforeach
            </div>

        </div>

        <div class="bg-slate-100 w-[90%] h-[3px] mt-10"></div>

        <div class="flex flex-col items-start w-full px-20 mt-20">

            <h1 class="text-3xl text-zinc-600 font-semibold">Suspension</h1>
            <p class="mt-5 text-zinc-600">The following students have a total of more than 12 disciplinary bookings and
                require further disciplinary action</p>

            <div class="mt-10 ml-10 flex flex-col gap-y-4">
                @foreach($suspensions as $i=>$suspension)
                <div class="display-flex items-center ">
                    {{($i+1).'. '}}
                    <a href="{{route('discipline.history', ['student'=>$suspension->student->id])}}"
                        class="text-blue-strath underline">{{$suspension->student->first_name.'
                        '.$suspension->student->last_name.'
                        ('.$suspension->student->classroom->name.')'}}</a>

                    <form method="POST" action="{{route('discipline.resolve')}}" class="inline-flex resolve-form">
                        @csrf

                        <input type="hidden" name="warning" value={{$suspension->id}}>
                        <button data-type="suspension" id={{$suspension->id}}
                            class="bg-emerald-100 text-sm text-black font-light ml-8 py-[2px] px-3 rounded-full
                            resolve-warning">Resolve</button>
                    </form>
                </div>
                @endforeach
            </div>

        </div>





    </div>

</div>

<script>
    $('.resolve-form').submit(function(e){
        e.preventDefault();

        if(!confirm('Resolving this warning will send a notification to the student\'s parents')){
            return;
        }
        $(this).unbind('submit').submit()
        })
</script>
@endsection