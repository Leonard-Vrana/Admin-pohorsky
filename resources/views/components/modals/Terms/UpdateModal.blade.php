<div class="fixed top-0 h-full w-full z-[180] -left-[100vw] duration-500 pointer-events-none" id="updateTerm">
    <div class="flex justify-center items-center h-full">
        <form method="post" action="{{ route("admin-storyUpdateTerms") }}">
            @csrf
            <input type="hidden" name="termType" class="termtype" value="" />
            <input type="hidden" name="id" class="id" value="" />
            <div class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl pointer-events-auto">
                <!-- Modal body -->
                <div class="mt-4 mb-6">
                  <!-- Modal title -->
                  <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300 text-center">
                    Upravenie autora
                  </p>
                  <!-- Modal description -->
                  <p class="text-xl text-gray-700 dark:text-gray-400 text-center">
                    <input type="text" name="nameAuthor" class="nameauthor block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="" />
                  </p>
                </div>
                <footer class="flex flex-col items-center justify-center px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                  <button type="submit" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Upraviť
                  </button>
                </footer>
              </div>
        </form>
    </div>
  </div>