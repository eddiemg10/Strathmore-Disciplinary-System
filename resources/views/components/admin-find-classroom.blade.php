<div class="grow min-w-[16rem] w-[33%] py-8 container bg-white shadow-xl flex flex-col px-8">
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
    <style>
        .form-control:focus {
            border-color: #FFFFFF;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-top-style: none;
        }

        .form-control {
            border-color: #FFFFFF;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-top-style: none;
        }
    </style>

    <div class="w-full flex flex-col items-center pb-2 border-b-2 mb-4">
        <h1 class="text-3xl text-zinc-600">Find Classroom</h1>
    </div>

    @if ($type == 'booking')
    <div class='m-4 p-4 rounded bg-gray-200'>
        <p class='text-center text-sm' id="general-bs">Not in a classroom? Use the <span
                class="text-blue-700 underline underline-offset-1 hover:cursor-pointer">general behaviour sheet</span>
            instead.</p>
    </div>
    @endif

    <div class="w-full flex flex-col items-center mt-8 mb-2">
        <p class="text-base text-zinc-600">Select classroom below</p>
    </div>

    <div class="w-full mt-4 flex justify-center border border-[#000000] rounded">
        <select name="classroom_id" id="classroom_id" class="w-full text-gray text-xs p-4 border rounded form-control">
            @if($type !== 'booking')
            <option value="" selected><span class="text-gray">All Classrooms</span></option>
            @else
            <option value="" selected disabled><span class="text-gray">Select Classroom</span></option>
            @endif
            @foreach($classrooms as $classroom)
            <option class="text-blue" value="{{ $classroom->id }}">{{ $classroom->name}}</option>
            @endforeach
        </select>
    </div>
</div>