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

                        <th class="text-left py-3">No</th>
                        <th class="text-left py-3">Name</th>
                        <th class="text-left py-3">Email</th>
                        <th class="text-left py-3">Role</th>
                        <th class="text-left py-3">Status</th>
                        <th class="text-left py-3">Action</th>

                    </tr>

                </thead>

                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td class="py-4">{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            
                            @if ($item->role == 'admin')
                                <td class="text-red-500">{{ $item->role }}</td>
                            @elseif ($item->role == 'pembeli')
                                <td class="text-cyan-400">{{ $item->role }}</td>
                            @elseif ($item->role == 'penjual')
                                <td class="text-orange-500">{{ $item->role }}</td>
                            @endif

                            @if ($item->status == 'active')
                                <td><span class="px-3 py-1 rounded-full bg-green-300 text-green-600">{{ $item->status }}</span></td>
                            @else
                                <td><span class="px-3 py-1 rounded-full bg-yellow-300 text-yellow-600">{{ $item->status }}</span></td>
                            @endif
                            <td>
                                <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm"><i class="fas fa-edit"></i></button>
                                <button class="bg-red-600 text-white px-3 py-1 rounded text-sm"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
</div>