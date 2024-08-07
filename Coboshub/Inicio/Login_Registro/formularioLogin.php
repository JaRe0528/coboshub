<?php
//Recibir los datos del formulario de crear cuenta;
/*
$nombreUsuario= $_POST['txtNombreUsuario'];
$apPaternoUsuario=$_POST[''];
$apMaternoUsuario=$_POST[''];
$emailUsuario=$_POST[''];
$telefonoUsuario=$_POST[''];
$fotoUsuario=addslashes(file_get_contents($_FILES["txtFoto"]["tmp_name"]));
$nombreLogin=$_POST[''];
$claveLogin=$_POST[''];
$idRolUsuario=$_POST[''];
*/
//Prueba
$nombreUsuario= "Alexander";
$apPaternoUsuario="Dominguez";
$apMaternoUsuario="Zarate";
$emailUsuario="23301324@uttt.edu.mx";
$telefonoUsuario="5559879544";
$fotoUsuario=null;
$nombreLogin="Alex";
$claveLogin="1234";
$idRolUsuario=1;

//Conectar a base de datos
$nombreServidor="localhost:3306";
$nombreUsuario="root";
$passwordUsuario="toormysql";
$nombreBD="usuariosBD";

try {
    $conn=new PDO("mysql:host=$nombreServidor;bdname=$nombreBD",$nombreUsuario,$passwordUsuario);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $stmt=$conn->prepare("Call sp_crearCuenta(
    :_nombreUsuario,
    :_apPaternoUsuario,
    :_apMaternoUsuario,
    :_emailUsuario,
    :_telefonoUsuario,
    :_fotoUsuario,
    :_nombreLogin,
    :_claveLogin,
    :_idRolUsuario
   )");
   $stmt->bindParam(':_nombreUsuario',$nombreUsuario);
   $stmt->bindParam(':_apPaternoUsuario',$apPaternoUsuario);
   $stmt->bindParam(':_apMaternoUsuario',$apMaternoUsuario);
   $stmt->bindParam(':_emailUsuario',$emailUsuario);
   $stmt->bindParam(' :_telefonoUsuario',$telefonoUsuario);
   $stmt->bindParam(' :_fotoUsuario',$fotoUsuario);
   $stmt->bindParam(' :_nombreLogin',$nombreLogin);
   $stmt->bindParam(':_claveLogin',$claveLogin);
   $stmt->bindParam(':_idRolUsuario',$idRolUsuario);
   
   $stmt->execute();

   echo 'Se guardo correctamente el usuario';
   
} catch (PDOException $e) {
    echo 'Error de sintaxis de SQL' . $e->getMessage();
}
$conn=null;


?>