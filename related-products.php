        <section class="section wow fadeInUp">
          <h3 class="section-title">Related Products</h3>
          
          <div class="new-arriavls">
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">

          <?php
            $tabItemsQ = mysqli_query($db, "SELECT * FROM products WHERE category=$catId ORDER BY dateadded DESC");
              if(mysqli_num_rows($tabItemsQ)>0){
                while($tabItemsRow = mysqli_fetch_assoc($tabItemsQ)){
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
                    <div class=\"rating rateit-small\" data-rateit-backingfld=\"#own$catName$prodId\" ></div>
                      <input type=\"range\" min=\"0\" max=\"5\" value=\"$rating\" step=\"0.10\" id=\"own$catName$prodId\">
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
                                  <button data-toggle=\"tooltip\" class=\"btn btn-primary icon\" type=\"button\" title=\"Add Cart\"> <i class=\"fa fa-shopping-cart\"></i> </button>
                                  <button class=\"btn btn-primary cart-btn\" type=\"button\">Add to cart</button>
                                </li>
                                <li class=\"lnk wishlist\"> <a data-toggle=\"tooltip\" class=\"add-to-cart\" href=\"deals-detail.php\" title=\"Wishlist\"> <i class=\"icon fa fa-heart\"></i> </a> </li>
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
            ?>


          </div>
          <!-- /.home-owl-carousel --> 
          </div>
        </section>
        <!-- /.section --> 