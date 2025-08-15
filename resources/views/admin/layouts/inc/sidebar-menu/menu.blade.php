<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column js-activeable" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <p>Products<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.terms.index', \App\Models\Term::vocabulariesList('slug', 'key')[\App\Models\Term::VOCABULARY_PRODUCT_CATEGORIES]) }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.attributes.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Attributes</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <p>Articles<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.articles.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">

                    <a href="{{ route('admin.terms.index', \App\Models\Term::vocabulariesList('slug', 'key')[\App\Models\Term::VOCABULARY_ARTICLE_CATEGORIES]) }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <p>Users<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.roles.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.leads.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.distributions.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Distribution</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orders.index') }}" class="nav-link">
                <p>Orders</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.terms.index', \App\Models\Term::vocabulariesList('slug','key')[\App\Models\Term::VOCABULARY_BRANDS]) }}" class="nav-link">
                <p>Brands</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pages.index') }}" class="nav-link">
                <p>Pages</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
