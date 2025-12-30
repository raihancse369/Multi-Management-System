<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <br>

        <div id="sidebar-menu">
            <ul>

                {{-- Dashboard --}}
                <li>
                    <a href="{{ route('admin.home') }}" class="waves-effect {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                        <i class="fa fa-home"></i> <span> Dashboard </span>
                    </a>
                </li>

                {{-- User Role --}}
                @if(Auth::user()->role == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-user-times"></i>
                        <span>User Role</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('role') }}">Add Role</a></li>
                    </ul>
                </li>
                @endif
                <hr>

                {{-- Site Settings --}}
                @if(Auth::user()->setting == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-cogs"></i>
                        <span>Site Settings</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('smtp') }}">SMTP Setting</a></li>
                        <li><a href="{{ route('seo') }}">SEO Setting</a></li>
                        <li><a href="{{ route('site') }}">Site Setting</a></li>
                        <li><a href="{{ route('slider') }}">Slider Setting</a></li>
                    </ul>
                </li>
                @endif

                {{-- Pages --}}
                @if(Auth::user()->page == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-credit-card"></i>
                        <span>Pages</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about-page') }}">About Us</a></li>
                        <li><a href="{{ route('serve') }}">Industry Serve</a></li>
                        <li><a href="{{ route('service-page') }}">Service</a></li>
                        <li><a href="{{ route('project-page') }}">Project</a></li>
                        <li><a href="{{ route('footer-page') }}">Footer</a></li>
                        <li><a href="{{ route('page') }}">Create Page</a></li>
                    </ul>
                </li>
                @endif
                <hr>

                {{-- Category --}}
                @if(Auth::user()->category == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-ticket"></i>
                        <span>Categories</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('category') }}">Categories</a></li>
                        <li><a href="{{ route('subcategory') }}">Subcategories</a></li>
                    </ul>
                </li>
                @endif

                {{-- Product --}}
                @if(Auth::user()->product == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Manage Products</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('brand') }}">Brand</a></li>
                        <li><a href="{{ route('product') }}">All Products</a></li>
                    </ul>
                </li>
                @endif

                {{-- Offers --}}
                @if(Auth::user()->offer == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-gift"></i>
                        <span>Offers</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('campaign.index') }}">Campaign</a></li>
                        <li><a href="{{ route('coupon.index') }}">Coupon</a></li>
                        <li><a href="{{ route('ticket.index') }}">Ticket</a></li>
                    </ul>
                </li>
                @endif

                {{-- Orders --}}
                @if(Auth::user()->orders == 1)
                <li>
                    <a href="{{ route('order.index') }}" class="waves-effect">
                        <i class="fa fa-sort-alpha-asc"></i> <span>Orders</span>
                    </a>
                </li>
                @endif

                {{-- Messages --}}
                @if(Auth::user()->message == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-comments-o"></i>
                        <span>Messages</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('contact') }}">Contact Message</a></li>
                        <li><a href="{{ route('review') }}">Product Review</a></li>
                        <li><a href="{{ route('website-review') }}">Website Review</a></li>
                    </ul>
                </li>
                @endif

                {{-- Blog --}}
                @if(Auth::user()->blog == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Blog</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('blog-category') }}">Blog Category</a></li>
                        <li><a href="{{ route('blog') }}">Blog List</a></li>
                    </ul>
                </li>
                @endif
                <hr>

                {{-- HRM --}}
                @if(Auth::user()->hrm == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-users"></i>
                        <span>HRM</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('department') }}">Department</a></li>
                        <li><a href="{{ route('designation') }}">Designation</a></li>
                        <li><a href="{{ route('employee') }}">Employee</a></li>
                        <li><a href="{{ route('award') }}">Award</a></li>
                        <hr>
                        <li><a href="{{ route('holiday') }}">Holiday</a></li>
                        <li><a href="{{ route('leave-type') }}">Leave Type</a></li>
                        <li><a href="{{ route('leave') }}">Leave Application</a></li>
                    </ul>
                </li>
                @endif

                {{-- Attendance --}}
                @if(Auth::user()->attendance == 1)
                <li>
                    <a href="{{ route('attendance.index') }}" class="waves-effect">
                        <i class="fa fa-calendar"></i> <span>Take Attendance</span>
                    </a>
                </li>
                @endif

                {{-- Payroll --}}
                @if(Auth::user()->payroll == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-money"></i>
                        <span>Payroll</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('payroll') }}">Payroll</a></li>
                    </ul>
                </li>
                @endif

                {{-- Expense --}}
                @if(Auth::user()->expense == 1)
                <li class="has_sub">
                    <a href="#" class="waves-effect">
                        <i class="fa fa-calculator"></i>
                        <span>Expense</span>
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('expense-type') }}">Expense Type</a></li>
                        <li><a href="{{ route('expense') }}">Expense List</a></li>
                    </ul>
                </li>
                @endif

            </ul>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
