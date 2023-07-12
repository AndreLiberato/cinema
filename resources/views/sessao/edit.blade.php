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
                                {{ __('Editar sessão do Cinema') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Adicione as informações sessao.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('sessao.update', ['sessao' => $sessao->id]) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="filme-select" :value="__('Filmes')" />
                                {!! Form::select('filme_id', $filmes, $sessao->filme_id, ['id' => 'filme-select', 'required', 'data-te-select-init', 'data-te-select-filter' => 'true']) !!}
                                <x-input-error class="mt-2" :messages="$errors->get('tipo')" />
                            </div>

                            <div>
                                <x-input-label for="sala-select" :value="__('Salas')" />
                                {!! Form::select('sala_id', $salas, $sessao->sala_id, ['id' => 'sala-select', 'required', 'data-te-select-init', 'data-te-select-filter' => 'true']) !!}
                                <x-input-error class="mt-2" :messages="$errors->get('tipo')" />
                            </div>

                            <div>
                                <x-input-label for="idioma_dublagem-select" :value="__('Idioma Dublagem')" />
                                {!! Form::select('idioma_dublagem_id', $idiomas, $sessao->idioma_dublagem_id, ['id' => 'idioma_dublagem-select', 'required', 'data-te-select-init', 'data-te-select-filter' => 'true']) !!}
                                <x-input-error class="mt-2" :messages="$errors->get('tipo')" />
                            </div>

                            <div>
                                <x-input-label for="idioma_legenda-select" :value="__('Idioma Legenda')" />
                                {!! Form::select('idioma_legenda_id', $idiomas, $sessao->idioma_legenda_id, ['id' => 'idioma_legenda-select', 'required', 'data-te-select-init', 'data-te-select-filter' => 'true']) !!}
                                <x-input-error class="mt-2" :messages="$errors->get('tipo')" />
                            </div>

                            <div>
                                <x-input-label for="data_hora_inicio" :value="__('Início')" />
                                <x-text-input value="{{ $sessao->data_hora_inicio }}" id="data_hora_inicio-input" name="data_hora_inicio" type="datetime-local" class="mt-1 block w-full"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('data_hora_inicio')" />
                            </div>

                            <div>
                                <x-input-label for="data_hora_fim" :value="__('Fim')" />
                                <x-text-input value="{{ $sessao->data_hora_fim }}" id="data_hora_fim-input" name="data_hora_fim" type="datetime-local" class="mt-1 block w-full"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('data_hora_fim')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>

                                @if (session('status') === 'sucesso')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('sessao atualizada') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
