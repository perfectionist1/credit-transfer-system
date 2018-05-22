<?php
    session_start();
    require_once "database.php";
    require_once "helper_functions.php";

    //register
    function register($data){
        $first_name = validation($data['first_name']);
        $last_name = validation($data['last_name']);
        $username = strtolower(validation($data['username']));
        $password = validation($data['password']);
        $email_address = validation($data['email_address']);
        $address = validation($data['address']);

        //empty field validation
        if(empty($first_name) || empty($last_name) || empty($username) || empty($password) || empty($email_address) || empty($address)){
            message(0, 'Field must not empty');
            redirect('register.php');
            return false;
        }

        //validation for First Name
        if (strlen($first_name) > 15){
            message(0, "First name must be less than 15 characters");
            redirect('register.php');
            return false;
        }

        //validation for Last Name
        if (strlen($last_name) > 15){
            message(0, "Last name must be less than 15 characters");
            redirect('register.php');
            return false;
        }

        //validation for username
        if(strlen($username) < 4 || strlen($username) > 15){
            message(0, "Username must be in 4 to 15 characters");
            redirect('register.php');
            return false;
        }elseif (preg_match('/[^a-z0-9_]+/i', $username)){
            message(0, "Username must only contain alphanumerical character and underscores");
            redirect('register.php');
            return false;
        }

        $query = "SELECT * FROM tbl_user WHERE username = '$username'";
        $result = query($query, 1);
        if (mysqli_num_rows($result)>0){
            message(0, "Username already exists");
            redirect('register.php');
            return false;
        }

        //validation for password
        if (strlen($password) < 4){
            message(0, "Password must be greater than 4 character");
            redirect('register.php');
            return false;
        }else{
            $password = md5($password);
        }

        //validation for email
        if(!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
            message(0, "Invalid email address! Provide valid email address");
            redirect('register.php');
            return false;
        }
        $query = "SELECT * FROM tbl_user WHERE email_address = '$email_address'";
        $result = query($query, 1);
        if (mysqli_num_rows($result)>0){
            message(0, "Email address already exists");
            redirect('register.php');
            return false;
        }

        //current date
        $date = date("d-m-Y");

        //Insert Query for registration
        $query = "INSERT INTO tbl_user(first_name, last_name, username, password, email_address, address, account_status, created_at) VALUES('$first_name', '$last_name', '$username', '$password', '$email_address', '$address', 0, '$date')";
        if(query($query)){
            $query = "SELECT id FROM tbl_user ORDER BY id DESC LIMIT 1";
            $account_info = query($query, 2);
            $last_user_id = $account_info['id'];
            $query = "INSERT INTO tbl_credit (user_id) VALUES('$last_user_id')";
            if(query($query)){
                return true;
            }
        }
    }

    //edit account
    function editAccount($data){
        $edit_info_id = $data['edit_info_id'];
        $first_name = validation($data['first_name']);
        $last_name = validation($data['last_name']);
        $email_address = validation($data['email_address']);
        $address = validation($data['address']);

        $query = "SELECT * FROM tbl_user WHERE id = '$edit_info_id'";
        $user_data = query($query, 2);

        //empty field validation
        if(empty($first_name) || empty($last_name) || empty($email_address) || empty($address)){
            message(0, 'Field must not empty');
            redirect('dashboard.php?edit_info&edit_info_id='.$edit_info_id);
            return false;
        }

        //validation for First Name
        if (strlen($first_name) > 15){
            message(0, "First name must be less than 15 characters");
            redirect('dashboard.php?edit_info&edit_info_id='.$edit_info_id);
            return false;
        }

        //validation for Last Name
        if (strlen($last_name) > 15){
            message(0, "Last name must be less than 15 characters");
            redirect('dashboard.php?edit_info&edit_info_id='.$edit_info_id);
            return false;
        }

        //validation for email
        if(!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
            message(0, "Invalid email address! Provide valid email address");
            redirect('dashboard.php?edit_info&edit_info_id='.$edit_info_id);
            return false;
        }

        $query = "SELECT * FROM tbl_user WHERE email_address = '$email_address'";
        $same_email_in_table = query($query, 1);
        if (mysqli_num_rows($same_email_in_table) > 0){
            if(mysqli_num_rows($same_email_in_table) == 1){
                $user_email_from_db = $user_data['email_address'];
                if($user_email_from_db != $email_address){
                    message(0, "Email address already exists");
                    redirect('dashboard.php?edit_info&edit_info_id='.$edit_info_id);
                    return false;
                }
            }else{
                message(0, "Email address already exists");
                redirect('dashboard.php?edit_info&edit_info_id='.$edit_info_id);
                return false;
            }
        }

        //username validation
        if(array_key_exists('username', $data)) {
            $username = validation($data['username']);

            //validation for username
            if(strlen($username) < 4 || strlen($username) > 15){
                message(0, "Username must be in 4 to 15 characters");
                redirect('dashboard.php?edit_info&edit_info_id='.$edit_info_id);
                return false;
            }elseif (preg_match('/[^a-z0-9_]+/i', $username)){
                message(0, "Username must only contain alphanumerical character and underscores");
                redirect('dashboard.php?edit_info&edit_info_id='.$edit_info_id);
                return false;
            }

            $query = "SELECT * FROM tbl_user WHERE username = '$username'";
            $same_username_in_table = query($query, 1);

            if (mysqli_num_rows($same_username_in_table) > 0) {
                if (mysqli_num_rows($same_username_in_table) == 1) {
                    $user_username_from_db = $user_data['username'];
                    if ($user_username_from_db != $username) {
                        message(0, "Username already exists");
                        redirect('dashboard.php?edit_info&edit_info_id=' . $edit_info_id);
                        return false;
                    }
                } else {
                    message(0, "Username already exists");
                    redirect('dashboard.php?edit_info&edit_info_id=' . $edit_info_id);
                    return false;
                }
            }
            $query = "UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name', username = '$username', email_address = '$email_address', address = '$address' WHERE id = '$edit_info_id'";
            $status = query($query);
        }else {
            $query = "UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name', email_address = '$email_address', address = '$address' WHERE id = '$edit_info_id'";
            $status = query($query);
            $username = $user_data['username'];
        }

        if($status == true){
            //if admin change own username then it will keep logged in
            if($_SESSION['account_status'] == $user_data['account_status']){
                $_SESSION['username'] = $username;
            }
            return true;
        }else{
            echo "Error in update info";
        }
    }

    //Change Password
    function changePassword($data){
        $change_password_id = $data['change_password_id'];
        $query = "SELECT password FROM tbl_user WHERE id = '$change_password_id'";
        $change_password_id_details = query($query, 2);
        $change_password_id_current_password = $change_password_id_details['password'];

        $new_password = validation($data['new_password']);
        $confirm_new_password = validation($data['confirm_new_password']);

        //empty field validation
        if(empty($new_password) || empty($confirm_new_password)){
            message(0, 'Field must not empty');
            redirect("dashboard.php?change_password&change_password_id=".$change_password_id);
            return false;
        }

        //validation for password
        if($new_password !== $confirm_new_password){
            message(0, 'New password does not match');
            redirect("dashboard.php?change_password&change_password_id=".$change_password_id);
            return false;
        }

        if (strlen($new_password) < 4){
            message(0, "Password must be greater than 4 character");
            redirect("dashboard.php?change_password&change_password_id=".$change_password_id);
            return false;
        }

        if(array_key_exists('old_password', $data)){
            $old_password = validation($data['old_password']);

            //empty field validation
            if(empty($old_password)){
                message(0, 'Field must not empty');
                redirect("dashboard.php?change_password&change_password_id=".$change_password_id);
                return false;
            }

            $encrypted_old_password = md5($old_password);

            if($encrypted_old_password != $change_password_id_current_password){
                message(0, 'Incorrect old password');
                redirect("dashboard.php?change_password&change_password_id=".$change_password_id);
                return false;
            }
        }

        $encrypted_new_password = md5($new_password);

        $query = "UPDATE tbl_user SET password = '$encrypted_new_password' WHERE id = '$change_password_id'";
        $status = query($query);
        if($status == true){
            return true;
        }else{
            echo "Failed to change password";
        }
    }

    //login
    function login($data){
        $username = validation($data['username']);
        $password = validation($data['password']);

        //empty field validation
        if(empty($username) || empty($password)){
            message(0, 'Field must not empty');
            redirect('index.php');
            return false;
        }

        //password encryption
        $password = md5($password);

        $query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
        $result = query($query, 1);
        if(mysqli_num_rows($result) == 1){
            $account_info = mysqli_fetch_assoc($result);
            if($account_info['account_status'] < '1'){
                message(0, 'Inactive account. Contact with admin to active your account');
                redirect('index.php');
            }else {
                $_SESSION['user_id'] = $account_info['id'];
                $_SESSION['username'] = $account_info['username'];
                $_SESSION['account_status'] = $account_info['account_status'];
                return true;
            }
        }else{
            message(0, 'invalid username or password');
            redirect('index.php');
            return false;
        }
    }

    //credit transfer
    function transfer($data){
        $transfer_user_id = $data['transfer_user_id'];
        $transfer_user_query = "SELECT * FROM tbl_credit WHERE  user_id = '$transfer_user_id'";
        $transfer_user_data = query($transfer_user_query, 2);
        $transfer_user_amount = $transfer_user_data['total_credit'];

        $amount = validation($data['amount']);
        $current_user_id = $data['current_user_id'];
        $current_user_query = "SELECT * FROM tbl_credit WHERE user_id = '$current_user_id'";
        $current_user_data = query($current_user_query, 2);
        $current_user_amount = $current_user_data['total_credit'];

        //minimum amount 1
        if($amount < 1){
            message(0, "Minimum amount must be greater than 0");
            redirect('dashboard.php?transfer&transfer_id='.$transfer_user_id);
            return false;
        }elseif($amount > $current_user_amount){
            message(0, "Insufficient credit to transfer");
            redirect('dashboard.php?transfer&transfer_id='.$transfer_user_id);
            return false;
        }elseif(!filter_var($amount, FILTER_VALIDATE_INT)){
            message(0, "Invalid input");
            redirect('dashboard.php?transfer&transfer_id='.$transfer_user_id);
            return false;
        }else{
            $rest_of_money_of_current_user = $current_user_amount - $amount;
            $query = "UPDATE tbl_credit SET total_credit = '$rest_of_money_of_current_user' WHERE user_id = '$current_user_id'";
            $subtraction =  query($query);

            $total_money_of_transfered_user = $transfer_user_amount + $amount;
            $query = "UPDATE tbl_credit SET total_credit = '$total_money_of_transfered_user' WHERE user_id = '$transfer_user_id'";
            $addition = query($query);
            if($subtraction == true AND $addition == true){
                //transferred history

                $transferred_date = date("h:i:s A, d-m-Y");
                $query = "INSERT INTO tbl_transfer(user_id, transferred_to_user_id, transferred_amount, transferred_date) VALUES ('$current_user_id', '$transfer_user_id', '$amount', '$transferred_date')";
                $transferred_history = query($query);
                if($transferred_history == true){
                    return true;
                }else{
                    echo "Failed to insert transferred history";
                }
            }else{
                echo "Transfer unsuccessful";
            }
        }
    }

    //Add Credit
    function addCredit($data){
        $admin_id = $_SESSION['user_id'];
        $add_credit_id = $data['add_credit_id'];
        $add_credit_id_query = "SELECT * FROM tbl_credit WHERE user_id = '$add_credit_id'";
        $add_credit_id_info = query($add_credit_id_query, 2);
        $add_credit_id_current_amount = $add_credit_id_info['total_credit'];

        $amount = validation($data['amount']);

        if($amount < 1){
            message(0, "Minimum amount must be greater than 0");
            redirect('dashboard.php?add_credit&add_credit_id='.$add_credit_id);
            return false;
        }

        if(!filter_var($amount, FILTER_VALIDATE_INT)){
            message(0, "Invalid input");
            redirect('dashboard.php?add_credit&add_credit_id='.$add_credit_id);
            return false;
        }

        $add_credit_id_total_amount = $add_credit_id_current_amount + $amount;
        $query = "UPDATE tbl_credit SET total_credit = '$add_credit_id_total_amount' WHERE user_id = '$add_credit_id'";
        $addition = query($query);
        if($addition == true){
            //transferred history
            $transferred_date = date("h:i:s A, d-m-Y");
            $query = "INSERT INTO tbl_transfer(user_id, transferred_to_user_id, transferred_amount, transferred_date) VALUES ('$admin_id', '$add_credit_id', '$amount', '$transferred_date')";
            $transferred_history = query($query);
            if($transferred_history == true){
                return true;
            }
        }else{
            echo "Add credit error";
        }
    }

    //reduce credit
    function reduceCredit($data){
        $reduce_credit_id = $data['reduce_credit_id'];
        $reduce_credit_id_query = "SELECT * FROM tbl_credit WHERE user_id = '$reduce_credit_id'";
        $reduce_credit_id_info = query($reduce_credit_id_query, 2);
        $reduce_credit_id_current_amount = $reduce_credit_id_info['total_credit'];

        $amount = validation($data['amount']);

        if($amount < 1){
            message(0, "Minimum amount must be greater than 0");
            redirect('dashboard.php?reduce_credit&reduce_credit_id='.$reduce_credit_id);
            return false;
        }

        if(!filter_var($amount, FILTER_VALIDATE_INT)){
            message(0, "Invalid input");
            redirect('dashboard.php?reduce_credit&reduce_credit_id='.$reduce_credit_id);
            return false;
        }

        if($amount > $reduce_credit_id_current_amount){
            message(0, "Maximum you can reduce $".$reduce_credit_id_current_amount);
            redirect('dashboard.php?reduce_credit&reduce_credit_id='.$reduce_credit_id);
            return false;
        }

        $reduce_credit_id_total_amount = $reduce_credit_id_current_amount - $amount;
        $query = "UPDATE tbl_credit SET total_credit = '$reduce_credit_id_total_amount' WHERE user_id = '$reduce_credit_id'";
        $addition = query($query);
        if($addition == true){
            return true;
        }else{
            echo "Reduce credit error";
        }
    }


    //sent credit request
    function sentCreditRequest($data){
        $user_id = $data['sent_request_id'];
        $amount = validation($data['amount']);
        $sent_request_date = date("h:i:s A, d-m-Y");
        $request_status = 1;

        if(empty($amount)){
            message(0, "Field must not empty");
            redirect('dashboard.php?sent_credit_request');
            return false;
        }

        if($amount < 1){
            message(0, "Minimum amount must be greater than 0");
            redirect('dashboard.php?sent_credit_request');
            return false;
        }

        if(!filter_var($amount, FILTER_VALIDATE_INT)){
            message(0, "Invalid input");
            redirect('dashboard.php?sent_credit_request');
            return false;
        }

        $query = "INSERT INTO tbl_credit_request(user_id, amount, date, request_status) VALUES('$user_id', '$amount', '$sent_request_date', '$request_status')";
        $status = query($query);
        if($status == true){
            return true;
        }else{
            echo "Failed to sent request check query";
        }

    }

    //confirm sent credit request
    function confirmSentCreditRequest($data){
        $logged_user_id = $_SESSION['user_id'];
        $request_id = $data['request_id'];
        $user_id = $data['user_id'];
        $amount = $data['amount'];
        $request_status = 2;

        $query = "SELECT * FROM tbl_credit WHERE user_id = '$user_id'";
        $user_credit_info = query($query, 2);
        $user_current_credit = $user_credit_info['total_credit'];

        $addition = $user_current_credit+$amount;
        $query = "UPDATE tbl_credit SET total_credit = '$addition' WHERE user_id = '$user_id'";
        $status = query($query);

        if($status == true){
            //for transfer table
            $date = date("h:i:s A, d-m-Y");
            $query = "INSERT INTO tbl_transfer(user_id, transferred_to_user_id, transferred_amount, transferred_date) VALUES('$logged_user_id', '$user_id', '$amount', '$date')";
            $status = query($query);

            if($status == true){
                //for request table
                $query = "UPDATE tbl_credit_request SET request_status = '$request_status' WHERE id = '$request_id'";
                $status = query($query);
                if($status == true){
                    return true;
                }else{
                    echo "failed to update request status";
                }
            }else{
                echo "failed to update transfer table";
            }

        }else{
            echo "Requested credit failed to add in total credit";
        }
    }


    //refuse credit request
    function refuseCreditRequest($data){
        $request_id = $data['request_id'];
        $request_status = 0;

        $query = "UPDATE tbl_credit_request SET request_status = '$request_status' WHERE id = '$request_id'";
        $status = query($query);
        if($status == true){
            return true;
        }else{
            echo "failed to update credit request table";
        }
    }


    //active account
    function active($id){
        $query = "UPDATE tbl_user SET account_status = '1' WHERE id = '$id'";
        $status = query($query);
        if($status == true){
            return true;
        }
    }

    //deactivate account
    function deactive($id){
        $query = "UPDATE tbl_user SET account_status = '0' WHERE id = '$id'";
        $status = query($query);
        if($status == true){
            return true;
        }
    }

    //delete account
    function deleteAccount($id){
        $query = "DELETE FROM tbl_user WHERE id = '$id'";
        $user_table_delete = query($query);
        $query = "DELETE FROM tbl_credit WHERE user_id = '$id'";
        $credit_table_delete = query($query);
        if($user_table_delete == true && $credit_table_delete == true){
            return true;
        }else{
            echo "Delete problem";
        }
    }