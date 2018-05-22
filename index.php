<?php
    include_once "header.php";
    if(isset($_SESSION['user_id']) && isset($_SESSION['username'])){
        $current_user_id= $_SESSION['user_id'];
        $current_username = $_SESSION['username'];
        $query = "SELECT * FROM tbl_user WHERE id = '$current_user_id' AND username = '$current_username'";
        $current_user_from_db = query($query, 2);
        if($_SESSION['user_id'] == $current_user_from_db['id'] AND $_SESSION['username'] == $current_user_from_db['username']){
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
                    <h3 class="panel-title text-center">Sign in</h3>
                </div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <form class="form-horizontal" action="process.php" method="POST">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" autofocus id="username" name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" name="login" class="btn btn-success btn-block" value="Sign in" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="container-fluid">
                        <h4 class="text-center text-primary">Need Account ? <a href="register.php" class="text-success">Sign Up</a></h4>
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