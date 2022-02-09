<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Oda Oluştur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col justify-center items-center">
                    <form class="w-full max-w-lg" action="{{route('admin.room.store')}}" method="post">
                        @csrf
                        <div class="flex-mx-3 mb-6 justify-center ">
                            <div class="w-full px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                       for="grid-first-name">
                                    Oda Adı
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-50 text-gray-50 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="grid-first-name" type="text" name="name" required>
                            </div>
                            <div class="ml-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4"
                                       for="grid-first-name">
                                    Odaya erişebilen roller
                                </label>
                                <div class="flex flex-wrap items-center justify-center mb-6">
                                    <div class="px-3 mb-6">
                                        <input
                                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                            type="checkbox" value="" id="checkCommunity" name="community_user">
                                        <label class="form-check-label inline-block text-gray-800" for="checkCommunity">
                                            Topluluk
                                        </label>
                                    </div>
                                    <div class="px-3 mb-6">
                                        <input
                                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                            type="checkbox" value="" id="checkNormalUser" name="normal_user">
                                        <label class="form-check-label inline-block text-gray-800"
                                               for="checkNormalUser">
                                            Normal Kullanıcı
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 px-3">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded md:w-[465px] sm:w-full">
                                        Ekle
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
