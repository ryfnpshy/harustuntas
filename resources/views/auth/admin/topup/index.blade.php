{{-- <x-layouts.admin>
    @if (session('success'))
    <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-800">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-800">
        <ul class="list-disc ps-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="/admin/topup/add" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="user_id" class="block mb-1 font-medium text-gray-700">Pilih User</label>
            <select name="user_id" id="user_id" class="block w-full rounded border border-gray-300 px-3 py-2">
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>
<div class="mb-4">
    <label for="topup_id" class="block mb-1 font-medium text-gray-700">Pilih Topup</label>
    <select name="topup_id" id="topup_id" class="block w-full rounded border border-gray-300 px-3 py-2">
        <option value="">-- Pilih Topup --</option>
        @for($i = 100; $i <= 1500; $i += 100)
            <option 
                value="{{ $i }}" 
                data-price="{{ number_format(($i / 100) * 15000, 0, '', '') }}"
            >
                {{ $i }} Diamond - Rp{{ number_format(($i / 100) * 15000, 0, ',', '.') }}
            </option>
        @endfor
    </select>
</div>

<input type="hidden" name="jumlah_diamond" id="jumlah_diamond" value="">
<input type="hidden" name="total_harga" id="total_harga" value="">

<button type="submit" class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">Submit</button>

<script>
    const topupSelect = document.getElementById('topup_id');
    const jumlahDiamondInput = document.getElementById('jumlah_diamond');
    const totalHargaInput = document.getElementById('total_harga');

    topupSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        jumlahDiamondInput.value = selectedOption.value || '';
        totalHargaInput.value = selectedOption.getAttribute('data-price') || '';
    });
</script>

</x-layouts.admin> --}}

<x-layouts.admin>
    @if (session('success'))
    <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-800">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-800">
        <ul class="list-disc ps-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/admin/topup/add" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="user_id" class="block mb-1 font-medium text-gray-700">Pilih User</label>
            <select name="user_id" id="user_id" class="block w-full rounded border border-gray-300 px-3 py-2">
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tambahan input number -->
        <div class="mb-4">
            <label for="jumlah_topup" class="block mb-1 font-medium text-gray-700">Jumlah Topup</label>
            <input type="number" name="jumlah_topup" id="jumlah_topup" min="1" class="block w-full rounded border border-gray-300 px-2 py-2" placeholder="Masukkan jumlah topup" required>
        </div>

        <!-- Submit button -->
        <button type="submit" class="rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">Submit</button>
    </form>
</x-layouts.admin>
