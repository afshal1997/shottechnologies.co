
<div id="wrapper-inner">
<div id="scroll-down">
  <span class="arrow-down">
  <!-- css generated icon -->
  </span>
  <span id="scroll-title">
    Back To Top
  </span>
</div>
  </div>

 <div class="footer parbase aem-GridColumn aem-GridColumn--default--12">
    <footer>
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <a class="footer-logo" href="/">
                            <img class="w-100" src="./assets/images/footer-logo.png">
                        </a>
                        <br>
                        <div class="social-links">
                            <ul>
                                <li>
                                    <a title="Facebook" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" href="https://www.facebook.com/Shot-Technologies-Pvt-Ltd-108207918017087">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                               
                                <li>
                                    <a title="instagram" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" href="https://www.instagram.com/shottechnologies/">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <h3 class="ftr-head mt-xs-20">Company</h3>

                        <ul class="list-unstyled footer-txt">
                              <li> <a href="/" title="Home">Home</a> </li>
                           <li> <a href="about.php" title="About Shot technologies">About Us</a> </li>
                           <li> <a href="ourservices.php" title="Our Services">Our Services</a> </li>
                             <li> <a href="ourportfolio.php" title="Our Portfolio">Our Portfolio</a> </li>
                              <li> <a href="contactus.php" title="Contact Us">Contact Us</a> </li>
                            <!--<li> <a href="career.php" title="Career">Careers</a> </li>-->
                            <!--<li> <a href="blog.php" title="Blog">Blog</a> </li>-->
                        </ul>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <h3 class="ftr-head mt-xs-20">Services</h3>

                        <ul class="list-unstyled footer-txt">
                            <li><a href="creative-design.php">Creative & Design</a></li>
                            <li><a href="web-development.php">Web Development</a></li>
                            <li><a href="digital-marketing.php">Digital Marketing</a></li>
                            <li><a href="app-development.php">App Development</a></li>
                            <li><a href="video-animation.php">Video Animation</a></li>
                            <li><a href="content-writing.php">Content Writing</a></li>
                        </ul>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <h3 class="ftr-head mt-sm-20 mt-xs-20">Support</h3>

                        <ul class="list-unstyled footer-txt">
                            <!--<li><a href="javascript:void(0)">Terms & Condition</a></li>-->
                            <li><a href="privacy-policy.php">Privacy Policy</a></li>
                        </ul>
                    </div>

                </div>

            </div>
             <div class="container-fluid ptb15" style="background: #eee;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center footer-tag">
                            <p>Copyright © 2021 Shot Technologies Limited</p>
                        </div>
                    </div>
                </div>
            </div>
    </footer>
</div>
</div>
</div>

        <script type="text/javascript" src="clientlibs/clientlibs/granite/jquery.js"></script>
        <script type="text/javascript" src="clientlibs/clientlibs/granite/utils.js"></script>
        <script type="text/javascript" src="clientlibs/clientlibs/granite/legacy/shared.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </div>
    <script type="text/javascript">
        window.$ = jQuery.noConflict();

        function OptanonWrapper() {}
        //
        $(document).ready(function() {
            AOS.init({
                    duration: 1200,
                })
                //
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();

                //>=, not <=
                if (scroll >= 500) {
                    //clearHeader, not clearheader - caps H
                    $("body").addClass("active_headers");
                }
            }); //missing );

        });
        
        var btn = $('#wrapper-inner');

        $(window).scroll(function() {
          if ($(window).scrollTop() > 300) {
            btn.addClass('show');
          } else {
            btn.removeClass('show');
          }
        });
        
        btn.on('click', function(e) {
          e.preventDefault();
          $('html, body').animate({scrollTop:0}, '300');
        });
        
    </script>
    <?php 
        if($page != 'index'){
                ?>
                <!--Inner Js-->
                <script src="inner/js/jquery-3.2.1.min.js"></script>
                <script src="inner/js/jquery-migrate-3.0.1.min.js"></script>
                <script src="inner/js/popper.min.js"></script>
                <script src="inner/js/jquery.waypoints.min.js"></script>
                <script src="inner/js/jquery.stellar.min.js"></script>
                <script src="inner/js/main.js"></script>
                <script src="assets/js/mouse-cursor.js"></script>
                <?php
        }
    ?>
</body>

</html>