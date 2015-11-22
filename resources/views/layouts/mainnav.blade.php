<!-- Stored in resources/views/layouts/master.blade.php -->
<aside id="sidebar">
    <div class="sidebar-inner c-overflow">
        <div class="profile-menu">
            <a href="">
            <div class="profile-pic">
                <img src="/img/profile-pics/1.jpg" alt="">
            </div>
            <div class="profile-info">
                Shakeel Mohamed
                <i class="zmdi zmdi-caret-down"></i>
            </div>
            </a>
            <ul class="main-menu">
                <li>
                    <a href="profile-about.html"><i class="zmdi zmdi-account"></i> View Profile</a>
                </li>
                <li>
                    <a href=""><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
                </li>
                <li>
                    <a href=""><i class="zmdi zmdi-settings"></i> Settings</a>
                </li>
                <li>
                    <a href="/auth/logout"><i class="zmdi zmdi-time-restore"></i> Logout</a>
                </li>
            </ul>
        </div>
        <ul class="main-menu">
            <li><a href="/dashboard"><i class="zmdi zmdi-view-dashboard"></i> Dashboard</a></li>
            <li class="sub-menu">
                <a href=""><i class="zmdi zmdi-accounts"></i> Staff</a>
                <ul>
                    <li><a href="/staff/create">Add New Staff</a></li>
                    <li><a href="">All Staff</a></li>
                </ul>
            </li>
            <li class="sub-menu sub-menu-branches">
                <a href=""><i class="zmdi zmdi-city-alt"></i> Branches</a>
                <ul>
                    <li><a class="sub-menu-branches-add" href="/branch/create">Add New Branch</a></li>
                    <li><a href="">Branch List</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href=""><i class="zmdi zmdi-local-shipping"></i> Suppliers</a>
                <ul>
                    <li><a href="">Add New Supplier</a></li>
                    <li><a href="">Supplier List</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href=""><i class="zmdi zmdi-layers"></i> Item Attributes</a>
                <ul>
                    <li><a href="">Categories</a></li>
                    <li><a href="">Brands</a></li>
                    <li><a href="">Models</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href=""><i class="zmdi zmdi-card-giftcard"></i> Items</a>
                <ul>
                    <li><a href="">Add New Item</a></li>
                    <li><a href="">Find Item</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href=""><i class="zmdi zmdi-settings"></i> Settings</a>
                <ul>
                    <li><a href="">Permissions</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>