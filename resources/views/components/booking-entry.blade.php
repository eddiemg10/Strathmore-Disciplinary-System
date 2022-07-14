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
    <i class="fa-solid fa-pen text-blue-strath hover:cursor-pointer edit-booking" data-booking={{$booking->id}}></i>
</td>
<td class="border border-black px-3 py-2 text-center ">
    <i class="fa-solid fa-trash-can text-red-strath hover:cursor-pointer"></i>
</td>