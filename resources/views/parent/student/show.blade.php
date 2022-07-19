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
                <a href={{route('parent.homework', ['id'=>$student->id])}} class="hover: cursor-pointer">Homework</a>
            </div>

        </div>

    </div>

    <div class="bg-white flex flex-col items-center px-5 md:px-10 pt-10 drop-shadow-md pb-40 w-full">

        <div class="bg-green-50 py-10 w-full">

            <div class="flex flex-col items-center">
                <h1 class="text-3xl text-zinc-700 mb-20">RECENT UPDATES</h1>

                {{-- <div class="bg-zinc-500 w-[90%] h-[3px] mt-5 mb-8"></div> --}}

                <div class="w-full px-20">
                    <h1 class="text-2xl text-zinc-700 font-semibold">This week's Bookings</h1>
                    <div class="bg-zinc-300 w-full h-[1px] mt-5 mb-8"></div>

                    @if(count($bookings) > 0)
                    <div class="flex flex-col items-center px-20 w-full">
                        <table class="border-collapse border w-full border-zinc-500">
                            <thead>
                                <tr class="bg-green-200 py-3">
                                    <th class="border border-zinc-500 ">Booking</th>
                                    <th class="border border-zinc-500 ">Period</th>
                                    <th class="border border-zinc-500 ">Date</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($bookings as $booking)
                                <tr class="py-2">
                                    <td class="pl-5 border border-zinc-500 ">{{$booking->offence}}</td>
                                    <td class="pl-5 border border-zinc-500 ">{{$booking->period}}</td>
                                    <td class="pl-5 border border-zinc-500 ">{{date('jS F
                                        Y',strtotime($booking->created_at))}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @endif

                </div>

                <div class="w-full px-20 mt-20">
                    <h1 class="text-2xl text-zinc-700 font-semibold">Warnings</h1>
                    <div class="bg-zinc-300 w-full h-[1px] mt-5 mb-8"></div>

                    @forelse ($warnings as $warning)
                    <div class="mt-9 pl-10">
                        @switch($warning->type)
                        @case('verbal')
                        <p class="font-bold text-zinc-700 text-lg"> Verbal Warning: <span class="font-light">A verbal
                                warning
                                was
                                issued to
                                <span class="font-semibold text-blue-strath">{{$student->first_name.'
                                    '.$student->last_name}}</span> on
                                <span class="font-semibold text-blue-strath">{{ date('jS F
                                    Y',strtotime($warning->updated_at))}}</span></span>
                        </p>

                        <p
                            class="font-light text-zinc-600 bg-green-100 text-center py-1 border mt-2 px-5 border-green-600">
                            A
                            verbal warning is an oral
                            warning given to
                            students who
                            have accumulated
                            more than 4
                            disciplinary bookings within the same school year. {{$student->first_name}} risks receiving
                            a warning letter should he surpass 8 bookings this year</p>

                        @break

                        @case('letter')
                        <p class="font-bold text-zinc-700 text-lg">Warning Letter: <span class="font-light">A Warning
                                Letter
                                was
                                issued to
                                <span class="font-semibold text-blue-strath">{{$student->first_name.'
                                    '.$student->last_name}}</span> on
                                <span class="font-semibold text-blue-strath">{{ date('jS F
                                    Y',strtotime($warning->updated_at))}}</span></span>
                        </p>

                        <p
                            class="font-light text-zinc-600 bg-green-100 text-center py-1 border mt-2 px-5 border-green-600">
                            A
                            warning letter is an official letter from the school
                            given to
                            students who
                            have accumulated
                            more than 8
                            disciplinary bookings within the same school year. Your son should produce this letter to
                            you which should be signed and returned to the school. {{$student->first_name}} risks
                            receiving
                            a suspension should he surpass 12 bookings this year</p>
                        @break

                        @case('suspension')
                        <p class="font-bold text-zinc-700 text-lg"> Suspension: <span class="font-light">A suspension
                                was
                                issued to
                                <span class="font-semibold text-blue-strath">{{$student->first_name.'
                                    '.$student->last_name}}</span> on
                                <span class="font-semibold text-blue-strath">{{ date('jS F
                                    Y',strtotime($warning->updated_at))}}</span></span>
                        </p>

                        <p
                            class="font-light text-zinc-600 bg-green-100 text-center py-1 border mt-2 px-5 border-green-600">
                            A suspension is a punishment given to students who have surpassed 12 bookings in the same
                            school year. {{$student->first_name}} risks receiving
                            a longer suspension should his discipline fail to improve within the year</p>
                        @break

                        @endswitch
                    </div>
                    @empty

                    @endforelse
                </div>
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
                target.html(data);
            }
        });

    }

});
</script>
@endsection