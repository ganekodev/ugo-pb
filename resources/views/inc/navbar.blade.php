<style>
    .nav-item .nav-link .logout button, #navbar_username {
        color: whitesmoke;
    }
    .nav-item .nav-link .logout button:hover, #navbar_username:hover {
        color: red;
    }
    /* tablet */
    @media(max-width: 758px){
        #navbar_brand,#btn_sidebar_toggler{
            display:none !important;
        }
        #btn_hamburger_menu{
            display:block !important;
        }
    }
    /* mobile phone*/
    @media(max-width: 450){
        html{
            font-size: 55%;
        }
    }
</style>
<nav class="navbar navbar-dark bg-dark sticky-top p-0 flex-md-nowrap shadow navbar-expand-lg">
    <a id="navbar_brand" class="navbar-brand bg-dark col-md-3 col-lg-2 me-0 px-3 show-sidebar" href="{{route('dashboard')}}">{{config('app.name', 'Laravel')}}</a>
    <button id="btn_sidebar_toggler" data-bs-target="#sidebar" data-bs-toggle="collapse" class="btn-outline-light bg-dark ms-3 borders rounded-3 p-1 text-white" style="border: 0"><i class="fa fa-bars fa-lg py-2 p-1"></i></button>
    <div class="d-flex justify-content-between flex-row-reverse w-100 h-100">
        <button id="btn_hamburger_menu" data-bs-target="#sidebar" class="btn-outline-light bg-dark ms-3 borders rounded-3 p-1 text-white" style="border:0;display:none"><i class="fa fa-bars fa-lg py-2 p-1"></i></button>
        <div class="pt-1">
            <div class="nav-item h-100">
                <div class="nav-link d-flex align-items-center text-light" aria-expanded="false">
                    <div class="dropdown">
                        <span id="navbar_username" class="nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{auth()->user()->first_name}} {{auth()->user()->last_name}}
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="list list-item p-2"><a class="dropdown-items rounded nav-link text-dark" href="{{route('change-password')}}">Change Password</a></li>
                        </ul>
                    </div>
                    <div class="vr mx-2" style="border: 1px solid white"></div>
                    <form action="{{ route('logout') }}" method="post" class="mb-1">
                        @csrf
                        <div class="logout">
                            <button class="btn btn-sm btn-link p-0 mt-1" type="submit" style="background:transparent; text-decoration:none;">Log out</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
@include('inc.library')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
