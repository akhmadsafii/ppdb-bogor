<div class="side-user">
    <a class="col-sm-12 media clearfix" href="{{ route('participant.account_participant.edit') }}">
        <figure class="media-left media-middle user--online thumb-sm mr-r-10 mr-b-0 my-auto">
            @php
                $img = asset('asset/image/user.png');
                if (Auth::guard('participant')->user()->file != 'user.png') {
                    $img = Helper::showImage(Auth::guard('participant')->user()->file);
                }
            @endphp
            <div id="profile-admin" class="rounded-circle" style="background-image: url('{{ $img }}')">
            </div>
        </figure>
        <div class="media-body hide-menu">
            <h4 class="media-heading mr-b-5 text-uppercase">
                {{ substr(strip_tags(Auth::guard('participant')->user()->name), 0, 13) }}</h4>
            <span class="user-type fs-12">login Peserta</span>
        </div>
    </a>
</div>
<nav class="sidebar-nav bg-custom">
    <ul class="nav in side-menu">
        <li>
            <a href="{{ route('participant.dashboard-participant') }}" class="text-custom">
                <i class="list-icon material-icons">dashboard</i>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="{{ request()->segment(2) == 'announcement' ? 'active' : '' }}">
            <a href="{{ route('participant.announcement') }}" class="text-custom">
                <i class="list-icon material-icons">rss_feed</i>
                <span class="hide-menu">Pengumuman</span>
            </a>
        </li>
        <li
            class="current-page menu-item-has-children {{ request()->segment(2) == 'information' || request()->segment(2) == 'schedule' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="ripple text-custom">
                <i class="list-icon material-icons">playlist_add</i>
                <span class="hide-menu">Informasi</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('participant.information.plot') }}" class="text-custom">Alur Pendaftaran</a>
                </li>
                <li>
                    <a href="{{ route('participant.information.requirement') }}" class="text-custom">Syarat
                        Pendaftaran</a>
                </li>
                <li>
                    <a href="{{ route('participant.schedule') }}" class="text-custom">Jadwal Kegiatan</a>
                </li>
                <li>
                    <a href="{{ route('participant.information.guide') }}" class="text-custom">Panduan Pendaftaran</a>
                </li>
                <li>
                    <a href="{{ route('participant.information.faq') }}" class="text-custom">FAQ</a>
                </li>
            </ul>
        </li>
        <li class="current-page menu-item-has-children {{ request()->segment(2) == 'register' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="ripple text-custom">
                <i class="list-icon material-icons">assignment_turned_in</i>
                <span class="hide-menu">Pendaftaran</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('participant.register.formulir') }}" class="text-custom">Formulir Pendaftaran</a>
                </li>
                <li>
                    <a href="{{ route('participant.register.document') }}" class="text-custom">Upload Dokumen
                        Pendukung</a>
                </li>
            </ul>
        </li>

        <li class="current-page menu-item-has-children {{ request()->segment(2) == 'print' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="ripple text-custom">
                <i class="list-icon material-icons">print</i>
                <span class="hide-menu">Cetak</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('participant.print.registration') }}" class="text-custom">Cetak Form
                        Pendaftaran</a>
                </li>
                <li>
                    <a href="{{ route('participant.print.card') }}" class="text-custom">Cetak Kartu Peserta</a>
                </li>
                <li>
                    <a href="{{ route('participant.print.announcement') }}" class="text-custom">Cetak Hasil
                        Pengumuman</a>
                </li>
            </ul>
        </li>

        <li class="current-page menu-item-has-children {{ request()->segment(2) == 'download' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="ripple text-custom">
                <i class="list-icon material-icons">file_download</i>
                <span class="hide-menu">Download</span>
            </a>
            <ul class="list-unstyled sub-menu">
                <li>
                    <a href="{{ route('participant.download.brochure') }}" class="text-custom">Brosur PPDB</a>
                </li>
                <li>
                    <a href="{{ route('participant.download.document') }}" class="text-custom">Contoh Dokumen</a>
                </li>
            </ul>
        </li>
        <li class="{{ request()->segment(2) == 'message' ? 'active' : '' }}">
            <a href="{{ route('participant.message') }}" class="text-custom">
                <i class="list-icon material-icons">question_answer</i>
                <span class="hide-menu">Pesan <span class="hide-menu">Pesan <span
                            class="badge badge-border badge-border-inverted bg-primary float-right mx-2">{{ $count_message }}</span></span></span>
            </a>
        </li>

        <li class="{{ request()->segment(2) == 'payment' ? 'active' : '' }}">
            <a href="{{ route('participant.payment.history') }}" class="text-custom">
                <i class="list-icon material-icons">show_chart</i>
                <span class="hide-menu">Tagihan Pembayaran</span>
            </a>
        </li>
        <li>
            <a href="{{ route('auth.logout') }}" class="text-custom">
                <i class="list-icon material-icons">settings_power</i>
                <span class="hide-menu">Log Out</span>
            </a>
        </li>
    </ul>
</nav>
