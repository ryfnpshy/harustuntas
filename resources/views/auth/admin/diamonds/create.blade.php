<x-layouts.admin>

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Tambah Paket Diamond Baru</h1>
                <p class="mt-2 text-sm text-gray-700">Isi detail paket diamond di bawah ini.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{ route('admin.diamonds.index') }}" type="button"
                    class="block rounded-md bg-gray-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                    Kembali ke Daftar
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="mt-4 rounded-md bg-red-50 p-4 text-sm text-red-800">
                <ul class="list-disc ps-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <form action="{{ route('admin.diamonds.store') }}" method="POST" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                        @csrf
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-4">
                                    <label for="nama_paket" class="block text-sm font-medium leading-6 text-gray-900">Nama Paket</label>
                                    <div class="mt-2">
                                        <input type="text" name="nama_paket" id="nama_paket" value="{{ old('nama_paket') }}"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            required>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="jumlah" class="block text-sm font-medium leading-6 text-gray-900">Jumlah Diamond</label>
                                    <div class="mt-2">
                                        <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            required>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="harga" class="block text-sm font-medium leading-6 text-gray-900">Harga (Rp)</label>
                                    <div class="mt-2">
                                        <input type="number" name="harga" id="harga" value="{{ old('harga') }}" step="0.01"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                            <a href="{{ route('admin.diamonds.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Batal</a>
                            <button type="submit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Simpan Paket Diamond
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.admin>