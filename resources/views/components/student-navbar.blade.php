<a href="{{route('home.index')}}" class="nav-item {{request()->is('home*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon type='solid' name='home' color='{{request()->is('home*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Home</p>
</a>

<a href="{{route('profile.index')}}" class="nav-item {{request()->is('profile*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon type='solid' name='user' color='{{request()->is('profile*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Profile</p>
</a>

<a href="{{ route('panel-members.index') }}"class="nav-item {{request()->is('panel-members*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon type='solid' name='chalkboard' color='{{request()->is('panel-members*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Panel Members</p>
</a>

<a href="{{ route('appointments.index') }}" class="nav-item {{request()->is('appointments*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon name='calendar' type='solid' color='{{request()->is('appointments*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Appointments</p>
</a>

<a href="{{ route('reports.index') }}" class="nav-item {{request()->is('reports*') ? 'hover:bg-primary-900 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon name='report' type='solid' color='{{request()->is('reports*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Reports</p>
</a>

<a href="{{ route('chatbot.index') }}" class="nav-item {{request()->is('chatbot*') ? 'hover:bg-primary-800 bg-primary-900 text-white fill-white' : ''}}">
    <box-icon name='message-dots' type='solid' color='{{request()->is('chatbot*') ? 'white' : '#8c2e2e'}}'></box-icon>
    <p class="text-sm">Chatbot</p>
</a>