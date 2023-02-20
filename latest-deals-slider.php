   
      <div id="product-tabs-slider" class="scroll-tabs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">Latest Deals</h3>


            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                    <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
              <?php
                $tabQ = mysqli_query($db, 
                  "SELECT category FROM (SELECT * FROM products ORDER BY dateadded DESC LIMIT 3) as newest
                    GROUP BY category"
                  );
                if(mysqli_num_rows($tabQ)>0){
                  while($tabRow = mysqli_fetch_assoc($tabQ)){
                    $catId = $tabRow['category'];
                    $catQ = mysqli_query($db, "SELECT name FROM category WHERE id=". $catId ." LIMIT 1");
                    $catRow = mysqli_fetch_assoc($catQ);
                    $catName = $catRow['name'];
                    echo"
                      <li><a data-transition-type=\"backSlide\" href=\"#"
                      . $catName .
                      "\" data-toggle=\"tab\">". $catName . "</a></li>
                    ";
                  }
                }
              ?>
            </ul>
            <!-- /.nav-tabs --> 
          </div>


          <!-- TAB CONTENT STARTS -->
          <div class="tab-content outer-top-xs">

            <!-- First Tab Pane: All -->
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">

                  <!-- ITEM START -->

                  <?php
                    $tabItemsQ = mysqli_query($db, "SELECT * FROM products ORDER BY dateadded DESC LIMIT 10");
                    if(mysqli_num_rows($tabItemsQ)>0){
                      while($tabItemsRow = mysqli_fetch_assoc($tabItemsQ)){
                        $catItemsId = $tabItemsRow['category'];
                        $catQ = mysqli_query($db, "SELECT name FROM category WHERE id=". $catId ." LIMIT 1");
                        $catRow = mysqli_fetch_assoc($catQ);
                        $catName = $catRow['name'];
                        $prodId = $tabItemsRow['id'];
                        $prodName = $tabItemsRow['name'];
                        $sale = $tabItemsRow['sale'];
                        $coverUrl = $tabItemsRow['cover'];
                        $vendorId = $tabItemsRow['vendor'];
                        $vendorQ = mysqli_query($db, "SELECT name FROM vendors WHERE id=".$vendorId." LIMIT 1");
                        $vendorRow = mysqli_fetch_assoc($vendorQ);
                        $vendorName = $vendorRow['name'];
                        $price = $tabItemsRow['price'];
                        $oldPrice = $tabItemsRow['oldprice'];
                        $oldPriceOutput = "<span class=\"price-before-discount\">$$oldPrice</span> ";
                        if($oldPrice==0) $oldPriceOutput = "";
                        //calculate rating
                        $ratingQ = mysqli_query($db, "SELECT AVG(quality+price+value) as avg FROM reviews WHERE product = ".$prodId );
                        $ratingRow = mysqli_fetch_assoc($ratingQ);
                        $rating = $ratingRow['avg']/3.0 ;
                        $ratingBlock = "
                          <div class=\"rating rateit-small\" data-rateit-backingfld=\"#$catId$prodId\" ></div>
                            <input type=\"range\" min=\"0\" max=\"5\" value=\"$rating\" step=\"0.10\" id=\"$catId$prodId\">
                          ";
                        $productTag = "";
                        if($sale=="yes") $productTag = "<div class=\"tag sale\"><span>sale</span></div>";
                        else if($price<$oldPrice) {
                          $percentage = (int)((($oldPrice-$price)*100.0)/$oldPrice) ;
                          $productTag = "<div class=\"tag new\"><span>-$percentage% </span></div>";
                        }
                        //PRINTING ITEMS IN HTML
                        echo"
                          <div class=\"item item-carousel\">
                            <div class=\"products\">
                              <div class=\"product\">
                                <div class=\"product-image\">
                                  <div class=\"image\"> 
                                    <a href=\"deals-detail.php?id=$prodId\">
                                      <img src=\"$coverUrl\" alt=\"\"> 
                                    </a> 
                                  </div>
                                  <!-- /.image -->
                                  $productTag
                                </div>
                                <!-- /.product-image -->
                                
                                <div class=\"product-info text-left\">
                                  <div class=\"brand\"> $vendorName </div>
                                  <h3 class=\"name\"><a href=\"deals-detail.php?id=$prodId \">$prodName</a></h3>
                                  $ratingBlock
                                  <div class=\"description\"></div>
                                  <div class=\"product-price\"> <span class=\"price\"> $$price </span> $oldPriceOutput </div>
                                  <!-- /.product-price --> 
                                </div>
                                <!-- /.product-info -->
                                <div class=\"cart clearfix animate-effect\">
                                  <div class=\"action\">
                                    <ul class=\"list-unstyled\">

                                      <li class=\"add-cart-button btn-group\">
                                        <button onclick=\"addToCart('$prodId')\"  data-toggle=\"tooltip\" class=\"btn btn-primary icon\" type=\"button\" title=\"Add Cart\"> <i class=\"fa fa-shopping-cart\"></i> </button>
                                      </li>

                                      <li style=\"display:none\" class=\"lnk wishlist cartprod$prodId\"> 
                                        <a data-toggle=\"tooltip\" class=\"add-to-cart\" href=\"shopping-cart.php\" title=\"View Cart\"> <i class=\"fa fa-check\"></i> 
                                        </a>
                                       </li>
                                      
                                      <li class=\"add-cart-button btn-group\"> <button data-toggle=\"tooltip\" class=\"btn btn-primary icon\" type=\"button\" onclick=\"addToWishlist('$prodId')\"  title=\"Wishlist\"> <i class=\"icon fa fa-heart\"></i> </button> </li>


                                      <li style=\"display:none\" class=\"lnk wishlist wishlistprod$prodId\"> <a data-toggle=\"tooltip\" class=\"add-to-cart\" href=\"my-wishlist.php\" title=\"View Wishlist\"> <i class=\"fa fa-check\"></i> </a> </li>


                                      <li class=\"lnk\"> <a data-toggle=\"tooltip\" class=\"add-to-cart\" href=\"comp-add-remove.php?id=$prodId&add=yes\" title=\"Compare\"> <i class=\"fa fa-signal\" aria-hidden=\"true\"></i> </a> </li>
                                    </ul>
                                  </div>
                                  <!-- /.action --> 
                                </div>
                                <!-- /.cart --> 
                              </div>
                              <!-- /.product --> 
                              
                            </div>
                            <!-- /.products --> 
                          </div>
                          <!-- /.item -->



                        ";
                      }
                    }
                  ?>
                  <!-- ITEM PRINTING ENDED -->

                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            <!-- /.tab-pane -->
            <!-- ALL ENDED -->


            <!-- Tab Pane: Other Tabs -->

                  

                <?php
                      

                  $tabQ = mysqli_query($db, 
                    "SELECT category FROM (SELECT * FROM products ORDER BY dateadded DESC LIMIT 50) as newest
                      GROUP BY category"
                    );
                  while($tabRow = mysqli_fetch_assoc($tabQ)){
                    $catId = $tabRow['category'];
                    $catQ = mysqli_query($db, "SELECT name FROM category WHERE id=". $catId ." LIMIT 1");
                    $catRow = mysqli_fetch_assoc($catQ);
                    $catName = $catRow['name'];
                    echo "
                      <div class=\"tab-pane inactive\" id=\"$catId\">
                        <div class=\"product-slider\">
                          <div class=\"owl-carousel home-owl-carousel custom-carousel owl-theme\">
                    ";

                    $tabItemsQ = mysqli_query($db, "SELECT * FROM products WHERE category=$catId ORDER BY dateadded DESC LIMIT 3");
                    if(mysqli_num_rows($tabItemsQ)>0){
                      while($tabItemsRow = mysqli_fetch_assoc($tabItemsQ)){
                        $catItemsId = $tabItemsRow['category'];
                        $catQ = mysqli_query($db, "SELECT name FROM category WHERE id=". $catId ." LIMIT 1");
                        $catRow = mysqli_fetch_assoc($catQ);
                        $catName = $catRow['name'];
                        $prodId = $tabItemsRow['id'];
                        $prodName = $tabItemsRow['name'];
                        $sale = $tabItemsRow['sale'];
                        $coverUrl = $tabItemsRow['cover'];
                        $vendorId = $tabItemsRow['vendor'];
                        $vendorQ = mysqli_query($db, "SELECT name FROM vendors WHERE id=".$vendorId." LIMIT 1");
                        $vendorRow = mysqli_fetch_assoc($vendorQ);
                        $vendorName = $vendorRow['name'];
                        $price = $tabItemsRow['price'];
                        $oldPrice = $tabItemsRow['oldprice'];
                        $oldPriceOutput = "<span class=\"price-before-discount\">$$oldPrice</span> ";
                        if($oldPrice==0) $oldPriceOutput = "";
                        //calculate rating
                        $ratingQ = mysqli_query($db, "SELECT AVG(quality+price+value) as avg FROM reviews WHERE product = ".$prodId );
                        $ratingRow = mysqli_fetch_assoc($ratingQ);
                        $rating = $ratingRow['avg']/3.0 ;
                        $ratingBlock = "
                          <div class=\"rating rateit-small\" data-rateit-backingfld=\"#own$catId$prodId\" ></div>
                            <input type=\"range\" min=\"0\" max=\"5\" value=\"$rating\" step=\"0.10\" id=\"own$catId$prodId\">
                          ";
                        $productTag = "";
                        if($sale=="yes") $productTag = "<div class=\"tag sale\"><span>sale</span></div>";
                        else if($price<$oldPrice) {
                          $percentage = (int)((($oldPrice-$price)*100.0)/$oldPrice) ;
                          $productTag = "<div class=\"tag new\"><span>-$percentage% </span></div>";
                        }
                        //PRINTING ITEMS IN HTML
                        echo"
                          <div class=\"item item-carousel\">
                            <div class=\"products\">
                              <div class=\"product\">
                                <div class=\"product-image\">
                                  <div class=\"image\"> 
                                    <a href=\"deals-detail.php?id=$prodId\">
                                      <img src=\"$coverUrl\" alt=\"\"> 
                                    </a> 
                                  </div>
                                  <!-- /.image -->
                                  $productTag
                                </div>
                                <!-- /.product-image -->
                                
                                <div class=\"product-info text-left\">
                                  <div class=\"brand\"> $vendorName </div>
                                  <h3 class=\"name\"><a href=\"deals-detail.php?id=$prodId \">$prodName</a></h3>
                                  $ratingBlock
                                  <div class=\"description\"></div>
                                  <div class=\"product-price\"> <span class=\"price\"> $$price </span> $oldPriceOutput </div>
                                  <!-- /.product-price --> 
                                </div>
                                <!-- /.product-info -->
                                <div class=\"cart clearfix animate-effect\">
                                  <div class=\"action\">
                                    <ul class=\"list-unstyled\">

                                      <li class=\"add-cart-button btn-group\">
                                        <button data-toggle=\"tooltip\" class=\"btn btn-primary icon cartprod$prodId\" type=\"button\" title=\"Add Cart\" onclick=\"addToCart('$prodId')\"> <i class=\"fa fa-shopping-cart\"></i> </button>
                                      </li>
                                      <li style=\"display:none\" class=\"lnk wishlist cartprod$prodId\"> 
                                        <a data-toggle=\"tooltip\" class=\"add-to-cart\" href=\"shopping-cart.php\" title=\"View Cart\"> <i class=\"fa fa-check\"></i> 
                                        </a>
                                       </li>
                                      

                                      <li  class=\"lnk wishlist\"> <a onclick=\"addToWishlist('$prodId')\"  data-toggle=\"tooltip\" class=\"add-to-cart\" title=\"Wishlist\"> <i class=\"icon fa fa-heart\"></i> </a> </li>
                                      <li style=\"display:none\" class=\"lnk wishlist wishlistprod$prodId\"> <a data-toggle=\"tooltip\" class=\"add-to-cart\" href=\"deals-detail.php\" title=\"Wishlist\"> <i class=\"fa fa-check\"></i> </a> </li>

                                      <li class=\"lnk\"> <a data-toggle=\"tooltip\" class=\"add-to-cart\" href=\"deals-detail.php\" title=\"Compare\"> <i class=\"fa fa-signal\" aria-hidden=\"true\"></i> </a> </li>

                                    </ul>
                                  </div>
                                  <!-- /.action --> 
                                </div>
                                <!-- /.cart --> 
                              </div>
                              <!-- /.product --> 
                              
                            </div>
                            <!-- /.products --> 
                          </div>
                          <!-- /.item -->



                        ";
                      }
                    }
                    echo "
                      <!-- ITEM PRINTING ENDED -->

                            </div>
                          <!-- /.home-owl-carousel --> 
                        </div>
                        <!-- /.product-slider --> 
                      </div>
                      <!-- /.tab-pane -->
                    ";
                  }
                ?>


                <!-- Others TAB ENDED -->
            
            
          </div>
          <!-- /.tab-content --> 
        </div>
        <!-- /.scroll-tabs --> 