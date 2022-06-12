<div class="flex flex-col w-full gap-y-4">
    @if (session('error'))
    <div
        class=" relative border border-solid border-red-800 bg-red-50 text-red-800 font-bold flex justify-center items-center w-full py-3">
        <span class="mr-4"><i class="fa-solid fa-triangle-exclamation fa-xl"></i></span> <span>{{ session('error') }}
        </span>

        <span id="error-session" class="absolute right-5 font-thin hover:cursor-pointer text-xl">X</span>


    </div>
    @endif

    @if (session('success'))
    <div
        class="relative border border-solid border-green-800 bg-green-50 text-green-800 font-bold flex justify-center items-center w-full py-3">
        <span class="mr-4"><i class="fa-solid fa-square-check fa-xl"></i></span> <span>{{ session('success') }} </span>

        <span id="success-session" class="absolute right-5 font-thin hover:cursor-pointer text-xl">X</span>
    </div>
    @endif
</div>

<script>
    $( document ).ready(function() {
        $("#success-session").click(function(e){
            $.get("/clear-flash/success", function(data, status){

            });

            $(this).parent().hide();
           
        });

        $("#error-session").click(function(e){
            $.get("/clear-flash/error", function(data, status){

            });

            $(this).parent().hide();
            

        });
    });
</script>