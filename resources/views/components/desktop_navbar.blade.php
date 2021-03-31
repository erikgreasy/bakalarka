<nav class="navbar navbar-expand-lg navbar-light bg-light" id="desktopNavbar">
    <a class="navbar-brand" href="/">Turista</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="/">Domov</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/hills">Kopce</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/trips">Dobrodružstvá</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/users">Rebriček dobrodruhov</a>
            </li>
        </ul>
        <ul class="ml-auto navbar-nav">

            <li class="nav-item">
                @auth
                    <a class="nav-link" href="/my-profile">{{ auth()->user()->name }}</a>
                @endauth
            </li>
        </ul>
    </div>
</nav>