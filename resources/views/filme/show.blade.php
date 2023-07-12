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
                                {{ __('Informações da Filme') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Todos os itens associados') }}
                            </p>
                        </header>

                        <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            <h1>Título: {{ $filme->titulo }}</h1>
                            <h1>Diretor: {{ $filme->diretor }}</h1>
                            <h1>Gênero: {{ $filme->genero }}</h1>
                            <h1>Classificação: {{ $filme->classificacao_indicativa }}</h1>
                            <h1>Duração: {{ $filme->duracao }}</h1>
                            <h1>Gênero: {{ $filme->sinopse }}</h1>
                            <h1>Copyrights: {{ $filme->copyrights }}</h1>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
