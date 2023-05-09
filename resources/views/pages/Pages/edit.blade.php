@extends('layouts.main',[
	'pageTitle' => 'Add page ',
])

@section("main")
    @php
        $pageProject = json_decode($page->domain);
    @endphp
    <script src="https://cdn.tiny.cloud/1/nxa5frwp0k2y5lntuzp82wiqztiglugvbghbmmpgu1a4fgp9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <section>
        <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Upraviť stránku</h1>
        <div class="flex flex-col dark:text-white py-3">
            <small>URL</small>
                @foreach ($urls as $url)
                    @php
                        $project = $projects->where("value", $url)->first();
                    @endphp
                    @if ($project)
                        <a href="{{ $project->project_url }}stranka/{{ $page->id }}">{{ $project->project_url }}stranka/{{ $page->id }}</a>
                    @endif
                @endforeach
        </div>
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-white inputs">
            <form method="post" action="{{ route("admin-updatePage") }}">
                @csrf
                <input type="hidden" name="id" value="{{ $page->id }}" />
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <label for="title">Názov</label>
                        <input type="text" id="title" name="title" value="{{ $page->title }}">
                    </div>
                    <div class="flex flex-col">
                        <label for="title">Projekty na ktorých sa zobrazí táto položka</label>
                        <select multiple name="projects[]">
                            @foreach ($projects as $project)
                            <option value="{{ $project->value }}" @if(in_array($project->value , $pageProject)) selected @endif>{{ $project->project }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="title">Kontent</label>
                        <textarea id="textareaContent" name="content">{{ $page->text }}</textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center mt-4">
                    <button type="submit" class="btn-primary">Upraviť</button>
                </div>
            </form>
        </div>
    </section>
@endsection