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

<footer class="footer">
  <div class="content has-text-centered">
    <p>
      Built with ❤ by <a href="https://twitter.com/zerquix18">Luis</a>. The source code is available on <a href="https://github.com/zerquix18/agadmator">Github</a>.
    </p>
  </div>
</footer>

<a href="https://github.com/zerquix18/agadmator"><img style="z-index: 10000000; position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>

<script>
  window.completeUrl = "{{ route('complete') }}";
  window.searchUrl   = "{{ route('search') }}";
</script>
<script src="{{ asset(mix('js/manifest.js')) }}"></script>
<script src="{{ asset(mix('js/vendor.js')) }}"></script>
<script src="{{ asset(mix('js/app.js')) }}"></script>
</body>
</html>
