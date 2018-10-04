<!DOCTYPE html>
<html lang="en">
<head>
  <title>Adagmator videos</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
  <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<nav class="navbar is-info" role="navigation" aria-label="main navigation">
  <div class="navbar-brand container">
    <a class="navbar-item" style="font-weight: bold">
      Agadmator's videos
    </a>
    <a class="navbar-item">
        Home
      </a>
    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
</nav>

<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Agadmator's database
      </h1>
      <h2 class="subtitle">
        Find chess games commented by Agadmator
      </h2>
    </div>
  </div>
</section>

<div class="container">
  <div id="app"></div>
</div>

<script>
  window.completeUrl = "{{ route('complete') }}";
  window.searchUrl   = "{{ route('search') }}";
</script>
<script src="{{ asset(mix('js/manifest.js')) }}"></script>
<script src="{{ asset(mix('js/vendor.js')) }}"></script>
<script src="{{ asset(mix('js/app.js')) }}"></script>
</body>
</html>
