<nav class="pcoded-navbar">
	<div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
	<div class="pcoded-inner-navbar main-menu">
		<div class="">
			<div class="main-menu-header">
				<img class="img-80 img-radius" src="{{ asset('images/avatar-4.jpg') }}" alt="User-Profile-Image">
				<div class="user-details">
					<span id="more-details">{{ auth()->user()->fullname }}<i class="fa fa-caret-down"></i></span>
				</div>
			</div>
			
			<div class="main-menu-content">
				<ul>
					<li class="more-details">
						{{--<a href="#"><i class="ti-user"></i>View Profile</a>--}}
						{{--<a href="#!"><i class="ti-settings"></i>Settings</a>--}}
				
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
							document.getElementById('logout').submit();" title="Logout">
							<i class="ti-layout-sidebar-left"></i>
							Logout
						</a>
						<form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
						
					</li>
				</ul>
			</div>
		</div>
		{{--<div class="p-15 p-b-0">--}}
			{{--<form class="form-material">--}}
				{{--<div class="form-group form-primary">--}}
					{{--<input type="text" name="footer-email" class="form-control" required="">--}}
					{{--<span class="form-bar"></span>--}}
					{{--<label class="float-label"><i class="fa fa-search m-r-10"></i>Search Friend</label>--}}
				{{--</div>--}}
			{{--</form>--}}
		{{--</div>--}}
		<div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Dashboard</div>
		<ul class="pcoded-item pcoded-left-item">
			<li>
				<a href="{{ route('welcome') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-home"></i><b>M</b></span>
					<span class="pcoded-mtext" data-i18n="nav.dash.main">Main</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<li class="{{ Nav::isRoute('home') }}">
				<a href="{{ route('home') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
					<span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
		</ul>

		@admin()
		<div class="pcoded-navigation-label" data-i18n="nav.category.forms">User</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="{{ Nav::isRoute('users.create') }}">
				<a href="{{ route('users.create') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-plus"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Add new</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<li class="{{ Nav::isRoute('users.index') }}">
				<a href="{{ route('users.index') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">View all</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
		</ul>
		@endadmin
		@Doctor
		<div class="pcoded-navigation-label" data-i18n="nav.category.forms">Patients</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="{{ Nav::isRoute('patients.create') }}">
				<a href="{{ route('patients.create') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-plus"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Add new</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<li class="{{ Nav::isRoute('patients.index') }}">
				<a href="{{ route('patients.index') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">View all</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
		</ul>


		<div class="pcoded-navigation-label" data-i18n="nav.category.forms">Tele Medicines</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="{{ Nav::isRoute('patients.teleMed') }}">
				<a href="{{ route('patients.teleMed') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Patients</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<li class="{{ Nav::isRoute('appointments.today') }}">
				<a href="{{ route('appointments.today') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Today's Appointments</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<li class="{{ Nav::isRoute('appointments.index') }}">
				<a href="{{ route('appointments.index') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">All Appointments</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
		</ul>

		<div class="pcoded-navigation-label" data-i18n="nav.category.forms">Visits</div>
		<ul class="pcoded-item pcoded-left-item">
	
			<li class="{{ Nav::isRoute('visits.today') }}">
				<a href="{{ route('visits.today') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Today</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<li class="{{ Nav::isRoute('visits.all') }}">
				<a href="{{ route('visits.all') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Previous</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
		</ul>
		@endDoctor
		@admin()
		<div class="pcoded-navigation-label" data-i18n="nav.category.forms">Treatments</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="{{ Nav::isRoute('treatments.create') }}" >
				<a href="{{ route('treatments.create') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-plus"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Add new</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<li class="{{ Nav::isRoute('treatments.index') }}">
				<a href="{{ route('treatments.index') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">View all</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
		</ul>
		
		<div class="pcoded-navigation-label" data-i18n="nav.category.forms">Medications</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="{{ Nav::isRoute('medications.create') }}" >
				<a href="{{ route('medications.create') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-plus"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Add new</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<li class="{{ Nav::isRoute('medications.index') }}">
				<a href="{{ route('medications.index') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">View all</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
		</ul>
		
		<div class="pcoded-navigation-label" data-i18n="nav.category.forms">Tests</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="{{ Nav::isRoute('tests.create') }}">
				<a href="{{ route('tests.create') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-plus"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Add new</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<li class="{{ Nav::isRoute('tests.index') }}">
				<a href="{{ route('tests.index') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">View all</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
		</ul>
		
		<div class="pcoded-navigation-label" data-i18n="nav.category.forms">Visit's Fee </div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="{{ Nav::isRoute('fees.create') }}">
				<a href="{{ route('fees.create') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-plus"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Add new</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
			<li class="{{ Nav::isRoute('fees.index') }}">
				<a href="{{ route('fees.index') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-list"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">View all</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
		</ul>
		
		<div class="pcoded-navigation-label" data-i18n="nav.category.forms">Notes</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="{{ Nav::isRoute('addNotes') }}">
				<a href="{{ route('addNotes') }}" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="ti-plus"></i><b></b></span>
					<span class="pcoded-mtext" data-i18n="nav.form-components.main">Add Notes</span>
					<span class="pcoded-mcaret"></span>
				</a>
			</li>
		</ul>
		@endadmin
		
	</div>
</nav>