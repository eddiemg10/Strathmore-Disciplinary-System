<div id="{{$id ?? 'modal-card'}}" tabindex="-1" aria-hidden="true" class=" {{count($errors) > 0 ? " flex" : "hidden" }}
    bg-slate-900 bg-opacity-80 overflow-x-hidden fixed top-0 inset-x-0 mx-auto right-0 left-0 z-50 w-full inset-0
    h-modal h-full justify-center items-center ">
    <div
        class=" relative p-4 w-full {{isset($width) ? 'md:max-w-' .$width : 'md:max-w-2xl' }} h-full md:h-auto">
    <!-- Modal content -->
    <div class="relative bg-white my-20  rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ $title }}
            </h3>
            <button id="close-modal" type="button"
                class="text-gray-400 bg-transparent close-modal hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="defaultModal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <!-- Modal body -->


        <div class="px-10 py-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('teacher.update') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" value="{{$teacher->id}} " name="teacher">
                <!-- First Name -->
                <div>
                    <x-label for="first_name" :value="__('First name')" />

                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                        value="{{$teacher->first_name}}" required autofocus />
                </div>

                <!-- Last Name -->
                <div class="mt-4">
                    <x-label for="last_name" :value="__('Last name')" />

                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                        value="{{$teacher->last_name}}" required />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$teacher->email}}"
                        required />
                </div>

                <!-- Staff No -->
                <div class="mt-4">
                    <x-label for="staff_number" :value="__('Staff Number')" />

                    <x-input id="staff_number" class="block mt-1 w-full" type="text" name="staff_number"
                        value="{{$teacher->staff->staff_number}}" required />
                </div>

                <!-- Profile Photo -->
                <div class="mt-4">
                    <x-label for="profile_photo" :value="__('Profile photo')" />
                    <label class="text-zinc-600 text-xs mb-2">Uploading a file will overwrite the current profule
                        photo</label>

                    <input name="profile_photo"
                        class="block file:py-2 file:px-2 file:bg-zinc-500 file:text-white  file:border-none w-full text-gray-900 bg-none border border-gray-300 rounded-md shadow-sm cursor-pointer focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        id="profile_photo" accept="image/*" type="file">
                </div>

                <!-- Role -->
                <div class="mt-4">
                    <x-label for="role" :value="__('User Type')" />

                    <select id="role" name="role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full p-2.5">
                        <option value="3">Teacher</option>
                        <option value="2">Administrator</option>

                    </select>
                </div>


                <div class="flex items-center justify-end mt-4">


                    <button type="submit"
                        class="w-full bg-sky-900 rounded-md hover:bg-sky-800 afocus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition text-md text-white py-3 px-3">{{$btn}}</button>
                </div>
            </form>
        </div>


        <!-- Modal footer -->
        <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">

        </div>
    </div>
</div>
</div>