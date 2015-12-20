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
            <li class="sub-menu sub-menu-company">
                <a href=""><i class="zmdi zmdi-accounts"></i> Company</a>
                <ul>
                    <li><a class="sub-menu-staff-add" href="/staff/create">Add New Staff</a></li>
                    <li><a href="">All Staff</a></li>
                    <li><a class="sub-menu-branches-add" href="/branch/create">Add New Branch</a></li>
                    <li><a class="sub-menu-branches-list" href="/branch">Branch List</a></li>
                </ul>
            </li>

            <li class="sub-menu sub-menu-inventory">
                <a href=""><i class="zmdi zmdi-card-giftcard"></i> Inventory</a>
                <ul>
                    <li><a class="sub-menu-find-product" href="/product">Find Product</a></li>
                    <li><a class="sub-menu-product-addproduct" href="/product/create">Add New Product</a></li>
                    <li><a class="sub-menu-product-category" href="/product/category">Categories</a></li>
                    <li><a class="sub-menu-product-brand" href="/product/brand">Brands</a></li>
                    <li><a class="sub-menu-product-model" href="/product/model">Models</a></li>
                </ul>
            </li>

            <li class="sub-menu sub-menu-purchase">
                <a href=""><i class="zmdi zmdi-card-giftcard"></i> Purchase</a>
                <ul>
                    <li><a class="sub-menu-supplier-add" href="/supplier/create">Add New Vendor</a></li>
                    <li><a class="sub-menu-supplier-list" href="/supplier">Vendor List</a></li>
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