<x-welcome-layout-app>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-900"/>
                </a>
            </div>
            <div class="justify-between">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    Etkinlikler
                </h1>
            </div>
            <div class="shrink-0 flex">
                @auth
                    <a href="{{ route('login') }}"  class="text-blue-600  hover:underline text-xl">
                            Admin
                    </a>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-blue-600  hover:underline text-xl">
                            Giriş Yap
                    </a>
                @endguest
            </div>
        </div>
    </x-slot>

    <div class="py-12 ">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 md:flex md:flex-col justify-center items-center">
                    <div class="flex flex-wrap">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block py-2 sm:px-6 lg:px-8">
                                <div class="shadow-md sm:rounded-lg">
                                    <table class="table-auto">
                                        <thead class="bg-green-100">
                                        <tr>
                                            <th scope="col"
                                                class="py-3 px-6 text-md font-bold tracking-wider text-left text-gray-700 uppercase bg-red-100">
                                                Etkinliği Oluşturan
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-md font-bold tracking-wider text-left text-gray-700 uppercase ">
                                                Etkinlik Adı
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-md font-bold tracking-wider text-left text-gray-700 uppercase ">
                                                Etkinlik Odası
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-md font-bold tracking-wider text-left text-gray-700 uppercase ">
                                                Başlangıç Tarihi
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-md font-bold tracking-wider text-left text-gray-700 uppercase ">
                                                Bitiş Tarihi
                                            </th>
                                            <th scope="col" class="relative py-3 px-6">
                                                <span class="sr-only">Etkinlik Detay
                                                </span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- Product 1 -->
                                        @foreach($events as $event)
                                            <tr class="bg-white border-b ">
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900  ">

                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex-shrink-0">
                                                            <img class="w-8 h-8 rounded-full" src="{{$event->user->avatar}}" alt="Neil image">
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            {{$event->user->name}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900 ">
                                                    {{$event->name}}
                                                </td>
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900">
                                                    {{$event->room->name}}
                                                </td>
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900">
                                                    {{carbon\carbon::parse($event->start_date)->format('Y-m-d - H:i')}}
                                                </td>
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900">
                                                    {{carbon\carbon::parse($event->end_date)->format('Y-m-d - H:i')}}
                                                </td>
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900">
                                                    <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="defaultModal{{$event->id}}">
                                                        Etkinlik Detayı
                                                    </button>

                                                    <!-- Main modal -->
                                                    <div id="defaultModal{{$event->id}}" aria-hidden="true" class="hidden p-5 overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
                                                        <div class="relative px-4 w-full max-w-2xl h-full md:h-auto">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-gray-50 rounded-lg shadow dark:bg-gray-700">
                                                                <!-- Modal header -->
                                                                <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                                                    <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                                                        {{$event->name}}
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal{{$event->id}}">
                                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div class="p-6 space-y-6">
                                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                                        {{$event->description}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-welcome-layout-app>

