<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Main Menu</li>

               
                <li>
                    <a href="#" class="waves-effect">
                        <i class="bx bxs-dashboard"></i>
                        <span key="t-chat">Dashboard (In-progress)</span>
                    </a>
                 </li>
                 
                 <li>
                    <a href="{{route('accounting.client.index')}}" class="waves-effect">
                        <i class="bx bx-user-voice"></i>
                        <span key="t-chat">Approved Client</span>
                    </a>
                 </li>
                  <li>
                    <a href="{{route('accounting.approve_po')}}" class="waves-effect">
                        <i class="bx bx-package"></i>
                        <span key="t-chat">Approved P.O.</span>
                    </a>
                 </li>
                 <li>
                    <a href="{{route('accounting.pending_invoice')}}" class="waves-effect">
                        <i class="bx bx-time-five"></i>
                        <span key="t-chat">Pending Invoices</span>
                    </a>
                 </li>
                 <li>
                    <a href="{{route('accounting.confirmed_invoice')}}" class="waves-effect">
                        <i class="bx bx-receipt"></i>
                        <span key="t-chat">Confirmed Invoices</span>
                    </a>
                 </li>
                 <li class="menu-title" key="t-menu">Generated Reports</li>
                 <li>
                    <a href="{{route('accounting.clients_payments')}}" class="waves-effect">
                        <i class="bx bxs-report"></i>
                        <span key="t-chat">Clients Payments By Date</span>
                    </a>
                 </li>
            
               

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->