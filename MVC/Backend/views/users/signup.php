
<!--views/users/signup.php-->
<!--
-->
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <form action="" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Username" name="username" type="email" autofocus="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Nhập lại Password" name="confirm_password" type="password" value="">
                        </div>
                        <input type="submit" name="submit" value="Register" class="btn btn-primary">
                    </fieldset>
                </form>
                Đã có tài khoản
                <a href="index.php?controller=login&action=login">Đăng nhập </a>ngay
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->