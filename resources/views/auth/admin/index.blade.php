<x-layouts.admin>
    <div class="p-6 bg-white min-h-screen">
        <h1 class="text-2xl font-bold mb-6 text-indigo-700">Dashboard Admin</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Card Users -->
            <div class="bg-indigo-600 rounded-lg shadow p-6 flex flex-col items-center text-white">
                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-3-3.87M9 20H4v-2a4 4 0 0 1 3-3.87m6-2.13a4 4 0 1 0-8 0 4 4 0 0 0 8 0zm6 2.13A4 4 0 1 0 17 8a4 4 0 0 0 0 8z" />
                </svg>
                <div class="text-lg font-semibold">Total Users</div>
                <div class="text-2xl font-bold mt-1">{{ $totalUsers ?? 0 }}</div>
            </div>
            <!-- Card Diamond Packages -->
            <div class="bg-indigo-500 rounded-lg shadow p-6 flex flex-col items-center text-white">
                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 10l6-6 6 6M6 14l6 6 6-6" />
                </svg>
                <div class="text-lg font-semibold">Paket Diamond</div>
                <div class="text-2xl font-bold mt-1">{{ $totalDiamond ?? 0 }}</div>
            </div>
            <!-- Card Transactions -->
            <div class="bg-indigo-400 rounded-lg shadow p-6 flex flex-col items-center text-white">
                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18" />
                </svg>
                <div class="text-lg font-semibold">Transaksi</div>
                <div class="text-2xl font-bold mt-1">{{ $totalTransactions ?? 0 }}</div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 mt-6">
            <h2 class="text-xl font-semibold mb-4 text-indigo-700">Histori Transaksi Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Diamond</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total Harga</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($latestTransactions ?? [] as $trx)
                        <tr>
                            <td class="px-4 py-2">{{ $trx->user->username ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $trx->diamond->nama_paket ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $trx->jumlah_diamond }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($trx->total_harga,0,',','.') }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-xs {{ $trx->status == 'success' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($trx->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center text-gray-400">Belum ada transaksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.admin>