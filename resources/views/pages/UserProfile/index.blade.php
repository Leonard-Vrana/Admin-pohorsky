@extends('layouts.main',[
	'pageTitle' => 'Uživatelský profil ',
])

@section("main")
    <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Uživatelský profil</h1>
    <section class="grid grid-cols-2 gap-7">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 dark:text-white inputs">
            <h2 class="my-6 text-xl font-semibold text-gray-700 dark:text-gray-200">Zmena hesla</h2>
            <form method="post" action="{{ route("admin-changeUserPassword") }}">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <label for="password">Nové heslo</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="flex flex-col">
                        <label for="repeat_password">Nové heslo znova</label>
                        <input type="password" id="repeat_password" name="repeat_password">
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn-primary">Zmenit</button>
                </div>
            </form>
        </div>
        <div></div>
    </section>
@endsection