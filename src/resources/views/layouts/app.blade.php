<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  @yield('css')
  
</head>

<body>
  <header class="header">
  <div class="header__inner">
  <a href="/" class="header__logo">FashionablyLate</a>

  @auth
  @if(request()->is('admin*'))
    <form action="/logout" method="post" class="header__logout">
      @csrf
      <button type="submit" class="header__login">logout</button>
    </form>
  @endif
@endauth
</div>

  <main>
    @yield('content')
  </main>
</body>

</html>