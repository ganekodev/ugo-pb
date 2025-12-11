<style>
    .setBackgroundNavLink { background-color: #858181; }
    .sidebar-scroller::-webkit-scrollbar {display: none} /* chrome */
    .sidebar-scroller {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse show-sidebar" style="border-right: 1px solid lightgray;margin-top:-5px;">
    <div class="position-sticky p-0 sidebar-scroller" style="max-height:88vh; overflow-y:auto;">
        <ul class="nav flex-column" id="main-menu">
            <!-- dashboard -->
            <li class="nav-item">
                <div class="">
                    <a class="{{ (request()->is('dashboard')) || (request()->is('dashboard/*')) ? 'active' : '' }} nav-link" aria-current="page" href="{{route('dashboard')}}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    Dashboard
                    </a>
                </div>
            </li>
            @php
            $partners = [
                'unverified', 'verified', 'traction', 'cashflow'
            ];
            @endphp
            <li class="nav-item" style="border-top: 2px solid lightgrey">
                <a href="#" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#partner-collapse" aria-expanded="true" role="button" aria-controls="partner-collapse">
                    <div class="d-flex justify-content-between expanded-menu">
                        <div>
                            <i class="fa fa-database"></i>
                            Partners
                        </div>
                        <i class="fa fa-caret-down caret mt-1"></i>
                    </div>
                </a>
                <div style="max-height:49vh; overflow-y:auto;" class="collapse @foreach($partners as $partner) {{ request()->is('partner/'.$partner) || request()->is('partner/'.$partner.'/*') ? 'show' : '' }} @endforeach" id="partner-collapse" data-bs-parent="#sidebarMenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="{{ (request()->is('partner/unverified')) || (request()->is('partner/unverified/*')) ? 'active' : '' }} nav-link px-4" aria-current="page" href="{{route('partner.unverified.index')}}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                             Unverified Partners
                            </a>
                        </li>
                    </ul>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="{{ (request()->is('partner/verified')) || (request()->is('partner/verified/*')) ? 'active' : '' }} nav-link px-4" aria-current="page" href="{{route('partner.verified.index')}}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Verified Partners
                            </a>
                        </li>
                    </ul>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="{{ (request()->is('partner/traction')) || (request()->is('partner/traction/*')) ? 'active' : '' }} nav-link px-4" aria-current="page" href="{{ route('partner.traction.index') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Partner Traction
                            </a>
                        </li>
                    </ul>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="{{ (request()->is('partner/cashflow')) || (request()->is('partner/cashflow/*')) ? 'active' : '' }} nav-link px-4" aria-current="page" href="{{ route('partner.cashflow.index') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Partner Cashflow
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @php
            $pbs = [
                'cashflow', 'withdraw'
            ];
            @endphp
            <li class="nav-item" style="border-top: 2px solid lightgrey">
                <a href="#" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#pb-collapse" aria-expanded="true" role="button" aria-controls="pb-collapse">
                    <div class="d-flex justify-content-between expanded-menu">
                        <div>
                            <i class="fa fa-database"></i>
                            PB
                        </div>
                        <i class="fa fa-caret-down caret mt-1"></i>
                    </div>
                </a>
                <div style="max-height:49vh; overflow-y:auto;" class="collapse @foreach($pbs as $pb) {{ request()->is('pb/'.$pb) || request()->is('pb/'.$pb.'/*') ? 'show' : '' }} @endforeach" id="pb-collapse" data-bs-parent="#sidebarMenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="{{ (request()->is('pb/withdraw')) || (request()->is('pb/withdraw/*')) ? 'active' : '' }} nav-link px-4" aria-current="page" href="{{route('pb.withdraw.index')}}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            withdraw
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<script>
    $(document).ready(function() {
        let wrapper_height = $('.show').height();
        let li_height = $('.show ul').height();
        let li_index = $('.show a').index($('.active'))+1;
        let max_content = Math.ceil(wrapper_height/li_height);
        if(li_index >= max_content) {
            $('.show').scrollTop(li_height*(li_index-3));
        }
    });
    $(document).on('click', 'a.nav-link', function() {
        $(this).find('.caret').toggleClass('fa-caret-down');
        $(this).find('.caret').toggleClass('fa-caret-up');
    });
</script>
