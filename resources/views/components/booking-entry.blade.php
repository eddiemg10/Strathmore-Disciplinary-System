<td class="border border-black px-3 py-2">{{$index}}</td>
<td class="border border-black px-3 py-2">{{$booking->student->last_name.".
    ".substr($booking->student->first_name, 0, 1)}}</td>
<td class="border border-black px-3 py-2">{{$booking->period}}</td>
<td class="border border-black px-3 py-2">{{$booking->offence}}
</td>
<td class="border border-black px-3 py-2">{{$booking->teacher->last_name.".
    ".substr($booking->teacher->first_name, 0, 1)}}</td>

<td class="border border-black px-3 py-2">
    <input type="radio" value="0" name="assess{{$booking->id}}" data-booking="{{$booking->id}}"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
</td>
<td class="border border-black px-3 py-2">
    <input type="radio" value="1" name="assess{{$booking->id}}" data-booking="{{$booking->id}}"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
</td>
<td class="border border-black px-3 py-2">
    <input type="radio" value="2" name="assess{{$booking->id}}" data-booking="{{$booking->id}}"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
</td>

<td class="border border-black px-3 py-2 text-center">
    <i class="fa-solid fa-pen text-blue-strath hover:cursor-pointer edit-booking" data-booking={{$booking->id}}
        data-number={{$index}}></i>
</td>
<td class="border border-black px-3 py-2 text-center ">
    <i class="fa-solid fa-trash-can text-red-strath hover:cursor-pointer delete-booking"></i>
</td>

<script>
    $('.edit-booking').click(function(e){
    let booking = $(this).data('booking');
    let number = $(this).data('number');

    let row = $(this).parent().parent();

    $.ajax({
        type: 'get',
        url: '/teacher/bookings/edit/'+booking,
        data:{index: number},
        success: function(data) {

            row.html(data);

        }
    });

});

$('.delete-booking').click(function(e){
    let booking = $(this).data('booking');

    if(confirm('This booking will be permanently deleted')){
        $.ajax({
        url: "{{route('booking.delete')}}",
        type:"POST",
        data:{
            "_token": "{{ csrf_token() }}",
            booking:booking,
        },
        success: function(data) {
            if(data.success){
                refresh();
            }

            else{
                $('#error').html="Booking could not be deleted."
                $("#error").show();

            }
        }
    });
    }

    

});

</script>