<aside class="sidebar-wrapper">
    <div class="sidebar sidebar-collapse" id="sidebar">
        <div class="sidebar__menu-group">
            <ul class="sidebar_nav">
                <li class="menu-title">
                    <span>Main menu</span>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="{{ !empty($active) && $active == 'dashboard' ? 'active' : '' }}">
                        <span data-feather="calendar" class="nav-icon"></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('db.topic.view') }}"
                        class="{{ !empty($active) && $active == 'topic' ? 'active' : '' }}">
                        <span data-feather="home" class="nav-icon"></span>
                        <span class="menu-text">Topic & Category</span>
                    </a>
                </li>
                <li
                    class="has-child {{ !empty($active) && ($active == 'add_quiz' || $active == 'list_quiz') ? 'open' : '' }}">
                    <a href="{{ route('db.quiz') }}">
                        <span data-feather="calendar" class="nav-icon"></span>
                        <span class="menu-text">Quiz</span>
                        <span class="toggle-icon"></span>
                    </a>
                    <ul style="top: 119.844px; left: 214px;">
                        <li>
                            <a href="{{ route('db.quiz') }}"
                                class="{{ !empty($active) && $active == 'add_quiz' ? 'active' : '' }}">Add quiz</a>
                        </li>
                        <li>
                            <a href="{{ route('db.quiz_list') }}"
                                class="{{ !empty($active) && $active == 'list_quiz' ? 'active' : '' }}">List quiz</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{ route('db.question') }}"
                        class="{{ !empty($active) && $active == 'question' ? 'active' : '' }}">
                        <span data-feather="calendar" class="nav-icon"></span>
                        <span class="menu-text">Question</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('db.user') }}"
                        class="{{ !empty($active) && $active == 'user' ? 'active' : '' }}">
                        <span data-feather="calendar" class="nav-icon"></span>
                        <span class="menu-text">User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('management.index') }}"
                        class="{{ !empty($active) && $active == 'management' ? 'active' : '' }}">
                        <span data-feather="calendar" class="nav-icon"></span>
                        <span class="menu-text">Management</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>
