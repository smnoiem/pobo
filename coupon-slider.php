    <?php
      $curDate = date("Y-m-d");
      $cpnQ = mysqli_query($db, "SELECT * FROM coupons WHERE end>$curDate");
      if(mysqli_num_rows($cpnQ)>0){
        echo "
          <section class=\"section coupons-section\">
            <div class=\"container\">
              <h3 class=\"section-title\">Latest Coupons</h3>
              
              <div class=\"coupons-deals\">
              <div class=\"owl-carousel home-owl-carousel1 custom-carousel owl-theme outer-top-xs\">
          ";
        $cpnCount=0;
        while($cpnRow = mysqli_fetch_assoc($cpnQ)){
              if($cpnCount==0) echo "<div class=\"item item-carousel\">";
              $cpnId = $cpnRow['id'];
              $cpnTitle = $cpnRow['title'];
              $cpnType = $cpnRow['type'];
              $cpnOff = $cpnRow['off'];
              $cpnEnd = $cpnRow['end'];
              $cpnCode = $cpnRow['code'];
              $cpnIcon = $cpnRow['icon'];
              $cpnApplicableTo = $cpnRow['applicableto'];
              $cpnDealLink = $cpnRow['deallink'];
              echo"
                <div class=\"products\">
                  <div class=\"product\">
                    <div class=\"product-image\">
                      <div class=\"image\"> 
                       <img class=\"img-responsive\" src=\"$cpnIcon\" alt=\"\">
                      <div class=\"brand\">$cpnApplicableTo</div>
                             <h3 class=\"name\"><a href=\"$cpnDealLink\">$cpnTitle</a></h3>
                            
                            </div>
                      <!-- /.image -->
                      
                   
                    </div>
                    <!-- /.product-image -->
                    
                    <div class=\"product-info text-left\">
                   <div class=\"discount\">$cpnOff% <span>OFF</span></div>
                   <div class=\"show-code\"><a href=\"#\" data-toggle=\"modal\" data-target=\"#modal$cpnId\">Show Code</a></div>
                    <p class=\"exp-date\"><i class=\"fa fa-clock-o\"></i> Expires on $cpnEnd</p>  
                    </div>
            
                  </div>
                  <!-- /.product --> 
                  
                </div>
                <!-- /.products --> 
              ";


              if($cpnCount==1){
                $cpnCount = 0;
                echo "
                  </div>
                  <!-- /.item -->
                ";
              }
              else $cpnCount=1;
              
        //first while ended PRINTING COUPON CARD
        }
        if($cpnCount==1){
          echo "
            </div>
            <!-- /.item -->
          ";
        }
        echo"
            </div>
            
            </div>
            
           </div>
        ";

      $cpnQ = mysqli_query($db, "SELECT * FROM coupons WHERE end>$curDate");
      if(mysqli_num_rows($cpnQ)>0){
        while($cpnRow = mysqli_fetch_assoc($cpnQ)){
              $cpnId = $cpnRow['id'];
              $cpnTitle = $cpnRow['title'];
              $cpnDescription = $cpnRow['description'];
              $cpnType = $cpnRow['type'];
              $cpnOff = $cpnRow['off'];
              $cpnEnd = $cpnRow['end'];
              $cpnCode = $cpnRow['code'];
              $cpnIcon = $cpnRow['icon'];
              $cpnApplicableTo = $cpnRow['applicableto'];
              $cpnDealLink = $cpnRow['deallink'];
              $cpnStoreLink = $cpnRow['storelink'];
              $cpnStoreLinkBlock = "";
              if($cpnStoreLink != "") 
                $cpnStoreLinkBlock = "
                  <span style=\"color: #ed6663; display:block; margin-top:10px;\">
                    <a style=\"color: #ed6663; text-decoration:underline\" href=\"$cpnStoreLink\" target=\"_blank\">Visit our Store</a>
                  </span>
                  ";
              echo"
                 <!-- Modal -->
                  <div id=\"modal$cpnId\" class=\"modal fade\" role=\"dialog\">
                    <div class=\"modal-dialog\">
                      <!-- Modal content-->
                      <div class=\"modal-content\">
                        <div class=\"modal-body\">
                          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                          <div>
                            <img class=\"img-responsive\" src=\"$cpnIcon\" alt=\"\">
                            <h3 class=\"mb-20\">$cpnTitle</h3>
                            <div class=\"coupon-content\">$cpnDescription
                              $cpnStoreLinkBlock
                            </div>

                          </div>
                          <div>
                            <h6 class=\"color-mid\">Click below to get your coupon code</h6>
                            <div class=\"copy-coupon-wrap\">
                              <input type=\"text\" value=\"$cpnCode\" id=\"$cpnCode\" class=\"coupon-code\">
                            </div>
                          </div>
                        </div>
                        
                        <div class=\"modal-footer\">
                          <h4>Subscribe to Mail</h4>
                          <p>Get our Daily email newsletter with Special Services, Updates, Offers and more!</p>
                          <form id=\"mc4wp-form-2\" class=\"mc4wp-form mc4wp-form-1257\" method=\"post\" data-id=\"1257\" data-name=\"dealdots\">
                            <div class=\"mc4wp-form-fields\">
                              <div id=\"container_form_news\">
                                <div id=\"container_form_news2\">
                                  <input type=\"email\" id=\"newsletter1\" name=\"EMAIL\" placeholder=\"Your email address\" required>
                                  <button type=\"submit\" class=\"button subscribe\"><span>Subscribe</span></button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                       
                      </div>
                      <!-- /.modal-content -->

                    </div>
                  </div>
                  <!-- /.my-modal -->
              ";
              //MODAL PRINTING ENDED
              }
            }

         


          
        
        echo "
          </section>
            <!-- /.section --> 
        ";
      }
    ?>