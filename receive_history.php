<?php

if(isset($_GET['received_history_id'])){
    adminValidation();
    $user_id = $_GET['received_history_id'];
    $query = "SELECT username FROM tbl_user WHERE id = '$user_id'";
    $user_details = query($query, 2);
}else{
    $user_id = $_SESSION['user_id'];
}
?>

<div class="row">
    <div class="col-sm-12">
        <h3 class="text-center">Credit Received History <?php if (isset($_GET['received_history_id'])){echo "of ".$user_details['username'];} ?></h3>
        <hr/>
    </div>
    <div class="col-sm-12">
    <div class="well">
            <table id="content_table" class="table table-striped table-bordered table-responsive table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Time & Date</th>
                    <th>Received from</th>
                    <th>Received Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //receive history
                $query = "SELECT * FROM tbl_transfer WHERE transferred_to_user_id = '$user_id' ORDER BY id DESC ";
                $result = query($query, 1);
                $serial = 1;
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $serial++; ?></td>
                            <td><?php echo $row['transferred_date']; ?></td>
                            <?php
                            $received_user_id = $row['user_id'];
                            $query = "SELECT username FROM tbl_user WHERE id = '$received_user_id'";
                            $received_id_info = query($query, 2);
                            $received_user_name = $received_id_info['username'];
                            ?>
                            <td>
                                <?php
                                if(!empty($received_user_name)){
                                    ?>
                                    <a href="?user-id=<?php echo $row['user_id']; ?>" class="text-info" title="View Profile"><?php echo $received_user_name;?></a>
                                    <?php
                                }else{
                                    echo "user deleted";
                                }
                                ?>
                            </td>
                            <td><?php echo '$'.$row['transferred_amount']; ?></td>
                        </tr>
                        </tr>
                        <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="4" align="center">No received history available</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>