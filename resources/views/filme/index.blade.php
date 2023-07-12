<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Filmes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-7xl">
                    <header>
                        <div class="flex justify-between">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Listagem de Filmes') }}
                            </h2>
                            <x-secondary-link-button href="{{ route('filme.create') }}">
                                {{ __('Adicionar') }}
                            </x-secondary-link-button>
                        </div>
                        @if (session('status') === 'sucesso')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Filme excluído') }}</p>
                        @endif
                    </header>

                    <table
                        class="text-center mt-6 space-y-6 table-auto w-full sm:rounded-lg text-gray-900 dark:text-gray-100 bg-indigo-200 dark:bg-indigo-500">
                        <thead class="h-10">
                            <tr>
                                <th>#</th>
                                <th>Título</th>
                                <th>Gênero</th>
                                <th>Duração</th>
                                <th>Diretor</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($filmes as $index => $filme)
                                <tr
                                    class="transition duration-300 h-10 ease-in-out hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $filme->titulo }}</td>
                                    <td>{{ $filme->genero }}</td>
                                    <td>{{ $filme->duracao }}</td>
                                    <td>{{ $filme->diretor }}</td>
                                    <td class="flex justify-center">
                                        <a title="Editar" href="{{ route('filme.edit', ['filme' => $filme->id]) }}">
                                            <x-far-edit class="w-5 h-5" />
                                        </a>
                                        <a title="Visualizar"
                                            href="{{ route('filme.show', ['filme' => $filme->id]) }}">
                                            <x-bx-show class="w-5 h-5" />
                                        </a>
                                        <a title="Deletar" x-data=""
                                            @click.prevent="$dispatch('open-modal', 'confirm-filme-deletion')"
                                            onclick="getDeleteUrl({{ $filme->id }})" href="#">
                                            <x-ri-delete-bin-2-line class="w-5 h-5" />
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr
                                    class="transition duration-300 h-10 ease-in-out hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <td colspan="7">Sem filmes cadastrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="confirm-filme-deletion" focusable>
        <form id="confirm-filme-deletion" method="post" action="#" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Você tem certeza que deseja excluir este filme?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Após a realização desta ação, ela não poderá mais ser disfeita e todos os recursos deste filme serão
                permanentemente excluídos.
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    Deletar filme
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    @push('scripts')
        <script>
            function getDeleteUrl(filme_id) {
                const form = document.getElementById('confirm-filme-deletion');
                form.action = `{{ route('filme.index') }}/${filme_id}`;
            }
        </script>
    @endpush
</x-app-layout>
