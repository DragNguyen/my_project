<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Đăng nhập hệ thống</title>
        <link rel="stylesheet" type="text/css" href="/semantic/semantic.min.css">
        <script src="/semantic/jquery-3.3.1.min.js"></script>
        <script src="/semantic/semantic.min.js"></script>
        <style>
            body {
                background-color: #DADADA; !important;
            }

            .grid {
                height: 100%;
            }

            .column {
                max-width: 450px; !important;
            }
        </style>
    </head>

    <body>

        <div class="ui middle aligned center aligned padded grid">
            <div class="column">
                <h2 class="ui teal image header">
                    <i class="fitted lock icon">
                        <div class="content">
                            Đăng nhập hệ thống
                        </div>
                    </i>
                </h2>
                <form class="ui small form" method="post" action="{{ route('admin.login.submit') }}">
                    {{ csrf_field() }}
                    <div class="ui stacked segment">
                        <div style="color: red; font-size: 15px; padding-bottom: 7px">
                            {{ session()->get('error') }}
                        </div>
                        <div class="field">
                            @if($errors->has('email'))
                                <div style="color: red; margin-top: 5px; font-size: 15px; text-align: left">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="email" placeholder="Nhập tài khoản..."
                                       value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="field">
                            @if($errors->has('password'))
                                <div style="color: red; margin-top: 5px; font-size: 15px; text-align: left">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="Nhập password..."
                                       {{ session()->has('error') ? 'autofocus' : '' }}>
                            </div>
                        </div>
                        <button class="ui fluid large teal submit button" type="submit">
                            Đăng nhập
                        </button>
                    </div>

                    <div class="ui error message"></div>

                </form>
            </div>
        </div>

    </body>

</html>