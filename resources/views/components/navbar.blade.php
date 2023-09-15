 <div class="app-header no-print" id="kt_app_header" data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}">
     <!--begin::Header container-->
     <div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
         <!--begin::Header mobile toggle-->
         <div class="d-flex align-items-center d-lg-none ms-n3 me-2" title="Show sidebar menu">
             <div class="btn btn-icon btn-color-white btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
                 <i class="ki-duotone ki-abstract-14 fs-2">
                     <span class="path1"></span>
                     <span class="path2"></span>
                 </i>
             </div>
         </div>
         <!--end::Header mobile toggle-->

         <!--begin::Header wrapper-->
         <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
             <!--begin::Menu wrapper-->
             <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">

                 <!--begin::Menu-->
                 <div class="menu menu-rounded menu-active-bg menu-state-primary menu-column menu-lg-row menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-lg-0 align-items-stretch fw-semibold px-lg-0 my-5 px-2" id="kt_app_header_menu" data-kt-menu="true">

                     <div class="menu-item">
                         <a class="menu-link" href="{{ route('dashboard') }}">
                             <span class="menu-title text-dark">Dashboard</span>
                             <span class="menu-arrow d-lg-none"></span>
                         </a>
                     </div>

                     <div class="menu-item">
                         <a class="menu-link" href="{{ route('rents.index') }}">
                             <span class="menu-title text-dark">My Rent</span>
                             <span class="menu-arrow d-lg-none"></span>
                         </a>
                     </div>

                     <div class="menu-item">
                         <a class="menu-link" href="{{ route('cars.index') }}">
                             <span class="menu-title text-dark">{{ auth()->user()->isOwner()? 'Manage ': 'List Of ' }} Cars</span>
                             <span class="menu-arrow d-lg-none"></span>
                         </a>
                     </div>
                 </div>
             </div>
             <x-user-dropdown />
         </div>
     </div>
 </div>
