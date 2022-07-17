<div class="w-full">
    <div class="flex flex-col items-center">
        <h1 class="text-3xl text-zinc-600">Disciplinary Record</h1>
        <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>

        <div class="mt-20 flex flex-col lg:flex-row gap-y-5 lg:items-center">
            <div class="w-full lg:w-[50%] px-8">
                <div class="w-full">
                    <img class="rounded-md shadow-lg object-cover"
                        src={{asset('assets/profile_pictures/'.$student->profile_photo)}}
                    alt="">
                </div>
            </div>

            <div class="w-full lg:w-[50%] px-5 flex flex-col gap-y-5 items-center">

                <div
                    class="bg-white shadow-xl flex flex-col gap-y-2 border border-solid border-slate-200 text-start pl-5 w-full rounded-md py-5">

                    <p class="text-zinc-700 ">Name: <span class="font-bold">{{$student->first_name.'
                            '.$student->last_name}}</span> </p>


                    <p class="text-zinc-700 ">Class: <span class="font-bold">{{$student->classroom->name}}</span> </p>

                    <p class="text-zinc-700 ">Total Bookings: <span
                            class="font-bold">{{$student->bookings->count()}}</span> </p>


                    <p class="text-zinc-700 ">Parents registered: <span
                            class="font-bold">{{count($student->parents)}}</span> </p>
                    <ul class="text-sm ml-4">

                        @forelse($student->parents as $i => $parent)
                        <li class="text-blue-strath"><a>{{($i+1).". ".$parent->first_name."
                                ".$parent->last_name}}</a></li>
                        @empty
                        <div class="w-full flex justify-start">
                            <div
                                class="border border-solid border-red-800 bg-red-50 text-red-800 font-bold px-3 py-2 mt-4 w-[80%]">
                                <p>No parents registered</p>
                            </div>
                        </div>
                        @endforelse
                    </ul>
                </div>



            </div>




        </div>

        <div class="bg-slate-100 w-[90%] h-[3px] mt-20"></div>

        <div class="text-center mt-8">
            <h1 class="text-3xl text-zinc-700 font-bold">Booking History</h1>
            <p class="text-zinc-700 font-light text-sm">Click on a year to view all bookings</p>
        </div>

        <div class="w-full px-5 mt-20 flex flex-col items-center gap-5">
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
                target.html(data);
            }
        });

    }

});
</script>