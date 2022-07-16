@php
$isSenior = false;
foreach(Auth::User()->roles as $role)
if($role->userType->id===4){
$isSenior = true;
}
@endphp



<div class='mt-5 flex justify-center md:w-[90%] w-full border-b-2 md:text-base text-xs '>

    <!-- Active for now, I will sort nav bar logic later on. -->
    <div class="{{($focus==='bs')  ? 'text-blue-strath font-bold border-b-4 border-[#00447D]' : '' }} {{$isSenior ? 'w-[25%]':'w-full text-base'}} flex flex-col
        items-center">
        <a href="{{route('admin.behavioursheet')}}" class="hover: cursor-pointer">Behaviour Sheet</a>
    </div>

    @if($isSenior)
    <div
        class="{{($focus==='detention')  ? 'text-blue-strath font-bold border-b-4 border-[#00447D]' : '' }} w-[25%] flex flex-col items-center">
        <a href="{{route('admin.detention')}}" class="hover: cursor-pointer">Detention</a>
    </div>
    <div
        class="{{($focus==='updates')  ? 'text-blue-strath font-bold border-b-4 border-[#00447D]' : '' }} w-[25%] flex flex-col items-center">
        <a href="" class="hover: cursor-pointer">Updates</a>
    </div>
    <div
        class="{{($focus==='history')  ? 'text-blue-strath font-bold border-b-4 border-[#00447D]' : '' }} w-[25%] flex flex-col items-center">
        <a href="" class="hover: cursor-pointer">History</a>
    </div>
    @endif
</div>