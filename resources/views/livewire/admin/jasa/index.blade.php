<div>
    <div>
        @include('layout.admin._statInfo')
                <div class="bg-white rounded-2xl shadow p-6">
    
                <div class="flex justify-between mb-4">
    
                    <h3 class="font-bold text-lg">
                        Pesanan Terbaru
                    </h3>
    
                    <button
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg">
    
                        Lihat Semua
    
                    </button>
    
                </div>
    
                <table class="w-full">
    
                    <thead>
    
                        <tr class="border-b">
    
                            <th class="text-left py-3">ID</th>
                            <th class="text-left py-3">Pelanggan</th>
                            <th class="text-left py-3">Jasa</th>
                            <th class="text-left py-3">Status</th>
                            <th class="text-left py-3">Total</th>
    
                        </tr>
    
                    </thead>
    
                    <tbody>
    
                        <tr class="border-b">
    
                            <td class="py-4">#001</td>
                            <td>Budi</td>
                            <td>Cleaning Service</td>
                            <td>
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">
                                    Selesai
                                </span>
                            </td>
                            <td>Rp150.000</td>
    
                        </tr>
    
                        <tr class="border-b">
    
                            <td class="py-4">#002</td>
                            <td>Siti</td>
                            <td>Desain Logo</td>
                            <td>
                                <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-sm">
                                    Diproses
                                </span>
                            </td>
                            <td>Rp250.000</td>
    
                        </tr>
    
                    </tbody>
    
                </table>
    
            </div>
    </div>
</div>
