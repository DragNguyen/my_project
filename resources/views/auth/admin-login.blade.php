<!DOCTYPE html>

<html>
    <head>
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
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="username" placeholder="Nhập tài khoản..."
                                       minlength="15" maxlength="100" value="nguyentrongcp@gmail.com" required>
                            </div>
                        </div>

                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="Nhập password..."
                                       minlength="6" maxlength="32" value="635982359" required>
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