<a href="{{ route('dashboard.index') }}" class="nav-item {{request()->is('dashboard*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon type='solid' name='home' color='{{request()->is('dashboard*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Dashboard</p>
</a>

<a href="{{ route('admin-roles.index') }}" class="nav-item {{request()->is('admin-roles*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon type='solid' name='graduation' color='{{request()->is('admin-roles*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Students</p>
</a>

<a href="{{ route('tracking.index') }}" class="nav-item {{request()->is('tracking*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon name='analyse' type='solid' color='{{request()->is('tracking*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Tracking</p>
</a>

<a href="{{ route('appointments.index') }}" class="nav-item {{request()->is('appointments*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon name='calendar' type='solid' color='{{request()->is('appointments*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Appointments</p>
</a>

<a href="{{ route('reports.index') }}" class="nav-item {{request()->is('reports*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon name='report' type='solid' color='{{request()->is('reports*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Reports</p>
</a>