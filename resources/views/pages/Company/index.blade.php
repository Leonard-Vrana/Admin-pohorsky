@extends('layouts.main',[
	'pageTitle' => 'Company setting ',
])

@section("main")
	<section>
		<h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Nastavení</h1>

		<table class="w-full whitespace-no-wrap">
			<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
				@foreach ($settings as $setting)
					<tr class="text-gray-700 dark:text-gray-400">
						<td class="px-4 py-3">{{ $setting->name }}</td>
						<td class="px-4 py-3">{{ $setting->value }}</td>
						<td>
							<div class="flex items-center">
								<button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray modal" data-name="editCompany" data-value="{{ $setting->value }}" data-id="{{ $setting->id }}" aria-label="Edit">
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
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</section>
@endsection
@push('modals')
	@include('components.modals.Company.EditCompanyModal')
@endpush