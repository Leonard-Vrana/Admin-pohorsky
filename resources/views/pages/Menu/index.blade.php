@extends('layouts.main',[
	'pageTitle' => 'Pages ',
])

@section("main")
	<section>
        <div class="flex justify-between items-center">
            <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Položky v menu</h1>
            <button class="btn-primary modal" data-name="addMenu">Pridat</button>
        </div>

		<table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                  class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                  <th class="px-4 py-3">#ID</th>
                  <th class="px-4 py-3">Doména</th>
                  <th class="px-4 py-3">Názov</th>
                  <th class="px-4 py-3">Url</th>
				  <th class="px-4 py-3">Akcia</th>
                </tr>
              </thead>
			<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($items as $item)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{ $item->id }}</td>
                        <td class="px-4 py-3">{{ $item->domain }}</td>
                        <td class="px-4 py-3">{{ $item->name }}</td>
						<td class="px-4 py-3">{{ $item->url }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <button
                                  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray modal" data-name="editMenu" data-id="{{ $item->id }}" data-title="{{ $item->name }}" data-url="{{ $item->url }}"
                                  aria-label="Edit"
                                >
                                  <svg
                                    class="w-5 h-5"
                                    aria-hidden="true"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                  >
                                    <path
                                      d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                    ></path>
                                  </svg>
                                </button>
                                <button
                                  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray modal" data-name="deleteMenu" data-id="{{ $item->id }}"
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
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
			<span class="flex items-center col-span-3">
			
			</span>
			<span class="col-span-2"></span>
			<!-- Pagination -->
			<span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
				<nav aria-label="Table navigation">
				<ul class="inline-flex items-center">
					<li>
						<a aria-label="Previous" href="{{$items->onFirstPage() ? "" : $items->previousPageUrl()}}">
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
						@if ($items->lastPage() > 1)
						@if ($items->currentPage() > 1)
							<a href="{{ $items->url(1) }}" class="px-3 py-1 rounded-md duration-300 hover:outline-none hover:shadow-outline-purple">
								<span>1</span>
							</a>
						@endif
						@if ($items->currentPage() > 3)
							<div class="disabled"><span>&hellip;</span></div>
						@endif
						@foreach (range(1, $items->lastPage()) as $i)
							@if ($i >= $items->currentPage() - 1 && $i <= $items->currentPage() + 1)
								<a href="{{ $items->url($i) }}" class="px-3 py-1 rounded-md duration-300 hover:outline-none hover:shadow-outline-purple {{ ($items->currentPage() == $i) ? ' active' : '' }}">
									<span>{{ $i }}</span>
								</a>
							@endif
						@endforeach
						@if ($items->currentPage() < $items->lastPage() - 2)
							<div class="disabled"><span>&hellip;</span></div>
						@endif
						@if ($items->currentPage() < $items->lastPage())
							<a href="{{ $items->url($items->lastPage()) }}" class="px-3 py-1 rounded-md duration-300 hover:outline-none hover:shadow-outline-purple">
								<span>{{ $items->lastPage() }}</span>
							</a>
						@endif
					@endif
					</li>
					<li>
						<a aria-label="Next" href="{{ $items->hasMorePages() ? $items->nextPageUrl() : ""}}">
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
	@include('components.modals.Menu.AddMenuModal')
	@include('components.modals.Menu.EditMenuModal')
	@include('components.modals.Menu.DeleteMenuModal')
@endpush