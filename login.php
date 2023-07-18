<?php 
$page_title= "log in Form";

include('includes/header.php');
include('includes/navbar.php');
include('logincode.php'); 

if(isset($_SESSION['authenticated']))
{
    $_SESSION['status']="You are already looged in";
    header("location: Dashboard.php");
    exit(0);

}



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
                        <h5>log in Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="logincode.php" method="POST">
                            <div class="form-group mb-3">
                            <label for="">Email Address</label>
                            <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="text" name="password" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" name="Login_now_btn" class="btn btn-primary">log in</button>
                                <a href="password-reset.php" class="float-end">Forget your Password</a>
                            </div>

                        </form>
                        <hr>
                        <h6>
                            Didn't recieve your verification Email ?
                            <a href="resend-email.php">Resend</a>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
