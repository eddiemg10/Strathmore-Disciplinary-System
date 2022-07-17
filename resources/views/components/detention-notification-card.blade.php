@extends('layouts.cardLayout')
@section('modal_content')
<div class="px-10 py-5">
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="#" enctype="multipart/form-data">
        @csrf

        <input type="hidden" id="startDate" val="">
        <input type="hidden" id="endDate" val="">

        <div class="flex flex-col items-center w-full ">
            <p class="text-zinc-700 mb-4">Pick detention date</p>

            <div class="relative w-[80%] md:w-[60%]">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input name="start" type="text" readonly id="detention-date"
                    class="date bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="YYYY/MM/DD">
            </div>

            <p id="detention-error" class="text-red-700 mt-2 text-sm hidden">Please enter a date</p>

            <p id="dateTaken"
                class="text-red-700 px-5 text-center w-full bg-red-50 border border-red-700 mt-2 text-sm hidden"></p>

            <p id="success-modal"
                class="text-green-700 px-5 py-2 text-center w-full bg-green-50 border border-green-700 mt-2 text-sm hidden">
            </p>



        </div>

        <div class="flex items-center justify-end mt-4">


            <button type="submit" id="send-notification"
                class="w-full bg-sky-900 rounded-md hidden mt-10 hover:bg-sky-800 afocus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition text-md text-white py-3 px-3">Send
                out Notifications</button>
        </div>
    </form>
</div>


<script>
    $(function(){
        $( "#detention-date" ).datepicker({
        dateFormat : 'yy-mm-dd',
        showAnim: 'slideDown',
        }); 
    });
    
    $("#send-notification").click(function(e){
        e.preventDefault();
        if(!$("#detention-date").val()){
            $("#detention-error").html('Please select the detention date');
            $("#detention-error").show();
        }
        else{
            $(this).attr("disabled", true);
            $(this).html('Sending notifications...');
            $(this).addClass('bg-slate-100 hover:bg-slate-100 text-zinc-700');
            $(this).removeClass('bg-sky-900');

            $.ajax({
            url:"{{ route('notify.detention')}}",
            method:'GET',
            data:{startDate: $("#startDate").val(), endDate:$("#endDate").val(), detentionDate: $('#detention-date').val()},
            dataType:'json',
            success:function(data)
            {

                $("#send-notification").removeAttr("disabled");
                $("#send-notification").html('Send out Notifications');
                $("#send-notification").removeClass('bg-slate-100 hover:bg-slate-100 text-zinc-700');
                $("#send-notification").addClass('bg-sky-900');

                if(data.success){
                    $('#success').html(data.message);
                    $('#success').show();

                    $('#success-modal').html(data.message);
                    $('#success-modal').show();

                }
                else{
                    $('#error').html(data.message);
                    $('#error').show();

                    $('#dateTaken').html(data.message);
                    $('#dateTaken').show();


                }

                



            }
        });
        }
     });

     $("#detention-date").change(function(e){
        if($(this).val()){
            $("#send-notification").show();
            console.log( $("#startDate").val()+' to '+  $("#endDate").val())
            var detentionDate = $(this).val();

            $.ajax({
            url:"{{ route('confirm.detention')}}",
            method:'GET',
            data:{detentionDate : detentionDate},
            dataType:'json',
            success:function(data)
            {
                console.log(data)
                if(data.exists){
                    $('#dateTaken').html('A detention notification has already been sent out for this date. Only proceed if you want to send another notification');
                    $('#dateTaken').show();
                }
                else{
                    $('#dateTaken').hide();
                }

            }
        });
        }
     })

</script>
@endSection