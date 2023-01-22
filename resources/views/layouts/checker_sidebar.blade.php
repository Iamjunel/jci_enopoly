<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Main Menu</li>
                    <li>
                        <a href="{{route('checker.dashboard')}}" class="waves-effect">
                            <i class="bx bxs-dashboard"></i>
                            <span key="t-chat">Dashboard</span>
                        </a>
                    </li>
            
                    <li>
                        <a href="{{route('checker.supplier')}}" class="waves-effect">
                            <i class="bx bxs-id-card"></i>
                            <span key="t-chat">Uncheck Supplier</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('checker.supplier_checked')}}" class="waves-effect">
                            <i class="bx bxs-id-card"></i>
                            <span key="t-chat">Valid | Invalid Supplier</span>
                        </a>
                    </li>
                     <li class="menu-title" key="t-menu">Generated Reports</li>
                    <li>
                        <a href="{{route('checker.supplier.report')}}" class="waves-effect">
                            <i class="bx bxs-report"></i>
                            <span key="t-chat">Valid | Invalid Supplier By Date</span>
                        </a>
                    </li>
                    
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->