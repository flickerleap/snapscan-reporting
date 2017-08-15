<li class="{{ Request::is('dashboard') ? 'active' : '' }}">
    <a href="{!! route('dashboard') !!}"><i class="fa fa-bar-chart"></i><span>Reports</span></a>
</li>

<li class="{{ Request::is('merchants*') ? 'active' : '' }}">
    <a href="{!! route('merchants.index') !!}"><i class="fa fa-building"></i><span>Merchants</span></a>
</li>

<li class="{{ Request::is('codes*') ? 'active' : '' }}">
    <a href="{!! route('codes.index') !!}"><i class="fa fa-qrcode"></i><span>Codes</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

