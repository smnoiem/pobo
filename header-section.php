<?php
  include("dbcon.php");
  if(isset($_SESSION['id'])) $accLink = "<li><a href=\"/dashboard.php\"><i class=\"icon fa fa-user\"></i>My Account</a></li><li><a href=\"/logout.php\"><i class=\"icon fa fa-user\"></i>Sign Out</a></li>";
  else $accLink = "<li><a href=\"/sign-in.php\"><i class=\"icon fa fa-user\"></i>Sign In</a></li>";
  $preDataArr=array();
  if(isset($_COOKIE['cart'])){
    $preData = stripcslashes($_COOKIE['cart']);
    $preDataArr = json_decode($preData, true);
  }
  $cartDatah = array();
  $icarth=0;
  $subTotal=0;
  foreach ($preDataArr as $key => $value) {
    if($key==""||$value=="") {
      continue;
    }
    $prodQ = mysqli_query($db, "SELECT * FROM products WHERE id='$key' ");
    if(mysqli_num_rows($prodQ)>0){
      $icarth++;
      $cartDatah[$icarth] = array();
      $prodRow = mysqli_fetch_assoc($prodQ);
      $cartDatah[$icarth]['id'] = $prodRow['id'];
      $cartDatah[$icarth]['name'] = $prodRow['name'];
      $cartDatah[$icarth]['cover'] = $prodRow['cover'];
      $cartDatah[$icarth]['price'] = (double)($prodRow['price']);
      $cartDatah[$icarth]['quantity'] = (double)($value);
      $cartDatah[$icarth]['subtotal'] =  ($cartDatah[$icarth]['price']*$cartDatah[$icarth]['quantity']);
      $subTotal += $cartDatah[$icarth]['subtotal'];
      $cartDatah[$icarth]['oldprice'] = $prodRow['oldprice'];
      $cartDatah[$icarth]['description'] = $prodRow['description'];
      $cartDatah[$icarth]['available'] = $prodRow['available'];
      $cartDatah[$icarth]['vendor'] = $prodRow['vendor'];
      $cartDatah[$icarth]['category'] = $prodRow['category'];
      $cartDatah[$icarth]['subcategory'] = $prodRow['subcategory'];
    }
  }
?>


