@extends("layouts.master")

@section('layout_content')

<div class="bg-slate-50 flex flex-col items-center pb-40 px-5 md:px-20 gap-y-20">

    <div
        class="bg-white px-5 md:px-20 py-4 pb-10 drop-shadow-md mt-10 w-full rounded-md flex flex-col items-center gap-y-8">

        <div class="flex gap-5 items-center">
            <div class="w-20">
                <img class="rounded-full shadow-lg object-contain"
                    src={{asset('assets/profile_pictures/'.$student->profile_photo)}}
                alt="">
            </div>
            <h1 class="text-zinc-700 md:text-3xl text-2xl font-semibold">{{$student->first_name."
                ".$student->last_name}}</h1>
        </div>

        <div class='mt-8 flex justify-center md:w-[70%] w-full border-b-2 md:text-2xl text-base'>

            <!-- Active for now, I will sort nav bar logic later on. -->
            <div class="text-blue-strath font-bold border-b-4 border-[#00447D] w-[50%] flex flex-col
                items-center">
                <p class="hover: cursor-pointer">Disipline Record</p>
            </div>
            <div class=" w-[50%] flex flex-col items-center">
                <a href="#" class="hover: cursor-pointer">Homework</a>
            </div>

        </div>

    </div>

    <div class="bg-white flex flex-col items-center px-5 md:px-10 pt-10 drop-shadow-md pb-40 w-full">

        <div class="bg-lime-100 py-10 w-full">

            <div class="flex flex-col items-center">
                <h1 class="text-2xl text-zinc-700">SUMMARY</h1>

                <div class="bg-zinc-500 w-[90%] h-[3px] mt-5 mb-8"></div>
            </div>

        </div>

        <div class="text-center mt-20">
            <h1 class="text-3xl text-zinc-700 font-bold">Booking History</h1>
            <p class="text-zinc-700 font-light text-sm">Click on a year to view all bookings</p>
        </div>

        <div class="w-full px-20 mt-20 flex flex-col items-center gap-5">
            @forelse ($history as $year)
            <div class="px-10 w-full flex py-3 text-white bg-blue-strath">
                <span data-year='{{$year->year}}' data-student='{{$student->id}}'
                    class="w-[80%] items-center flex font-bold font-sans text-xl hover:cursor-pointer drop-down justify-start">
                    <i class="fa-solid fa-caret-right fa-lg mr-3  transition"></i>
                    <p> {{$year->year}}</p>
                </span>

                <span class="font-thin w-[20%] flex justify-end">
                    @if($year->bookings === 1)
                    <p>{{$year->bookings}} booking</p>
                    @else
                    <p>{{$year->bookings}} bookings</p>
                    @endif
                </span>

            </div>

            <div class="w-[90%] booking-results hidden"></div>

            @empty
            <p class="text-zinc-700 w-full font-light text-center p-10 bg-slate-50">No entered bookings found for
                this
                student
            </p>
            @endforelse
        </div>

    </div>

</div>


<script>
    $( document ).ready(function() {

    $('.drop-down').click(function(e){
        var icon = $(this).children("i");
        var student = $(this).data('student');
        var year = $(this).data('year');
        var target = $(this).parent().next('.booking-results');


        if(icon.hasClass('clicked')){
                
            icon.removeClass('rotate-90 clicked');
            target.hide();
                       
        }

        else{

            if(icon.hasClass('loaded')){

                target.show();
            }
            else{
                fetchYearBookings(year, student, target);
                icon.addClass('loaded');
                target.show();

            }

            icon.addClass('rotate-90 clicked');
        }
        
    });


    function fetchYearBookings(year, student, target){

        $.ajax({
            url:"{{ route('student.history') }}",
            method:'GET',
            data:{year:year, student:student},
            dataType:'html',
            success:function(data)
            {
                console.log(data);
                target.html(data);
            }
        });

    }

});
</script>
@endsection