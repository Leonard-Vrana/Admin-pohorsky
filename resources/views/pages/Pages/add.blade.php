@extends('layouts.main',[
	'pageTitle' => 'Add page ',
])

@section("main")
    <script src="https://cdn.tiny.cloud/1/nxa5frwp0k2y5lntuzp82wiqztiglugvbghbmmpgu1a4fgp9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <section>
        <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Přidání stránky</h1>
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-white inputs">
            <form method="post" action="{{ route("admin-createPage") }}">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <label for="title">Název</label>
                        <input type="text" id="title" name="title">
                    </div>
                    <div class="flex flex-col">
                        <label for="title">Projekty na kterých se zobrazí tato položka</label>
                        <select multiple name="projects[]">
                            @foreach ($projects as $project)
                            <option value="{{ $project->value }}">{{ $project->project }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="title">Kontent</label>
                        <textarea id="textareaContent" name="content"></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center mt-4">
                    <button type="submit" class="btn-primary">Přidat</button>
                </div>
            </form>
        </div>
    </section>
@endsection