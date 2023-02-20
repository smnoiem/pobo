<?php
  $blogQ = mysqli_query($db, "SELECT * FROM blog ORDER BY postedon DESC LIMIT 10");
  if(mysqli_num_rows($blogQ)>0){
    echo"
        <section class=\"section blog-section outer-bottom-xs wow fadeInUp\">
          <h3 class=\"section-title\">Latest form Blog</h3>
          <div class=\"latest-blog\">
          <div class=\"blog-slider-container outer-top-xs\">
            <div class=\"owl-carousel blog-slider custom-carousel\">
    ";

              //<!-- BLOG ITEMS STARTED -->
    while ($blogRow = mysqli_fetch_assoc($blogQ)) {
      $blgId = $blogRow['id'];
      $blgCover = $blogRow['cover'];
      $blgTitle = $blogRow['title'];
      $blgAuthorId = $blogRow['userid'];
      $userQ = mysqli_query($db, "SELECT fname FROM users WHERE id=$blgAuthorId LIMIT 1");
      $userRow = mysqli_fetch_assoc($userQ);
      $blgAuthor = $userRow['fname'];
      $blgDateStr = $blogRow['postedon'];
      $blgDate = date("d F Y", strtotime($blgDateStr));
      echo"
              <div class=\"item\">
                <div class=\"blog-post\">
                  <div class=\"blog-post-image\">
                    <div class=\"image\"> <a href=\"blog.php?id=$blgId\"><img src=\"$blgCover\" alt=\"\"></a> </div>
                  </div>
                  <!-- /.blog-post-image -->
                  
                  <div class=\"blog-post-info text-left\">
                    <h3 class=\"name\"><a href=\"blog.php?id=$blgId\">$blgTitle</a></h3>
                    <span class=\"info\">$blgAuthor &nbsp;|&nbsp; $blgDate </span>
                    <p class=\"text\">Sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                   </div>
                  <!-- /.blog-post-info --> 
                  
                </div>
                <!-- /.blog-post --> 
              </div>
              <!-- /.item -->
      ";
    }
              //<!-- ITEMS PRINTING ENDED -->
              
    echo"
            </div>
            <!-- /.owl-carousel --> 
          </div>
          <!-- /.blog-slider-container --> 
          </div>
        </section>
        <!-- /.section -->
    ";
  }
?>