<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
<button class="btn btn-light" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 pl-2">
    <h6 class="navbar-brand" class="h-6">Person & Household</h6>
      <li class="nav-item">
        <a class="nav-link" href="/person">Person</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/households">Households</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/benefit">Benefit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/person/reports">Reports</a>
      </li>
    </ul>
      <a class="btn btn-light" type="submit" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
  </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>