<div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1" style="overflow: hidden; ">
	<div class="sidebar-list-padding app-sidebar sidenav" id="contact-sidenav">
		<ul class="contact-list display-grid">
		    <li class="sidebar-title" style="cursor: none">Sub Menu</li>
		    <li class="{{ request()->is('admin/user*') ? 'active' : '' }}">
		    	<a href="/admin/user" class="text-sub"><i class="material-icons mr-2">perm_identity</i>Users</a>
		    </li>
		    <li class="{{ request()->is('admin/role*') ? 'active' : '' }}">
		    	<a href="/admin/role" class="text-sub"><i class="material-icons mr-2"> history </i>Roles</a>
		    </li>
		    <li class="{{ request()->is('admin/permission*') ? 'active' : '' }}">
		    	<a href="/admin/permission" class="text-sub"><i class="material-icons mr-2"> brightness_high </i>Permissions</a>
		    </li>
		    <li class="">
		    	<a href="#" class="text-sub"><i class="material-icons mr-2"> clear_all </i>Menu Management </a>
		    </li>
		    <li class="">
		    	<a href="#" class="text-sub"><i class="material-icons mr-2"> import_contacts </i>Page Management </a>
		    </li>
		    <li class="">
		    	<a href="#" class="text-sub"><i class="material-icons mr-2"> shop_two </i>Widget Management </a>
		    </li>
		</ul>
	</div>
</div>
 <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only" ><i
          class="material-icons" style="color:blue">menu</i></a>