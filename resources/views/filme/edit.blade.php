<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Filmes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Adicionar nova Filme de Cinema') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Adicione as informações da nova Filme.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('filme.update', ['filme' => $filme->id]) }}"
                            class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="titulo" :value="__('Título')" />
                                <x-text-input value="{{ $filme->titulo }}" id="titulo" name="titulo" type="text" class="mt-1 block w-full"
                                    required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('titulo')" />
                            </div>

                            <div>
                                <x-input-label for="diretor" :value="__('Diretor')" />
                                <x-text-input value="{{ $filme->diretor }}" id="diretor" name="diretor" type="text" class="mt-1 block w-full"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('diretor')" />
                            </div>

                            <div>
                                <x-input-label for="genero" :value="__('Gênero')" />
                                <x-text-input value="{{ $filme->genero }}" id="genero" name="genero" type="text" class="mt-1 block w-full"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('genero')" />
                            </div>

                            <div>
                                <x-input-label for="classificacao_indicativa" :value="__('Classificação Indicativa')" />
                                <x-text-input value="{{ $filme->classificacao_indicativa }}" id="classificacao_indicativa" name="classificacao_indicativa"
                                    type="text" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('classificacao_indicativa')" />
                            </div>

                            <div>
                                <x-input-label for="duracao" :value="__('Duração')" />
                                <x-text-input value="{{ $filme->duracao }}" id="duracao" name="duracao" type="time" class="mt-1 block w-full"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('duracao')" />
                            </div>

                            <div>
                                <x-input-label for="sinopse-textarea" :value="__('Sinópse')" />
                                <textarea name="sinopse" id="sinopse-textarea" cols="63" rows="5">
                                    {{ $filme->sinopse }}
                                </textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('capacidade')" />
                            </div>

                            <div>
                                <x-input-label for="copyrights" :value="__('Copyrights')" />
                                <x-text-input value="{{ $filme->copyrights }}" id="copyrights" name="copyrights" type="text" class="mt-1 block w-full"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('copyrights')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>

                                @if (session('status') === 'sucesso')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Filme atualizada') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
