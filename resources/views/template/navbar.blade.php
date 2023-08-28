<div class="collapse navbar-collapse main-menu-item justify-content-end"
id="navbarSupportedContent">
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('tentangkami')}}">Tentang Kami</a>
        </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Program Kami
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach($static_content['program_menu'] as $value)
                <a class="dropdown-item" href="{{route('program',[$value->slug])}}">{{$value->name}}</a>
                @endforeach
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('berita')}}">Berita/Kabar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('hubungi.kami')}}">Hubungi Kami</a>
        </li>
        <li class="d-none d-lg-block">
            <a class="btn_1" href="{{route('donasi.konsumen')}}">Donasi Disini</a>
        </li>
    </ul>
</div>