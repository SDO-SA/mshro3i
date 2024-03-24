<div class="flex flex-col items-center justify-center h-96">
    <h2 class="font-semibold text-2xl text-gray-800 sm:text-4xl dark:text-gray-200 leading-tight">{{ __('app.no_group') }}</h2>
    <div class="flex mt-4 md:mt-6">
        <a href="{{ url('/groups/create-group') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('app.create_group') }}</a>
        <a href="{{ url('/groups/browse-list') }}" class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">{{ __('app.browse_groups') }}</a>
    </div>
</div>
