<?php
session_start();
include("function/conexion.php");

if($_POST){
$q = $_POST['palabra'];//se recibe del jquery la cadena que queremos buscar
$consulta = "SELECT * FROM persona WHERE concat(Nombre,' ',Ap_Paterno,' ',Ap_Materno) like '%".$q."%' and numero=1 ORDER BY nombre LIMIT 10";
$sql_res=mysqli_query($conexion,$consulta);

while($row=mysqli_fetch_assoc($sql_res)){
	$rut=$row['Rut'];
	$nombre = $row['Nombre'];
	$paterno = $row['Ap_Paterno'];
	$materno = $row['Ap_Materno'];
	$perfil ="Alumno";


$consultal = "SELECT * FROM alumno WHERE Persona_Rut='".$row['Rut']."'";
$sql_resl=mysqli_query($conexion,$consultal);
$rowal=mysqli_fetch_array($sql_resl);//sacamos id alumno y foto
	$id_Alumno=$rowal['id_alumno']."";
	$foto=$rowal['Foto'];
	$ditto=$rowal['nombreCarpeta'];

if ($foto=="usuario.jpg") {
	$ruta="images/Alumno/usuario.jpg";
}else{
	$ruta ="images/".$ditto."/".$foto;
}


$_SESSION['modo']="cargar";

?>
<a href="mantenedor_al.php?id=<?php echo @$id_Alumno; ?>" style="text-decoration:none;" >
<div onclick="" class="div_encontrado" align="left">
<div style="float:left; margin-right:6px;"><img src="<?php echo $ruta ?>" width="60" height="60" /></div>
<div onclick="" style="margin-right:6px;"><b><?php echo $nombre." ".$paterno." ".$materno; ?></b></div>



<div style="margin-right:6px; font-size:12px;" class="div_detalle"><?php echo "Perfil: <strong>".$perfil; ?></strong></div></div>
</a>

<?php
}
?>

<?php
}else{
//no post
}
?>