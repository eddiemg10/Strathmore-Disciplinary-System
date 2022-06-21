{{-- Navbar for Large screens --}}
<div id="main-nav" class="pt-20 z-40 hidden w-[50%] top-0 left-0 md:flex md:w-[20%] fixed h-[100vh] bg-slate-100">
    <div class="flex flex-col mt-16 items-center w-full text-sm my-8">
        <ul class="text-blue-strath space-y-4">
            @if($focus == 'student')
                <div class="bg-[#00447D] text-white flex flex-row h-16 items-center space-x-4 text-lg rounded drop-shadow">
                    <i class="fa-solid fa-user-graduate ml-4"></i>
                    <li class="pr-4"><a href="{{route('admin')}}">Student Management</a></li>
                </div>
            @else
                <div class="hover:text-[#A11111] flex flex-row h-16 items-center space-x-4 text-lg rounded drop-shadow">
                    <i class="fa-solid fa-user-graduate ml-4"></i>
                    <li class="pr-4"><a href="{{route('admin')}}">Student Management</a></li>
                </div>
            @endif
            @if($focus == 'teacher')
                <div class="bg-[#00447D] text-white flex flex-row h-16 items-center space-x-4 text-lg rounded drop-shadow">
                    <i class="fa-solid fa-user-tie ml-4"></i>
                    <li class="pr-4"><a href="{{route('admin.teachers')}}">Teacher Management</a></li>
                </div>
            @else
                <div class="hover:text-[#A11111] flex flex-row h-16 items-center space-x-4 text-lg rounded drop-shadow">
                    <i class="fa-solid fa-user-tie ml-4"></i>
                    <li class="pr-4"><a href="{{route('admin.teachers')}}">Teacher Management</a></li>
                </div>
            @endif
            @if($focus == 'parent')
                <div class="bg-[#00447D] text-white flex flex-row h-16 items-center space-x-4 text-lg rounded drop-shadow">
                    <i class="fa-solid fa-children ml-4"></i>
                    <li class=" pr-4"><a href="{{route('admin.parents')}}">Parent Management</a></li>
                </div>
            @else
                <div class="hover:text-[#A11111] flex flex-row h-16 items-center space-x-4 text-lg rounded drop-shadow">
                    <i class="fa-solid fa-children ml-4"></i>
                    <li class="pr-4"><a href="{{route('admin.parents')}}">Parent Management</a></li>
                </div>
            @endif
            @if($focus == 'discipline')
                <div class="bg-[#00447D] text-white flex flex-row h-16 items-center space-x-4 text-lg rounded drop-shadow">
                    <i class="fa-solid fa-check-to-slot ml-4"></i>
                    <li class="pr-4"><a href="#">Discipline Management</a></li>
                </div>
            @else
                <div class="hover:text-[#A11111] flex flex-row h-16 items-center space-x-4 text-lg rounded drop-shadow">
                    <i class="fa-solid fa-check-to-slot ml-4"></i>
                    <li class="pr-4"><a href="#">Discipline Management</a></li>
                </div>
            @endif
            @if($focus == 'homework')
                <div class="bg-[#00447D] text-white flex flex-row h-16 items-center space-x-4 text-lg rounded drop-shadow">
                    <i class="fa-solid fa-book ml-4"></i>
                    <li class="pr-4"><a href="#">Homework Management</a></li>
                </div>
            @else
                <div class="hover:text-[#A11111] flex flex-row h-16 items-center space-x-4 text-lg rounded drop-shadow">
                    <i class="fa-solid fa-book ml-4"></i>
                    <li class="pr-4"><a href="#">Homework Management</a></li>
                </div>
            @endif     
        </ul>
        

    </div>

</div>

{{-- Navbar for Mobile --}}
<div id="mobile-nav" class="pt-20 z-40 hidden w-[50%] top-0 left-0 md:hidden md:w-[20%] fixed h-[100vh] bg-white">

    {{-- Close button for mobile --}}
    <div id="close-nav" class="flex md:hidden absolute right-5 hover:cursor-pointer">
        {{-- Put Nice Icon --}}
        X
    </div>
    <div class="flex flex-col mt-16 items-center w-full text-sm">

        <ul>
            <li class="my-10"><a href="{{route('admin')}}">Student Management</a></li>
            <li class="my-10"><a href="{{route('admin.teachers')}}">Teacher Management</a></li>
            <li class="my-10"><a href="{{route('admin.parents')}}">Parent Management</a></li>
            <li class="my-10"><a href="#">Discipline Management</a></li>
            <li class="my-10"><a href="#">Homework Management</a></li>
        </ul>

    </div>

</div>

<div id="mobile-toggle" class="fixed md:hidden left-3 w-16 h-16 top-10 rounded-full bg-blue-strath p-4">

</div>

<script>
    $( document ).ready(function() {
    
        
        $("#mobile-toggle").click(function(e){
            $("#mobile-nav").slideDown();

        });

        $("#close-nav").click(function(e){
            $("#mobile-nav").slideUp();
        });

});
</script>