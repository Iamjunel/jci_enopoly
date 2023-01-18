<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Main Menu</li>

               
                <li>
                    <a href="<?php echo e(route('client_corr.dashboard')); ?>" class="waves-effect">
                        <i class="bx bxs-dashboard"></i>
                        <span key="t-chat">Dashboard</span>
                    </a>
                 </li>
                 <li>
                    <a href="<?php echo e(route('client_corr.client.index')); ?>" class="waves-effect">
                        <i class="bx bx-user-voice"></i>
                        <span key="t-chat">Onboarding Clients</span>
                    </a>
                 </li>
                 <li>
                    <a href="<?php echo e(route('client_corr.company.index')); ?>" class="waves-effect">
                        <i class="bx bx-buildings"></i>
                        <span key="t-chat">Company</span>
                    </a>
                 </li>
                 <li class="menu-title" key="t-menu">Generated Reports</li>
                 <li>
                    <a href="<?php echo e(route('client_corr.client.report')); ?>" class="waves-effect">
                        <i class="bx bxs-report"></i>
                        <span key="t-chat">Clients List By Date</span>
                    </a>
                 </li>
               

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End --><?php /**PATH D:\Skote_v4.0.0\Laravel - ENOPOLY\Admin\resources\views/layouts/client_corr_sidebar.blade.php ENDPATH**/ ?>