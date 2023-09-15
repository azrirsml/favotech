 <div class="app-navbar flex-shrink-0">
     <div class="app-navbar-item ms-lg-3 ms-1" id="kt_header_user_menu_toggle">
         <!--begin::Menu wrapper-->
         <div class="symbol symbol-35px cursor-pointer" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
             <img class="symbol symbol-35px" src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="user" />
         </div>
         <!--begin::User account menu-->
         <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold fs-6 w-275px py-4" data-kt-menu="true">
             <!--begin::Menu item-->
             <div class="menu-item px-3">
                 <div class="menu-content d-flex align-items-center px-3">
                     <!--begin::Avatar-->
                     <div class="symbol symbol-50px me-5">
                         <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="Logo" />
                     </div>
                     <!--end::Avatar-->
                     <!--begin::Username-->
                     <div class="d-flex flex-column">
                         <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}
                             <span class="badge badge-light-success fw-bold fs-8 ms-2 px-2 py-1">{{ Auth::user()->roles()->first()->name }}</span>
                         </div>
                         <a class="fw-semibold text-muted text-hover-primary fs-7" href="#">{{ Auth::user()->email }}</a>
                     </div>
                     <!--end::Username-->
                 </div>
             </div>
             <!--end::Menu item-->
             <!--begin::Menu separator-->
             <div class="separator my-2"></div>
             <!--end::Menu separator-->
             <!--begin::Menu item-->
             <div class="menu-item px-5">
                 <a class="menu-link" href="{{ route('profile.edit') }}">My Profile</a>
             </div>
             <!--end::Menu item-->

             <!--begin::Menu item-->
             <div class="menu-item px-5">
                 <a class="menu-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign Out</a>
                 <form id="logout-form" style="display: none;" action="{{ route('logout') }}" method="POST">
                     @csrf
                 </form>
             </div>
             <!--end::Menu item-->
         </div>
         <!--end::User account menu-->
         <!--end::Menu wrapper-->
     </div>
 </div>
