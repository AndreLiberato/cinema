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
                                {{ __('Listagem de Cinemas') }}
                            </h2>
                            <x-secondary-link-button href="{{ route('cinema.create') }}">
                                {{ __('Adicionar') }}
                            </x-secondary-link-button>
                        </div>
                        @if (session('status') === 'sucesso')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Cinema excluído') }}</p>
                        @endif
                    </header>

                    <table
                        class="text-center mt-6 space-y-6 table-auto w-full sm:rounded-lg text-gray-900 dark:text-gray-100 bg-indigo-200 dark:bg-indigo-500">
                        <thead class="h-10">
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Estado</th>
                                <th>Cidade</th>
                                <th>Rua</th>
                                <th>Número</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cinemas as $index => $cinema)
                                <tr
                                    class="transition duration-300 h-10 ease-in-out hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $cinema->nome }}</td>
                                    <td>{{ $cinema->estado ?? '--' }}</td>
                                    <td>{{ $cinema->cidade ?? '--' }}</td>
                                    <td>{{ $cinema->rua ?? '--' }}</td>
                                    <td>{{ $cinema->numero ?? '--' }}</td>
                                    <td class="flex justify-center">
                                        <a title="Endereço" 
                                            data-te-toggle="tooltip"
                                            href="{{ route('endereco_cinema.index', ['cinema_id' => $cinema->id]) }}">
                                            <x-iconpark-localtwo-o class="w-5 h-5" />
                                        </a>
                                        <a title="Editar" 
                                            data-te-toggle="tooltip"
                                            href="{{ route('cinema.edit', ['cinema' => $cinema->id]) }}">
                                            <x-far-edit class="w-5 h-5" />
                                        </a>
                                        <a title="Visualizar"
                                            data-te-toggle="tooltip"
                                            href="{{ route('cinema.show', ['cinema' => $cinema->id]) }}">
                                            <x-bx-show class="w-5 h-5" />
                                        </a>
                                        <a title="Deletar" 
                                            data-te-toggle="tooltip"
                                            x-data=""
                                            @click.prevent="$dispatch('open-modal', 'confirm-cinema-deletion')"
                                            onclick="getDeleteUrl({{ $cinema->id }})" href="#">
                                            <x-ri-delete-bin-2-line class="w-5 h-5" />
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr
                                    class="transition duration-300 h-10 ease-in-out hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <td colspan="7">Sem cinemas cadastrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="confirm-cinema-deletion" focusable>
        <form id="confirm-cinema-deletion" method="post" action="#" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Você tem certeza que deseja excluir este cinema?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Após a realização desta ação, ela não poderá mais ser disfeita e todos os recursos deste cinema serão
                permanentemente excluídos.
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    Deletar cinema
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    @push('scripts')
        <script>
            function getDeleteUrl(cinema_id) {
                const form = document.getElementById('confirm-cinema-deletion');
                const action = "{{ route('cinema.index') }}";
                form.action = `${action}/${cinema_id}`;
            }
        </script>
    @endpush
</x-app-layout>
