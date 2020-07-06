<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('admin.home') }}" class="waves-effect">
                        <i class="ti-home"></i><span class="badge badge-pill badge-primary float-right">2</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-email"></i>
                        <span>Pengajuan Surat</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox">
                            <span class="badge badge-pill badge-primary float-right">2</span> Menunggu Persetujuan </a></li>
                            <li><a href="email-read">Disetujui</a></li>
                            <li><a href="email-compose">Ditolak</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">Master Data</li>
                    <li>
                        <a href="{{ route('admin.data.index') }}" class=" waves-effect">
                            <i class="ti-calendar"></i>
                            <span>Data Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class=" waves-effect">
                            <i class="ti-calendar"></i>
                            <span>Data Warga</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.letters.index') }}" class=" waves-effect">
                            <i class="ti-calendar"></i>
                            <span>Daftar Surat</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
<!-- Left Sidebar End -->