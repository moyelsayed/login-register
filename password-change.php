<?php
session_start();
$page_title="Password change ";
include('includes/header.php');
include('includes/navbar.php');



?>
<link rel="stylesheet" href="main.css">
<div class="bg-image">
    <div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if(isset($_SESSION['status'])){?>
                    <div class="alert alert-success">
                        <?php echo"<h5>".$_SESSION['status']."</h5>";?>
                    </div>
                    <?php unset($_SESSION['status']);?>
                <?php } ?>

                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="password-reset-code.php" method="POST">
                            <input type="hidden" name="pass-token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>" class="form-control">
                            <div class="form-group mb-3">
                            <label for="">Email Address</label>
                            <input type="text" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                            <label for="">New Password</label>
                            <input type="text" name="new-password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                            <label for="">Confirm Password</label>
                            <input type="text" name="confirm-password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="password_update" class="btn btn-success w-100">Update Password</button>
                            </div>

                        </form>      
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>