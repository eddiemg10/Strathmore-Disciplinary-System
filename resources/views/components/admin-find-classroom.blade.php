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

    <div class='m-4 p-4 rounded bg-gray-200'>
        <p class='text-center text-sm'>Not in a classroom? Use the <a class="text-blue-700 underline underline-offset-1" href="">general behaviour sheet</a> instead.</p>
    </div>

    <div class="w-full flex flex-col items-center mt-8 mb-2">
        <p class="text-base text-zinc-600">Select classroom below</p>
    </div>

    <div class="w-full mt-4 flex justify-center border border-[#000000] rounded">
        <select name="classroom_id" id="classroom_id" class="w-full text-gray text-xs p-4 border rounded form-control">
            <option value="" selected><span class="text-gray">All Classrooms</span></option>
            @foreach($classrooms as $classroom)
            <option class="text-blue" value="{{ $classroom->id }}">{{ $classroom->name}}</option>
            @endforeach
        </select>
    </div>

    
    <script>
        $(document).ready(function(){

    fetch_customer_data();

    function fetch_customer_data(query = '', classroom = '')
    {
    $.ajax({
    url:"{{ route('student.action') }}",
    method:'GET',
    data:{query:query, classroom:classroom},
    dataType:'json',
    success:function(data)
    {
        $('#students-table-body').html(data.table_data);
        $('#total_records').text(data.total_data);
    }
    })
    }

    //On search by name
    $(document).on('keyup', '#search', function(){
    var query = $(this).val();
    var classroom = $('#classroom_id').val();
    console.log(query+" on class "+classroom);
    // console.log(query);
    fetch_customer_data(query, classroom);
    });

    //Search by classroom
    $('select').on('change', function() {
        var query = $("#search").val()
        var classroom = $('#classroom_id').val();
        console.log(query+" on class "+classroom);

        fetch_customer_data(query, classroom);
    });


    });
    </script>

</div>
