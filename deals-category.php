      <div class="side-menu side-menu-inner animate-dropdown outer-bottom-xs">
        <div class="head">Categories</div>
          <nav class="yamm megamenu-horizontal">
            <ul class="nav">
              <?php
                //counting sale
                $saleQ = mysqli_query($db, "SELECT id FROM products WHERE sale='yes' ");
                $saleCount = mysqli_num_rows($saleQ);
                if($saleCount>0){
                  echo"
                    <li class=\"menu-item\"> <a href=\"deals-grid.php?sale=yes\">
                    On Sale! 
                      <span style=\"
                        color: #fff;
                        background: #ee4054;
                        padding: 1px 5px;
                        font-size: 11px;
                        margin-left: 2px;
                        border-radius: 2px;
                        vertical-align: top;
                        display: inline-block;
                      \">" . $saleCount . "</span></a></li>
                  ";
                }
              ?>

              <?php
                $catQ = mysqli_query($db, "SELECT * FROM category");
                while ($catRow = mysqli_fetch_assoc( $catQ ) ) {
                  $catId = $catRow['id'];
                  $subCatQ = mysqli_query($db, "SELECT * FROM subcategory WHERE category = '$catId' AND id !=2 ");
                  if(mysqli_num_rows($subCatQ)>0 ) {
                    echo "<li class='dropdown menu-item'> <a href='#' class='dropdown-toggle' data-toggle='dropdown' > ";
                    echo $catRow['name'];
                    echo "</a> \n";
                    echo ("
                            <ul class=\"dropdown-menu mega-menu\">
                              <li class=\"yamm-content\">
                                <!--row started-->
                                  <div class=\"row\"> 
                          ");
                    $subCatCounter = 0;
                    while ($subCatRow = mysqli_fetch_assoc($subCatQ) ) {
                              if($subCatCounter == 0) {
                                echo("
                                    <div class=\"col-sm-12 col-md-3\">
                                      <ul class=\"links list-unstyled\">
                                  ");
                              }
                              echo("
                                <li>
                                <a href=\"deals-grid.php?cat="
                                . $catId .
                                "&subcat="
                                . $subCatRow['id'] .
                                "\">"
                                . $subCatRow['name'] . 
                                "</a></li>\n ");

                              if($subCatCounter == 7){
                                echo("
                                        </ul>
                                     </div>
                                ");
                                $subCatCounter = 0;
                              }
                              else $subCatCounter++;
                    }
                    if($subCatCounter != 0) {
                      echo ("
                                        </ul>
                                     </div>

                        ");
                    }
                    $categoryBanner = $catRow['banner'];
                    if($categoryBanner != ""){
                      echo"
                          <div class=\"dropdown-banner-holder\">
                            <a href=\"/deals-grid.php?cat="
                              . $catId .
                              "\">
                              <img alt=\"\" src=\""
                              . $categoryBanner .
                              "\">
                            </a>
                          </div>
                      ";
                    }
                    echo("
                          </div>
                          <!-- /.row --> 


                          </li>
                          <!-- /.yamm-content -->
                        </ul>
                        <!-- /.dropdown-menu --> </li>
                      <!-- /.menu-item -->

                    ");
                  }
                }
              ?>

              <?php
                $catQ = mysqli_query($db, "SELECT * FROM category");
                while ($catRow = mysqli_fetch_assoc( $catQ ) ) {
                  $catId = $catRow['id'];
                  $subCatQ = mysqli_query($db, "SELECT * FROM subcategory WHERE category = '" . $catId . "' ");
                  if(mysqli_num_rows($subCatQ) == 0 ) {
                    echo("
                      <li class=\"menu-item\"> <a href=\"/deals-grid.php?cat=". $catRow['id'] ."\">". $catRow['name'] ."</a> </li>
                      <!-- /.menu-item -->
                      ");
                  }
                }
              ?>
              
            </ul>
            <!-- /.nav --> 
          </nav>
          <!-- /.megamenu-horizontal --> 
        </div>
      
        <!-- /.side-menu --> 