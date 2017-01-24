<?php
require_once 'Excel/reader.php';

$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251'); // Character Encodings - Legacy Encodings - CP1251
$data->read('DatosClientes.xls');

		
// Mostramos los datos en forma de tabla por medio de un bucle for

echo("<table>");
for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	echo("<tr>");
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		echo("<td>".$data->sheets[0]['cells'][$i][$j] ."</td>");
	}
	echo("</tr>");	
}
echo("</table>");


// Conectamos con la base de datos 

$dbhost="localhost";  	// host del MySQL (generalmente localhost)
$dbusuario="root"; 		// aqui debes ingresar el nombre de usuario para acceder a la base
$dbpassword=""; 	// password de acceso para el usuario de la linea anterior
$db="";     // Seleccionamos la base con la cual trabajar

$conexion = mysql_connect($dbhost, $dbusuario, $dbpassword);
mysql_select_db($db, $conexion);


// Otra manera de leer el documento EXCEL y cada línea la introducimos en la base de datos creada

for ($fila = 1; $fila <= $data->sheets[0]['numRows']; $fila++) {
	echo("<tr>");
	$vcodcliente = $data->sheets[0]['cells'][$fila][1]; 
	$vrazon = $data->sheets[0]['cells'][$fila][2]; 
	$vdireccion = $data->sheets[0]['cells'][$fila][3];
	$vcodigopostal = $data->sheets[0]['cells'][$fila][4];
	$vpoblacion = $data->sheets[0]['cells'][$fila][5];
	$vprovincia = $data->sheets[0]['cells'][$fila][6];
	$vtelefono = $data->sheets[0]['cells'][$fila][7];
	$vrotulo = $data->sheets[0]['cells'][$fila][8];
	$vnif = $data->sheets[0]['cells'][$fila][9];
	echo $fila, " - ", $vcodcliente, $vrazon, $vdireccion, $vcodigopostal, $vpoblacion, $vprovincia, $vtelefono, $vrotulo, $vnif;  
	echo("</tr>");echo("<BR>");

	// Aquí cada línea que obtenemos de la hoja excel la introducimos en la base de datos MySQL

	$result = mysql_query("INSERT INTO clientes (codcli, razon, direccion, codigopostal, poblacion, provincia, telefono, rotulo, nif, DtoFamilia01, DtoFamilia02, DtoFamilia03, DtoFamilia04, DtoFamilia05, DtoFamilia06, DtoFamilia07, DtoFamilia08, DtoFamilia09, DtoFamilia10) VALUES ('$vcodcliente', '$vrazon', '$vdireccion', '$vcodigopostal', '$vpoblacion', '$vprovincia', '$vtelefono', '$vrotulo', '$nif','0','0','0','0','0','0','0','0','0','0')", $conexion);
	if (!$result) {
    				die('Consulta no válida: '.mysql_error());
	}

}


// Cerramos la base de datos
mysql_close($conexion);

?>