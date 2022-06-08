{{-- <div class="h-full flex flex-col justify-center">
    <div class="relative py-3 sm:max-w-xl mx-auto">
        <nav x-data="{ open: false }">
            <button class="text-white w-10 h-10 relative focus:outline-none bg-none" @click="open = !open">
                <span class="sr-only">Open main menu</span>
                <div class="block w-5 absolute left-1/2 top-1/2   transform  -translate-x-1/2 -translate-y-1/2">
                    <span aria-hidden="true"
                        class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                        :class="{'rotate-45': open,' -translate-y-1.5': !open }"></span>
                    <span aria-hidden="true"
                        class="block absolute  h-0.5 w-5 bg-current   transform transition duration-500 ease-in-out"
                        :class="{'opacity-0': open } "></span>
                    <span aria-hidden="true"
                        class="block absolute  h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out"
                        :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
                </div>
            </button>
        </nav>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}



<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div @click.away="open = false" class="relative" x-data="{ open: false }">
    <button class="text-white w-10 h-10 relative focus:outline-none bg-none" @click="open = !open">
        <span class="sr-only">Open main menu</span>
        <div class="block w-5 absolute left-1/2 top-1/2   transform  -translate-x-1/2 -translate-y-1/2">
            <span aria-hidden="true"
                class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                :class="{'rotate-45': open,' -translate-y-1.5': !open }"></span>
            <span aria-hidden="true"
                class="block absolute  h-0.5 w-5 bg-current   transform transition duration-500 ease-in-out"
                :class="{'opacity-0': open } "></span>
            <span aria-hidden="true"
                class="block absolute  h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out"
                :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
        </div>
    </button>
    <div x-show="open" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                    href="{{route('logout')}}" onclick="event.preventDefault();
                    this.closest('form').submit();">Logout</a>
            </form>


            @if(Illuminate\Support\Facades\Auth::User()->roles->count() > 1)
            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="/accountselect">Change Account Type</a>
            @endif

        </div>
    </div>
</div>