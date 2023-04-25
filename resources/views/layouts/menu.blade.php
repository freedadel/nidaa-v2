@can('index states')
<li class="nav-item">
    <a href="{{ route('states.index') }}"
       class="nav-link {{ Request::is('states*') ? 'active' : '' }}">
        <p>States</p>
    </a>
</li>
@endcan

@can('index users')
<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <p>Users</p>
    </a>
</li>
@endcan

@can('index calls')
<li class="nav-item">
    <a href="{{ route('calls.index') }}"
       class="nav-link {{ Request::is('calls*') ? 'active' : '' }}">
        <p>Calls</p>
    </a>
</li>
@endcan

@can('index roles')
<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <p>Roles</p>
    </a>
</li>
@endcan

@can('index permissions')
<li class="nav-item">
    <a href="{{ route('permissions.index') }}"
       class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">
        <p>Permissions</p>
    </a>
</li>
@endcan



