<!-- Sidebar -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <a href="{{ route('users.show', Auth::user()->id) }}" title="{{ __('auth.profile') }}">
    <div class="user-panel">

      <!-- Avatar -->
      <div class="pull-left image">
        <img src="{{ URL::asset(Auth::image()) }}" class="img-circle" alt="{{ Auth::name() }}">
      </div>

      <div class="pull-left info">

        <!-- Name -->
        <p class="text-center">{{ Auth::name() }}</p>

        <!-- Status -->
        <small>
          <span class="{{ __('messages.status.' . Auth::user()->status . '.class') }}">
          {{ __('messages.status.' . Auth::user()->status . '.name') }}
          </span>
        </small>

      </div>
    </div>
    </a>
  <!-- /. sidebar user panel -->

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">

    <li class="header">Menu</li>

    <!-- Dashboard Module -->
    <li class="@if (routeNameIs('dashboard.index')) active @endif">
      <a href="{{ URL::route('dashboard.index') }}">
        <i class="fa fa-home"></i>
        <span>{{ __('dashboard.title') }}</span>
      </a>
    </li>
    <!-- /. dashboard module -->

		@if (Auth::user()->hasPermission('Meditions', true))
    <!-- Meditions Module -->
    <li class="@if (routeNameIs('meditions', true)) active @endif">
      <a href="{{ URL::route('meditions.index') }}">
        <i class="fa fa-home"></i>
        <span>Mediciones</span>
      </a>
    </li>
    <!-- /. meditions module -->
    @endif

		@if (Auth::user()->hasPermission('Invoices', true))
    <!-- Invoices Module -->
    <li class="@if (routeNameIs('invoices', true)) active @endif">
      <a href="{{ URL::route('invoices.index') }}">
        <i class="fa fa-home"></i>
        <span>Facturas</span>
      </a>
    </li>
    <!-- /. invoices module -->
    @endif

		@if (Auth::user()->hasPermission('Sensors', true))
    <!-- Sensors Module -->
    <li class="@if (routeNameIs('sensors', true)) active @endif">
      <a href="{{ URL::route('sensors.index') }}">
        <i class="fa fa-home"></i>
        <span>Medidores</span>
      </a>
    </li>
    <!-- /. sensors module -->
    @endif

		@if (Auth::user()->hasPermission('Sensors', true))
    <!-- Payments Module -->
    <li class="@if (routeNameIs('payments', true)) active @endif">
      <a href="{{ URL::route('payments.index') }}">
        <i class="fa fa-home"></i>
        <span>Pagos</span>
      </a>
    </li>
    <!-- /. payments module -->
    @endif

    @if (Auth::user()->hasPermission('Users|Roles|Permissions', true))
    <!-- Access section -->
    <li class="treeview @if (routeNameIs(['users', 'roles', 'permissions'], true)) menu-open @endif">
      <a href="#"><i class="fa fa-lock"></i> <span>{{ __('users.parent') }}</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu" @if (routeNameIs(['users', 'roles', 'permissions'], true)) style="display: block;"  @endif>

		@if (Auth::user()->hasPermission('Users', true))
        <!-- Users module -->
        <li class="@if (routeNameIs('users', true)) active @endif">
          <a href="{{ URL::route('users.index') }}"><i class="fa fa-users"></i> <span>{{ __('users.title') }}</span></a>
        </li>
        <!-- /. user module -->
        @endif

        @if (Auth::user()->hasPermission('Roles', true))
        <!-- Role module -->
        <li class="@if (routeNameIs('roles', true)) active @endif">
          <a href="{{ URL::route('roles.index') }}"><i class="fa fa-user"></i><span>{{ __('roles.title') }}</span></a>
        </li>
        <!-- /. role module -->
        @endif

        @if (Auth::user()->hasPermission('Permissions', true))
        <!-- Permission module -->
        <li class="@if (routeNameIs('permissions', true)) active @endif">
          <a href="{{ URL::route('permissions.index') }}"><i class="fa fa-user-secret"></i><span>{{ __('permissions.title') }}</span></a>
        </li>
        <!-- /. permission module -->
        @endif

     </ul>
    </li>
    @endif
    <!-- /. access section -->

  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
