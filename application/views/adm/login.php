<!--
<section class="bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <?php
                        if($error){
                      ?>
                      <div class="alert alert-danger" role="alert"><?=$error?></div>
                      <?php
                        }
                      ?>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    	<div class="row">
    		<div class="col-lg-12 text-center">
                <h2 class="section-heading">Login</h2>
                <hr class="light">
    			<div class="row">
    				<div class="col-md-4"></div>
    				<div class="col-md-4">
    					<form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        	<div class="control-group">
                                <div class="controls">
                                	<input class="form-control" id="inputUser" type="text" name="user" placeholder="Usuário" />
                           	    </div>
                            </div>
                            <br>
                            <div class="control-group">
                            	<div class="controls">
                                	<input class="form-control" id="inputPassword" type="password" name="senha" placeholder="Senha" />
                                </div>
                            </div>
                            <div class="control-group">
                               <div class="controls">
                               		<p></p>
                                	<button class="btn btn-default btn-xl sr-button" name="submit" type="submit">Acessar</button>
                                </div>
                            </div>
                        </form>				
    				</div>
    				<div class="col-md-4"></div>
    			</div>
    		</div>
    	</div>
    </div>
    </section>
    -->


<!DOCTYPE html>
<html>
<title>Paciente Móvel | Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!-- Bootstrap -->
<link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">

<style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}a{text-decoration: none;}

    body {
        background-color:  #a81f2f;
    }

    @media screen and (max-width: 767px) {
    .tamanho {width: 90%}
    }

    @media screen and (min-width: 768px) {
    .tamanho {width: 40%;}
    }

    @media screen and (min-width: 1200px) {
    .tamanho {width: 25%;}
    }

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</style>

<body>

    <div class="w3-display-middle tamanho">
        <?php if($error): ?>
        <div class="w3-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
                <i class="fa fa-remove"></i>
            </span>
            <p><strong>Houve um Erro!</strong></p>
            <p><?=$error?></p>
        </div>
        <?php endif; ?>
        <div class="w3-card-4 w3-white w3-padding w3-padding-32 w3-round w3-center">
            <h2 class="w3-margin-bottom" style="color: #a81f2f">
                <i class="fa fa-ambulance"></i>
            </h2>
            
            <h4 class="w3-opacity w3-margin-bottom" style="color: #a81f2f">Paciente Móvel</h4>
            <form class="form-horizontal" method="POST" action="<?=base_url('login'); ?>">
               
                <div class="w3-cell-row">
                    <div class="w3-cell">
                        <i class="fa fa-user fa-2x" style="color: #a81f2f"></i>
                    </div>
                    <div class="w3-cell">
                        <input class="w3-input" id="inputUser" type="text" name="user" placeholder="Digite o seu Usuário..." />
                    </div>
                </div>

                <br>
                <div class="w3-cell-row">
                    <div class="w3-cell">
                        <i class="fa fa-lock fa-2x" style="color: #a81f2f"></i>
                    </div>
                    <div class="w3-cell">
                        <input class="w3-input" id="inputPassword" type="password" name="senha" placeholder="Digite a sua senha..." />
                    </div>
                </div>

                <br>
                <button class="w3-btn w3-margin-top w3-block" style="background-color: #a81f2f; color:#fff !important" type="submit">Login</button>
                
            </form>
        </div>
    </div>

    
    

<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>


</body>
</html> 

