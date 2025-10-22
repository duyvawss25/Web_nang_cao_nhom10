<x-admin-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Thêm Chuyến bay mới</h1>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.flights.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Số hiệu chuyến bay -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Số hiệu chuyến bay</label>
                        <input type="text" name="flight_number" value="{{ old('flight_number') }}" required
                               placeholder="VJ101"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Giá vé -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Giá vé ($)</label>
                        <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Sân bay đi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sân bay đi</label>
                        <select name="departure_airport_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Chọn sân bay --</option>
                            @foreach($airports as $airport)
                                <option value="{{ $airport->id }}" {{ old('departure_airport_id') == $airport->id ? 'selected' : '' }}>
                                    {{ $airport->code }} - {{ $airport->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sân bay đến -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sân bay đến</label>
                        <select name="arrival_airport_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Chọn sân bay --</option>
                            @foreach($airports as $airport)
                                <option value="{{ $airport->id }}" {{ old('arrival_airport_id') == $airport->id ? 'selected' : '' }}>
                                    {{ $airport->code }} - {{ $airport->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Thời gian khởi hành -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Thời gian khởi hành</label>
                        <input type="datetime-local" name="departure_time" value="{{ old('departure_time') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Thời gian hạ cánh -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Thời gian hạ cánh</label>
                        <input type="datetime-local" name="arrival_time" value="{{ old('arrival_time') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Số ghế -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Số ghế khả dụng</label>
                        <input type="number" name="available_seats" value="{{ old('available_seats') }}" min="0" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('admin.flights.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Hủy
                    </a>
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Tạo chuyến bay
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>