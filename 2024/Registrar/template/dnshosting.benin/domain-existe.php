<?php
session_start() 
//$dn = "";
      //$dn = $_SESSION['domain'];

 ?>

<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="BREED HOSTING">
      <meta name="author" content="coodiv (https://themeforest.net/user/coodiv)">
      <link rel="icon" href="favicon.png">
      <title>DNS Hosting | domains existe</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/animate.css">
      <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
      <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="font/flaticon.css">
      <link rel="stylesheet" href="css/bootstrap.offcanvas.min.css" />
      <link rel="stylesheet" href="css/responsive.css">
      <style>
         .background-loader {
         position: fixed;
         left: 0px;
         top: 0px;
         width: 100%;
         height: 100%;
         z-index: 9999;
         background: url(img/loader/preview.gif) center no-repeat #fff;
         background-size: 290px;
         overflow: hidden;
         }
      </style>
   </head>
   <body data-spy="scroll" data-offset="80">
      <div class="background-loader" id="pageloeadacc"></div>
      <div class="header-area-in non-index-header-stl">
         <div class="header-animation"> 
            <span class="header-waves"></span>
            <span class="white-background-header"></span>
            <span class="black-background-header"></span>
            <span class="wiz-line"></span>
            <span class="xo-on"></span>
            <span class="xo-tw"></span>
            <span class="xo-tr"></span>
            <span class="xo-fr"></span>
            <span class="right-poly-side-top"></span>
         </div>
         <div class="main-header">
            <div class="top-header-nav-cs">
               <div class="container">
                  <nav class="navbar navbar-expand-lg">
                     <div class="overlay"></div>
                     <a class="navbar-brand text-light" style="font-weight:bold;" href="index.html"><img style="max-width: 100px;" src="img/full_logo_benindns.png" alt="">Hosting</a> 
                     <button class="menu-btn-span-bar ml-auto" type="button" id="navbarSideButton">
                     <span></span>
                     <span></span>
                     <span></span>
                     </button>
                     <div class="navbar-side" id="navbarSide">
                        <ul class="navbar-nav ml-auto">
                          
                           <li class="nav-item">
                              <a class="nav-link" href="ddos.html">Accueil</a>
                           </li>
                            <li class="nav-item">
                              <a class="nav-link" href="ddos.html">Domaine</a>
                           </li>
                            <li class="nav-item">
                              <a class="nav-link" href="ddos.html">Hébergement</a>
                           </li>
                          
                          
                           <li class="nav-item">
                              <a class="nav-link" href="contact.html">A propos</a>
                           </li>
                           <li class="nav-item header-login-btn dropdownn">
                              <a data-toggle="dropdown" aria-haspopup="true" id="customarea" aria-expanded="false" href="#">login</a> 
                              <div class="dropdown-menu login-drop-down-header" aria-labelledby="customarea">
                                 <form method="post" action="https://coodiv.net/project/breed/html/dologin.php" class="login-form" role="form">
                                    <div class="form-group">
                                       <input type="email" name="email" class="form-control" id="inputEmail" placeholder="your email" autofocus>
                                    </div>
                                    <div class="form-group">
                                       <input type="password" name="password" class="form-control" id="inputPassword" placeholder="password" autocomplete="off">
                                    </div>
                                    <p class="help-block"><a href="#">lost password</a> <a href="#">register</a></p>
                                    <div align="center">
                                       <input id="login" type="submit" class="btn btn-primary" value="login" />
                                    </div>
                                 </form>
                              </div>
                           </li>
                           <li class="nav-item header-regsiter-btn">
                              <a class="wow fadeInUp" href="#">sign up</a> 
                           </li>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-12 pagnon-titl-g-host">
                     <h5 class="tittle-non-index">Oh <span>Yeah</span></h5>
                     <p class="tittle-non-index-sub">le nom de domaine <strong style="font-size: 20px;"><?php echo $_SESSION['domain']; ?></strong> est disponible chez nous</p>
                     <a  class="tittle-non-index-sub btn btn-outline-light wow fadeInUp" href="domaine-reservation.<?php  ?>">Réserver maintenant</a>
                  </div>
                  <div class="col-6 img-title-uimh-st-sm">
                     <img src="img/pages/4.png" alt="" />
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- <section class="non-index-section">
         <div class="fist-tab-word-non">
            <div class="container">
               <h5 class="host-plans-title-non-index">We are Providing Free Domain for every month new extentions.
                  <span>Officially Recommended by xxx.com</span>
               </h5>
               <form action="#" id="domain-search" class="wow fadeIn" data-wow-delay="0.5s">
                  <input id="domain-text" type="text" name="domain" placeholder="Write your domain name here.." />
                  <span class="inline-button">
                  <button id="search-btn" type="submit" name="submit" value="Search"> <img src="img/search.svg" alt="search icon" /> </button>
                  </span>
               </form>
               <div class="row justify-content-center">
                  <div class="col-3">
                     <a class="domain-price-non-index" href="#">
                     <small><img src="img/domain/com.png" alt="" /></small>
                     <span>$ 0.99</span>
                     </a>
                  </div>
                  <div class="col-3">
                     <a class="domain-price-non-index" href="#">
                     <small><img src="img/domain/net.png" alt="" /></small>
                     <span>$ 11.99</span>
                     </a>
                  </div>
                  <div class="col-3">
                     <a class="domain-price-non-index" href="#">
                     <small><img src="img/domain/org.png" alt="" /></small>
                     <span>$ 9.99</span>
                     </a>
                  </div>
                  <div class="col-3">
                     <a class="domain-price-non-index" href="#">
                     <small><img src="img/domain/store.png" alt="" /></small>
                     <span>$ 5.99</span>
                     </a>
                  </div>
                  <div class="wp-cont-spo-img">
                     <a href="#"><img src="img/client/client1.png" alt="" /></a>
                     <a href="#"><img src="img/client/client2.png" alt="" /></a>
                     <a href="#"><img src="img/client/client3.png" alt="" /></a>
                     <a href="#"><img src="img/client/client4.png" alt="" /></a>
                  </div>
               </div>
            </div>
         </div>
         <div class="second-tab-word-non">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-4 cons-wp-info-tes">
                     <img src="img/svgs/idead.svg" alt="" />
                     <h5>1-Click Installer <span>we are officially recommended by WordPress</span></h5>
                  </div>
                  <div class="col-4 cons-wp-info-tes">
                     <img src="img/svgs/contract.svg" alt="" />
                     <h5>Autoupdates <span>we are officially recommended by WordPress</span></h5>
                  </div>
                  <div class="col-4 cons-wp-info-tes">
                     <img src="img/svgs/growth.svg" alt="" />
                     <h5>SuperCacher<span>we are officially recommended by WordPress</span></h5>
                  </div>
                  <div class="col-4 cons-wp-info-tes">
                     <img src="img/svgs/clipboard.svg" alt="" />
                     <h5>1-Click Installer <span>we are officially recommended by WordPress</span></h5>
                  </div>
                  <div class="col-4 cons-wp-info-tes">
                     <img src="img/svgs/coffee-cup.svg" alt="" />
                     <h5>Autoupdates <span>we are officially recommended by WordPress</span></h5>
                  </div>
                  <div class="col-4 cons-wp-info-tes">
                     <img src="img/svgs/trophyf.svg" alt="" />
                     <h5>SuperCacher<span>we are officially recommended by WordPress</span></h5>
                  </div>
               </div>
            </div>
         </div>
         <div class="container tablepricdomain">
            <div class="col-sm-12">
               <div class="table-responsive">
                  <table class="table pricing_table_domain">
                     <thead>
                        <tr>
                           <th>domain</th>
                           <th>1 year</th>
                           <th>2 year</th>
                           <th>renew</th>
                           <th>transfer</th>
                           <th>whois privacy</th>
                           <th>buy</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th>.com</th>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.today</th>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.guru</th>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.org</th>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.net</th>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.co.uk</th>
                           <td>$8.98</td>
                           <td>$8.98</td>
                           <td>$8.98</td>
                           <td>$8.98</td>
                           <td>$8.98</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.email</th>
                           <td>$11.25</td>
                           <td>$11.25</td>
                           <td>$11.25</td>
                           <td>$11.25</td>
                           <td>$11.25</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.today</th>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.guru</th>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.org</th>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.today</th>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td>$9.50</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.guru</th>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td>$9.95</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                        <tr>
                           <th>.org</th>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td>$10.00</td>
                           <td><a href="#">buy</a></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </section> -->
      <section class="footer-section non-index-footer">
         <a class="footer-fb-icon" href="#"><i class="fa fa-facebook"></i></a> 
         <a class="footer-twiiter-icon" href="#"><i class="fa fa-twitter"></i></a> 
         <a class="footer-pinterest-icon" href="#"><i class="fa fa-pinterest-p"></i></a> 
         <div class="container">
            <div class="row justify-content">
               <div class="col-5 first-panu-footer">
                  <img class="footer-logo" src="img/header/logo.png" alt="" />
                  <p class="footer-text">Lorem ipsum dolor sit amet, consectetuer adipis, Lorem ipsum dolor s Lorem ipsum dolor sit amet, consectetuer adipis,</p>
                  <p class="footer-cpy">© 2017 Coodiv. Trademarks and brands are the property of their respective owners.</p>
                  <img class="footer-paypment" src="img/footer/payment.png" alt="" />
               </div>
               <div class="col-4 second-panu-footer">
                  <h5 class="tittle-footer">our <span>company</span></h5>
                  <ul class="col-6">
                     <li><a href="#">web hosting</a></li>
                     <li><a href="#">reseller hosting</a></li>
                     <li><a href="#">VPS hosting</a></li>
                     <li><a href="#">web hosting</a></li>
                     <li><a href="#">reseller hosting</a></li>
                  </ul>
                  <ul class="col-6">
                     <li><a href="#">web hosting</a></li>
                     <li><a href="#">reseller hosting</a></li>
                     <li><a href="#">VPS hosting</a></li>
                     <li><a href="#">web hosting</a></li>
                     <li><a href="#">reseller hosting</a></li>
                  </ul>
               </div>
               <div class="col-3 third-panu-footer">
                  <h5 class="tittle-footer">subscribe <span>to us</span></h5>
                  <form id="subscribe-footer-form">
                     <input type="text" name="email" placeholder="Write your email here.." />
                     <button id="subscribe-btn" type="submit" name="submit" value="subscribe"> <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                  </form>
               </div>
            </div>
         </div>
      </section>
      <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/smoothscroll.js"></script>
      <script src="owlcarousel/owl.carousel.min.js"></script>
      <script src="js/jquery.bootstrap.wizard.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <script src="js/waypoints.min.js"></script>
      <script src="js/bootstrap.offcanvas.min.js"></script>
      <script src="js/pagescript.js"></script>
      <script src="js/wow.min.js"></script>
      <script src="js/vidbg.min.js"></script>
   </body>
</html>