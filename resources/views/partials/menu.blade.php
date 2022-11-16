<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('perizinan_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.perizinans.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/perizinans") || request()->is("admin/perizinans/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.perizinan.title') }}
                </a>
            </li>
        @endcan
        @can('data_lembaga_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.data-lembagas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/data-lembagas") || request()->is("admin/data-lembagas/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-atlas c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.dataLembaga.title') }}
                </a>
            </li>
        @endcan
        @can('data_kerja_sama_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.data-kerja-samas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/data-kerja-samas") || request()->is("admin/data-kerja-samas/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-hands-helping c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.dataKerjaSama.title') }}
                </a>
            </li>
        @endcan
        @can('data_lembaga_daerah_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/data-daerahs*") ? "c-show" : "" }} {{ request()->is("admin/data-cabangs*") ? "c-show" : "" }} {{ request()->is("admin/data-rantings*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.dataLembagaDaerah.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('data_daerah_access')
                    {{-- @dump(Auth::user()->level) --}}
                    @if(Auth::user()->level == 'Wilayah' || Auth::user()->level == 'Daerah' )
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.data-daerahs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/data-daerahs") || request()->is("admin/data-daerahs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-justify c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.dataDaerah.title') }}
                            </a>
                        </li>
                    @endif
                    @endcan
                    @can('data_cabang_access')
                    @if(Auth::user()->level == 'Wilayah' || Auth::user()->level == 'Daerah' || Auth::user()->level == 'Cabang' )
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.data-cabangs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/data-cabangs") || request()->is("admin/data-cabangs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrows-alt-v c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.dataCabang.title') }}
                            </a>
                        </li>
                    @endif
                    @endcan
                    @can('data_ranting_access')
                    @if(Auth::user()->level == 'Wilayah' || Auth::user()->level == 'Daerah' || Auth::user()->level == 'Cabang' || Auth::user()->level == 'Ranting' )
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.data-rantings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/data-rantings") || request()->is("admin/data-rantings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-asterisk c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.dataRanting.title') }}
                            </a>
                        </li>
                    @endif
                    @endcan
                </ul>
            </li>
        @endcan
        @can('data_master_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/instansis*") ? "c-show" : "" }} {{ request()->is("admin/kontaks*") ? "c-show" : "" }} {{ request()->is("admin/ketuas*") ? "c-show" : "" }} {{ request()->is("admin/provinces*") ? "c-show" : "" }} {{ request()->is("admin/regencies*") ? "c-show" : "" }} {{ request()->is("admin/districts*") ? "c-show" : "" }} {{ request()->is("admin/villages*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-database c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.dataMaster.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('instansi_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.instansis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/instansis") || request()->is("admin/instansis/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.instansi.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('kontak_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.kontaks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/kontaks") || request()->is("admin/kontaks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.kontak.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('ketua_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.ketuas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/ketuas") || request()->is("admin/ketuas/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-tie c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.ketua.title') }}
                            </a>
                        </li>
                    @endcan
                    @if(Auth::id() == 1)
                    @can('province_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.provinces.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/provinces") || request()->is("admin/provinces/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.province.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('regency_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.regencies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/regencies") || request()->is("admin/regencies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.regency.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('district_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.districts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/districts") || request()->is("admin/districts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.district.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('village_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.villages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/villages") || request()->is("admin/villages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.village.title') }}
                            </a>
                        </li>
                    @endcan
                    @endif
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/teams*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('team_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.team.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
                <li class="c-sidebar-nav-item">
                    <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "c-active" : "" }} c-sidebar-nav-link" href="{{ route("admin.team-members.index") }}">
                        <i class="c-sidebar-nav-icon fa-fw fa fa-users">
                        </i>
                        <span>{{ trans("global.team-members") }}</span>
                    </a>
                </li>
            @endif
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>