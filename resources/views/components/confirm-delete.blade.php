@props(['title' => 'Hapus Data', 'description' => 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.'])

<x-modal :name="$attributes->get('name', 'confirm-delete')" focusable>
    <form method="post" {{ $attributes->except(['name']) }}>
        @csrf
        @method('delete')

        <div class="p-6">
            <h2 class="text-lg font-semibold text-edu-text">{{ $title }}</h2>
            <p class="mt-1 text-sm text-edu-muted">{{ $description }}</p>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>
                <x-danger-button>
                    Hapus
                </x-danger-button>
            </div>
        </div>
    </form>
</x-modal>
