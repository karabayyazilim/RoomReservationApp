<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Odalar
            </h2>
            <a href="{{route('admin.room.create')}}">
                <button
                    class="h-10 px-5 text-indigo-700 transition-colors duration-150 border border-indigo-500 rounded-lg focus:shadow-outline hover:bg-indigo-500 hover:text-indigo-100">
                    Oda Oluştur
                </button>
            </a>
        </div>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 md:flex md:flex-col justify-center items-center">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block py-2 sm:px-6 lg:px-8">
                                <div class="shadow-md sm:rounded-lg">
                                    <table class="w-full md:w-[665px] table-auto">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="py-3 px-6 text-xl font-bold tracking-wider text-left text-gray-700 uppercase ">
                                                Oda Adı
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xl font-bold tracking-wider text-left text-gray-700 uppercase ">
                                                Birincil Oda
                                            </th>
                                            <th scope="col" class="relative py-3 px-6">
                                                <span class="sr-only">Sil</span>
                                            </th>
                                            <th scope="col" class="relative py-3 px-6">
                                                <span class="sr-only">Düzenle</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- Product 1 -->
                                        @foreach($rooms as $room)
                                            <tr class="bg-white border-b ">
                                                <td class="py-4 px-6 text-md font-medium text-gray-900 whitespace-nowrap ">
                                                    {{$room->name}}
                                                </td>

                                                <td class="py-4 px-6 text-md font-medium text-gray-900 whitespace-nowrap ">
                                                    {{$room->primary == true ? 'Evet' : 'Hayır'}}
                                                </td>

                                                <td class="py-4 px-6 text-md font-medium text-right whitespace-nowrap">
                                                    <form action="{{route('admin.room.destroy',$room)}}"
                                                          method="post"
                                                          onsubmit="return confirm('Silmek istediğinize eminmisiniz ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="text-red-600  hover:underline">
                                                            Sil
                                                        </button>

                                                    </form>
                                                </td>
                                                <td class="py-4 px-6 text-md font-medium text-right whitespace-nowrap">
                                                    <a href="{{route('admin.room.edit', $room)}}"
                                                       class="text-blue-600  hover:underline">Düzenle</a>
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
</x-app-layout>

<script>
    function validate(form) {
        if (!valid)
            return false;
        return confirm('Silmek istediğinize eminisiniz?');
    }
</script>
</script>
