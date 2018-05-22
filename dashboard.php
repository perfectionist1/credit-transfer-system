<?php
    include_once "header.php";
?>
<?php
    if(isset($_SESSION['user_id']) && isset($_SESSION['username'])){
        $current_user_id= $_SESSION['user_id'];
        $current_username = $_SESSION['username'];
        $query = "SELECT * FROM tbl_user WHERE id = '$current_user_id' AND username = '$current_username'";
        $current_user_from_db = query($query, 2);
        if($_SESSION['user_id'] != $current_user_from_db['id'] || $_SESSION['username'] != $current_user_from_db['username']){
            message(0, "You must login first");
            redirect('index.php');
        }
    }else{
        message(0, "You must login first");
        redirect('index.php');
    }
?>
    <?php
        if(isset($_GET['logout'])){
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['account_status']);
            message(1,"You are now logged out");
            redirect('index.php');
}
    ?>
    <?php
        $current_user = $current_user_from_db['id'];
        $query = "SELECT total_credit FROM tbl_credit WHERE user_id = '$current_user'";
        $credit = query($query, 2);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Dashboard</h3>
                </div>
                <div class="panel-body">
                    <div class="row dashboard_header">
                        <div class="col-sm-3">
                            <h5 class="text-center">
                                Account Status : <span class="text-info">
                                    <?php
                                        if($_SESSION['account_status'] == 2){
                                            echo "<span class='text-primary'>Administrator</span>";
                                        }elseif($_SESSION['account_status'] == 1){
                                            echo "<span class='text-success'>Active</span>";
                                        }elseif ($_SESSION['account_status'] == 0){
                                            echo "<span class='text-danger'>Inactive</span>";
                                        }
                                    ?>
                                </span>
                            </h5>
                            <?php
                            if ($_SESSION['account_status'] != 2){
                            ?>
                                <h5 class="text-center">
                                    User Credit : <span class="text-info">
                                        <?php
                                            if($credit['total_credit'] != null){
                                                echo '$'.$credit['total_credit'];
                                            }else{
                                                echo 0;
                                            }
                                            ?>
                                    </span>
                                </h5>
                            <?php
                            }
                            ?>
                            <h5 class="text-center">User joined : <span class="text-info"><?php echo $current_user_from_db['created_at']; ?></span></h5>
                        </div>
                        <div class="col-sm-7">
                            <h2 class="text-center">Welcome <span class="text-primary"><?php echo $current_user_from_db['first_name'].' '.$current_user_from_db['last_name'] ?></span></h2>
                        </div>
                        <div class="col-sm-2">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="?user-info" class="btn btn-default btn-sm btn-block <?php activeClass('user-info')?>"><i class="fa fa-user"></i> User Profile</a>
                                </div>
                                <hr/>
                                <div class="col-sm-12">
                                    <a href="?logout" onclick="return confirm('are you sure to sign out?')" class="btn btn-default btn-sm btn-block"><i class="fa fa-sign-out"></i> Sign Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row dashboard_body">
                        <div class="col-sm-2 sidebar">
                            <div class="list-group">
                                <a href="?all_users" class="list-group-item <?php activeClass('all_users')?>">All users</a>
                                <?php
                                if ($current_user_from_db['account_status'] == 2) {
                                    //number of inactive account
                                    $query = "SELECT * FROM tbl_user WHERE account_status = 0 ORDER BY id DESC ";
                                    $result = query($query, 1);
                                    $number_of_deactive_account = mysqli_num_rows($result);

                                    //number of pending credit request
                                    $query ="SELECT request_status FROM tbl_credit_request WHERE request_status=1";
                                    $result = query($query, 1);
                                    $number_of_pending_credit_request = mysqli_num_rows($result);
                                    ?>
                                    <a href="?inactive_account" class="list-group-item <?php activeClass('inactive_account')?>">Inactive Account <span class="badge"><?php if($number_of_deactive_account>0){echo $number_of_deactive_account;}?></span></a>
                                    <a href="?my_transferred_history" class="list-group-item  <?php activeClass('my_transferred_history')?>">Add Credit History</a>
                                    <a href="?all_credit_request" class="list-group-item  <?php activeClass('all_credit_request')?>">Credit Request <span class="badge"><?php if($number_of_pending_credit_request>0){echo $number_of_pending_credit_request;}?></span></a>
                                    <?php
                                }else {
                                    ?>
                                    <a href="?my_transferred_history" class="list-group-item <?php activeClass('my_transferred_history')?>">My Transferred History</a>
                                    <a href="?my_receive_history" class="list-group-item <?php activeClass('my_receive_history')?>">My Receive History</a>
                                    <a href="?sent_credit_request" class="list-group-item <?php activeClass('sent_credit_request')?>">Sent Credit Request</a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-10 content">
                            <?php
                            if(isset($_GET['all_users'])){
                                include_once 'all-user.php';
                            }elseif(isset($_GET['user-info']) || isset($_GET['user-id'])){
                                include_once "user-info.php";
                            }elseif(isset($_GET['transfer'])){
                                include_once "transfer-credit.php";
                            }elseif(isset($_GET['add_credit'])){
                                include_once "add-credit.php";
                            }elseif(isset($_GET['reduce_credit'])){
                                include_once "reduce-credit.php";
                            }elseif(isset($_GET['inactive_account'])){
                                include_once "inactive-account.php";
                            }elseif(isset($_GET['edit_info'])){
                                include_once "edit-info.php";
                            }elseif (isset($_GET['change_password'])){
                                include_once "change_password.php";
                            }elseif(isset($_GET['my_transferred_history']) || isset($_GET['transferred_history'])){
                                include_once "transferred_history.php";
                            }elseif(isset($_GET['my_receive_history']) || isset($_GET['received_history'])){
                                include_once "receive_history.php";
                            }elseif (isset($_GET['sent_credit_request'])){
                                include_once 'sent_credit_request.php';
                            }elseif(isset($_GET['all_credit_request'])){
                                include_once 'all_credit_request.php';
                            }else{
                                include_once 'all-user.php';
                            }
                            ?>
                        </div>
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