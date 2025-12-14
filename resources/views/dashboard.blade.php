<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Tổng quan') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-3 bg-indigo-50 rounded-full text-indigo-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Tổng số Link</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $links->count() }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-3 bg-green-50 rounded-full text-green-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Tổng lượt Click</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $links->sum('visits') }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-3 bg-blue-50 rounded-full text-blue-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Mới nhất</p>
                        <p class="text-sm font-semibold text-gray-900 truncate w-32">
                            {{ $links->first()?->created_at->diffForHumans() ?? 'Chưa có' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Tạo liên kết mới</h3>
                
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-100 rounded-lg flex items-center justify-between">
                        <span class="text-green-700 font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('shorten') }}" method="POST" class="flex flex-col md:flex-row gap-3">
                    @csrf
                    <input type="text" name="original_url" 
                           placeholder="Dán đường dẫn dài của bạn vào đây (https://...)" required 
                           class="flex-1 rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-indigo-200 transition transform hover:-translate-y-0.5">
                        Rút gọn
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Lịch sử liên kết</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b bg-white">
                                <th class="px-6 py-4">QR</th>  <th class="px-6 py-4">Link Gốc</th>
                                <th class="px-6 py-4">Link Rút gọn</th>
                                <th class="px-6 py-4 text-center">Clicks</th>
                                <th class="px-6 py-4">Ngày tạo</th>
                                <th class="px-6 py-4 text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($links as $link)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="bg-white p-1 inline-block border rounded">
                                            <a href="{{ url($link->short_code) }}" target="_blank">
                                                {!! QrCode::size(50)->generate(url($link->short_code)) !!}
                                            </a>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 max-w-xs">
                                        <div class="text-sm text-gray-900 truncate" title="{{ $link->original_url }}">
                                            {{ $link->original_url }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-sm font-bold text-indigo-700 bg-indigo-50 rounded-full">
                                            {{ url($link->short_code) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-sm font-bold text-gray-700">{{ $link->visits }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $link->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button onclick="copyToClipboard('{{ url($link->short_code) }}')" 
                                                class="text-gray-400 hover:text-indigo-600 transition" title="Copy Link">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                        Chưa có link nào. Hãy tạo link đầu tiên!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Đã copy link: ' + text);
            });
        }
    </script>
</x-app-layout>