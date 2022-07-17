{{-- Navbar for Large screens --}}
<div id="main-nav" class="pt-20 z-40 hidden w-[50%] top-0 left-0 md:flex md:w-[20%] fixed h-[100vh] bg-slate-100">
    <div class="flex flex-col gap-y-4 mt-16 items-center text-blue-strath w-full text-sm my-8 px-5">

        {{-- <div
            class="{{$focus == 'student' ? 'bg-[#00447D] text-white':'hover:font-semibold hover:shadow-inner' }} flex flex-row w-full h-16 items-center space-x-4 text-sm mx-4 lg:text-base rounded drop-shadow">
            <i class="fa-solid fa-user-graduate ml-4"></i>
            <p class="pr-4"><a href="{{route('teacher')}}">Your Profile</a></p>
        </div> --}}

        <div
            class="{{$focus == 'discipline' ? 'bg-[#00447D] text-white':'hover:font-semibold hover:shadow-inner' }} w-full flex flex-row h-16 items-center space-x-4 text-sm mx-4 lg:text-base  rounded drop-shadow">
            <i class="fa-solid fa-check-to-slot ml-4"></i>
            <p class="pr-4"><a href="{{route('admin.behavioursheet')}}">Discipline Management</a></p>
        </div>

        <div
            class="{{$focus == 'homework' ? 'bg-[#00447D] text-white':'hover:font-semibold hover:shadow-inner' }} w-full flex flex-row h-16 items-center space-x-4 text-sm mx-4 lg:text-base rounded drop-shadow">
            <i class="fa-solid fa-book ml-4"></i>
            <p class="pr-4"><a href="{{route('admin.homework.homework')}}">Homework Management</a></p>
        </div>




    </div>

</div>

{{-- Navbar for Mobile --}}
<div id="mobile-nav" class="pt-20 z-40 hidden w-[60%] top-0 left-0 md:hidden md:w-[20%] fixed h-[100vh] bg-white">

    {{-- Close button for mobile --}}
    <div id="close-nav" class="flex md:hidden absolute right-5 hover:cursor-pointer">
        {{-- Put Nice Icon --}}
        X
    </div>

    <div class="flex flex-col gap-y-4 mt-16 items-center text-blue-strath w-full text-sm my-8 px-5">

        {{-- <div
            class="{{$focus == 'student' ? 'bg-[#00447D] text-white':'hover:font-semibold hover:shadow-inner' }} flex flex-row w-full h-16 items-center space-x-4 text-sm mx-4 lg:text-base rounded drop-shadow">
            <i class="fa-solid fa-user-graduate ml-4"></i>
            <p class="pr-4"><a href="{{route('teacher')}}">Your Profile</a></p>
        </div> --}}

        <div
            class="{{$focus == 'discipline' ? 'bg-[#00447D] text-white':'hover:font-semibold hover:shadow-inner' }} w-full flex flex-row h-16 items-center space-x-4 text-sm mx-4 lg:text-base  rounded drop-shadow">
            <i class="fa-solid fa-check-to-slot ml-4"></i>
            <p class="pr-4"><a href="{{route('admin.behavioursheet')}}">Discipline Management</a></p>
        </div>

        <div
            class="{{$focus == 'homework' ? 'bg-[#00447D] text-white':'hover:font-semibold hover:shadow-inner' }} w-full flex flex-row h-16 items-center space-x-4 text-sm mx-4 lg:text-base rounded drop-shadow">
            <i class="fa-solid fa-book ml-4"></i>
            <p class="pr-4"><a href="{{route('admin.homework.homework')}}">Homework Management</a></p>
        </div>




    </div>


</div>

<div id="mobile-toggle"
    class="fixed md:hidden text-white left-3 z-40 w-16 h-16 top-10 rounded-full flex justify-center shadow-md items-end bg-blue-strath p-4">
    @switch($focus)
    @case('student')
    <i class="fa-solid fa-user-graduate fa-lg mb-2"></i>
    @break

    @case('discipline')
    <i class="fa-solid fa-check-to-slot fa-lg mb-2"></i>
    @break

    @case('homework')
    <i class="fa-solid fa-book fa-lg mb-2"></i>
    @break

    @case('admin')
    <i class="fa-solid fa-user-gear mb-2 fa-lg"></i>
    @break


    @default
    @endswitch
</div>

<script>
    $( document ).ready(function() {
    
        
        $("#mobile-toggle").click(function(e){
            $("#mobile-nav").slideToggle('slow', 'swing');

        });

        $("#close-nav").click(function(e){
            $("#mobile-nav").slideUp();
        });

});
</script>