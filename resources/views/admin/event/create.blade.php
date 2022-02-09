<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Etkinlik Oluştur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col justify-center items-center">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div
                                class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                                role="alert">
                                <span class="font-medium">Error</span> {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <form class="w-full max-w-lg" action="{{route('admin.event.store')}}" method="post">
                        @csrf
                        <form class="w-full max-w-lg">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Etkinlik Adı
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-50 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="grid-first-name" type="text" required name="name">
                                {{--<p class="text-red-500 text-xs italic">Please fill out this field.</p>--}}
                            </div>
                            <div class="w-full px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Etkinlik Açıklama
                                </label>
                                <textarea
                                    class="form-control mb-6 block w-full px-3 py-1.5 bg-gray-50 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    rows="4"
                                    placeholder="Etkinlik Açıklama" required name="description"
                                ></textarea>
                            </div>
                            <div class="w-full px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                       for="grid-state">
                                    Etkinlik Odası Seçiniz
                                </label>
                                <div class="relative">
                                    <select
                                        class="block appearance-none w-full bg-gray-50 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-state" required name="room_id">
                                        <option disabled selected>Seçiniz</option>
                                        @foreach($rooms as $room)
                                            <option value="{{$room->id}}">{{$room->name}}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap">
                                <div class="w-full  md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Etkinlik Başlangıç Tarihi
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-50 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        type="datetime-local" required name="start_date">
                                </div>
                                <div class="w-full  md:w-1/2 px-3 mb-6">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Etkinlik Bitiş Tarihi
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-50 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        type="datetime-local" required name="end_date">
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <div class="w-full md:w-1/2 px-3">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded md:w-[465px] sm:w-full">
                                        Ekle
                                    </button>
                                </div>
                            </div>
                        </form>

                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

