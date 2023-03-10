<style>
    @media (max-width: 960px) {
        .navbar-header {
            width: 150px !important;
        }
    }
</style>
<nav class="navbar bg-custom">
    <div class="navbar-header">
        <a href="{{ route('ppdb-public') }}" class="navbar-brand bg-custom text-center">
            @php
                $logo = asset('asset/image/tutwuri.png');
                if (session()->has('logo_school')) {
                    $logo = Helper::showImage(session('logo_school'));
                }
            @endphp
            <img class="logo-expand mx-2" alt="" src="{{ $logo }}" height="80">
            <img class="logo-collapse" alt="" src="{{ $logo }}" height="80">
            <span class="text-white logo-expand"> {{ session('name_program') ?? 'E-PPDB' }} </span>
            <span class="text-white logo-collapse"> {{ session('name_program') ?? 'E-PPDB' }} </span>
        </a>
    </div>
    <ul class="nav navbar-nav" style="position: absolute; right: 0">
        <li class="sidebar-toggle"><a href="javascript:void(0)" class="ripple"><i
                    class="material-icons list-icon">menu</i></a>
        </li>
    </ul>
    <div class="spacer"></div>
</nav>
<aside class="site-sidebar x clearfix valign">
    <div class="nav-top ">
        <nav class="sidebar-nav">
            <ul class="nav in side-menu">
                <li><a href="{{ route('ppdb-public') }}"><i class="material-icons list-icon">rss_feed</i><span
                            class="hide-menu">Beranda</span></a></li>
                <li class="menu-item-has-children"><a href="javascript:void(0);" class="ripple">
                        <i class="material-icons list-icon">info</i>
                        <span class="hide-menu">Informasi Pendaftaran</span></a>
                    <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                        <li><a href="{{ route('public_information.plot') }}">Alur Pendaftaran</a>
                        </li>
                        <li><a href="{{ route('public_information.requirement') }}">Syarat Pendaftaran</a>
                        </li>
                        <li><a href="{{ route('public_information.guide') }}">Panduan Pendaftaran</a>
                        </li>
                        <li><a href="{{ route('public_schedule') }}">Rangkaian Kegiatan</a>
                        </li>
                        <li><a href="{{ route('public_information.faq') }}">FAQ</a>
                        </li>
                    </ul>
                </li>
                {{-- <li><a href="{{ route('public_announcement') }}"><i class="material-icons list-icon">feedback</i><span
                            class="hide-menu">Pengumuman</span></a>
                </li> --}}
                <li class="menu-item-has-children"><a href="javascript:void(0);" class="ripple">
                        <i class="material-icons list-icon">feedback</i>
                        <span class="hide-menu">Pengumuman</span></a>
                    <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                        <li><a href="{{ route('public_announcement') }}">Informasi</a>
                        </li>
                        <li><a href="{{ route('public_score') }}">Nilai Siswa</a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ route('public_selection') }}"><i class="material-icons list-icon">list</i><span
                            class="hide-menu">Seleksi PPDB
                        </span></a></li>

                <li class="menu-item-has-children"><a href="javascript:void(0);" class="ripple">
                        <i class="material-icons list-icon">cloud_download</i>
                        <span class="hide-menu">Download</span></a>
                    <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                        <li><a href="{{ route('public_download.file') }}">File</a>
                        </li>
                        <li><a href="{{ route('public_download.brochure') }}">Brosur</a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ route('auth.login') }}"><i class="material-icons list-icon">arrow_forward</i><span
                            class="hide-menu">Login</span></a></li>
            </ul>
        </nav>
    </div>
</aside>
