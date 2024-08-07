<?php
//iniciar la sesion
session_start();


$usuario=$_POST["txtUsuario"];
$clave=$_POST["txtPassword"];

//Consultar a la base de datos el usuario y contraseña

$nombreServidor="localhost:3306";
$nombreUsuario="root";
$passwordUsuario="toormysql";
$nombreBD="usuariosBD";

try {
    $conn=new PDO("mysql:host=$nombreServidor;bdname=$nombreBD",$nombreUsuario,$passwordUsuario);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $stmt=$conn->prepare("call usuariosBD.sp_validarLogin(:usuarioU,:claveU);");
   $stmt->bindParam(':usuarioU',$usuario);
   $stmt->bindParam(':claveU',$clave);
   $stmt->execute();
   $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
   $result= $stmt->fetchAll();
    
   $usuarioBD=$result[0]['nombreUsuario'];
   $claveBD=$result[0]['contraseniaLogin'];

   //echo "usuario: ".$usuarioBD;
   //echo "Clave: ". $claveBD;

} catch (PDOException $e) {
    echo 'Error de sintaxis de SQL' . $e->getMessage();
}
$conn=null;



if ($usuarioBD==$usuario && $claveBD==$clave) {
   // echo "Usuario y/o Contraseña Correctos...";
    //Agregar el nombre del usuario a la variable global de sesion
    $_SESSION['usuarioValido']=$usuarioBD;

    echo '
    <script>
    window.location.href="paginaAdministrador.php";
    </script>
    ';

} else {
    echo "Usuario y/o Contraseña Incorrectos..."; 
}


?>