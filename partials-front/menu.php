<?php include('config/constant.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img  src="images/logo1.jpg"  class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL;?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>club.php">Clubs</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>events.php">Events</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>admin/login.php">Admin Login</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
