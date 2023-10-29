<a href="{{ route('students.index') }}" class="nav-item {{request()->is('students*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon type='solid' name='graduation' color='{{request()->is('students*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Students</p>
</a>

<a href="{{ route('teachers.index') }}" class="nav-item {{request()->is('teachers*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon type='solid' name='chalkboard' color='{{request()->is('teachers*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Teachers</p>
</a>

<a href="{{ route('tracking.index') }}" class="nav-item {{request()->is('tracking*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon name='analyse' type='solid' color='{{request()->is('tracking*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Tracking</p>
</a>

<a href="{{ route('appointments.index') }}" class="nav-item {{request()->is('appointments*') ? 'hover:bg-primary-800 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon name='calendar' type='solid' color='{{request()->is('appointments*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Appointments</p>
</a>

<a href="{{ route('reports.index') }}" class="nav-item {{request()->is('reports*') ? 'hover:bg-primary-800 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon name='report' type='solid' color='{{request()->is('reports*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Reports</p>
</a>

<a href="{{ route('chatbot.index') }}" class="nav-item {{request()->is('chatbot*') ? 'hover:bg-primary-800 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon name='message-dots' type='solid' color='{{request()->is('chatbot*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Chatbot</p>
</a>