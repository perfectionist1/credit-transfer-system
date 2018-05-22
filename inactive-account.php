<?php
//admin validation
adminValidation();
?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Inactive users</h3>
        <hr/>
    </div>
    <div class="col-sm-12">
        <div class="well">
            <table id="content_table" class="table table-striped table-bordered table-responsive table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>E-mail Address</th>
                        <th>Address</th>
                        <th>Total Credit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                //all inactive users
                $query = "SELECT * FROM tbl_user WHERE account_status = 0 ORDER BY id DESC ";
                $result = query($query, 1);
                $serial = 1;
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr align="center">
                    <td><?php echo $serial++; ?></td>
                    <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email_address']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td>
                        <?php
                        $user_id = $row['id'];
                        $query = "SELECT total_credit FROM tbl_credit WHERE user_id = '$user_id'";
                        $credit = query($query, 2);
                        if ($credit['total_credit'] != null) {
                            echo '$' . $credit['total_credit'];
                        } else {
                            echo "$0";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="?user-id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm" title="View Profile"><i class="fa fa-user-circle-o"></i></a>
                        <a href="?add_credit&add_credit_id=<?php echo $row['id'];?>" class="btn btn-success btn-sm" title="Add Credit"><i class="fa fa-dollar"></i></a>
                        <a href="?reduce_credit&reduce_credit_id=<?php echo $row['id'];?>" class="btn btn-warning btn-sm" title="Reduce Credit"><i class="fa fa-minus-square"></i></a>
                        <a href="?transferred_history&transferred_history_id=<?php echo $row['id'];?>" class="btn btn-primary btn-sm" title="Transferred History"><i class="fa fa-list-alt"></i></a>
                        <a href="?received_history&received_history_id=<?php echo $row['id'];?>" class="btn btn-primary btn-sm" title="Received History"><i class="fa fa-th-list"></i></a>
                        <form class="inline_form" action="process.php" method="POST">
                            <input type="hidden" name="active_id" value="<?php echo $row['id'];?>" />
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure to activate this account?')" name="active" title="Active"><i class="fa fa-check"></i></button>
                        </form>
                        <form class="inline_form" action="process.php" method="POST">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>" />
                            <button type="submit" class="btn btn-danger btn-sm" name="delete-account" title="Delete User" onclick="return confirm('Are you sure to delete this account?')"><i class="fa fa-trash-o"></i></button>
                        </form>
                    </td>
                </tr>
                    <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="7" align="center">No inactive account</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>