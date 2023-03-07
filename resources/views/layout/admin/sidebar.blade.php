<div class="side-user">
    <a class="col-sm-12 media clearfix" href="javascript:void(0);">
        <figure class="media-left media-middle user--online thumb-sm mr-r-10 mr-b-0">
            @php
                $img = asset('asset/image/user.png');
                if (Auth::guard('admin')->user()->file != 'user.png') {
                    $img = Helper::showImage(Auth::guard('admin')->user()->file);
                }
            @endphp
            <div id="profile-admin" class="rounded-circle" style="background-image: url('{{ $img }}')">
            </div>
        </figure>
        <div class="media-body hide-menu">
            <h4 class="media-heading mr-b-5 text-uppercase">{{ Auth::guard('admin')->user()->name }}</h4>
            <span class="user-type fs-12">login Admin</span>
        </div>
    </a>
</div>
<nav class="sidebar-nav bg-custom">
    <ul class="nav in side-menu">
        <li>
            <a href="{{ route('dashboard-admin') }}" class="text-custom">
                <i class="list-icon material-icons">dashboard</i>
                <span class="hide-menu">Dashboard </span>
            </a>
        </li>
        <li>
            <a href="{{ route('account_admin') }}" class="text-custom">
                <i class="list-icon material-icons">supervisor_account</i>
                <span class="hide-menu">Data Admin</span>
            </a>
        </li>
        <li
            class="current-page menu-item-has-children {{ request()->segment(2) == 'registration' || request()->segment(2) == 'participant' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="ripple text-custom">
                <i class="list-icon material-icons">perm_contact_calendar</i>
                <span class="hide-menu">Data Peserta</span>
            </a>
            <ul class="list-unstyled sub-menu">
                {{-- <li class="menu-item-has-children">
                    <a href="javascript:void(0);" class="text-custom">Pendaftar</a>
                    <ul class="list-unstyled sub-menu">
                        <li>
                            <a href="app-inbox.html" class="text-custom">Akun</a>
                        </li>
                        <li>
                            <a href="app-inbox-single.html" class="text-custom">Register</a>
                        </li>
                    </ul>
                </li> --}}
                <li>
                    <a href="{{ route('account_participant') }}" class="text-custom">Akun</a>
                </li>
                <li>
                    <a href="{{ route('master_registration', ['based' => 'all-account']) }}"
                        class="text-custom">Peserta</a>
                </li>
                {{-- <li>
                    <a href="../collapse-nav/index.html" class="text-custom">Pendaftaran</a>
                </li> --}}
                {{-- <li>
                    <a href="../horizontal-nav-icons/index.html" class="text-custom">Pendaftar Ditolak</a>
                </li> --}}
            </ul>
        </li>
        <li class="current-page menu-item-has-children {{ request()->segment(2) == 'payment' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="ripple text-custom">
                <i class="list-icon material-icons">payment</i>
                <span class="hide-menu">Pembayaran</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li class="menu-item-has-children {{ request()->segment(3) == 'confirm' ? 'active' : '' }}">
                    {{-- <a href="{{ route('payment') }}" class="text-custom">Pembayaran</a> --}}
                    <a href="javascript:void(0);" class="text-custom">Konfirmasi</a>
                    <ul class="list-unstyled sub-menu">
                        <li>
                            <a href="{{ route('payment.confirm', ['status' => 'confirmation']) }}"
                                class="text-custom">Menunggu Konfirmasi</a>
                        </li>
                        <li>
                            <a href="{{ route('payment.confirm', ['status' => 'approved']) }}"
                                class="text-custom">Diterima</a>
                        </li>
                        <li>
                            <a href="{{ route('payment.confirm', ['status' => 'canceled']) }}"
                                class="text-custom">Dibatalkan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('payment.pending') }}" class="text-custom">Menunggu Pembayaran</a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->segment(2) == 'message' ? 'active' : '' }}">
            <a href="{{ route('message') }}" class="text-custom">
                <i class="list-icon material-icons">message</i>
                <span class="hide-menu">Pesan <span
                        class="badge badge-border badge-border-inverted bg-primary float-right mx-2">{{ $count_message }}</span></span>
            </a>
        </li>
        <li class="{{ request()->segment(2) == 'announcement' ? 'active' : '' }}">
            <a href="{{ route('announcement') }}" class="text-custom">
                <i class="list-icon material-icons">rss_feed</i>
                <span class="hide-menu">Pengumuman</span>
            </a>
        </li>
        <li
            class="current-page menu-item-has-children {{ (request()->segment(2) == 'pages' && request()->segment(3) != 'faq') || request()->segment(2) == 'banner' || request()->segment(2) == 'registration-schedule' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="ripple text-custom">
                <i class="list-icon material-icons">playlist_add</i>
                <span class="hide-menu">Informasi</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('banner') }}" class="text-custom">Banner</a>
                </li>
                <li>
                    <a href="{{ route('pages.plot') }}" class="text-custom">Alur Pendaftaran</a>
                </li>
                <li>
                    <a href="{{ route('pages.requirement') }}" class="text-custom">Syarat Pendaftaran</a>
                </li>
                <li>
                    <a href="{{ route('registration_schedule') }}" class="text-custom">Jadwal Pendaftaran</a>
                </li>
                <li>
                    <a href="{{ route('pages.guide') }}" class="text-custom">Panduan Pendaftaran</a>
                </li>
            </ul>
        </li>
        <li class="current-page menu-item-has-children {{ request()->segment(2) == 'downloads' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="ripple text-custom">
                <i class="list-icon material-icons">attach_file</i>
                <span class="hide-menu">Download</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('downloads.brochure') }}" class="text-custom">Brosur PPDB</a>
                </li>
                <li>
                    <a href="{{ route('downloads.file') }}" class="text-custom">Sample Pendaftaran PPDB</a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->segment(3) == 'faq' ? 'active' : '' }}">
            <a href="{{ route('pages.faq') }}" class="text-custom">
                <i class="list-icon material-icons">help</i>
                <span class="hide-menu">FAQ</span>
            </a>
        </li>
        <li class="current-page menu-item-has-children {{ request()->segment(2) == 'setting' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="ripple text-custom">
                <i class="list-icon material-icons">tune</i>
                <span class="hide-menu">Pengaturan</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('setting.general') }}" class="text-custom">Pengaturan PPDB</a>
                </li>
                <li>
                    <a href="{{ route('setting.type_form') }}" class="text-custom">Formulir Pendaftaran</a>
                </li>
                <li>
                    <a href="{{ route('setting.template.letter') }}" class="text-custom">Template Surat</a>
                </li>
                <li>
                    <a href="{{ route('setting.payment') }}" class="text-custom">Pembayaran</a>
                </li>
                <li>
                    <a href="{{ route('setting.template.card') }}" class="text-custom">Template Kartu</a>
                </li>
                <li>
                    <a href="{{ route('pages.greeting') }}" class="text-custom">Sambutan</a>
                </li>
                {{-- <li>
                    <a href="../collapse-nav/index.html" class="text-custom">Notifikasi</a>
                </li> --}}
                <li>
                    <a href="{{ route('setting.appearance') }}" class="text-custom">Tampilan</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('auth.logout') }}" class="text-custom">
                <i class="list-icon material-icons">settings_power</i>
                <span class="hide-menu">Log Out</span>
            </a>
        </li>
    </ul>
</nav>
