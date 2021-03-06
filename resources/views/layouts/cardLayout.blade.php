<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body>
    <!-- Main modal -->
    <div id="{{$id ?? 'modal-card'}}" tabindex="-1" aria-hidden="true" class=" {{count($errors) > 0 ? " flex" : "hidden"
        }} bg-slate-900 bg-opacity-80 overflow-x-hidden fixed top-0 inset-x-0 mx-auto right-0 left-0 z-50 w-full inset-0
        h-modal h-full justify-center items-center">
        <div
            class="relative p-4 w-full {{isset($width) ? 'md:max-w-'.$width :  'md:max-w-2xl'}} h-full md:h-auto md:max-h-[90vh]">
            <!-- Modal content -->
            <div class="relative bg-white   rounded-lg shadow dark:bg-gray-700">
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
                @yield('modal_content')
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">

                </div>
            </div>
        </div>
    </div>
</body>

</html>