<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>


            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="/{{ (empty($admin->avatar)?'assets/img/avatar/default.jpg':$admin->avatar) }}" alt="">
                        <span class=" fa fa-angle-down"></span>
                    </a>

                    @include('admin.my-self.modal-change-avatar')
                    @include('admin.my-self.modal-change-password')

                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <div class="ui cards">
                                <div class="card">
                                    <div class="image">
                                        <img src="/{{ (empty($admin->avatar)?
                                        'assets/img/avatar/default.jpg':$admin->avatar) }}">
                                    </div>
                                    <div class="content">
                                        <div class="center aligned header">{{ $admin->name }}</div>
                                        <div class="meta center aligned">
                                            <span>
                                                {{ ($admin->role==0)?'Admin':'Nhân viên' }}
                                            </span>
                                        </div>
                                        <div class="description">
                                            <strong>Email:</strong> {{  $admin->email }} <br>
                                            <strong>Số điện thoại:</strong> {{ $admin->phone }}
                                        </div>
                                    </div>
                                    {{--<div class="extra content">--}}
                                        {{--<a>--}}
                                            {{--<i class="user icon"></i>--}}
                                            {{--22 Friends--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    <div class="extra content">
                                        <a onclick="$('#modal-change-password').modal('show')"><span class="blue right floated">Đổi mật khẩu</span></a>
                                        <a onclick="$('#modal-change-avatar').modal('show')"><span class="blue">Đổi ảnh đại diện</span></a>
                                        {{--<div class="ui two buttons">--}}
                                            {{--<div class="ui blue button">Thay đổi thông tin</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="ui two buttons">--}}
                                            {{--<div class="ui blue button">Đổi ảnh đại diện</div>--}}
                                        {{--</div>--}}
                                    </div>
                                    <div class="extra content">
                                        <a class="ui red button" href="{{ route('admin.logout') }}">Đăng xuất</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{--<li><a href="javascript:;"> Thông tin</a></li>--}}
                        {{--<li><a href="javascript:;">Đổi mật khẩu</a></li>--}}
                        {{--<li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out pull-right"></i>Đăng xuất</a></li>--}}
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="bell icon"></i>
                        {{--<span class="badge bg-green">6</span>--}}
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        {{--<li>--}}
                            {{--<a>--}}
                                {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                                {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                                {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a>--}}
                                {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                                {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                                {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a>--}}
                                {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                                {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                                {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a>--}}
                                {{--<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>--}}
                                {{--<span>--}}
                          {{--<span>John Smith</span>--}}
                          {{--<span class="time">3 mins ago</span>--}}
                        {{--</span>--}}
                                {{--<span class="message">--}}
                          {{--Film festivals used to be do-or-die moments for movie makers. They were where...--}}
                        {{--</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <li>
                            <a>
                                <span>Chưa có thông báo nào hết!</span>
                            </a>
                        </li>
                        {{--<li>--}}
                            {{--<div class="text-center">--}}
                                {{--<a>--}}
                                    {{--<strong>See All Alerts</strong>--}}
                                    {{--<i class="fa fa-angle-right"></i>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->