<?php 
$page_title= "Dash board";
include('includes/header.php');
include('includes/navbar.php');
include('authentication.php');

?>
<link rel="stylesheet" href="dash.css">
<div class="bg-image">
    <div class="py-5" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <?php if(isset($_SESSION['status'])){?>
                    <div class="alert alert-success">
                        <?php echo"<h5>".$_SESSION['status']."</h5>";?>
                    </div>
                    <?php unset($_SESSION['status']);?>
                <?php } ?>

                    <div class="card">
                    <div class="card-header">
                        <h4>User Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <h4>Welcome</h4>
                        <hr>
                        <h5>Username: <?=$_SESSION['auth_user']['username']?></h5>
                        <h5>Email: <?=$_SESSION['auth_user']['email']?></h5>
                        <h5>Phone: <?=$_SESSION['auth_user']['phone']?></h5>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>

