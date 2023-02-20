<?php
  $testimQ = mysqli_query($db, "SELECT * FROM testimonials WHERE publish = 'yes' ");
  if(mysqli_num_rows($testimQ)>0){
    echo"
            <div class=\"sidebar-widget  wow fadeInUp outer-top-vs  animated\" style=\"visibility: visible; animation-name: fadeInUp;\">
              <div id=\"advertisement\" class=\"advertisement owl-carousel owl-theme\" style=\"opacity: 1; display: block;\">
                <div class=\"owl-wrapper-outer\">
                  <div class=\"owl-wrapper\" style=\"width: 1338px; left: 0px; display: block;\">
    ";
    while($testimRow = mysqli_fetch_assoc($testimQ)){
      $tid = $testimRow['id'];
      $tauthor = $testimRow['author'];
      $tcompany = $testimRow['company'];
      $tstatement = $testimRow['statement'];
      $tphoto = $testimRow['photo'];
      echo"
                    <div class=\"owl-item\" style=\"width: 223px;\">
                      <div class=\"item\">
                        <div class=\"avatar\"><img src=\"$tphoto\" alt=\"Image\"></div>
                        <div class=\"testimonials\"><em>\"</em> $tstatement<em>\"</em></div>
                        <div class=\"clients_author\">$tauthor <span>$tcompany</span> </div>
                        <!-- /.container-fluid --> 
                      </div>
                    </div>
                    <!-- item -->
      ";
    }
    echo"
                  </div>
                  <!-- /.owl-wrapper -->
                </div>
                <!-- /.owl-wraper-outer -->
              <div class=\"owl-controls clickable\">
                <div class=\"owl-pagination\">
                  <div class=\"owl-page active\"><span class=\"\"></span></div>
                  <div class=\"owl-page\"><span class=\"\"></span></div>
                  <div class=\"owl-page\"><span class=\"\"></span></div>
                </div>
                <div class=\"owl-buttons\">
                  <div class=\"owl-prev\"></div>
                  <div class=\"owl-next\"></div>
                </div>
              </div>

            </div>
            <!-- /.owl-carousel --> 
          </div>
          <!-- /.sidebar widget -->
    ";
  }
?>