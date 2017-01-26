<html>
<head>
    <meta charset="utf-8">
    <title>Leer XLS</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style type="text/css"></style>

  

    <?php
    
      require_once 'Excel/reader.php';


      $data = new Spreadsheet_Excel_Reader();
      $data->setOutputEncoding('CP1251'); // Character Encodings - Legacy Encodings - CP1251
      $data->read('ClientesUT8.xls');


    ?>

 
</head>
    <body>
        <div class="table-responsive">
        <table class="table table-bordered">
<?php      

    # Conexión base de datos MySql
    $link = mysqli_connect("localhost","root","root","PCRClientes2");
    if (mysqli_connect_errno()) {
                die("Error al conectar: ".mysqli_connect_error());
        }
        
//$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
/*
$result = mysqli_query($link, "SELECT * FROM Clientes");

while (($fila = mysqli_fetch_array($result))!=NULL){

               printf("<tr> 
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
               <td>%s</td>
                    </tr>",          
                $fila['codcli'], $fila['razon'], $fila['direccion'], $fila['codigopostal'], $fila['poblacion'], $fila['provincia'], 
                $fila['telefono'], $fila['rotulo'], $fila['nif'], 
                $fila['DtoFamilia01'], $fila['DtoFamilia02'], $fila['DtoFamilia03'], $fila['DtoFamilia04'], $fila['DtoFamilia05'], $fila['DtoFamilia06'], $fila['DtoFamilia07'], $fila['DtoFamilia08'], $fila['DtoFamilia09'], $fila['DtoFamilia10']);

                }

            # Libero la memoria asociada a result y cierro base de datos
            mysqli_free_result($result);
*/
            


# Leer el documento EXCEL y cada línea la introducimos en la base de datos creada

for ($fila = 1; $fila <= $data->sheets[0]['numRows']; $fila++) {

	$vcodcliente = $data->sheets[0]['cells'][$fila][1]; 
	$vrazon = $data->sheets[0]['cells'][$fila][2]; 
	$vdireccion = $data->sheets[0]['cells'][$fila][3];
	$vcodigopostal = $data->sheets[0]['cells'][$fila][4];
    
	$vpoblacion = $data->sheets[0]['cells'][$fila][5];
    
	$vprovincia = $data->sheets[0]['cells'][$fila][6];
	$vtelefono = $data->sheets[0]['cells'][$fila][7];
	$vrotulo = $data->sheets[0]['cells'][$fila][8];
	$vnif = $data->sheets[0]['cells'][$fila][9];

    printf("<tr>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td></td>
           </tr>",
            $fila, 
            $vcodcliente, 
            $vrazon,
            $vdireccion,
            $vcodigopostal, 
            $vpoblacion, 
            $vprovincia, 
            $vtelefono,
            $vrotulo,
            $vnif);
    
        /*
        # Enviamos toda la infomación a la base de datos
        $sql="INSERT INTO Clientes (codcli, razon, direccion, codigopostal, poblacion, provincia, telefono, rotulo, nif, DtoFamilia01, DtoFamilia02, DtoFamilia03, DtoFamilia04, DtoFamilia05, DtoFamilia06, DtoFamilia07, DtoFamilia08, DtoFamilia09, DtoFamilia10)
        VALUES ('$vcodcliente', '$vrazon', '$vdireccion', '$vcodigopostal', '$vpoblacion', '$vprovincia', '$vtelefono', '$vrotulo', '$vnif','0','0','0','0','0','0','0','0','0','0')";

        # Escribimos el registro correspondiente al índice de $fila en la base de datos
        $result = mysqli_query($link, $sql);
        */

}



    # Desconectamos Base de datos       
    $close = mysqli_close($link) 
     or die("Ha sucedido un error inexperado en la desconexion de la base de datos");

?>
        </table>
        </div>
    </body>
</html>