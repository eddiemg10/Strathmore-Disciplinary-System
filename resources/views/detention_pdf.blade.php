<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detention List</title>
</head>

<style>
    .container {
        width: 100%;
        margin-top: 100px;
        margin-bottom: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;

    }

    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin: 50px 0;
    }

    table td,
    table th {
        border: 1px solid rgb(150, 150, 150);
        padding: 8px;
    }

    .row1 th {
        padding-top: 15px;
        padding-bottom: 15px;
    }

    th {
        font-size: 0.8rem;
    }

    td {
        font-size: 0.7rem;
    }


    table .row1 {
        padding-top: 20px;
        padding-bottom: 20px;
        text-align: center;
        background-color: #4d4f4e;
        color: white;
    }

    table .row2 {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #bdbdbd;
        color: black;
    }
</style>

<body>

    <div class="container">

        @foreach ($detention_list as $classBookings)


        <table class="border-collapse border border-black w-full text-sm my-10">
            <thead>
                <tr class="row1">
                    <th colspan="5">
                        {{strtoupper($classBookings['classroom']->classroom->name)}} DETENTION LIST FOR:
                        {{$endDateHuman}}
                    </th>

                </tr>

                <tr class="row2">
                    <th>First name</th>
                    <th>Surname</th>
                    <th>Subject</th>
                    <th>Booking</th>
                    <th>Remarks</th>

                </tr>

            </thead>
            <tbody>

                @forelse($classBookings['bookings'] as $booking)
                <tr class="odd:bg-white even:bg-slate-50">

                    <td>{{$booking->student->last_name}}</td>
                    <td>{{$booking->student->last_name}}</td>
                    <td>{{$booking->period}}</td>
                    <td>{{$booking->offence}}</td>
                    <td></td>
                </tr>

                @empty
                <tr>
                    <td colspan="5">
                        No assessed bookings are available for the specified time span
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

        @endforeach

    </div>

</body>

</html>