<div class="lime-sidebar">
    <div class="lime-sidebar-inner slimscroll">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Apps
            </li>
            <li>
                <a href="{{ route('admin.home') }}" class="{{ (request()->is('*home*')) ? 'active' : '' }}"><i class="material-icons">dashboard</i>Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.integrity.index') }}" class="{{ (request()->is('*integrity*')) ? 'active' : '' }}"><i class="material-icons">assessment</i>Integrity</a>
            </li>
            <li>
                <a href="{{ route('admin.criteria.index') }}" class="{{ (request()->is('*criteria*')) ? 'active' : '' }}"><i class="material-icons">assignment</i>Criteria</a>
            </li>
            <li>
                <a href="{{ route('admin.herb.index') }}" class="{{ (request()->is('*herb*')) ? 'active' : '' }}"><i class="material-icons">eco</i>Herb</a>
            </li>
            <li>
                <a href="{{ route('admin.fuzzification.index') }}" class="{{ (request()->is('*fuzzification')) ? 'active' : '' }}"><i class="material-icons">assignment</i>Fuzzification</a>
            </li>
            <li>
                <a href="{{ route('admin.zadeh.index') }}" class="{{ (request()->is('*zadeh')) ? 'active' : '' }}"><i class="material-icons">assignment</i>Zadeh</a>
            </li>
        </ul>
    </div>
</div>
