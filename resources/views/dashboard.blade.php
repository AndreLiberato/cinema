<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mt-12">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 lg:gap-2">
            <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-indigo-500/50 rounded-lg shadow-2xl shadow-indigo-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-indigo-500 max-w-7xl mx-auto sm:px-6">
                <div>
                    <p class="mt-3 text-gray-500 dark:text-white text-sm">
                        <strong>Total de cinemas cadastrados: </strong> {{ $cinemas_count }}
                    </p>
                </div>
            </div>
            <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-indigo-500/50 rounded-lg shadow-2xl shadow-indigo-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-indigo-500 max-w-7xl mx-auto sm:px-6">
                <div>
                    <p class="mt-3 text-gray-500 dark:text-white text-sm">
                        <strong>Total de filmes cadastrados: </strong> {{ $filmes_count }}
                    </p>
                </div>
            </div>
            <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-indigo-500/50 rounded-lg shadow-2xl shadow-indigo-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-indigo-500 max-w-7xl mx-auto sm:px-6">
                <div>
                    <p class="mt-3 text-gray-500 dark:text-white text-sm">
                        <strong>Total de salas cadastradas: </strong>{{ $salas_count }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
