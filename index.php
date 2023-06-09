<?php
//define("UPLOAD_DIR", "/var/www/upload/uploads/");
$msg="";
if(isset($_POST['Televerser'])){

$actualdir = getcwd();
$uploaddir = $actualdir."/uploads/";
//echo $uploaddir;
//$uploaddir = '/var/www/upload/uploads/';
$uploadfile = $uploaddir.basename($_FILES['fileToUpload']['name']);

	//echo '<pre>';
	if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
    	$msg="Upload success.\n";
    	chmod($uploadfile, 0777);
	} else {
	    $msg="Possible file upload attack!\n";
	}

	//echo 'Here is some more debugging info:';
	//print_r($_FILES);

	//print "</pre>";
}

function listing($repertoire){
	$fichier = array();
	if (is_dir($repertoire)){
		$dir = opendir($repertoire);//ouvre le repertoire courant désigné par la variable
		while(false!==($file = readdir($dir))){  //on lit tout et on récupere tout les fichiers dans $file
			if(!in_array($file, array('.','..'))){
				$page = $file;  //sort l'extension du fichier
				$page = explode('.', $page);
				$nb = count($page);
				$nom_fichier = $page[0];
				for ($i = 1; $i < $nb-1; $i++){
					$nom_fichier .= '.'.$page[$i];
				}
				if(isset($page[1])){
					$ext_fichier = $page[$nb-1];
					if(!is_file($file)) { $file = ''.$file; }
				}
				else {
					if(!is_file($file)) { $file = '/'.$file; }//on rajoute un "/" devant les dossier pour qu'ils soient triés au début
					$ext_fichier = '';
				}
				if($ext_fichier != 'php' and $ext_fichier != 'html') { //utile pour exclure certains types de fichiers à ne pas lister
					array_push($fichier, $file);
				}
				if($ext_fichier == 'pdf' || $ext_fichier != 'doc'|| $ext_fichier != 'docx'|| $ext_fichier != 'xls'|| $ext_fichier != 'xlsx'|| $ext_fichier != 'dot'|| $ext_fichier != 'ppt'|| $ext_fichier != 'pptx'|| $ext_fichier != 'pps') { //utile pour exclure certains types de fichiers à ne pas lister
					//array_push($fichier, $file);
				}
			}
		}
	}

	natcasesort($fichier);//la fonction natcasesort( ) est la fonction de tri standard sauf qu'elle ignore la casse
	$lg = sizeof($fichier);
	$i=1;
	//$ligne = floor ( $lg / 3);
	echo'<div>';
	function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    if(isMobile()){
    	$op = 15;// Do something for only mobile users
	}else {
    	$op = 40;// Do something for only desktop users
	}
	foreach($fichier as $value) {
			$lienFic = $repertoire.'/'.rawurlencode(str_replace ('/', '', $value));
			if(strlen($value)>=$op){
				$val = substr($value , 0, $op)." ... ".substr($value , -10 );
			}else{
				$val = $value;
			}
			echo'<div class="col-sm-6" align="left">';
			//echo '<a href="#"><span id="supe" class="glyphicon glyphicon-remove" style="display:none"></span></a>';
			echo '<div id="aff" display="none"><a target="blank" alt="'.$value.'"href="'.$lienFic.'">';
			//if(!is_file($value)){
			//	echo '<span class="glyphicon glyphicon-folder-open"></span>';
			//}else{
				echo '<span class="glyphicon glyphicon-file"></span>';
			//}
			echo'  '.$val.'</a></div>';
			//echo '';
			echo'</div>';
	}
	echo'</div><br/>';
	echo'<div class="col-sm-12" align="center">'.$lg.' &eacute;l&eacute;ments trouv&eacute;s</div>';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Online file storage</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="image/favicon.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
  <!-- other options -->
  <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css"/>
  <script src="bootstrap-3.3.7/js/jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap-theme.min.css"/>
  <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
  <!-- end of option -->
  <style>
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
      background-color: #e6fff2;
  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #006633;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #006633;
      font-weight: 400;
      margin-bottom: 30px;
  }  
  .jumbotron {
      background-color: #006633;
      color: #fff;
      padding: 50px 15px;
      font-family: Montserrat, sans-serif;
  }
  .container-fluid {
      padding: 5px 5px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #009933;
      font-size: 50px;
  }
  .logo {
      color: #009933;
      font-size: 200px;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      background-color: #e6ffee;
      border: none;
      border-radius: 0;
  }
  .thumbnail img {
      width: 100%;
      height: 100%;
      margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #006633;
  }
  .carousel-indicators li {
      border-color: #006633;
  }
  .carousel-indicators li.active {
      background-color: #006633;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 70px 0;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #006633; 
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,66,33, 1);
  }
  .panel-footer .btn:hover {
      border: 1px solid #006633;
      background-color: #fff !important;
      color: #006633;
  }
  .panel-heading {
      color: #006633 !important;
      background-color: #b3ffcc !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }
  .panel-footer {
      background-color: white !important;
  }
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 14px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #006633;
      color: #fff;
  }
  .navbar {
      margin-bottom: 0;
      background-color: #f4511e;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 2px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #006633 !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #fff !important;
      background-color: #006633 !important;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
      
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #006633 !important;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #006633;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#myPage"><span class="glyphicon glyphicon-cloud-download"></span> File listing</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about"><span class="glyphicon glyphicon-list-alt"></span> FILE LIST</a></li>
        <li><a href="#upload"><span class="glyphicon glyphicon-cloud-upload"></span> UPLOAD</a></li>
        <li><a href="#" onclick="suppr('supe')"><span class="glyphicon glyphicon-remove-sign"></span> DELETE</a></li>
	<li><a href="moodle" target="blanck"><span class="glyphicon glyphicon-education"></span> MOODLE</a></li>
	<li><a href="sujet" target="blanck"><span class="glyphicon glyphicon-briefcase"></span> SUJETS</a></li>
        <li><a href="#contact"><span class="glyphicon glyphicon-envelope"></span> CONTACT</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>ooO RAHOMBE Ooo</h1> 
  <p>Liste des fichiers sur le serveur</p> 
    	Trouver un fichier : 
  <form>
    <div class="input-group">
      <input type="email" class="form-control" size="50" placeholder="mots cl&eacute;s" required>
      <div class="input-group-btn">
        <button type="button" class="btn btn-primary">Rechercher</button>
      </div>
    </div>
  </form>
</div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
	<b>
	<p align="center">Liste des fichiers</p>
		<?php
			listing('uploads');        //chemin du dossier
			//listing('../../../../Users/njakarison/Documents/ETS/DocThese/Papers');
		?>
	</b>
	</p>
</div>

<div id="upload" class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-6" align ="center">
      <span class="glyphicon glyphicon-cloud-upload logo slideanim"></span>
    </div>
    <div class="col-sm-6">
      <h2>UPLOAD NEW FILE</h2><br>
      <div>
      	<?php echo $msg;?>		
    	<h4><p>Veuillez s&eacute;lectionner un fichier &agrave; t&eacute;l&eacute;verser</p></h4>
  		<form action="index.php" method="post" enctype="multipart/form-data">
    		<div class="form-group">
				<label for="email">Filename :</label>
      			<input type="file" class="form-control" placeholder="Enter email" name="fileToUpload" id="fileToUpload">
    		</div>
    		<button type="submit" class="btn btn-primary" name="Televerser">T&eacute;l&eacute;verser</button>
  		</form>
		</div>
    </div>
  </div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Vous pouvez nous contacter, r&eacute;ponse dans les 24h</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Motr&eacute;al, Canada</p>
      <p><span class="glyphicon glyphicon-phone"></span> (+1) 438-468-4272</p>
      <p><span class="glyphicon glyphicon-envelope"></span> admin@rahombe.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Envoyer</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Google Maps -->
<!--div id="googleMap" style="height:400px;width:100%;"></div-->
<!--script>
function myMap() {
	var myCenter = new google.maps.LatLng(-12.3231, 49.2943);
	var mapProp = {center:myCenter, zoom:14, scrollwheel:true, draggable:true, mapTypeId:google.maps.MapTypeId.ROADMAP};
	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
	var marker = new google.maps.Marker({position:myCenter});
	marker.setMap(map);
}
</script-->
<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1926.781353587181!2d49.28885769140778!3d-12.333326690545919!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTLCsDE5JzU5LjMiUyA0OcKwMTcnMjQuNSJF!5e1!3m2!1sen!2sca!4v1684883587633!5m2!1sen!2sca" width="100%" height="50%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<!--script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp8myWVxwD3rWAd3GgLUZUYAKhMWchoj0&callback=myMap" async defer></script-->
<!--script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=myMap" async defer>
</script-->

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p><span class="glyphicon glyphicon-copyright-mark"></span> Copyright  - <a href="http://www.rahombe.com/" title="Visitez notre site ici">Rahombe 2017</a></p>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})

</script>
<script language="javascript" type="text/javascript">
	function basculer(elem){
		var action = (document.getElementById(elem).style.display == "block") ? "none" : "block";
			document.getElementById(elem).style.display = action;
	}
	function suppr(sup){
		var act = (document.getElementById(sup).style.display == "block") ? "none" : "block";
		document.getElementById(sup).style.display  = act;
	}
</script>
</body>
</html>
