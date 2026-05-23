<x-layout>
    <div class="max-w-[1440px] mx-auto pt-8 pb-16 px-6 md:px-12 min-h-screen">
        <div class="mb-12">
            <h1 class="text-4xl font-display text-zinc-900 dark:text-zinc-50 font-bold tracking-tight">Kotak Masuk</h1>
            <p class="text-zinc-500 dark:text-zinc-400 mt-2">Notifikasi terbaru Anda.</p>
        </div>

        @php
            $notifications = auth()->user()->notifications()->latest()->paginate(20);
        @endphp

        @if($notifications->isEmpty())
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-12 text-center">
                <span class="material-symbols-outlined text-zinc-300 text-4xl mb-4">mail</span>
                <h3 class="text-zinc-900 dark:text-zinc-50 font-medium">Belum ada notifikasi</h3>
            </div>
        @else
            <div class="space-y-4">
                @foreach($notifications as $notification)
                <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6 flex items-start gap-4 {{ $notification->read_at ? 'opacity-60' : '' }}">
                    <span class="material-symbols-outlined text-zinc-400 mt-0.5">notifications</span>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-zinc-900 dark:text-zinc-50">{{ $notification->data['message'] ?? 'Notifikasi' }}</p>
                        @if(isset($notification->data['notes']))
                        <p class="text-xs text-zinc-500 mt-1">{{ $notification->data['notes'] }}</p>
                        @endif
                        <span class="text-xs text-zinc-400 mt-2 block">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    @if(isset($notification->data['action_url']))
                    <a href="{{ $notification->data['action_url'] }}" class="text-xs font-medium text-zinc-900 dark:text-zinc-50 underline whitespace-nowrap">Lihat</a>
                    @endif
                </div>
                @endforeach
            </div>
            {{ $notifications->links() }}
        @endif
    </div>
</x-layout>
