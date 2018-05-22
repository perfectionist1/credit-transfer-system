<?php
if(isset($_GET['edit_info_id'])){
    $edit_info_id = $_GET['edit_info_id'];
    $query = "SELECT * FROM tbl_user WHERE id = '$edit_info_id'";
    $current_user_info = query($query, 2);
}

//Validation for edit info
/*
                * Hints
 * Admin can edit all users info
 * Users can edit only own info
 */
if($_SESSION['account_status'] != 2){
    if($_SESSION['user_id'] != $current_user_info['id']){
        redirect('dashboard.php?all_users');
    }
}

?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Edit Profile</h3>
        <hr/>
    </div>
    <?php
    if(isset($_SESSION['user_id'])){
        if(isset($_GET['edit_info'])){
            showMessage();
        }
    }
    ?>
    <div class="col-sm-12">
        <div class="well profile_table">
            <form class="form-horizontal" method="POST" action="process.php">
                <input type="hidden" name="edit_info_id" value="<?php echo $current_user_info['id'];?>"/>
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                        <?php
                        if($_SESSION['account_status'] == 2){
                        ?>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $current_user_info['username']; ?>" placeholder="Username">
                        <?php
                            }else {
                            ?>
                            <p class="form-control-static"><?php echo $current_user_info['username']; ?></p>
                            <?php
                                }
                            ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="first_name" class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $current_user_info['first_name'];?>" placeholder="Fast name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name" class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $current_user_info['last_name'];?>" placeholder="Last name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email_address" class="col-sm-3 control-label">E-mail address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="email_address" name="email_address" value="<?php echo $current_user_info['email_address'];?>" placeholder="something@example.com">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="address" name="address" rows="4" placeholder="Address"><?php echo $current_user_info['address'];?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input class="btn btn-success btn-block" type="submit" name="edit-info" value="Update"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>