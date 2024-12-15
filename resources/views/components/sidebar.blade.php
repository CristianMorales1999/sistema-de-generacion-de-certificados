<aside class="sidebar">
    <ul>
        <li class="{{ request()->routeIs('administrator.index') ? 'active' : '' }}">
            <a href="{{ route('administrator.index') }}">Dashboard</a>
        </li>
        <li class="{{ request()->routeIs('certificates.index') ? 'active' : '' }}">
            <a href="{{ route('certificates.index') }}">Certificados</a>
        </li>
        <li class="{{ request()->routeIs('groups.index') ? 'active' : '' }}">
            <a href="{{ route('groups.index') }}">Grupos</a>
        </li>
        <li class="{{ request()->routeIs('people.index') ? 'active' : '' }}">
            <a href="{{ route('people.index') }}">Personas</a>
        </li>
        <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}">Usuarios</a>
        </li>
        <li class="{{ request()->routeIs('templates.index') ? 'active' : '' }}">
            <a href="{{ route('templates.index') }}">Plantillas</a>
        </li>
        <li class="{{ request()->routeIs('logos.index') ? 'active' : '' }}">
            <a href="{{ route('logos.index') }}">Logos</a>
        </li>
    </ul>
</aside>