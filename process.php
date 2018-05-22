<?php
    require_once "functions/functions.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        //Register
        if (isset($_POST['register'])){
            $status = register($_POST);
            if ($status == true){
                message(1, "Registration complete. Please contact with admin to active your account");
                redirect('index.php');
            }
        }

        //Login
        if(isset($_POST['login'])){
            $status = login($_POST);
            if($status == true){
                redirect('dashboard.php?all_users');
            }
        }

        //Transfer credit
        if(isset($_POST['transfer'])){
            $status = transfer($_POST);
            if($status == true){
                message(1, "Transfer successful");
                redirect('dashboard.php?all_users');
            }
        }

        //Add credit
        if(isset($_POST['add-credit'])){
            $status = addCredit($_POST);
            if($status == true){
                message(1, "Credit added successfully");
                redirect('dashboard.php?all_users');
            }
        }

        //Reduce credit
        if(isset($_POST['reduce-credit'])){
            $status = reduceCredit($_POST);
            if($status == true){
                message(1, "Credit reduced successfully");
                redirect('dashboard.php?all_users');
            }
        }

        //Activate account
        if(isset($_POST['active'])){
            $status = active($_POST['active_id']);
            if($status == true){
                message(1, "Id successfully activated");
                redirect('dashboard.php?all_users');
            }
        }

        //Deactivate account
        if(isset($_POST['deactive'])){
            $status = deactive($_POST['deactive_id']);
            if($status == true){
                message(1, "Id successfully deactivated");
                redirect('dashboard.php?all_users');
            }
        }

        //Delete account
        if(isset($_POST['delete-account'])){
            $status = deleteAccount($_POST['delete_id']);
            if($status == true){
                message(1, "Account successfully deleted");
                redirect('dashboard.php?all_users');
            }
        }

        //edit account
        if(isset($_POST['edit-info'])){
            $status = editAccount($_POST);
            if($status == true){
                message(1, "Account successfully updated");
                redirect('dashboard.php?all_users');
            }
        }

        //Change Password
        if(isset($_POST['change-password'])){
            $status = changePassword($_POST);
            if($status == true){
                message(1, "Password successfully changed");
                redirect('dashboard.php?all_users');
            }
        }

        //send credit request
        if(isset($_POST['sent-credit-request'])){
            $status = sentCreditRequest($_POST);
            if($status == true){
                message(1, "Credit request has been sent");
                redirect('dashboard.php?sent_credit_request');
            }
        }


        //confirm sent credit request
        if(isset($_POST['confirm_sent_request'])){
            $status = confirmSentCreditRequest($_POST);
            if($status == true){
                message(1, "Credit request confirmed");
                redirect('dashboard.php?all_credit_request');
            }
        }

        //refuse sent credit request
        if(isset($_POST['refused_sent_request'])){
            $status = refuseCreditRequest($_POST);
            if($status == true){
                message(1, "Credit request successfully refused");
                redirect('dashboard.php?all_credit_request');
            }
        }







    }else{
        header('Location:index.php');
    }