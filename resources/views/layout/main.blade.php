<!DOCTYPE html>
<html lang="en">

<head>

  @include('layout.meta')

  <title>@yield('title')</title>

  @include('layout.preJsCss')

</head>

<body>

  @include('layout.navbar')
  @include('layout.errmsg')
  
  @yield('content')

  @include('layout.footer')

</body>

</html>