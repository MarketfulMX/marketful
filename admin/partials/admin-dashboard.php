<!-- // creo que sobra  -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap CSS and JS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<script>
    function clic()
    {
        console.log('CLick');
        $('tab-superior').children('li').attr('class','nav-link');
        $(this).attr('class','nav-link active');
    }
</script>

<style>
</style>

<ul class="nav nav-tabs tab-superior" id= tab-superior>
    <li class="nav-item"><a href="#" class="nav-link active" onclick="click()" >Dashboard</a></li>
    <li class="nav-item"><a href="#" class="nav-link" onclick="click()" >Instalación</a></li>
    <li class="nav-item"><a href="#" class="nav-link" onclick="click()" >Instrucciones</a></li>
    <li class="nav-item"><a href="#" class="nav-link" onclick="click()" >Preguntas Frecuentes</a></li>
    <li class="nav-item"><a href="#" class="nav-link" onclick="click()" >Soporte</a></li>
</ul>