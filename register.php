<?php
    include_once "header.php";
    if(isset($_SESSION['user_id']) && isset($_SESSION['username'])){
        $current_user_id= $_SESSION['user_id'];
        $current_username = $_SESSION['username'];
        $query = "SELECT * FROM tbl_user WHERE id = '$current_user_id' AND username = '$current_username'";
        $result = query($query, 2);
        debug($result);
        if($_SESSION['user_id'] == $result['id'] AND $_SESSION['username'] == $result['username']){
            redirect('dashboard.php?all_users');
        }
    }
?>
        <?php
        showMessage();
        ?>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Sign up</h3>
                </div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <form class="form-horizontal" action="process.php" method="POST">
                            <div class="form-group">
                                <label for="first_name" class="col-sm-3 control-label">First name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" autofocus id="first_name" name="first_name" placeholder="First name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-sm-3 control-label">Last name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_address" class="col-sm-3 control-label">E-mail address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email_address" name="email_address" placeholder="something@example.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-3 control-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="address" name="address" rows="4" placeholder="Address"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input class="btn btn-success btn-block" type="submit" name="register" value="Submit" />
                                    <input class="btn btn-danger btn-block" type="reset" value="Reset" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="container-fluid">
                        <h4 class="text-center text-primary">Already have an account ? <a href="index.php" class="text-success">Sign in</a></h4>
                    </div>
                </div>
                <div class="panel-footer">
                    <p class="text-center">&copy; <a href="http://facebook.com/ShibbirAhmedRizwan" target="_blank">Shibbir Ahmed 2018</a></p>
                </div>
            </div>
        </div>
    </div>
<?php
    include_once "footer.php";
?>