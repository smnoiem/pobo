<?php 
  include("dbcon.php");
  if(isset($_GET['cat'])) $cat=$_GET['cat'];
  if(isset($_GET['subcat'])) $subcat=$_GET['subcat'];
  if(isset($_GET['searchKey'])) $searchKey = $_GET['searchKey'];

?>
      <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
        <div class="sidebar-module-container">

					<div class="search-area outer-bottom-small">
						<form action="blog.php" method="GET">
			        <div class="control-group">
                  <input type="text" name="searchKey" 
                  <?php echo (($searchKey=="")?"placeholder=\"Search in blog..\"":"value=\"$searchKey\"");  ?>
                   class="search-field">
                  <input type="hidden" name="cat" value="<?=$cat?>">
                  <input type="hidden" name="subcat" value="<?=$subcat?>">
			            <input type="hidden" class="search-button" value="Search">   
			        </div>
						</form>
					</div>		

          <?php
            $sidebarBannerQ = mysqli_query($db, "SELECT * FROM blogsidebanner WHERE publish = 'yes' LIMIT 1");
            if(mysqli_num_rows($sidebarBannerQ)>0){
              while ($bannerRow = mysqli_fetch_assoc($sidebarBannerQ)) {
                $bsBanner = $bannerRow['banner'];
                $bsAddress = $bannerRow['address'];
                $bsImg = "";
                if($bsAddress=="") $bsImg = "
                  <div class=\"home-banner outer-top-n outer-bottom-xs\"><img src=\"$bsBanner\" alt=\"\" class=\"img-responsive\"> </div>
                ";
                else $bsImg = "
                  <div class=\"home-banner outer-top-n outer-bottom-xs\"> <a href=\"$bsAddress\" target=\"_blank\"> <img src=\"$bsBanner\" alt=\"\" class=\"img-responsive\"></a> </div>
                  ";

                echo $bsImg;
              }
            }
          ?>
					<!-- ==============================================CATEGORY============================================== -->

					<div class="sidebar-widget outer-bottom-xs">
						<h3 class="section-title">Category</h3>
						<div class="sidebar-widget-body m-t-10">
							<div class="accordion">

                <?php
                $catQ = mysqli_query($db, "SELECT * FROM category");
                while ($catRow = mysqli_fetch_assoc( $catQ ) ) {
                  $catId = $catRow['id'];
                  $catName = $catRow['name'];
                  $subCatQ = mysqli_query($db, "SELECT * FROM subcategory WHERE category = '$catId' AND id !=2 ");
                  if(mysqli_num_rows($subCatQ)>0 ) {
                    echo"
                      <div class=\"accordion-group\">
                        <div class=\"accordion-heading\">
                            <a href=\"#collapse$catId\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
                               $catName
                            </a>
                        </div><!-- /.accordion-heading -->
                    ";
                    echo"
                      <div class=\"accordion-body collapse\" id=\"collapse$catId\" style=\"height: 0px;\">
                            <div class=\"accordion-inner\">
                                <ul>
                    ";
                    while ($subCatRow = mysqli_fetch_assoc($subCatQ) ) {
                      $subCatId = $subCatRow['id'];
                      $subCatName = $subCatRow['name'];
                      echo"
                        <li><a href=\"blog.php?cat=$catId&subcat=$subCatId\">$subCatName</a></li>
                      ";
                    }
                    echo"

                                </ul>
                            </div><!-- /.accordion-inner -->
                        </div><!-- /.accordion-body -->

                    ";
                    echo("
                          </div><!-- /.accordion-group -->
                    ");
                  }
                }
              ?>

              <?php
                $catQ = mysqli_query($db, "SELECT * FROM category");
                while ($catRow = mysqli_fetch_assoc( $catQ ) ) {
                  $catId = $catRow['id'];
                  $catName = $catRow['name'];
                  $subCatQ = mysqli_query($db, "SELECT * FROM subcategory WHERE category = '$catId' AND id !=2 ");
                  if(mysqli_num_rows($subCatQ)==0 ) {
                    echo"
                      <div class=\"accordion-group\">
                        <div class=\"accordion-heading\">
                            <a href=\"/blog.php?cat=$catId\"  class=\"accordion-toggle collapsed\">
                               $catName
                            </a>
                        </div><!-- /.accordion-heading -->
                    ";
                    echo("
                          </div><!-- /.accordion-group -->
                    ");
                  }
                }
              ?>

						    </div><!-- /.accordion -->
						</div><!-- /.sidebar-widget-body -->
					</div><!-- /.sidebar-widget -->
						<!-- ============================================== CATEGORY : END ============================================== -->		

					<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
					  <h3 class="section-title">Recent Posts</h3>
            <!--
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#popular" data-toggle="tab">popular post</a></li>
						  <li class="active"><a href="#recent" data-toggle="tab">recent post</a></li>
						</ul>
            -->
						<div class="tab-content" style="padding-left:0">
              <!-- Popular pane is commented out. Develop it later
						  <div class="tab-pane active m-t-20" id="popular">
								<div class="blog-post inner-bottom-30 " >
									<img class="img-responsive" src="assets/images/blog-post/blog_big_01.jpg" alt="">
									<h4><a href="blog-details.html">Powerful and flexible premium Ecommerce themes</a></h4>
										<span class="review">6 Comments</span>
									<span class="date-time">12/06/19</span>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
									
								</div>
								<div class="blog-post" >
									<img class="img-responsive" src="assets/images/blog-post/blog_big_02.jpg" alt="">
									<h4><a href="blog-details.html">Awesome template with lot's of features on the board!</a></h4>
									<span class="review">6 Comments</span>
									<span class="date-time">23/06/19</span>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
									
								</div>
							</div>
            -->

							<div class="tab-pane active m-t-20" id="recent">
                <?php
                  $recentPostQ = mysqli_query($db, "SELECT * FROM blog ORDER BY postedon DESC LIMIT 3");
                  if(mysqli_num_rows($recentPostQ)>0){
                    while($postRow = mysqli_fetch_assoc($recentPostQ)){
                      $cover = $postRow['cover'];
                      $title = $postRow['title'];
                      $postId = $postRow['id'];
                      $postedOn = $postRow['postedon'];
                      $postBody = $postRow['postbody'];
                      if(strlen($postBody)>100) $postBody = substr($postBody, 0, 99) . "...";
                      $cmtQ = mysqli_query($db, "SELECT id FROM blogcomments WHERE postid='$postId' ");
                      $cmtNum = 0;
                      $cmtNum = mysqli_num_rows($cmtQ);
                      echo"
        								<div class=\"blog-post\">
        									<img class=\"img-responsive\" src=\"$cover\" alt=\"\">
        									<h4><a href=\"blog-details.php?id=$postId\">$title</a></h4>
        									<span class=\"review\">$cmtNum Comments</span>
        									<span class=\"date-time\">$postedOn</span>
        									<p>$postBody</p>
        								</div>
                      ";
                    }
                  }
                  else echo"<h4>No Posts Found!</h4>";
                ?>

							</div><!-- tab pane -->
						</div><!-- tab content -->
					</div><!-- sidebar widget -->
						<!-- ============================================== PRODUCT TAGS ============================================== -->
        <!-- PRODUCT TAGS' HIDDEN, DEVELOP IT LATER
					<div class="sidebar-widget product-tag wow fadeInUp">
						<h3 class="section-title">Product Tags</h3>
						<div class="sidebar-widget-body outer-top-xs">
							<div class="tag-list">					
								<a class="item" title="Phone" href="category.html">Phone</a>
								<a class="item active" title="Vest" href="category.html">Vest</a>
								<a class="item" title="Smartphone" href="category.html">Smartphone</a>
								<a class="item" title="Furniture" href="category.html">Furniture</a>
								<a class="item" title="T-shirt" href="category.html">T-shirt</a>
								<a class="item" title="Sweatpants" href="category.html">Sweatpants</a>
								<a class="item" title="Sneaker" href="category.html">Sneaker</a>
								<a class="item" title="Toys" href="category.html">Toys</a>
								<a class="item" title="Rose" href="category.html">Rose</a>
							</div><\!-- /.tag-list --\>
						</div><\!-- /.sidebar-widget-body --\>
					</div><\!-- /.sidebar-widget --\>
        -->
					<!-- ============================================== PRODUCT TAGS : END ============================================== -->					
				</div><!-- /.sidebar-module-container -->
            
      </div>