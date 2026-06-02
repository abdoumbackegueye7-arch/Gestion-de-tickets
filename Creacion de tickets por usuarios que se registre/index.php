<?php

// Aqui declaro los variable de los campos
$div_label_nombre="";
$div_label_apellido="";
$div_label_prioridad="";
$div_textarea_mensaje="";

//si ha prosesado bien los datos
$procesar= false;

// esto variable es para ver si no hay error en los campos y selo ha rellenado bien
$error=true;

// verifica si ha creado el archivo en excito
$verificar_archivo=false;

// para cierra la session
$destroy = false;
// Aqui creo un session un se incrementa cada vez con el nombre [cantidad_tickets]


// Aqui estoy verificando si los campo no son vacio y asegurarme de que el user ha enviado el formulario
if(isset($_POST['enviar']) && !empty($_POST['div_label_nombre']) && !empty($_POST['div_label_apellido']) && !empty($_POST['div_label_prioridad']) && !empty($_POST['div_textarea_mensaje'])){

//asigno los datos en una variable 
$div_label_nombre= trim($_POST['div_label_nombre']);
$div_label_apellido=trim($_POST['div_label_apellido']);
$div_label_prioridad=trim($_POST['div_label_prioridad']);
$div_textarea_mensaje=trim($_POST['div_textarea_mensaje']);




//aqui estoy verificando si los campo se han rellenado correctamente 
if(
    (!is_string($div_label_nombre) || preg_match("/[0-9]+/",$div_label_nombre) )|| (!is_string($div_label_apellido) || preg_match("/[0-9]+/",$div_label_apellido))
    ){

    $error =false;
    }
if(empty($_POST['div_label_prioridad'])){
    $error = false;
}

$rute= 'tickets/';
//aqui me aseguro que no exciste un archivo



if($error){
    //aqui creo el archivo
    $permiso = fopen($rute.$div_label_apellido, 'w+');
    
    // asigno el bool true para poder controlar la session
    $verificar_archivo=true;
    //intento declarar el texto que boy a escribir en el archivo
    $texto = '<h2>Su nombre es :'.$div_label_nombre.'<br/>'.
                'Su apellido es :'.$div_label_apellido.'<br/>'.
                'Su Prioridad es :'.$div_label_prioridad.'<br/>'.
                'Su mensaje es :'.$div_textarea_mensaje.'<br/>'.
                '</h2>';
    //abro el archivo
    
    // intento escribir texto en el archivo
    fwrite($permiso, $texto);
    fclose($permiso);
    }
if($verificar_archivo){
    session_start();
        if(!isset($_SESSION['cantidad_tickets'])){
            $_SESSION['cantidad_tickets'] =1;
        }else{
        $cantidad_tickets = $_SESSION['cantidad_tickets']++;
            echo '<h2 class="excito">cantidad de tickets son : '. $cantidad_tickets.'</h2>';
        }
    
}
echo '<h2 class="excito">se ha creado el ticket con [EXCITO]</h2>';

$procesar= true;

}elseif(isset($_POST['enviar'])){
    echo'<h2 class="error">[ERROR] en algun campo </h2>';
}
if($destroy){
session_destroy();
}

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Entorno Servidor</title>
    <style>
        div,p{
          margin:1rem;  
        }
        h2.error{
            border: 1px solid red;
            color: red;

        }
        h2.excito{
            border: 1px solid green;
            color: green;

        }
    </style>
</head>
<body>
    <form action="" method="post" class="formulario_prin">
        <div>
            <label>Nombre:
                <input type="text" name="div_label_nombre" minlength="5" maxlength="10" pattern="[^0-9]*" required>
            </label>
        </div>
        <div>
            <label>Apellidos:
                <input type="text" name="div_label_apellido" minlength="5" maxlength="15" pattern="[^0-9]*" required>
            </label>
        </div>
        <div>
            <label>Prioridad:
                <label for="leve">Leve
                    <input type="radio" name="div_label_prioridad" value="Leve" id="leve" required>
                </label>
                <label for="medio">Medio
                    <input type="radio" name="div_label_prioridad" value="medio" id="medio" required>
                </label>
                <label for="urgente">Urgente
                    <input type="radio" name="div_label_prioridad" value="urgente" id="urgente" required>
                </label>
            </label>
        </div>
        <div>Mensaje:
            <textarea name="div_textarea_mensaje" id="" cols="50" rows="10">

            </textarea>
        </div>
        <p>
            <input type="submit" value="enviar" name="enviar">
        </p>
    </form>
    <a href="<?php $destroy=true;?>">
        Volver a Cero por la cantidad de tickets
    </a>
</body>
</html>
