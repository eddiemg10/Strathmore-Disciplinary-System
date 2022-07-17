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
            <a href="{{route('discipline.updates')}}">Unresolved
                Warnings</a>
            <a class="text-blue-strath hover:cursor-pointer border-b-4 border-[#00447D] font-semibold">Resolved
                Warnings</a>
        </div>

        <div class="w-full px-20 mt-20 flex flex-col items-center gap-5">
            @forelse ($history as $year)
            <div class="px-10 w-full flex py-3 text-white bg-blue-strath">
                <span data-year='{{$year->year}}'
                    class="w-[80%] items-center flex font-bold font-sans text-xl hover:cursor-pointer drop-down justify-start">
                    <i class="fa-solid fa-caret-right fa-lg mr-3  transition"></i>
                    <p> {{$year->year}}</p>
                </span>

                <span class="font-thin w-[20%] flex justify-end">
                    @if($year->warnings === 1)
                    <p>{{$year->warnings}} warning</p>
                    @else
                    <p>{{$year->warnings}} warnings</p>
                    @endif
                </span>

            </div>

            <div class="w-[90%] warning-results hidden"></div>

            @empty
            <p class="text-zinc-700 w-full font-light text-center p-10 bg-slate-50">No warnings present for this year
            </p>
            @endforelse
        </div>





    </div>

</div>

<script>
    $( document ).ready(function() {
        
        $('.drop-down').click(function(e){
        var icon = $(this).children("i");
        var year = $(this).data('year');
        var target = $(this).parent().next('.warning-results');


        if(icon.hasClass('clicked')){
                
            icon.removeClass('rotate-90 clicked');
            target.hide();
                       
        }

        else{

            if(icon.hasClass('loaded')){

                target.show();
            }
            else{
                fetchYearWarnings(year, target);
                icon.addClass('loaded');
                target.show();

            }

            icon.addClass('rotate-90 clicked');
        }
        
    });


    function fetchYearWarnings(year, target){

        $.ajax({
            url:"{{ route('warnings.history') }}",
            method:'GET',
            data:{year:year},
            dataType:'html',
            success:function(data)
            {
                target.html(data);
            }
        });

    }

    });
</script>
@endsection