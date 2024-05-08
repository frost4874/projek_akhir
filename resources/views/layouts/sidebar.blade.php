@php
  $role = auth()->user()->role;
@endphp

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if($role === 'Admin Master')
          <li class="nav-item">
            <a href="{{route('admin.dashboard_master')}}" class="nav-link {{ ($npage == 1) ? ' active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
          </li>
          <li class="nav-header">MENU</li>
          <li class="nav-item">
              <a href="{{route('admin.data_admindesa')}}" class="nav-link {{ ($npage == 2) ? ' active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                      Data Admin Desa
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{route('admin.templatesurat')}}" class="nav-link {{ ($npage == 3) ? ' active' : '' }}">
                  <i class="nav-icon fas fa-chart-bar"></i>
                  <p>
                      Template Surat
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{route('admin.laporan_master')}}" class="nav-link {{ ($npage == 4) ? ' active' : '' }}">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>
                      Laporan
                  </p>
              </a>
          </li>
              <li class="nav-item">
                <a href="{{route('admin.biodata_master')}}" class="nav-link {{ ($npage == 5) ? ' active' : '' }}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Biodata Master Admin</p>
                </a>
              </li>

          @elseif($role === 'Admin Desa')
          <li class="nav-item">
    <a href="{{route('admin.dashboard')}}" class="nav-link{{ ($npage == 0) ? ' active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
            @if($role === 'Admin Desa' && $jumlah_requ > 0)
                <span class="badge badge-danger right">{{ $jumlah_requ }}</span>
            @endif
        </p>
    </a>
</li>

          <li class="nav-header">MENU</li>
          <li class="nav-item">
            <a href="{{route('admin.data_masyarakat')}}" class="nav-link{{ ($npage == 1) ? ' active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Data Masyarakat
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.berkas_permohonan')}}" class="nav-link{{ ($npage == 2) ? ' active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Berkas Permohonan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.laporan')}}" class="nav-link{{ ($npage == 3) ? ' active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                    Laporan
                </p>
            </a>
        </li>

        <li class="nav-item">
    <a class="nav-link">
        <i class="nav-icon fas fa-cog"></i>
        <p>
            Pengaturan
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview {{ ($npage == 4 || $npage == 5) ? 'show' : '' }}" id="pengaturanDropdown">
        <li class="nav-item">
            <a href="{{ route('admin.pejabat_desa') }}" class="nav-link{{ ($npage == 4) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Pejabat</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.biodata_desa') }}" class="nav-link{{ ($npage == 5) ? ' active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Biodata Admin Desa</p>
            </a>
        </li>
    </ul>
</li>
          @elseif($role === 'Pemohon')
          <li class="nav-item menu-open">
            <a href="{{route('admin.dashboard')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">MENU</li>
          <li class="nav-item">
            <a href="{{route('admin.data_masyarakat')}}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Biodata
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.berkas_permohonan')}}" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Status Permohonan
                </p>
            </a>
        </li>
          @endif
        </ul>
      </nav>
