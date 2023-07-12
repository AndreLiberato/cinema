<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sessões') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Adicionar nova Sessões de Cinema') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Adicione as informações da nova Sessões.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('sessao.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="filme-select" :value="__('Filmes')" />
                                <select data-te-select-init 
                                    data-te-select-filter="true"
                                    required id="filme-select" name="filme_id">
                                    @forelse ($filmes as $filme)
                                        <option value="{{ $filme->id }}">{{ $filme->titulo }}</option>
                                    @empty
                                        <option disabled>Sem filmes cadastrados</option>
                                    @endforelse
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('filme')" />
                            </div>

                            <div>
                                <x-input-label for="sala-select" :value="__('Salas')" />
                                <select data-te-select-init 
                                    data-te-select-filter="true"
                                    required id="sala-select" name="sala_id">
                                    @forelse ($salas as $sala)
                                        <option value="{{ $sala->id }}">{{ $sala->cinema_nome }} - {{ $sala->numero }}</option>
                                    @empty
                                        <option disabled>Sem salas cadastrados</option>
                                    @endforelse
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('sala')" />
                            </div>

                            <div>
                                <x-input-label for="idioma_dublagem-select" :value="__('Idioma Dublagem')" />
                                <select data-te-select-init 
                                    data-te-select-filter="true"
                                    required id="idioma_dublagem-select" name="idioma_dublagem_id">
                                    @forelse ($idiomas as $idioma)
                                        <option value="{{ $idioma->id }}">{{ $idioma->nome }}</option>
                                    @empty
                                        <option disabled>Sem idiomas cadastrados</option>
                                    @endforelse
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('idioma_dublagem_id')" />
                            </div>

                            <div>
                                <x-input-label for="idioma_legenda-select" :value="__('Idioma Dublagem')" />
                                <select data-te-select-init 
                                    data-te-select-filter="true"
                                    required id="idioma_legenda-select" name="idioma_legenda_id">
                                    @forelse ($idiomas as $idioma)
                                        <option value="{{ $idioma->id }}">{{ $idioma->nome }}</option>
                                    @empty
                                        <option disabled>Sem idiomas cadastrados</option>
                                    @endforelse
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('idioma_legenda_id')" />
                            </div>

                            <div>
                                <x-input-label for="data_hora_inicio" :value="__('Início')" />
                                <x-text-input id="data_hora_inicio-input" name="data_hora_inicio" type="datetime-local" class="mt-1 block w-full"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('data_hora_inicio')" />
                            </div>

                            <div>
                                <x-input-label for="data_hora_fim" :value="__('Fim')" />
                                <x-text-input id="data_hora_fim-input" name="data_hora_fim" type="datetime-local" class="mt-1 block w-full"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('data_hora_fim')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>

                                @if (session('status') === 'sucesso')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Sessão salva') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
