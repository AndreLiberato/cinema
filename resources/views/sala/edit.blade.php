<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Salas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Atualize a Sala do Cinema') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Adicione as informações da Sala.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('sala.update', ['sala' => $sala->id]) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div>
                                <x-input-label for="numero" :value="__('Número')" />
                                <x-text-input value="{{ $sala->numero }}" id="numero" name="numero" type="text" class="mt-1 block w-full"
                                    required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('numero')" />
                            </div>

                            <div>
                                <x-input-label for="tipo-select" :value="__('Tipo')" />
                                {!! Form::select('tipo', $tipos, $sala->tipo, ['id' => 'tipo-select', 'required', 'data-te-select-init', 'data-te-select-filter' => 'true']) !!}
                                <x-input-error class="mt-2" :messages="$errors->get('tipo')" />
                            </div>

                            <div>
                                <x-input-label for="capacidade" :value="__('capacidade')" />
                                <x-text-input value="{{ $sala->capacidade }}" id="capacidade" name="capacidade" type="text" class="mt-1 block w-full"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('capacidade')" />
                            </div>

                            <div>
                                <x-input-label for="cinema-select" :value="__('Cinemas')" />
                                {!! Form::select('cinema_id', $cinemas, $sala->cinema_id, ['id' => 'cinema-select', 'required', 'data-te-select-init', 'data-te-select-filter' => 'true']) !!}
                                <x-input-error class="mt-2" :messages="$errors->get('capacidade')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>

                                @if (session('status') === 'sucesso')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Sala atualizada') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
