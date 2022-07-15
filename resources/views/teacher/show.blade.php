<x-edit-teacher id="update-teacher" type="update" title="Teacher Information" :classrooms="$classrooms"
    :teacher="$teacher" btn="Update Teacher" />

<div class="w-full my-10 px-5">
    <div id="success"
        class="hidden relative my-5 text-center font-bold text-green-900 bg-green-50 border-2 border-green-600 rounded-md w-full py-5">
        User Successfully deleted

        <span class="absolute font-light text-2xl right-10 close-notification hover:cursor-pointer">X</span>
    </div>

    <div id="error"
        class=" hidden my-5 text-center font-bold text-red-900 bg-red-50 border-2 border-red-700 rounded-md w-full py-5">
        Error! User could not be deleted

        <span class="absolute font-light text-2xl right-10 close-notification hover:cursor-pointer">X</span>

    </div>
</div>

@if(isset($teacher))
<div id="teacher-details">

    <div class="flex flex-col items-center">
        <h1 class="text-3xl text-zinc-600">Teacher Details</h1>
        <div class="bg-slate-100 w-[90%] h-[2px] mt-5"></div>

        <div class="mt-20 flex flex-col lg:flex-row gap-y-5 lg:items-center">
            <div class="w-full lg:w-[50%] px-8">
                <div class="w-full">
                    <img class="rounded-md shadow-lg object-cover"
                        src={{asset('assets/profile_pictures/'.$teacher->profile_photo)}}
                    alt="">
                </div>
            </div>

            <div class="w-full lg:w-[50%] px-5 flex flex-col gap-y-5 items-center">

                <div class="bg-white shadow-xl border border-solid border-slate-200 text-center w-full rounded-md py-5">
                    <p class="text-zinc-700 text-xl">Class Teacher: <span
                            class="font-bold text-green-900">{{$teacher->classroom ? $teacher->classroom->name : "-"
                            }}</span> </p>
                    <p class="text-zinc-700 text-xl mt-4">
                        Roles:

                        @foreach($teacher->roles as $role)
                        <span class="text-zinc-900 text-sm font-bold">{{$role->userType->type." | "}}</span>
                        @endforeach

                    </p>
                    <ul>

                        {{-- @forelse($teacher->parents as $i => $parent)
                        <li class="text-blue-strath underline my-3"><a href="#">{{($i+1).". ".$parent->first_name."
                                ".$parent->last_name}}</a></li>
                        @empty
                        <div class="w-full flex justify-center">
                            <div
                                class="border border-solid border-red-800 bg-red-50 text-red-800 font-bold px-3 py-2 mt-4 w-[80%]">
                                <p>No parents registered</p>
                            </div>
                        </div>
                        @endforelse --}}
                    </ul>
                </div>

                <button id="edit-teacher" data-id="{{$teacher->id}}"
                    class="bg-blue-strath py-2 px-3 w-full text-white rounded-md mt-6 mb-2 flex justify-center relative items-center gap-x-5 hover:shadow-md hover:cursor-pointer"><i
                        class="fa-solid fa-pen "></i>Edit teacher
                    Details</button>

                <form method="POST" action="{{ route('user.delete') }}" id="delete-form" class="w-full">
                    @csrf
                    <input type="hidden" name="user" value="{{$teacher->id}}" />
                    <input type="hidden" name="type" value="teacher" />

                    <button id="delete-teacher" data-id="{{$teacher->id}}"
                        class="bg-red-strath py-2 px-3 w-full text-white rounded-md flex justify-center relative items-center gap-x-5 hover:shadow-md hover:cursor-pointer"><i
                            class="fa-solid fa-trash-can delete-teacher"></i>Delete teacher
                        Record</button>
                </form>



            </div>


        </div>


    </div>

    <div class="flex flex-col items-center">
        <div class="bg-slate-100 w-[90%] h-[2px] mt-16"></div>

    </div>

    <div class="w-full px-5 mt-24 flex justify-center">

        <table class="w-full">
            <thead class="bg-blue-strath text-white text-bold ">
                <tr>
                    <th class="py-4 px-2 md:text-md text-center">Staff No.</th>
                    <th class="py-4 px-2 md:text-md text-center">First Name</th>
                    <th class="py-4 px-2 md:text-md text-center">Surname</th>
                    <th class="py-4 px-2 md:text-md text-center">Class</th>
                    <th class="py-4 px-2 md:text-md text-center">Email</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 bg-slate-100 text-center px-3">{{$teacher->staff->staff_number}}</td>
                    <td class="py-2 bg-slate-100 text-center px-3">{{$teacher->first_name}}</td>
                    <td class="py-2 bg-slate-100 text-center px-3">{{$teacher->last_name}}</td>
                    <td class="py-2 bg-slate-100 text-center px-3">
                        {{$teacher->classroom ? $teacher->classroom->name : "-"}}</td>
                    <td class="py-2 bg-slate-100 text-center px-3">{{$teacher->email}}</td>

                </tr>

            </tbody>
        </table>
    </div>

</div>
@else
<div class=" my-5 px-5 text-center font-bold text-red-900 bg-red-50 border-2 border-red-700 rounded-md w-full py-5">
    This user does not exist


</div>
@endif


<script>
    $( document ).ready(function() {

            $("#delete-form").submit(function(e){

                e.preventDefault();

                if(!confirm('This User will be permanently deleted')){
                    return;
                }
                $(this).unbind('submit').submit()

            });

            $("#edit-teacher").click(function(e){
                $("#update-teacher").removeClass('hidden');
                $("#update-teacher").addClass('flex');
            })

            $(".close-modal").click(function(e){
                $("#update-teacher").removeClass('flex');
                $("#update-teacher").addClass('hidden');
            });

        
        });
</script>