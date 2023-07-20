@extends('layouts.main',[
	'pageTitle' => 'Kategorie ',
])

@section("main")
	<section>
		<h2
		class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
	  >
		Práve zobrazujete {{ $countAuthors }} záznamov z tabulky {{ $name }}
	  </h2>

	  <div class="flex justify-between">
		<div class="flex items-center gap-3 pb-6">
			<a href="{{ route("admin-storyTerms", "maker") }}" class="btn-primary {{ $type == "storyMaker" ? "selected" : null }}">Výrobce</a>
			<a href="{{ route("admin-storyTerms", "artAuthor") }}" class="btn-primary {{ $type == "artAuthor" ? "selected" : null }}">Autor kreseb</a>
			<a href="{{ route("admin-storyTerms", "templateAuthor") }}" class="btn-primary {{ $type == "templateAuthor" ? "selected" : null }}">Autor předlohy</a>
			<a href="{{ route("admin-storyTerms", "textAuthor") }}" class="btn-primary {{ $type == "textAuthor" ? "selected" : null }}">Autor textu</a>
			<a href="{{ route("admin-storyTerms", "publisher") }}" class="btn-primary {{ $type == "publisher" ? "selected" : null }}">Vydavatel</a>
		  </div>
		  <div>
			<button class="btn-primary modal" data-name="addTerm" data-termtype="{{ $type }}">Přidat položku</button>
		  </div>
	  </div>

	  <div>
		<table class="w-full whitespace-no-wrap">
			<thead>
			  <tr
				class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
			  >
				<th class="px-4 py-3">#ID</th>
				<th class="px-4 py-3">Name</th>
				<th class="px-4 py-3">Actions</th>
			  </tr>
			</thead>
			<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
				@foreach ($authors as $author)
				<tr class="text-gray-700 dark:text-gray-400">
					<td class="px-4 py-3">
					  <div class="flex items-center text-sm">
						<div>
						  <p class="font-semibold">{{ $author->id }}</p>
						</div>
					  </div>
					</td>
					<td class="px-4 py-3 text-sm">
					  {{ $author->name }}
					</td>
					<td class="px-4 py-3">
					  <div class="flex items-center space-x-4 text-sm">
						<button
						  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray modal" data-name="updateTerm" data-id="{{ $author->id }}" data-termtype="{{$type}}" data-nameauthor="{{ $author->name }}"
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
						  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray modal" data-name="deleteTerm" data-termtype="{{$type}}" data-id="{{ $author->id }}"
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
						<a aria-label="Previous" href="{{$authors->onFirstPage() ? "" : $authors->previousPageUrl()}}">
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
						@if ($authors->lastPage() > 1)
						@if ($authors->currentPage() > 2)
							<a href="{{ $authors->url(1) }}" class="px-3 py-1 rounded-md duration-300 hover:outline-none hover:shadow-outline-purple">
								<span>1</span>
							</a>
						@endif
						@if ($authors->currentPage() > 3)
							<div class="disabled"><span>&hellip;</span></div>
						@endif
						@foreach (range(1, $authors->lastPage()) as $i)
							@if ($i >= $authors->currentPage() - 1 && $i <= $authors->currentPage() + 1)
								<a href="{{ $authors->url($i) }}" class="px-3 py-1 rounded-md duration-300 hover:outline-none hover:shadow-outline-purple {{ ($authors->currentPage() == $i) ? ' active' : '' }}">
									<span>{{ $i }}</span>
								</a>
							@endif
						@endforeach
						@if ($authors->currentPage() < $authors->lastPage() - 2)
							<div class="disabled"><span>&hellip;</span></div>
						@endif
						@if ($authors->currentPage() < $authors->lastPage() - 1)
							<a href="{{ $authors->url($authors->lastPage()) }}" class="px-3 py-1 rounded-md duration-300 hover:outline-none hover:shadow-outline-purple">
								<span>{{ $authors->lastPage() }}</span>
							</a>
						@endif
					@endif
					</li>
					<li>
						<a aria-label="Next" href="{{ $authors->hasMorePages() ? $authors->nextPageUrl() : ""}}">
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
	@include('components.modals.Terms.DeleteModal')
	@include('components.modals.Terms.UpdateModal')
	@include('components.modals.Terms.CreateModal')
@endpush
