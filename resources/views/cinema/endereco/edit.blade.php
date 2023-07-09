<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Endereço') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Informações do Endereço') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Edite as informações do endereço.") }}
                            </p>

                            <div>
                                <x-input-error class="mt-2" :messages="$errors->get('cinema_id')" />
                            </div>
                        </header>

                        <form method="post" action="{{ route('endereco_cinema.update', ['endereco' => $endereco->id]) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="estado" :value="__('Estado')" />
                                <x-text-input value="{{ $endereco->estado }}" id="estado" name="estado" type="text" class="mt-1 block w-full" required autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                            </div>

                            <div>
                                <x-input-label for="cidade" :value="__('Cidade')" />
                                <x-text-input value="{{ $endereco->cidade }}"  id="cidade" name="cidade" type="text" class="mt-1 block w-full" required/>
                                <x-input-error class="mt-2" :messages="$errors->get('cidade')" />
                            </div>

                            <div>
                                <x-input-label for="rua" :value="__('Rua')" />
                                <x-text-input value="{{ $endereco->rua }}"  id="rua" name="rua" type="text" class="mt-1 block w-full" required/>
                                <x-input-error class="mt-2" :messages="$errors->get('rua')" />
                            </div>

                            <div>
                                <x-input-label for="numero" :value="__('Número')" />
                                <x-text-input value="{{ $endereco->numero }}"  id="numero" name="numero" type="text" class="mt-1 block w-full" required/>
                                <x-input-error class="mt-2" :messages="$errors->get('numero')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>

                                @if (session('status') === 'sucesso')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Endereço atualizado') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
