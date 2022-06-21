@extends('layouts.master')

@section('layout_content')

<div class="flex w-[100vw]">
    {{-- SideBar Component goes here --}}
    <div class="md:w-[20%]">
        @yield('sidebar')
 
    </div>

    {{-- Main Div stuff will go here --}}
    <div class="md:w-[80%] w-full pt-20 bg-slate-50 md:pt-0">
        @yield('content')


    </div>

</div>

@endsection