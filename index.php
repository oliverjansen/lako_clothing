<?php
	include_once 'header.php';
	include_once 'includes/dbh.inc.php';
?>
  

  
   

    <!-- ##### start of the body ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url(img/bg-img/bg-1.png);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    
                </div>
            </div>
        </div>
    </section>
   
    <!-- ##### ALL PRODUCTS ##### -->
	
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>All Products</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">

						<?php
						$query = "SELECT * FROM tbl_product";
						$result = mysqli_query($conn, $query);
						if(mysqli_num_rows($result) > 0)
						{
							while($row = mysqli_fetch_array($result))
							{
						?>
						
						<!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="img/product-img/<?php echo $row["image"]; ?>" alt="">
                             

                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span></span>

                                    <h6><?php echo $row["name"]; ?></h6>
                              
                                <p class="product-price"><?php echo number_format($row["price"]); ?></p>

                             
                                
                            </div>
                        </div>
						
					<?php
							}
						}
					?>
						
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
 
	
<?php
	include_once 'footer.php';
?>
 <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
	<!-- Plugins js -->
    <script src="js/plugins.js"></script>
	<!-- Classy Nav js -->
    <script src="js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
