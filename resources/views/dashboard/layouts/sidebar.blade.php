<!--**********************************
            Sidebar start
        ***********************************-->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <!-- Admin Sidebar -->
            <li class="nav-label first text-white">Menu</li>
            <!-- <li>
                <a href="{{ route('dashboard.post.index') }}" class="has-arrow" aria-expanded="false"><i class="fas fa-book"></i>
                    <span class="nav-text">Blog</span>
                </a>
            </li> -->
            <li>
                <a href="{{ route('dashboard.post.index') }}" aria-expanded="false"><i class="fas fa-book"></i>
                    <span class="nav-text">Posts</span>
                </a>
            </li>
            <li>
                <a href="{{ route('auth.logout') }}" aria-expanded="false"><i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
            
        </ul>
    </div>

    
</div>
<!--**********************************
            Sidebar end
        ***********************************-->