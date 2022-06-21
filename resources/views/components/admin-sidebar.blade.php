{{-- Navbar for Large screens --}}
<div id="main-nav" class="pt-20 z-40 hidden w-[50%] top-0 left-0 md:flex md:w-[20%] fixed h-[100vh] bg-slate-100">
    <div class="flex flex-col mt-16 items-center w-full text-sm my-8">

        <ul class="text-blue-strath space-y-4">
            <div class="flex flex-row h-16 items-center space-x-4 text-lg">
                <i class="fa-solid fa-user-graduate"></i>
                <li class=""><a href="{{route('admin')}}">Student Management</a></li>
            </div>
            <div class="flex flex-row h-16 items-center space-x-4 text-lg ">
                <i class="fa-solid fa-user-tie"></i>
                <li class=""><a href="{{route('admin.teachers')}}">Teacher Management</a></li>
            </div>
            <div class="flex flex-row h-16 items-center space-x-4 text-lg">
                <i class="fa-solid fa-children"></i>
                <li class=""><a href="{{route('admin.parents')}}">Parent Management</a></li>
            </div>
            <div class="flex flex-row h-16 items-center space-x-4 text-lg">
                <i class="fa-solid fa-check-to-slot"></i>
                <li class=""><a href="#">Discipline Management</a></li>
            </div>
            <div class="flex flex-row h-16 items-center space-x-4 text-lg">
                <i class="fa-solid fa-book"></i>
                <li class=""><a href="#">Homework Management</a></li>
            </div>
            
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