<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cinemas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-7xl">
                    <header>
                        <div class="flex justify-between">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Listagem de Salas') }}
                            </h2>
                            <x-secondary-link-button href="{{ route('sala.create') }}">
                                {{ __('Adicionar') }}
                            </x-secondary-link-button>
                        </div>
                        @if (session('status') === 'sucesso')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Sala excluído') }}</p>
                        @endif
                    </header>

                    <table
                        class="text-center mt-6 space-y-6 table-auto w-full sm:rounded-lg text-gray-900 dark:text-gray-100 bg-indigo-200 dark:bg-indigo-500">
                        <thead class="h-10">
                            <tr>
                                <th>#</th>
                                <th>Número</th>
                                <th>Tipo</th>
                                <th>Capacidade</th>
                                <th>Cinema</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($salas as $index => $sala)
                                <tr
                                    class="transition duration-300 h-10 ease-in-out hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $sala->numero }}</td>
                                    <td>{{ $sala->tipo }}</td>
                                    <td>{{ $sala->capacidade }}</td>
                                    <td>{{ $sala->cinema_nome }}</td>
                                    <td class="flex justify-center">
                                        <a title="Editar" href="{{ route('sala.edit', ['sala' => $sala->id]) }}">
                                            <x-far-edit class="w-5 h-5" />
                                        </a>
                                        <a title="Visualizar"
                                            href="{{ route('sala.show', ['sala' => $sala->id]) }}">
                                            <x-bx-show class="w-5 h-5" />
                                        </a>
                                        <a title="Deletar" x-data=""
                                            @click.prevent="$dispatch('open-modal', 'confirm-sala-deletion')"
                                            onclick="getDeleteUrl({{ $sala->id }})" href="#">
                                            <x-ri-delete-bin-2-line class="w-5 h-5" />
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr
                                    class="transition duration-300 h-10 ease-in-out hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <td colspan="7">Sem salas cadastrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="confirm-sala-deletion" focusable>
        <form id="confirm-sala-deletion" method="post" action="#" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Você tem certeza que deseja excluir esta sala?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Após a realização desta ação, ela não poderá mais ser disfeita e todos os recursos desta sala serão
                permanentemente excluídos.
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    Deletar sala
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    @push('scripts')
        <script>
            function getDeleteUrl(sala_id) {
                const form = document.getElementById('confirm-sala-deletion');
                form.action = `{{ route('sala.index') }}/${sala_id}`;
            }
        </script>
    @endpush
</x-app-layout>
