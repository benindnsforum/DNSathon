<?php
session_start();
require_once "./model/Db_Handler.php";
$db=new Db_Handler();
//$response="";
$save=$dn=$name=$first=$email="";
$ok="";
if ($_SERVER['REQUEST_METHOD'] =="POST") {
   $dn = $_POST['domain'];
   $name = $_POST['name'];
   $first = $_POST['first_name'];
   $email = $_POST['email'];
   $saveOnlyDns = $db->saveOnlyDNS($dn);
   $save = $db->saveDNS($name,$first,$email,$dn);
   $ok = true;
   if ($ok) {
      header('Location: checkout.php');
   }else {
      //$ok = false;
      header("Location: domain-existe.php");
      //header("Location: index.php");
   }
}

 ?>

<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="BREED HOSTING">
      <meta name="author" content="coodiv (https://themeforest.net/user/coodiv)">
      <link rel="icon" href="favicon.png">
      <title>DNS Hosting | Réserver votre domaine</title>
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
      <div class="header-area-in non-index-header-stl help-center-header cnctpg vedeobg-coodiv">
         <div class="header-animation"> 
            <span class="white-background-header"></span>
            <span class="black-background-header"></span>
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
                     <h5 class="tittle-non-index">Réserver maintenant <span>votre domaine</span></h5>
                     <p class="tittle-non-index-sub">entrez vos informations ici afin de réserver votre domaine</p>
                  </div>
                  <div class="col-8">
                     <form id="cotact-us-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <input type="text" id="name" name="name" placeholder="entrer votre nom" required />
                        <input type="text" id="email" name="first_name" placeholder="entrer votre prénom" required />
                        <input type="email" id="name" name="email" placeholder="entrer votre email" required />
                        <input type="text" id="email" name="domain" placeholder="entrer le domaine concerné" value="<?php echo $_SESSION['domain'] ?>" />
                        <input type="text" id="name" name="adresse" placeholder="ville de résidence" required />
                        <input type="number" id="email" name="annee" placeholder="nombre d'année" required />
                        <input type="text" id="name" name="ns1" placeholder="ns1 optionnel"/>
                        <input type="text" id="email" name="ns2" placeholder="ns2 optionnel"/>
                        <input type="password" id="name" name="pass" placeholder="mot de passe" reqired>
                        <input type="password" id="email" name="confirmePass" placeholder="confirmer le mot de passe" required />
                        <span class="inline-button">
                        <button id="search-btn" type="submit" name="submit" value="Réservé"> <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        </span>
                     </form>
                     <div id="form-messages"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <section class="non-index-section">
         <div class="container our-client-img ht-prf cnxtpgsd">
            <div class="row justify-content">
               <div class="col-4">
                  <a href="#"><img src="img/pertner/php.png" alt="" /></a>
               </div>
               <div class="col-4">
                  <a href="#"><img src="img/pertner/MySQL.png" alt="" /></a>
               </div>
               <div class="col-4">
                  <a href="#"><img src="img/pertner/dell.png" alt="" /></a>
               </div>
            </div>
         </div>
         <!-- <div class="host-plan-areatl">
            <div class="container our-client-img ht-prf">
               <div style="margin-bottom:0px;" class="row justify-content-center">
                  <h5 class="host-plans-title-non-index">find us on our earth <span>usin google earth</span></h5>
                  <div class="col-9">
                     <iframe frameborder="none" class="map-contact-us-why" width="100%" height="500px" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD4iE2xVSpkLLOXoyqT-RuPwURN3ddScAI&amp;q=Space+Needle,Seattle+WA" allowfullscreen="">
                     </iframe>
                  </div>
               </div>
            </div>
            <div class="dsrib-prtyer">
               <div class="container">
                  <p>or call us on <b>00213 123 45 67 89</b> </p>
               </div>
            </div>
         </div> -->
         <div style="padding-top: 100px;" class="ourservplans-text">
            <div class="container">
               <div class="row justify-content">
                  <div class="col-7">
                     <div class="qst-qa-lost">
                        <h5>why use our server</h5>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean m Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean m Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu</p>
                     </div>
                     <div class="qst-qa-lost">
                        <h5>why use us</h5>
                        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu</p>
                     </div>
                  </div>
                  <div class="col-5 ourservplans-text-sdiebar">
                     <a href="#" class="alollnk">
                     <img src="img/svgs/gambling.svg" alt="" />
                     <span>why use our server <small>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean</small></span>
                     </a>
                     <a href="#" class="alollnk">
                     <img src="img/svgs/hula-hoop.svg" alt="" />
                     <span>why use our server <small>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean</small></span>
                     </a>
                     <a href="#" class="alollnk">
                     <img src="img/svgs/maps-and-flags.svg" alt="" />
                     <span>why use our server <small>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean</small></span>
                     </a>
                     <a href="#" class="alollnk">
                     <img src="img/svgs/world-wide.svg" alt="" />
                     <span>why use our server <small>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean</small></span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
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
