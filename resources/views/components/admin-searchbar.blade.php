<div class="grow min-w-[16rem] w-[33%] py-10 container bg-white  flex flex-col px-8">
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
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

    @if ($type == 'student')
    {{-- <div class="w-full my-4 pb-4 border-b-2 flex justify-center">
        <p class="mb-2 text-black text-sm">{{ $title }}</p>
    </div> --}}

    <div class="w-full flex flex-col items-center">
        <h1 class="text-3xl text-zinc-600">{{ $title }}</h1>

        <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>
    </div>

    <div class="w-full mt-20 flex justify-center border border-[#000000] rounded">
        <select name="classroom_id" id="classroom_id" class="w-full text-gray text-xs p-4 border rounded form-control">
            <option value="" selected><span class="text-gray">All Classrooms</span></option>
            @foreach($classrooms as $classroom)
            <option class="text-blue" value="{{ $classroom->id }}">{{ $classroom->name}}</option>
            @endforeach
        </select>
        <!-- <i class="fa-solid fa-caret-down pr-4 pt-4"></i> -->
    </div>

    <div class="w-full my-4 py-2 flex justify-center border border-black rounded pr-4">
        <input type="text" name="search" id="search" class="border m-0 w-full text-xs form-control"
            placeholder="Search by one name">
        <i class="fas fa-search pt-2"></i>
    </div>
    <div class="my-4 py-4 flex justify-center border-b-2">
        <p class="text-black text-sm">Search Results</p>
    </div>
    <div class="my-4 py-1 flex justify-center">
        <table class="table table-fixed table-striped table-hover w-full rounded" id="students-table">
            <thead class="w-full rounded bg-blue-strath text-white text-xs">
                <tr>
                    <th class="p-4 text-center w-1/3">{{ $title2 }}</th>
                    <th class="p-4 text-center w-1/3">Name</th>
                    <th class="p-4 text-center w-1/3">Class</th>
                </tr>
            </thead>
            <tbody id="students-table-body">

            </tbody>
        </table>
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

    @elseif ($type == "parent")

    <div class="w-full flex flex-col items-center">
        <h1 class="text-3xl text-zinc-600">{{ $title }}</h1>

        <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>
    </div>

    <div class="w-full mt-20 py-2 flex justify-center border border-black rounded pr-4">
        <input type="text" name="search" id="search" class="border border-0 m-0 w-full text-xs form-control"
            placeholder="Search by one name">
        <i class="fas fa-search pt-2"></i>
    </div>
    <div class="my-4 py-4 flex justify-center border-b-2">
        <p class="text-black text-sm">Search Results</p>
    </div>
    <div class="my-4 py-1 flex justify-center">
        <table class="table table-striped table-hover w-full rounded" id="parents-table">
            <thead class="w-full rounded bg-blue-strath text-white text-xs">
                <tr>
                    <th class="p-4 text-center w-1/3">{{ $title2 }}</th>
                    <th class="p-4 text-center w-1/3">Name</th>
                </tr>
            </thead>
            <tbody id="parents-table-body">

            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){

    fetch_customer_data();

    function fetch_customer_data(query = '')
    {
    $.ajax({
    url:"{{ route('parent.action') }}",
    method:'GET',
    data:{query:query},
    dataType:'json',
    success:function(data)
    {
        $('tbody').html(data.table_data);
        $('#total_records').text(data.total_data);
    }
    })
    }

    $(document).on('keyup', '#search', function(){
    var query = $(this).val();
    console.log(query);
    fetch_customer_data(query);
    });
    });
    </script>

    @elseif ($type == "teacher")

    <div class="w-full flex flex-col items-center">
        <h1 class="text-3xl text-zinc-600">{{ $title }}</h1>

        <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>
    </div>

    <div class="w-full mt-20 py-2 flex justify-center border border-black rounded pr-4">
        <input type="text" name="search" id="search" class="border m-0 w-full text-xs form-control"
            placeholder="Search by one name">
        <i class="fas fa-search pt-2"></i>
    </div>
    <div class="my-4 py-4 flex justify-center border-b-2">
        <p class="text-black text-sm">Search Results</p>
    </div>
    <div class="my-4 py-1 flex justify-center">
        <table class="table table-striped table-hover w-full rounded" id="teachers-table">
            <thead class="w-full rounded bg-blue-strath text-white text-xs">
                <tr>
                    <th class="p-4 text-center w-1/3">{{ $title2 }}</th>
                    <th class="p-4 text-center w-1/3">Name</th>
                </tr>
            </thead>
            <tbody id="teachers-table-body">

            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){

    fetch_customer_data();

    function fetch_customer_data(query = '')
    {
    $.ajax({
    url:"{{ route('teacher.action') }}",
    method:'GET',
    data:{query:query},
    dataType:'json',
    success:function(data)
    {
        $('#teachers-table-body').html(data.table_data);
        $('#total_records').text(data.total_data);
    }
    })
    }

    $(document).on('keyup', '#search', function(){
    var query = $(this).val();
    console.log(query);
    fetch_customer_data(query);
    });
    });
    </script>
    @endif
</div>