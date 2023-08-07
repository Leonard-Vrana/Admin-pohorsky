@extends('layouts.main',[
	'pageTitle' => 'Přidat diafilm ',
])

@section("main")
    <section>
        <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Vytvoření položky v tabulce Stories</h1>

        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-white inputs">
            <form method="post" action="{{ route("admin-storyAddCMD") }}">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <label for="title">Název</label>
                        <input type="text" id="title" name="title" value="{{ old("title") }}">
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
                        <label for="img">Náhledový obrázek (URL)</label>
                        <input type="text" id="img" name="img" value="{{ old("img") }}">
                    </div>
                    <div class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        <div>
                            <select class="text-black" name="maker">
                                <option selected disabled>Výrobce</option>
                                @foreach ($makers as $maker)
                                    <option value="{{ $maker->id }}" @if(old("maker") == $maker->id) selected @endif>{{ $maker->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select class="text-black" name="artAuthor">
                                <option selected disabled>Autor kreseb</option>
                                @foreach ($artAuthors as $author)
                                    <option value="{{ $author->id }}" @if(old("artAuthor") == $author->id) selected @endif>{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select class="text-black" name="templateAuthor">
                                <option selected disabled>Autor předlohy</option>
                                @foreach ($templateAuthors as $author)
                                <option value="{{ $author->id }}" @if(old("templateAuthor") == $author->id) selected @endif>{{ $author->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div>
                            <select class="text-black" name="textAuthor">
                                <option selected disabled>Autor Text</option>
                                @foreach ($textAuthors as $author)
                                <option value="{{ $author->id }}" @if(old("textAuthor") == $author->id) selected @endif>{{ $author->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col">
                            <label for="marked">Označení</label>
                            <input type="text" name="marked" id="marked" value="{{ old("marked") }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="year">Rok</label>
                            <input type="text" id="year" name="year" value="{{ old("year") }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="lenght">Délka</label>
                            <input type="text" id="lenght" name="lenght" value="{{ old("lenght") }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col">
                            <label for="annotation">Anotace</label>
                            <input type="text" name="annotation" id="annotation" value="{{ old("annotation") }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="height">Výška</label>
                            <input type="text" name="height" id="height" value="{{ old("height") }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="have">Mám</label>
                            <input type="text" name="have" id="have" value="{{ old("have") }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col">
                            <label for="file">Súbor</label>
                            <input type="text" name="file" id="file" value="{{ old("file") }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="attribute">Atribúty</label>
                            <input type="text" name="attribute" id="attribute" value="{{ old("attribute") }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="labels">Štítky</label>
                            <input type="text" name="labels" id="labels" value="{{ old("labels") }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col">
                            <label for="prop-text">Prop text</label>
                            <input type="text" name="prop-text" id="prop-text" value="{{ old("prop-text") }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="collection">Sbírka</label>
                            <input type="text" name="collection" id="collection" value="{{ old("collection") }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="publisher">Vydavatel</label>
                            <select class="text-black autocomplete" name="publisher">
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" @if(old("publisher") == $publisher->id) selected @endif>{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col">
                            <label for="editor">Editor</label>
                            <input type="text" name="editor" id="editor" value="{{ old("editor") }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="translator">Preložil</label>
                            <input type="text" name="translator" id="translator" value="{{ old("translator") }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="language">Jazyk</label>
                            <input type="text" name="language" id="language" value="{{ old('language') }}">
                        </div>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div class="flex items-center whitespace-nowrap gap-3">
                        <input type="checkbox" id="onlyUser" name="onlyUser">
                        <label for="onlyUser" style="padding-bottom: 0px !important;">Zobrazit prvních 5 obrázku</label>
                    </div>
                    <button class="btn-primary" type="submit">Přidat</button>
                </div>
            </form>
        </div>
    </section>
@endsection