<!-- ========== Left Sidebar Start ========== -->
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
                        <span key="t-chat">Dashboard(In-Progress)</span>
                    </a>
                 </li>
                 <li>
                    <a href="{{route('purchaser_product.index')}}" class="waves-effect">
                        <i class="bx bx-layer"></i>
                        <span key="t-chat">Good To Order Products</span>
                    </a>
                 </li>
                 <li>
                    <a href="{{route('purchaser_product.pending_po')}}" class="waves-effect">
                        <i class="bx bx-layer"></i>
                        <span key="t-chat">Pending Purchase Order</span>
                    </a>
                 </li>
                 <li>
                    <a href="{{route('purchaser_product.approved_po')}}" class="waves-effect">
                        <i class="bx bx-layer"></i>
                        <span key="t-chat">Approved Purchase Order</span>
                    </a>
                 </li>
                 

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->