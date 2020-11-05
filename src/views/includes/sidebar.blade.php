<div class="sidebar" data-color="white" data-active-color="info">
    <div class="logo">
        <a href="{{config('app.url', 'https://duoneos.com')}}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{asset('vendor/larablend/paper/img/logo-small.png')}}">
            </div>
            <!-- <p>CT</p> -->
        </a>
        <a href="{{config('app.url', 'https://duoneos.com')}}" class="simple-text logo-normal">
            {{config('app.name', 'Larablend')}}
            <!-- <div class="logo-image-big">
              <img src="vendor/larablend/paper/img/logo-big.png">
            </div> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="data:image/png;base64,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" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#user" class="collapsed">
              <span>
                {{Auth::user()->name}}
                <b class="caret"></b>
              </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="user">
                    <ul class="nav">
                        <li>
                            <a href="/user/{{Auth::user()->id}}/edit">
                                <span class="sidebar-normal">Edit Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="active">
                <a href="/">
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#customer">
                    <p>
                        Customers <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="customer">
                    <ul class="nav">
                        <li>
                            <a href="/customer">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> All Customers </span>
                            </a>
                            <a href="/customer/create">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-simple-add"></i></span>
                                <span class="sidebar-normal"> Create Customer </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#ticket">
                    <p>
                        Tickets <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="ticket">
                    <ul class="nav">
                        <li>
                            <a href="/ticket">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> All Tickets </span>
                            </a>
                            <a href="/ticket/create">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-simple-add"></i></span>
                                <span class="sidebar-normal"> Create Ticket </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#invoice">
                    <p>
                        Invoices <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="invoice">
                    <ul class="nav">
                        <li>
                            <a href="/invoice">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> All Invoices </span>
                            </a>
                            <a href="/invoice/create">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-simple-add"></i></span>
                                <span class="sidebar-normal"> Create Invoice </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#payment">
                    <p>
                        Payments <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="payment">
                    <ul class="nav">
                        <li>
                            <a href="/payment">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-bullet-list-67"></i></span>
                                <span class="sidebar-normal"> All Payments </span>
                            </a>
                            <a href="/payment/create">
                                <span class="sidebar-mini-icon"><i class="nc-icon nc-simple-add"></i></span>
                                <span class="sidebar-normal"> Create Payment </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!--
            <li>
                <a href="#">
                    <p>Reports</p>
                </a>
            </li>
            -->
        </ul>
    </div>
</div>
