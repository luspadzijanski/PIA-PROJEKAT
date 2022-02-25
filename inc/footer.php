<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- gore smo importovali (napravili) biblioteku za ubacivanje simbola drustvenih mreza -->

<div id="footer"><!-- #footer Begin -->
    <div class="container"><!-- container Begin -->
        <div class="column"><!-- row Begin -->
            <div class="col-sm-6 col-md-3"><!-- col-sm-6 col-md-3 Begin -->
                
                <h4 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white;">Korisnički deo</h4>
                
                <ul><!-- ul Begin -->
                            
                           <?php
                           
                           if(!isset($_SESSION['customer_email'])){
                               
                               echo"<a href='index.php'><strong style>Ulogujte se</strong></a>"; //element strong za boldovanje
                               
                           }else{
                               
                               echo"<a href='customer/my_account.php?my_orders' >Moj nalog</a>";
                              
                           }
                           
                           ?>
                         
                    <li><a href="registration.php" style = "font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white;">Registracija</a></li>
                </ul><!-- ul Finish -->
                
                <hr class="hidden-md hidden-lg hidden-sm">
                
            </div><!-- col-sm-6 col-md-3 Finish -->
    
            </div><!-- col-sm-6 col-md-3 Finish -->
            
            <div class="col-sm-6 col-md-3"><!-- col-sm-6 col-md-3 Begin -->
                
                <h4 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white">Pronadjite nas</h4>
                
                <p style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white"><!-- p Start -->
                    
                    <strong style="color: white;">Pavle Zoric</strong>
                    <br>
                    <br/>Mesto: Kraljevo
                    <br/>Telefon: 0365325226
                    <br/>E-mail: pavlezoric2000@gmail.com
                    
                </p><!-- p Finish -->
                
                <a href="contact.php" style="color: white; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Kontakt stranica</a>
                
                <hr class="hidden-md hidden-lg">
                
            </div><!-- col-sm-6 col-md-3 Finish -->
            
            <div class="col-sm-6 col-md-3">

                <hr>
                
                <h4 style = "font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white;">Ostanimo u kontaktu</h4>
                
                <p class="social">
                    <a href="https://www.facebook.com/pakizoric00/" class="fa fa-facebook fa-2x" style="color: #3b5998;"></a>
                    <a href="#" class="fa fa-twitter fa-2x" style="color: #55acee;"></a>
                    <a href="https://www.instagram.com/luspau_/" class="fa fa-instagram fa-2x" style="color: #ac2bac;"></a>
                    <a href="#" class="fa fa-google-plus fa-2x" style="color: #dd4b39;"></a>
                    <a href="#" class="fa fa-envelope fa-2x"></a>
                </p>
                
            </div>
        </div><!-- row Finish -->
    </div><!-- container Finish -->
</div><!-- #footer Finish -->

</body>
</html>

