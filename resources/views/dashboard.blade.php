<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex-grow-1 overflow-y-auto">
            <!-- Group: Menu -->
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Menu</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="index.html" class="sidebar-menu-link active" id="menu-overview" title="Overview">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Group: Components -->
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Components</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="tables-basic.html" class="sidebar-menu-link" id="menu-basictables"
                            title="Basic Tables">
                            <i class="bi bi-table"></i>
                            <span>Basic Tables</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="ui-forms.html" class="sidebar-menu-link" id="menu-uiforms" title="Forms and Input">
                            <i class="bi bi-input-cursor-text"></i>
                            <span>Forms & Input</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="ui-buttons.html" class="sidebar-menu-link" id="menu-uibuttons" title="Buttons">
                            <i class="bi bi-menu-button-wide-fill"></i>
                            <span>Buttons & Alerts</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Group: Pages -->
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Pages</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="page-blank.html" class="sidebar-menu-link" id="menu-blankpage" title="Blank Page">
                            <i class="bi bi-file-earmark"></i>
                            <span>Blank Page</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="page-login.html" class="sidebar-menu-link" id="menu-loginpage" title="Login Page">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Login Screen</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="page-404.html" class="sidebar-menu-link" id="menu-404" title="404 Page">
                            <i class="bi bi-slash-circle"></i>
                            <span>Error 404</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>