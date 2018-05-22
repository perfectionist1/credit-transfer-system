<?php
    if(isset($_GET['user-info'])){
        $query = "SELECT * FROM tbl_user WHERE id = '$current_user_id'";
        $current_user_info = query($query, 2);
    }else{
        if (isset($_GET['user-id'])) {
            $current_user_id = $_GET['user-id'];
            $query = "SELECT * FROM tbl_user WHERE id = '$current_user_id'";
            $current_user_info = query($query, 2);
        }
    }
?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">
            User profile
            <?php
                if($_SESSION['user_id'] != $current_user_id){
                    echo "of ".$current_user_info['username'];
                }
            ?>
        </h3>
        <hr/>
    </div>
    <div class="col-sm-12">
        <div class="well profile_table">
            <table class="table table-striped table-bordered table-responsive">
                <tr>
                    <th>Name</th>
                    <td><?php echo $current_user_info['first_name'].' '.$current_user_info['last_name'];?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?php echo $current_user_info['username'];?></td>
                </tr>
                <tr>
                    <th>E-mail Address</th>
                    <td><?php echo $current_user_info['email_address'];?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo $current_user_info['address'];?></td>
                </tr>
                <?php
                if($current_user_info['account_status'] != 2) {
                    ?>
                    <tr>
                        <th>Total credit</th>
                        <td>
                            <?php
                            $user_id = $current_user_info['id'];
                            $query = "SELECT total_credit FROM tbl_credit WHERE user_id = '$user_id'";
                            $credit = query($query, 2);
                            if ($credit['total_credit'] != null) {
                                echo '$' . $credit['total_credit'];
                            } else {
                                echo "$0";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <th>Joined</th>
                    <td><?php echo $current_user_info['created_at'];?></td>
                </tr>
                <?php
                if($_SESSION['user_id'] == $current_user_info['id'] || $current_user_from_db['account_status'] == 2){
                    ?>
                    <tr>
                        <th>Action</th>
                        <td>
                            <a href="?edit_info&edit_info_id=<?php echo $current_user_info['id'];?>" class="btn btn-info" title="Edit Profile"><i class="fa fa-edit"></i> Edit Profile</a>
                            <a href="?change_password&change_password_id=<?php echo $current_user_info['id'];?>" class="btn btn-primary" title="Change Password"><i class="fa fa-unlock-alt"></i> Change Password</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>