<header class="header-style-1"> 
  
  <!-- ============================================== TOP MENU ============================================== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
            <?=$accLink?>
            <li><a href="/my-wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
            <li><a href="/shopping-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
            <li><a href="/checkout.php"><i class="icon fa fa-check"></i>Checkout</a></li>
            <li><a href="/sign-in.php"><i class="icon fa fa-lock"></i>Become a Vendor</a></li>
          </ul>
        </div>
        <!-- /.cnt-account -->
        
        <div class="cnt-block">
          <ul class="list-unstyled list-inline">
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">USD</a></li>
                <li><a href="#">INR</a></li>
                <li><a href="#">GBP</a></li>
              </ul>
            </li>
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">English</a></li>
                <li><a href="#">French</a></li>
                <li><a href="#">German</a></li>
              </ul>
            </li>
          </ul>
          <!-- /.list-unstyled --> 
        </div>
        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.header-top --> 
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 logo-holder"> 
          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo"> <a href="home.php"> <img src="assets/images/logo.png" heigh="37" width="176" alt="logo"> </a> </div>
          <!-- /.logo --> 
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->
        
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 top-search-holder"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form>
              <div class="control-group">
                  <input class="search-field" placeholder="Search here..." />
                <a class="search-button" href="#" ></a> </div>
            </form>
          </div>
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
         <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 navmenu"> 
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="dropdown"> <a href="#"  class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Deals</a> 
                 <ul class="dropdown-menu pages">
                    <li>
                      <div class="yamm-content">
                        <div class="row">
                          <div class="col-xs-12 col-menu">
                            <ul class="links">
                              <li><a href="deals-grid.php">Grid/List View</a></li>
                              <li><a href="deals-detail.php">Deal Detail</a></li>
                              </ul>
                              </div>
                              </div>
                              </div>
                              </li>
                              </ul>
                
                </li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Coupons</a> 
                <ul class="dropdown-menu pages">
                    <li>
                      <div class="yamm-content">
                        <div class="row">
                          <div class="col-xs-12 col-menu">
                            <ul class="links">
                              <li><a href="coupons.php">Coupons Grid</a></li>
                              <li><a href="coupons-sidebar.php">Grid Sidebar</a></li>
                              </ul>
                              </div>
                              </div>
                              </div>
                              </li>
                              </ul>
                </li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Stores</a> 
                <ul class="dropdown-menu pages">
                    <li>
                      <div class="yamm-content">
                        <div class="row">
                          <div class="col-xs-12 col-menu">
                            <ul class="links">
                              <li><a href="stores.php">Stores Grid</a></li>
                              <li><a href="store-detail.php">Store Details</a></li>
                              </ul>
                              </div>
                              </div>
                              </div>
                              </li>
                              </ul>
                </li>
                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
                  <ul class="dropdown-menu pages">
                    <li>
                      <div class="yamm-content">
                        <div class="row">
                          <div class="col-xs-12 col-menu">
                            <ul class="links">
                              <li><a href="home.php">Home</a></li>
                              <li><a href="deals-grid.php">Shop</a></li>
                                 <li><a href="shopping-cart.php">Shopping Cart Summary</a></li>
                              <li><a href="checkout.php">Checkout</a></li>
                              <li><a href="blog.php">Blog</a></li>
                              <li><a href="blog-details.php">Blog Detail</a></li>
                              <li><a href="contact.php">Contact</a></li>
                              <li><a href="sign-in.php">Sign In</a></li>
                              <li><a href="my-wishlist.php">Wishlist</a></li>
                              <li><a href="terms-conditions.php">Terms and Condition</a></li>
                              <li><a href="track-orders.php">Track Orders</a></li>
                              <li><a href="product-comparison.php">Product-Comparison</a></li>
                              <li><a href="faq.php">FAQ</a></li>
                              <li><a href="404.php">404</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
            
              </ul>
              <!-- /.navbar-nav -->
              <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer --> 
          </div>
          <!-- /.navbar-collapse --> 
          
        </div>
        <!-- /.nav-bg-class --> 
      </div>
      <!-- /.navbar-default --> 
      <div class="top-cart-row"> 
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
          
          <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
            <div class="items-cart-inner">
              <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
              <div class="basket-item-count"><span class="count"><?=$icarth?></span></div>
              <div class="total-price-basket"> <span class="lbl">My Cart</span>  </div>
            </div>
            </a>
            <ul class="dropdown-menu">
              <li>

              <?php
                for($jcarth=1; $jcarth<=$icarth; $jcarth++){
                  echo'
                    <div class="cart-item product-summary">
                      <div class="row">
                        <div class="col-xs-4">
                          <div class="image"> <a href="deals-detail.php?id='.$cartDatah[$jcarth]['id'].'"><img src="'.$cartDatah[$jcarth]['cover'].'" alt=""></a> </div>
                        </div>
                        <div class="col-xs-7">
                          <h3 class="name"><a href=/deals-detail.php?id="'.$cartDatah[$jcarth]['id'].'">'.$cartDatah[$jcarth]['name'].'</a></h3>
                          <div class="price">$'.$cartDatah[$jcarth]['price'].'</div>
                        </div>

                        <div class="col-xs-1 action"> <a href="" id="rmv'
                        .$cartDatah[$jcarth]['id'].
                        '"
                        onclick="removeFromCart('
                        .$cartDatah[$jcarth]['id'].
                        ')"
                        ><i class="fa fa-trash"></i></a> </div>
                      </div>
                    </div>
                    <!-- /.cart-item -->
                  ';
                }
              ?>

              <?php
                if($icarth>0){
                  echo'
                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix cart-total">
                      <div class="pull-right"> <span class="text">Sub Total :</span><span class="price">$'.$subTotal.'</span> </div>
                      <div class="clearfix"></div>
                       <a href="shopping-cart.php" class="btn btn-upper btn-primary btn-block m-t-20">View Cart</a>
                      <a href="checkout.php" class="btn btn-upper btn-primary btn-block m-t-20 btn-check">Checkout</a> </div>
                    <!-- /.cart-total--> 
                  ';
                }
                else echo'
                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix cart-total">
                      <div class="pull-right"> <span class="text">Your Cart is Empty</span> </div>
                      <div class="clearfix"></div>
                       <a href="deals-grid.php" class="btn btn-upper btn-primary btn-block m-t-20">Go to shop</a>
                    </div>
                    <!-- /.cart-total--> 

                  ';
              ?>
                
              </li>
            </ul>
            <!-- /.dropdown-menu--> 
          </div>
          <!-- /.dropdown-cart --> 
          
          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
    </div>
    <!-- /.container-class --> 
    

        
        </div>
    
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
    
  </div>
  <!-- /.main-header --> 
  
 
  
</header>