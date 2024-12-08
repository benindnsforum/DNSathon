<?php
session_start();
require_once "./model/Db_Handler.php";
$db=new Db_Handler();
//$response="";
$dn="";
$ok="";
if ($_SERVER['REQUEST_METHOD'] =="POST") {
   $dn = $_POST['domain'];
   if ($db->checkDnsExists($dn)) {
      $ok = true;
   }else {
      $_SESSION['domain'] = $dn;
      $_SESSION['msg'] = "";
      header("Location: domain-existe.php");
      //header("Location: index.php");
   }
}

//include("./controller/login.php");

 ?>


<!DOCTYPE html>
<html lang="zxx">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="BREED HOSTING">
      <meta name="author" content="coodiv (https://themeforest.net/user/coodiv)">
      <link rel="icon" href="favicon.png">
      <title>DNS Hosting - Réservez votre nom de domaine ici</title>
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="css/style.css" />
      <link rel="stylesheet" href="css/animate.css" />
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
      <div id="header-indx-pg" class="header-area-in headerfixedhightslider">
         <div class="header-animation"></div>
         <div class="main-header">
            <div class="top-header-nav-cs header-with-img-slider">
               <div class="container-fluid">
                  <nav class="navbar navbar-expand-lg">
                     <div class="overlay"></div>
                     <a class="navbar-brand text-light" style="font-weight:bold;" href="index.html"><img style="max-width: 100px;" src="img/full_logo_benindns.png" alt="">Hosting</a> 
                     <button class="menu-btn-span-bar ml-auto" type="button" id="navbarSideButton">
                     <span></span>
                     <span></span>
                     <span></span>
                     </button>
                     <div class="navbar-side" id="navbarSide" style="margin-left: 30vw;">
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
                              <a id="customarea" aria-expanded="false" href="user/auth-login.php">Se connecter</a>
                           </li>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
            <div class="headercoresil-anomat owl-carousel owl-theme">
               <div class="item">
                  <div style="background: url(img/header/help.jpg) no-repeat bottom;" class="item-bg-slider-header">
                     <div class="container">
                        <h5 class="header-v2-title-head">Verifiez ici si votre nom de domaine est disponible</h5>
                              <div class="mt-5 alert alert-danger text-center" style="display:<?php 
                              if ($ok) {
                                 echo "block";
                              }else echo "none"; 
                           ?>" role="alert">
                                 Oups désolé nom de domaine deja pris merci
                              </div>
                        <div class="row justify-content-md-center">
                           <div class="col-md-7">
                              <form class="wow fadeInUp" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="domain-search-form-v2"> 
                                 <input id="" type="text" name="domain" placeholder="écrivez ici le nom de domaine ex: toto.benin" />
                                 <button id="" type="submit" name="submit" value="Rechercher"> Rechercher </button>
                              </form>
                              <div class="domain-price-header justify-content-center row d-flex">
                                 <a style="display: flex;">
                                 <p style="font-weight: bold;"><strong>. </strong>cotonou</p>
                                 <span style="margin-top: 4px; margin-left: 10px;">$14.99</span>
                                 </a>
                                 <a style="display: flex;">
                                 <p style="font-weight: bold;"><strong>. </strong>benin</p>
                                 <span style="margin-top: 4px; margin-left: 10px;">$9.99</span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <div style="background: url(img/header/404.jpg) no-repeat bottom;" class="item-bg-slider-header">
                     <div class="container">
                        <h5 class="header-v2-title-head">are you ready ? for the best hosting experience</h5>
                        <div class="box-sor-hosting vrtr">
                           <a data-toggle="tooltip" data-placement="bottom" title="pay now" href="checkout.html">
                           <i class="flaticon-payment-method"></i>
                           </a>
                           <a data-toggle="tooltip" data-placement="bottom" title="web hosting" href="web-hosting.html">
                           <i class="flaticon-pie-chart"></i>
                           </a>
                           <a data-toggle="tooltip" data-placement="bottom" title="reseller hosting" href="reseller.html">
                           <i class="flaticon-shield"></i>
                           </a>
                           <a data-toggle="tooltip" data-placement="bottom" title="support" href="help.html">
                           <i class="flaticon-headphones"></i>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="pertner-section">
         <div class="container">
            <div class="row justify-content-md-center">
               <div class="col-md-8">
                  <a class="wow fadeInUp" data-toggle="tooltip" data-placement="top" title="php" href="#"><img src="img/pertner/php.png" alt="png" /></a>
                  <a data-toggle="tooltip" data-placement="top" title="MySQL" href="#"><img src="img/pertner/MySQL.png" alt="png" /></a>
                  <a class="wow fadeInUp" data-toggle="tooltip" data-placement="top" title="dell" href="#"><img src="img/pertner/dell.png" alt="png" /></a>
                  <a class="wow fadeInUp" data-toggle="tooltip" data-placement="top" title="directadmin" href="#"><img src="img/pertner/directadmin.png" alt="png" /></a>
                  <a class="wow fadeInUp" data-toggle="tooltip" data-placement="top" title="ibm" href="#"><img src="img/pertner/ibm.png" alt="png" /></a>
                  <a data-toggle="tooltip" data-placement="top" title="ubuntu" href="#"><img src="img/pertner/ubuntu.png" alt="png" /></a>
               </div>
            </div>
         </div>
      </div>
   
      <div class="index-ads">
         <div class="container">
            <p><span>Vous pouvez acheter votre hébergement avec nous. </span><a href="help.html" style="border: none">J'Héberge</a></p>
         </div>
      </div>
        
      <!-- <section class="technologie">
         <div class="container">
            <h5 class="title-head">we petting the best technologie in our server</h5>
            <div class="row justify-content-center">
               <div class="col-4 techno-icons wow fadeInUp">
                  <i class="flaticon-delivery"></i>
                  <h6>fast delivery</h6>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
               </div>
               <div class="col-4 techno-icons">
                  <i class="flaticon-dollar-symbol-2"></i>
                  <h6>fast delivery</h6>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
               </div>
               <div class="col-4 techno-icons phonnochowop">
                  <i class="flaticon-monitor"></i>
                  <h6>fast delivery</h6>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
               </div>
            </div>
            <div class="row justify-content-center">
               <div class="col-4 techno-icons">
                  <i class="flaticon-percentage"></i>
                  <h6>fast delivery</h6>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
               </div>
               <div class="col-4 techno-icons wow fadeInUp">
                  <i class="flaticon-shield"></i>
                  <h6>fast delivery</h6>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
               </div>
               <div class="col-4 techno-icons phonnochowop">
                  <i class="flaticon-invoice"></i>
                  <h6>fast delivery</h6>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
               </div>
            </div>
         </div>
      </section> -->
     
      <section class="how-work">
         <div class="container">
            <div class="how-ordr-txt">How can I order ?</div>
            <div class="row justify-content-center">
               <div class="col-3">
                  <div class="how-ordr-box blurbrbox wow fadeInUp">
                     <i class="flaticon-shopping-basket"></i>
                     <h6>choose your plan</h6>
                     <span class="fa fa-angle-double-right" aria-hidden="true"></span>
                  </div>
               </div>
               <div class="col-3">
                  <div class="how-ordr-box greenbrbox">
                     <i class="flaticon-dollar-symbol-2"></i>
                     <h6>pay the invoice</h6>
                     <span class="fa fa-angle-double-right" aria-hidden="true"></span>
                  </div>
               </div>
               <div class="col-3">
                  <div class="how-ordr-box orangebrbox wow fadeInUp">
                     <i class="flaticon-delivery"></i>
                     <h6>use immediately</h6>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="our-services">
         <div class="container">
            <h5 class="tittle-head">our services <span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span></h5>
            <div class="row justify-content-center">
               <div class="col-3">
                  <div class="box-service orgwani-box-icon">
                     <i class="flaticon-box-1"></i>
                     <h6>web hosting</h6>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipis.</p>
                  </div>
               </div>
               <div class="col-3">
                  <div class="box-service orgwani-box-icon">
                     <i class="flaticon-badge"></i>
                     <h6>domains</h6>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipis.</p>
                  </div>
               </div>
               <div class="col-3">
                  <div class="box-service blue-box-icon wow fadeInUp">
                     <i class="flaticon-invoice"></i>
                     <h6>emails</h6>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipis.</p>
                  </div>
               </div>
               <div class="col-3">
                  <div class="box-service green-box-icon">
                     <i class="flaticon-package-5"></i>
                     <h6>support</h6>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipis.</p>
                  </div>
               </div>
            </div>
            <div class="row justify-content-center">
               <div class="col-3">
                  <div class="box-service sbt-box-icon wow fadeInUp">
                     <i class="flaticon-shield"></i>
                     <h6>web hosting</h6>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipis.</p>
                  </div>
               </div>
               <div class="col-3">
                  <div class="box-service lgt-box-icon">
                     <i class="flaticon-piggy-bank"></i>
                     <h6>domains</h6>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipis.</p>
                  </div>
               </div>
               <div class="col-3">
                  <div class="box-service lmn-box-icon">
                     <i class="flaticon-payment-method"></i>
                     <h6>emails</h6>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipis.</p>
                  </div>
               </div>
               <div class="col-3">
                  <div class="box-service opk-box-icon">
                     <i class="flaticon-wallet"></i>
                     <h6>support</h6>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipis.</p>
                  </div>
               </div>
            </div>
         </div>
      </section>
    
      <section class="testimonial-sestion">
         <div class="container">
            <h5 class="tittle-head">Notre équipe</h5>
            <div class="fadeOut owl-carousel owl-theme owl-testimonial">
               <div class="item testimonial-item">
                  <img src="img/svgs/farmer.svg" alt="" />
                  <h5>nedjai moh <span>coodiv.net</span></h5>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipis, Lorem ipsum dolor s Lorem ipsum dolor sit amet, consectetuer adipis, Lorem ipsum dolor sit. Lorem ipsum dolor sit amet, consectetuer adipis, Lorem ipsum dolor sit.</p>
               </div>
               <div class="item testimonial-item">
                  <img src="img/svgs/welder.svg" alt="" />
                  <h5>nedjai moh <span>coodiv.net</span></h5>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipis, Lorem ipsum dolor s Lorem ipsum dolor sit amet, consectetuer adipis, Lorem ipsum dolor sit. Lorem ipsum dolor sit amet, consectetuer adipis, Lorem ipsum dolor sit.</p>
               </div>
               <div class="item testimonial-item">
                  <img src="img/svgs/showman.svg" alt="" />
                  <h5>nedjai moh <span>coodiv.net</span></h5>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipis, Lorem ipsum dolor s Lorem ipsum dolor sit amet, consectetuer adipis, Lorem ipsum dolor sit. Lorem ipsum dolor sit amet, consectetuer adipis, Lorem ipsum dolor sit.</p>
               </div>
            </div>
         </div>
      </section>
     
      <section class="footer-section">
         <a class="footer-fb-icon" href="#"><i class="fa fa-facebook"></i></a> 
         <a class="footer-twiiter-icon" href="#"><i class="fa fa-twitter"></i></a> 
         <a class="footer-pinterest-icon" href="#"><i class="fa fa-pinterest-p"></i></a> 
         <div class="container">
            <div class="row justify-content">
               <div class="col-12">
                  <img class="footer-logo" src="img/header/logo.png" alt="" /> 
                  <p class="footer-text">DNS Hosting</p>
                  <p class="footer-cpy">© 2017 Coodiv. Trademarks and brands are the property of their respective owners.</p>
                  <img class="footer-paypment" src="img/footer/payment.png" alt="" />
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
      <script>
         $('.headercoresil-anomat').owlCarousel({
            items:1,
         dots:false,
         loop:true,
         responsive:{
                0:{
                    items: 1,
                }
            }
            });
         
      </script>
   </body>
</html>
