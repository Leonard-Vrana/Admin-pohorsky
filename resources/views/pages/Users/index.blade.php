@extends('layouts.main',[
	'pageTitle' => 'Users ',
])

@section("main")
    <section>
        <div class="flex justify-between items-center">
            <div>
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Prehlad uživatelú
                </h2>
            </div>
            <div>
                <button class="btn-primary modal" data-name="addUser">Pridať užívateľa</button>
            </div>
        </div>

    <div>
        <table class="w-full whitespace-no-wrap">
            <thead>
            <tr
                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
                <th class="px-4 py-3">#ID</th>
                <th class="px-4 py-3">Email uživatela</th>
                <th class="px-4 py-3">Rola</th>
                <th class="px-4 py-3">Akcia</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($users as $user)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                        <div>
                            <p class="font-semibold">{{ $user->id }}</p>
                        </div>
                    </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $user->email }}
                    </td>
                    <td class="px-4 py-3 text-xs">
                        {{ $user->role }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                            <button
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray modal" data-name="deleteUser" data-id="{{ $user->id }}"
                            aria-label="Delete"
                            >
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                                ></path>
                            </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
            
            </span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">
                    <li>
                        <a aria-label="Previous" href="{{$users->onFirstPage() ? "" : $users->previousPageUrl()}}">
                            <div class="px-3 py-1 rounded-md rounded-l-lg hover:outline-none hover:shadow-outline-purple duration-300" >
                                <svg
                                class="w-4 h-4 fill-black dark:fill-white"
                                aria-hidden="true"
                                viewBox="0 0 20 20"
                                >
                                <path
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                                </svg>
                            </div>
                        </a>
                    </li>
                    <li class="flex items-center">
                        @if ($users->lastPage() > 1)
                        @if ($users->currentPage() > 1)
                            <a href="{{ $users->url(1) }}" class="px-3 py-1 rounded-md duration-300 hover:outline-none hover:shadow-outline-purple">
                                <span>1</span>
                            </a>
                        @endif
                        @if ($users->currentPage() > 3)
                            <div class="disabled"><span>&hellip;</span></div>
                        @endif
                        @foreach (range(1, $users->lastPage()) as $i)
                            @if ($i >= $users->currentPage() - 1 && $i <= $users->currentPage() + 1)
                                <a href="{{ $users->url($i) }}" class="px-3 py-1 rounded-md duration-300 hover:outline-none hover:shadow-outline-purple {{ ($users->currentPage() == $i) ? ' active' : '' }}">
                                    <span>{{ $i }}</span>
                                </a>
                            @endif
                        @endforeach
                        @if ($users->currentPage() < $users->lastPage() - 2)
                            <div class="disabled"><span>&hellip;</span></div>
                        @endif
                        @if ($users->currentPage() < $users->lastPage())
                            <a href="{{ $users->url($users->lastPage()) }}" class="px-3 py-1 rounded-md duration-300 hover:outline-none hover:shadow-outline-purple">
                                <span>{{ $users->lastPage() }}</span>
                            </a>
                        @endif
                    @endif
                    </li>
                    <li>
                        <a aria-label="Next" href="{{ $users->hasMorePages() ? $users->nextPageUrl() : ""}}">
                            <div class="px-3 py-1 rounded-md rounded-r-lg hover:outline-none hover:shadow-outline-purple duration-300">
                                <svg
                                class="w-4 h-4 fill-black dark:fill-white"
                                aria-hidden="true"
                                viewBox="0 0 20 20"
                                >
                                <path
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                ></path>
                                </svg>
                            </div>
                        </a>
                    </li>
                </ul>
                </nav>
            </span>
        </div>
    </section>
@endsection

@push('modals')
	@include('components.modals.Users.DeleteUserModal')
    @include('components.modals.Users.CreateUserModal')
@endpush