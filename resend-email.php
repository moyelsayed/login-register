<?php 
session_start();
$page_title= "log in Form";

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
                        <h5>Resend Email verification</h5>
                    </div>
                    <div class="card-body">
                        <form action="resendcode.php" method="POST">
                            <div class="form-group mb-3">
                            <label for="">Email Address</label>
                            <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="resend_btn" class="btn btn-primary">Submit</button>
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
