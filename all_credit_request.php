<?php
    //admin validation
    adminValidation();
?>
<!--Pending credit request-->
<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Pending Credit Request</h3>
        <hr/>
    </div>
    <?php
    if (isset($_SESSION['user_id'])){
        if(isset($_GET['all_credit_request'])){
            showMessage();
        }
    }
    ?>
    <div class="col-sm-12">
        <div class="well">
            <table id="content_table" class="table table-striped table-bordered table-responsive table-hover content_table" style="width:100%">
                <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Time & Date</th>
                    <th>Username</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM tbl_credit_request WHERE request_status=1 ORDER BY id DESC";
                $all_info_of_sent_request = query($query,1);
                if(mysqli_num_rows($all_info_of_sent_request) > 0) {
                    $serial = 1;
                    while ($row = mysqli_fetch_assoc($all_info_of_sent_request)) {
                        ?>
                        <tr align="center">
                            <td><?php echo $serial++;?></td>
                            <td><?php echo $row['date'];?></td>
                            <td>
                                <?php
                                $user_id = $row['user_id'];
                                $query = "SELECT username FROM tbl_user WHERE id = '$user_id'";
                                $sent_request_user_info = query($query, 2);
                                $sent_request_username = $sent_request_user_info['username'];
                                ?>
                                <a href="?user-id=<?php echo $row['user_id']; ?>"><?php echo $sent_request_username;?></a>
                            </td>
                            <td><?php echo $row['amount'];?></td>
                            <td>
                                <form action="process.php" method="POST" class="inline_form">
                                    <input type="hidden" name="request_id" value="<?php echo $row['id'];?>" />
                                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
                                    <input type="hidden" name="amount" value="<?php echo $row['amount'];?>" />
                                    <button type="submit" onclick="return confirm('Are you sure to accept this request?')" name="confirm_sent_request" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
                                </form>

                                <form action="process.php" method="POST" class="inline_form">
                                    <input type="hidden" name="request_id" value="<?php echo $row['id'];?>" />
                                    <button type="submit" onclick="return confirm('Are you sure to refuse this request?')" name="refused_sent_request" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                }else {
                    ?>
                    <tr>
                        <td colspan="4" align="center">No pending request</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--confirmed credit request-->
<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Confirmed Credit Request</h3>
        <hr/>
    </div>

    <div class="col-sm-12">
        <div class="well">
            <table id="content_table" class="table table-striped table-bordered table-responsive table-hover data_table" style="width:100%">
                <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Time & Date</th>
                    <th>Username</th>
                    <th>Amount</th>
                    <th>Request Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM tbl_credit_request WHERE request_status !=1 ORDER BY id DESC";
                $all_info_of_sent_request = query($query,1);
                if(mysqli_num_rows($all_info_of_sent_request) > 0) {
                    $serial = 1;
                    while ($row = mysqli_fetch_assoc($all_info_of_sent_request)) {
                        ?>
                        <tr align="center" class="<?php
                        if($row['request_status'] == 0){
                            echo "danger";
                        }elseif ($row['request_status'] == 2){
                            echo "success";
                        }
                        ?>">
                            <td><?php echo $serial++; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td>
                                <?php
                                $user_id = $row['user_id'];
                                $query = "SELECT username FROM tbl_user WHERE id = '$user_id'";
                                $sent_request_user_info = query($query, 2);
                                $sent_request_username = $sent_request_user_info['username'];
                                ?>
                                <a href="?user-id=<?php echo $row['user_id']; ?>"><?php echo $sent_request_username; ?></a>
                            </td>
                            <td><?php echo $row['amount']; ?></td>
                            <td>
                                <?php
                                if ($row['request_status'] == 2) {
                                    echo "Accepted";
                                } elseif ($row['request_status'] == 0) {
                                    echo "Refused";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }else {
                    ?>
                    <tr>
                        <td colspan="4" align="center">No pending request</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>