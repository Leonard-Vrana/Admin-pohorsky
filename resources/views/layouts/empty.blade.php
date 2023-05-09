<!DOCTYPE HTML>
<html class="@if(isset($_COOKIE['dark-mode'])) dark  @endif" lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ !empty($pageTitle ?? null) ? ($pageTitle .' | ') : '' }} Pohorsky</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name='robots' content='noindex, nofollow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
    <script src="{{ asset('/js/app.js') }}"></script>
  </head>
  <body>
    @yield('body')

    <script src="https://kit.fontawesome.com/db1d89e055.js" crossorigin="anonymous"></script>
  </body>
</html>