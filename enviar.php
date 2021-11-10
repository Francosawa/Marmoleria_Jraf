<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	//Se debe verificar que los archivos que se requieren a continuación se encuentren en las rutas indicadas
	require 'PHPMailer/Exception.php';
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';

    //Se instancia un objeto de la clase PHPMailer
	$mail = new PHPMailer(true);

    //Declaración de variables para almacenar los datos ingresados por el usuario en cada input del formulario. Recordar que se accede por el "name" del input.

    $nombre = $_POST['introducir_nombre'];
    $email = $_POST['introducir_mail'];
    $comentario = $_POST['introducir_mensaje'];
    $asunto = $_POST['introducir_asunto'];

try {
    //Configuración del servidor
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //SMTP::DEBUG_SERVER;    //Se habilita la depuración, si se utiliza un servidor local colocar en 0
    $mail->isSMTP();   //Se utiliza el protocolo SMTP
    $mail->Host       = 'smtp.gmail.com';  //Colocar aquí el servidor de correo a utilizar, en el ejemplo smtp de gmail
    $mail->SMTPAuth   = true;     //Se habilita la autenticación smtp
    $mail->Username   = 'Jraf.amoblamientos@gmail.com'; //Colocar aquí una dirección de correo valida, debe pertenecer al servidor indicado arriba
    $mail->Password   = 'depto764'; //Colocar aquí la contraseña
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Habilita el cifrado TLS; se recomienda `PHPMailer::ENCRYPTION_SMTPS` 
    $mail->Port       = 587;                                    //Número del puerto utilizado

 
    $mail->setFrom('colocar_email', 'Nombre_usuario'); //Desde donde se envía el mail, el nombre es opcional
    $mail->addAddress('Jraf.amoblamientos@gmail.com', 'Nombre_usuario');     //A quién se le envía el mail, el nombre es opcional
    //$mail->addAddress('ellen@example.com');  //información opcional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Las siguiente líneas se utilizan si se desea enviar archivos
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Agrega archivos adjuntos
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    

    //Contenido
    $mail->isHTML(true);                     //Si se envía con formato HTML
    $mail->Subject = $asunto;  //Asunto del mensaje

    //Sobre esta variable $mail armamos el cuerpo del mensaje los puntos son para concatenar, es lo mismo que con el + en C#.
    $mail->Body    = 'Nombre: ' . $nombre . '<br> Email: ' . $email . '<br> Mensaje: '. $comentario;
 

    $mail->send(); //Se envía el mail
    // header(location:index.html);
    echo "Gracias por contactarnos, responderemos a la brevedad"; //Fin del try
} catch (Exception $e) {
    echo "Error, el mensaje no se envió: {$mail->ErrorInfo}"; //Si hay algún error
}

?>
