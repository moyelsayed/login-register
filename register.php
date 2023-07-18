<?php 
session_start();
$page_title= "Regestration Form";

include('includes/header.php');
include('includes/navbar.php'); 


?>
<link rel="stylesheet" href="main.css">
<div class="bg-image">
    <div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-danger">
                    <?php if(isset($_SESSION['status'])){?>
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <?php echo"<h4>".$_SESSION['status']."</h4>";?>
                        </div>
                        <?php unset($_SESSION['status']);?>
                    <?php } ?>
                </div>
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-header">
                        <h5>Registration Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                            <label for="">Phone number</label>
                            <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                            <label for="">Email Address</label>
                            <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-primary">Rigester Now</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
