<div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="/">Pengajuan</a></h1>
    <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link scrollto active" href="/">Home</a></li>
            @if($token == "kosong")
            <li><a class="nav-link scrollto" href="/loginSuplier">Masuk</a></li>
            <li><a class="nav-link scrollto" href="/registrasi">Daftar</a></li>
            @else
            <li><a class="nav-link scrollto" href="/logoutSuplier">Keluar</a></li>
            <li><a class="nav-link scrollto" href="#about">Pengajuan</a></li>
            @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>

</div>