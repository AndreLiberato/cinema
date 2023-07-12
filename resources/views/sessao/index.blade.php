<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sessões') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-7xl">
                    <header>
                        <div class="flex justify-between">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Listagem de Sessões') }}
                            </h2>
                            <x-secondary-link-button href="{{ route('sessao.create') }}">
                                {{ __('Adicionar') }}
                            </x-secondary-link-button>
                        </div>
                        @if (session('status') === 'sucesso')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400">{{ __('sessao excluído') }}</p>
                        @endif
                    </header>

                    <table
                        class="text-center mt-6 space-y-6 table-auto w-full sm:rounded-lg text-gray-900 dark:text-gray-100 bg-indigo-200 dark:bg-indigo-500">
                        <thead class="h-10">
                            <tr>
                                <th>#</th>
                                <th>Nome do Filme</th>
                                <th>Cinema - Sala</th>
                                <th>Dublagem</th>
                                <th>Legenda</th>
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sessoes as $index => $sessao)
                                <tr
                                    class="transition duration-300 h-10 ease-in-out hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $sessao->filme_titulo }}</td>
                                    <td>{{ $sessao->cinema_nome }} - {{ $sessao->sala_numero }}</td>
                                    <td>{{ $sessao->idioma_dublagem }}</td>
                                    <td>{{ $sessao->idioma_legenda ?? "Sem legenda" }}</td>
                                    <td>{{ $sessao->data_hora_inicio }}</td>
                                    <td>{{ $sessao->data_hora_fim }}</td>
                                    <td class="flex justify-center">
                                        <a title="Editar" href="{{ route('sessao.edit', ['sessao' => $sessao->id]) }}">
                                            <x-far-edit class="w-5 h-5" />
                                        </a>
                                        <a title="Visualizar"
                                            href="{{ route('sessao.show', ['sessao' => $sessao->id]) }}">
                                            <x-bx-show class="w-5 h-5" />
                                        </a>
                                        <a title="Deletar" x-data=""
                                            @click.prevent="$dispatch('open-modal', 'confirm-sessao-deletion')"
                                            onclick="getDeleteUrl({{ $sessao->id }})" href="#">
                                            <x-ri-delete-bin-2-line class="w-5 h-5" />
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr
                                    class="transition duration-300 h-10 ease-in-out hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <td colspan="7">Sem sessões cadastrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="confirm-sessao-deletion" focusable>
        <form id="confirm-sessao-deletion" method="post" action="#" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Você tem certeza que deseja excluir esta sessão?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Após a realização desta ação, ela não poderá mais ser disfeita e todos os recursos desta sessão serão
                permanentemente excluídos.
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    Deletar Sessão
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    @push('scripts')
        <script>
            function getDeleteUrl(sessao_id) {
                const form = document.getElementById('confirm-sessao-deletion');
                form.action = `{{ route('sessao.index') }}/${sessao_id}`;
            }
        </script>
    @endpush
</x-app-layout>
