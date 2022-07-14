<td class="border border-black px-3 py-2 bg-yellow-100">{{$index}}</td>
<td class="border border-black px-3 py-2 bg-yellow-100">{{$booking->student->last_name.".
    ".substr($booking->student->first_name, 0, 1)}}</td>
<td class="border border-black px-3 py-1 bg-yellow-100"><input type="text" class="w-full" name="period"
        value="{{$booking->period}}" />
</td>
<td class="border border-black px-3 py-1 bg-yellow-100"><input type="text" class="w-full" name="offence"
        value="{{$booking->offence}}" />
</td>
<td class="border border-black px-3 py-2 bg-yellow-100">{{$booking->teacher->last_name.".
    ".substr($booking->teacher->first_name, 0, 1)}}</td>

<td class="border border-black px-3 py-2 bg-yellow-100">
    <input disabled type="radio" value="0" name="assess{{$booking->id}}" data-booking="{{$booking->id}}"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
</td>
<td class="border border-black px-3 py-2 bg-yellow-100">
    <input disabled type="radio" value="1" name="assess{{$booking->id}}" data-booking="{{$booking->id}}"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
</td>
<td class="border border-black px-3 py-2 bg-yellow-100">
    <input disabled type="radio" value="2" name="assess{{$booking->id}}" data-booking="{{$booking->id}}"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
</td>

<td class="border border-black px-3 py-2 text-center bg-yellow-100">
    <i class="fa-solid fa-check text-green-600 fa-lg hover:cursor-pointer submit-edit"
        data-booking={{$booking->id}}></i>
</td>
<td class="border border-black px-3 py-2 text-center bg-yellow-100">
    <i class="fa-solid fa-trash-can text-red-strath hover:cursor-pointer"></i>
</td>

<script>
    $('.submit-edit').click(function(e){
            let booking = $(this).data('booking');
            let row = $(this).parent().parent();

            let newPeriod = row.find('input[name="period"]:first').val();
            let newOffence = row.find('input[name="offence"]:first').val();




            $.ajax({
                url: "{{route('booking.edit')}}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    booking:booking,
                    period:newPeriod,
                    offence:newOffence,
                    index: "{{$index}}",
                },
                success: function(data) {

                    row.html(data);

                }
            });

        });
</script>