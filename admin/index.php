
    <?php include('partials/menu.php'); ?>
    <!--Main Content  Section Starts -->
    <div class="main-content">
        <div class="wrapper">
        <h2>Dashboard</h2><br/>
        <?php
        if(isset($_SESSION['login']))
          {
              echo $_SESSION['login'];
              unset ($_SESSION['login']);//Removing sesion message
          }
          ?>
          <br/>
        <div class="col-4 text-center">
         <?php
        
   $sql = "SELECT*FROM tbl_category";
   $res = mysqli_query($conn,$sql);
   $count =mysqli_num_rows($res);//Function to get all the rows in the database
   ?>
           <h1><?php echo $count ;?></h1>
           <br/>
        Clubs
        </div>
        <div class="col-4 text-center">
        <?php
        
        $sql2 = "SELECT*FROM tbl_food";
        $res2 = mysqli_query($conn,$sql2);
        $count2 =mysqli_num_rows($res2);
        ?>
           <h1><?php echo $count2 ;?></h1>
           <br/>
        Events
        </div>
        <div class="col-4 text-center">
        <?php
        
        $sql3 = "SELECT*FROM tbl_order";
        $res3 = mysqli_query($conn,$sql3);
        $count3 =mysqli_num_rows($res3);
        ?>
           <h1><?php echo $count3 ;?></h1>
           <br/>
        Total Registration
        </div>
        <div class="clearfix">
        </div>
        </div>
       
    </div>
    <!--Main Content Section Ends -->
    <?php include('partials/footer.php'); ?>
