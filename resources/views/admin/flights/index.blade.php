    <x-admin-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Quản lý Chuyến bay</h1>
                <a href="{{ route('admin.flights.create') }}" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Thêm chuyến bay
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Số hiệu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hành trình</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thời gian</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Giá</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ghế trống</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($flights as $flight)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">
                                    {{ $flight->flight_number }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $flight->departureAirport->code }} → {{ $flight->arrivalAirport->code }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($flight->departure_time)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-blue-600">
                                    ${{ $flight->price }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $flight->available_seats }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ route('admin.flights.show', $flight->id) }}" 
                                    class="text-blue-600 hover:text-blue-900 mr-3">Xem</a>
                                    <a href="{{ route('admin.flights.edit', $flight->id) }}" 
                                    class="text-green-600 hover:text-green-900 mr-3">Sửa</a>
                                    <form action="{{ route('admin.flights.destroy', $flight->id) }}" 
                                        method="POST" class="inline"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Chưa có chuyến bay nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $flights->links() }}
            </div>
        </div>
    </x-admin-layout>