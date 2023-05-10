@extends('layouts.main',[
	'pageTitle' => 'Edit Story',
])

@section("main")
    @php
        $storyProject = json_decode($story->domain);
    @endphp
    <section>
        <div class="flex justify-between items-center">
            <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Upravenie položky v tabulke Stories</h1>
            <form method="post" action="{{ route("admin-storyPublicCMD") }}">
                @csrf
                <input type="hidden" name="id" value="{{ $story->id }}" />
                <button class="btn-primary" type="submit">@if($story->public == true) Schovat @else Publikovat @endif</button>
            </form>
        </div>

        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-white inputs">
            <form method="post" action="{{ route("admin-storyUpdateCMD") }}">
                @csrf
                <input type="hidden" name="id" value="{{ $story->id }}" />
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <label for="title">Názov</label>
                        <input type="text" id="title" value="{{ $story->title }}" name="title">
                    </div>
                    <div class="flex flex-col">
                        <label for="title">Projekty na ktorých sa zobrazí táto položka</label>
                        <select multiple name="projects[]">
                            @foreach ($projects as $project)
                            <option value="{{ $project->value }}" @if(in_array($project->value , $storyProject)) selected @endif>{{ $project->project }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="img">Náhladový obrázok (URL)</label>
                        <input type="text" id="img" name="img" value="{{ $story->img }}">
                    </div>
                    <div class="grid lg:grid-cols-4 grid-cols-1 gap-3">
                        <div>
                            <select class="text-black" name="maker">
                                <option selected disabled>Výrobce</option>
                                @foreach ($makers as $maker)
                                    <option value="{{ $maker->id }}" @if($maker->id == $story->maker) selected  @endif>{{ $maker->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select class="text-black" name="artAuthor">
                                <option selected disabled>Autor kreseb</option>
                                @foreach ($artAuthors as $author)
                                    <option value="{{ $author->id }}" @if($author->id == $story->art_author) selected  @endif>{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select class="text-black" name="templateAuthor">
                                <option selected disabled>Autor předlohy</option>
                                @foreach ($templateAuthors as $author)
                                <option value="{{ $author->id }}" @if($author->id == $story->template_author) selected  @endif>{{ $author->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div>
                            <select class="text-black" name="textAuthor">
                                <option selected disabled>Autor Text</option>
                                @foreach ($textAuthors as $author)
                                <option value="{{ $author->id }}" @if($author->id == $story->text_author) selected  @endif>{{ $author->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col">
                            <label for="marked">Označení</label>
                            <input type="text" name="marked" id="marked" value="{{ $story->marked }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="year">Rok</label>
                            <input type="text" id="year" name="year" value="{{ $story->year }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="lenght">Dĺžka</label>
                            <input type="text" id="lenght" name="lenght" value="{{ $story->lenght }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col">
                            <label for="annotation">Anotácia</label>
                            <input type="text" name="annotation" id="annotation" value="{{ $story->annotation }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="height">Výška</label>
                            <input type="text" name="height" id="height" value="{{ $story->height }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="have">Mám</label>
                            <input type="text" name="have" id="have" value="{{ $story->have }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col">
                            <label for="file">Súbor</label>
                            <input type="text" name="file" id="file" value="{{ $story->file }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="attribute">Atribúty</label>
                            <input type="text" name="attribute" id="attribute" value="{{ $story->attribute }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="labels">Štítky</label>
                            <input type="text" name="labels" id="labels" value="{{ $story->labels }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col">
                            <label for="prop-text">Prop text</label>
                            <input type="text" name="prop-text" id="prop-text" value="{{ $story['prop-text'] }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="collection">Text</label>
                            <input type="text" name="collection" id="collection" value="{{ $story->collection }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="publisher">Vydavatel</label>
                            <select class="text-black" name="publisher">
                                <option selected disabled>Prázdné</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" @if($publisher->id == $story->publisher) selected  @endif>{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex flex-col">
                            <label for="editor">Editor</label>
                            <input type="text" name="editor" id="editor" value="{{ $story->editor }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="translator">Preložil</label>
                            <input type="text" name="translator" id="translator" value="{{ $story->translator }}">
                        </div>
                        <div class="flex flex-col">
                            <label for="language">Jazyk</label>
                            <input type="text" name="language" id="language" value="{{ $story->language }}">
                        </div>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <div class="flex items-center whitespace-nowrap gap-3">
                        <input type="checkbox" id="onlyUser" name="onlyUser" @if($story->onlyUser) checked @endif>
                        <label for="onlyUser" style="padding-bottom: 0px !important;">Zobrazit prvých 5 obrázku</label>
                    </div>
                    <button class="btn-primary" type="submit">Upraviť</button>
                </div>
            </form>
        </div>
    </section>

    <section class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-white inputs mt-5">
        <div class="flex justify-between items-center">
            <h2 class="my-6 text-xl font-semibold text-gray-700 dark:text-gray-200">Galéria</h2>
            <button class="btn-primary modal" data-name="addImage" data-id="{{ $story->id }}">Pridať</button>
        </div>
        <div class="table w-full"> 
            <table class="w-full whitespace-no-wrap">
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($story->storyChildrens as  $gallery)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-5">#{{ $gallery->id }}</td> 
                            <td>{{ mb_substr($gallery->text, 0, 40, "UTF-8") }} {{ strlen($gallery->text) > 50 ? "..." : "" }}</td>
                            <td>
                                <div class="h-11 w-11 relative overflow-hidden bg-cover bg-center">
                                    <img class="absolute top-0 w-full h-full object-cover object-center" src="{{ $gallery->img }}">
                                </div>
                            </td>
                        </td>
                        <td class="px-4 py-3">
                          <div class="flex items-center space-x-4 text-sm">
                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray modal" data-name="updateImage" data-text="{{ $gallery->text }}" data-id="{{ $gallery->id }}" aria-label="Edit">
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
                            <form method="post" action="{{ route("admin-storyDeleteImage") }}" class="m-0">
                                @csrf
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" name="id" value="{{ $gallery->id }}" type="submit" aria-label="Delete">
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
                            </form>
                          </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('modals')
	@include('components.modals.Stories.CreateImageModal')
    @include('components.modals.Stories.UpdateImageModal')
@endpush