<!--views/users/login.php-->
<!--
-->
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Log in</div>
            <div class="panel-body">
                <form action="" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Username" name="username" type="email" autofocus="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                        <input type="submit" name="submit" value="Login" class="btn btn-primary">
                    </fieldset>
                </form>
                Chưa có tài khoản,
                <a href="index.php?controller=login&action=signup">Đăng ký </a>tại đây.
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->