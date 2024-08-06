
<?php include('partials-front/menu.php') ?>
<section class="food-search text-center">
        <div class="container">
             <form action="<?php echo SITEURL; ?>event-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Events.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>


    <!-- event Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Events</h2>
            <?php

     $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' ";
     //Execute the query
     $res2 = mysqli_query($conn,$sql2);
      //count rows to check whether the event  is available or not
     $count2 =mysqli_num_rows($res2);
     if($count2>0)
     {
        //events available
        while($row2=mysqli_fetch_assoc($res2))
        {
     
        //Get the values like id,title,image_name
        $id= $row2['id'];
        $title= $row2['title'];
        $description= $row2['description'];
        $price= $row2['price']; 
        $club= $row2['club'];           
        $location= $row2['location'];       
        $date= $row2['date'];       
        $time= $row2['time'];      
        $image_name = $row2['image_name'];
        ?>
         <div class="food-menu-box">
                <div class="food-menu-img">
                <?php
                //check whether the image is available or not
                 if($image_name=="")
                 {
                   //display massage
                 echo "<div class='error'>Food not Available</div>"; 
                 }
                 else{
                 
                    //image available
                    ?>
                  <img src="<?php echo SITEURL;?>images/event/<?php echo $image_name;?>" class="img-responsive img-curve" >
                  <?php
                 } 
                 ?>
                    
                </div>

                <div class="food-menu-desc">
                    <h4 style="color: black"> <?php echo $title ; ?></h4>
                    <p style="color:blue"class="food-price">₹<?php echo $price  ; ?></p>
                    <p class="food-price">location: <?php echo $location  ; ?></p>
                    <p class="food-price">Date: <?php echo $date  ; ?></p>
                    <p class="food-price">Time: <?php echo $time  ; ?></p>
                    <p class="food-price">Club : <?php echo $club; ?></p>
                    <p class="food-detail">
                       <?php echo $description ; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>register.php?food_id=<?php echo $id;?>" class="btn btn-primary">Register Now</a>
                </div>
                </div>
                    <?php               
    }
    } 
    else
    {
        //clubs not available
        echo "<div class='error'>Event not added</div>";
    }
               ?>               

            <div class="clearfix"></div>     

    </section>
  

    <?php include('partials-front/footer.php') ?>