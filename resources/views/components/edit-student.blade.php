@extends('layouts.cardLayout')
@section('modal_content')

<div class="px-10 py-5">
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('student.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- First Name -->
        <div>
            <x-label for="first_name" :value="__('First name')" />

            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')"
                required autofocus />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-label for="last_name" :value="__('Last name')" />

            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"
                required />
        </div>

        <!-- Profile Photo -->
        <div class="mt-4">
            <x-label for="profile_photo" :value="__('Profile photo')" />

            <input name="profile_photo"
                class="block file:py-2 file:px-2 file:bg-zinc-500 file:text-white  file:border-none w-full text-gray-900 bg-none border border-gray-300 rounded-md shadow-sm cursor-pointer focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                id="profile_photo" accept="image/*" type="file">
        </div>

        <!-- Classroom -->
        <div class="mt-4">
            <x-label for="classroom" :value="__('Classroom')" />

            <select id="countries" name="classroom"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-2.5">
                @foreach($classrooms as $classroom)
                <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="flex items-center justify-end mt-4">


            <button type="submit"
                class="w-full bg-sky-900 rounded-md hover:bg-sky-800 afocus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition text-md text-white py-3 px-3">Update
                Student</button>
        </div>
    </form>
</div>

@endSection