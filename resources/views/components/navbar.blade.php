<div class="fixed top-0 left-0 h-screen min-w-[16rem] max-w-[16rem] bg-white text-black z-50">
    <div class="flex flex-col h-full gap-10 py-5 relative after:absolute after:inset-0 after:top-[4rem] after:pointer-events-none after:shadow-md">
        <div class="flex flex-col items-center gap-5 px-5">
            <img class=" h-[100px] w-fit aspect-square bg-white rounded-full flex items-center justify-center overflow-hidden" src="{{asset('images/logo.png')}}">
            <h2 class="text-sm font-bold text-center">College of Computer Studies</h2>
        </div>

        
        {{-- <div class="flex flex-col h-full text-sm">

            @if (checkRole(auth()->user(), [2,3,4]))
                <a href="{{ route('dashboard.index') }}" class="flex items-center gap-2 px-5 py-3 {{request()->is('dashboard*') ? 'bg-primary-900 text-white fill-white' : ''}}">
                    <box-icon type='solid' name='home' color='{{request()->is('dashboard*') ? 'white' : '#8c2e2e'}}'></box-icon>
                    <p class="text-sm">Dashboard</p>
                </a>
            @endif

            @if (checkRole(auth()->user(), [5]))
                <a href="#" class="flex items-center gap-2 px-5 py-3 {{request()->is('dashboard*') ? 'bg-primary-900 text-white fill-white' : ''}}">
                    <box-icon type='solid' name='home' color='{{request()->is('dashboard*') ? 'white' : '#8c2e2e'}}'></box-icon>
                    <p class="text-sm">Dashboard</p>
                </a>
            @endif

            @if (checkRole(auth()->user(), [5]))
                <a href="#" class="flex items-center gap-2 px-5 py-3 {{request()->is('profile*') ? 'bg-primary-900 text-white fill-white' : ''}}">
                    <box-icon type='solid' name='user' color='{{request()->is('profile*') ? 'white' : '#8c2e2e'}}'></box-icon>
                    <p class="text-sm">Profile</p>
                </a>
            @endif
            
            @can('viewAny', App\Model\Student::class)
                <a href="{{ route('students.index') }}" class="flex items-center gap-2 px-5 py-3 {{request()->is('students*') ? 'bg-primary-900 text-white fill-white' : ''}}">
                    <box-icon type='solid' name='graduation' color='{{request()->is('students*') ? 'white' : '#8c2e2e'}}'></box-icon>
                    <p class="text-sm">Students</p>
                </a>
            @endcan
            
            @if (checkRole(auth()->user(), [2,3,4]))
                <a href="{{ route('admin-roles.index') }}" class="flex items-center gap-2 px-5 py-3 {{request()->is('admin-roles*') ? 'bg-primary-900 text-white fill-white' : ''}}">
                    <box-icon type='solid' name='graduation' color='{{request()->is('admin-roles*') ? 'white' : '#8c2e2e'}}'></box-icon>
                    <p class="text-sm">Students</p>
                </a>
            @endif
            
            @if(checkRole(auth()->user(), [5]))
                <a href="{{ route('panel-members.index') }}"class="flex items-center gap-2 px-5 py-3 {{request()->is('panel-members*') ? 'bg-primary-900 text-white fill-white' : ''}}">
                    <box-icon type='solid' name='chalkboard' color='{{request()->is('panel-members*') ? 'white' : '#8c2e2e'}}'></box-icon>
                    <p class="text-sm">Panel Members</p>
                </a>
            @endif
            
            @can('viewAny', App\Model\Teacher::class)
                <a href="{{ route('teachers.index') }}" class="flex items-center gap-2 px-5 py-3 {{request()->is('teachers*') ? 'bg-primary-900 text-white fill-white' : ''}}">
                    <box-icon type='solid' name='chalkboard' color='{{request()->is('teachers*') ? 'white' : '#8c2e2e'}}'></box-icon>
                    <p class="text-sm">Teachers</p>
                </a>
            @endcan
            

            @can('viewAny', App\Model\Appointment::class)
                <a href="{{ route('appointments.index') }}" class="flex items-center gap-2 px-5 py-3 {{request()->is('appointments*') ? 'bg-primary-900 text-white fill-white' : ''}}">
                    <box-icon name='calendar' type='solid' color='{{request()->is('appointments*') ? 'white' : '#8c2e2e'}}'></box-icon>
                    <p class="text-sm">Appointments</p>
                </a>
            @endcan

            @can('viewAny', App\Model\Report::class)
                <a href="{{ route('reports.index') }}" class="flex items-center gap-2 px-5 py-3 {{request()->is('reports*') ? 'bg-primary-900 text-white fill-white' : ''}}">
                    <box-icon name='report' type='solid' color='{{request()->is('reports*') ? 'white' : '#8c2e2e'}}'></box-icon>
                    <p class="text-sm">Reports</p>
                </a>
            @endcan
            
        </div> --}}

        <div class="flex flex-col h-full text-sm">
            @if(checkRole(auth()->user(), [1]))
                <x-admin-navbar/>
            @elseif (checkRole(auth()->user(), [2,3,4]))
                <x-user-navbar/>
            @else
                <x-student-navbar/>
            @endif
        </div>
    </div>
</div>