        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-learning <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('sekolah') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Sekolah</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kelas') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Kelas</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('jurusan') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Jurusan</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('mata-pelajaran') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Mata Pelajaran</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('gurus') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Guru</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('tus') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>TU</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Siswa</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('ruangan') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Ruangan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('penjagaperpus') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Penjaga Perpustakaan</span></a>
            </li>
            

            <li class="nav-item">
                <a class="nav-link" href="{{ route('jadwals') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Jadwals</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('wali_kelas') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Wali Kelas</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('tugas_guru') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tugas</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>