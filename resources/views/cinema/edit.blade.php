<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cinemas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Informações do Cinema') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Edite as informações do Cinema.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('cinema.update', ['cinema' => $cinema->id]) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div>
                                <x-input-label for="nome" :value="__('Nome')" />
                                <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full"
                                    value="{{ $cinema->nome }}" required autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('nome')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>

                                @if (session('status') === 'sucesso')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Cinema atualizado') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
