<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <?php $count = 1; ?>
        @foreach($mymenu as $m => $item)
            @if(isset($item['child']))
                <li class="{{ in_array($current_route, $item['child_urls']) ? 'active' : '' }} ">
                    <a href="javascript:;" data-toggle="collapse" data-target="#submenu<?= $count ?>">
                        <i class="fa fa-fw fa-btn {{ $item['icon'] }}"></i>{{ $m }}<i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="submenu<?= $count ?>" class="collapse {{ in_array($current_route, $item['child_urls']) ? 'in' : '' }}">
                        @foreach($item['child'] as $c => $subitem)
                            <li class="{{ ($current_route == $subitem['url']) ? 'subactive' : '' }}">
                                <a href="{{ route($subitem['url']) }}">{{ $c }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <?php $count += 1; ?>
            @else
                <li class="{{ ($current_route == $item['url']) ? 'active' : '' }}">
                    <a href="{{ route($item['url']) }}"><i class="fa fa-fw fa-btn {{ $item['icon'] }}"></i>{{ $m }}</a>
            @endif
                </li>
        @endforeach



        <!-- <li class="active"> -->
       <!--  <li>
            <a href="index.html"><i class="fa fa-fw fa-dashboard"></i>Home</a>
        </li> -->

        <!-- <li class="active">
            <a href="javascript:;" data-toggle="collapse" data-target="#submenu1">
                <i class="fa fa-fw fa-btn fa-user"></i> Members <i class="fa fa-fw fa-caret-down"></i>
            </a>
            <ul id="submenu1" class="collapse {{ ($current_route == 'allmember' || $current_route == 'addmember' ) ? 'in' : '' }}">
                <li class="{{ ($current_route == 'allmember') ? 'subactive' : '' }}">
                    <a href="{{ route('allmember') }}">All Members</a>
                </li>
                <li class="{{ ($current_route == 'addmember') ? 'subactive' : '' }}">
                    <a href="{{ route('addmember') }}">Add New Member</a>
                </li>                
            </ul>
        </li>
        
      
 -->
       <!--  <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#submenu22"><i class="fa fa-fw fa-btn fa-home" aria-hidden="true"></i> Family <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="submenu22" class="collapse">
                <li>
                    <a href="#">All Families</a>
                </li>
                <li>
                    <a href="#">Add New Family</a>
                </li>                
            </ul>
        </li>

        <li>
            <a href="#" data-toggle="collapse" data-target="#submenu3"><i class="fa fa-fw fa-btn fa-graduation-cap" aria-hidden="true"></i> Bible Study <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="submenu3" class="collapse">

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#submenu3-1"><i class="fa fa-fw fa-arrows-v"></i> Engage <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="submenu3-1" class="collapse">
                        <li>
                            <a href="#">All Engage</a>
                        </li>
                        <li>
                            <a href="#">Add Engage Class</a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#">Establish</a>
                </li>                
            </ul>
        </li>


        <li>
            <a href="forms.html"><i class="fa fa-fw fa-btn fa-university" aria-hidden="true"></i> Ministry</a>
        </li>
        <li>
            <a href="bootstrap-elements.html"><i class="fa fa-fw fa-btn fa-users" aria-hidden="true"></i> iCare</a>
        </li>
         -->

       <!--  <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#submenu2"><i class="fa fa-fw fa-bar-chart-o"></i> Admin Users <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="submenu2" class="collapse">
                <li>
                    <a href="#">Members</a>
                </li>
                <li>
                    <a href="#">Visitors</a>
                </li>                
            </ul>
        </li>

        <li>
            <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Roles</a>
        </li> -->

     <!--    <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="#">Dropdown Item</a>
                </li>
                <li>
                    <a href="#">Dropdown Item</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo2" class="collapse">
                        <li>
                            <a href="#">Dropdown Item</a>
                        </li>
                        <li>
                            <a href="#">Dropdown Item</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="blank-page.html"><i class="fa fa-fw fa-file"></i>Family</a>
        </li>
        <li>
            <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i>RTL Dashboard</a>
        </li> -->
    </ul>
</div>
<!-- /.navbar-collapse -->