
    <?php include('partials-front/menu.php'); ?>

    <!-- event  sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 

                //Get the Search Keyword
                // $search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            
            ?>


            <h2 class="text-yellow">Events on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- event sEARCH Section Ends Here -->



    <!-- events Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Events</h2>

            <?php 

                //SQL Query to Get events based on search keyword
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether event available of not
                if($count>0)
                {
                    //Event Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $location = $row['location'];
                        $price = $row['price'];
                        $club = $row['club'];
                        $date = $row['date'];
                        $time = $row['time'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    // Check whether image name is available or not
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/event/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php 

                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4 style="color: black"><?php echo $title; ?></h4>
                                <p style="color:blue"class="food-price">₹<?php echo $price; ?></p>
                                <p class="food-price">location: <?php echo $location; ?></p>
                                <p class="food-price">Date: <?php echo $date; ?></p>
                                <p class="food-price">Time: <?php echo $time; ?></p>
                                <p class="food-price">Club: <?php echo $club; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
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
                    //Event Not Available
                    echo "<div class='error'>Event not found.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Event Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>