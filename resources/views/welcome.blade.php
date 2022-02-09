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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 md:flex md:flex-col justify-center items-center">
                    <div class="flex flex-col">
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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- Product 1 -->
                                        @foreach($events as $event)
                                            <tr class="bg-white border-b ">
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900 whitespace-nowrap ">
                                                    {{$event->user->name}}
                                                </td>
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900 whitespace-nowrap ">
                                                    {{$event->name}}
                                                </td>
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900 whitespace-nowrap ">
                                                    {{$event->room->name}}
                                                </td>
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900 whitespace-nowrap ">
                                                    {{carbon\carbon::parse($event->start_date)->format('Y-m-d - H:i')}}
                                                </td>
                                                <td class="py-4 px-6 text-sm font-bold text-gray-900 whitespace-nowrap ">
                                                    {{carbon\carbon::parse($event->end_date)->format('Y-m-d - H:i')}}
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
