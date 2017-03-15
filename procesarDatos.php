<?php

$html="";
$accion=$_POST['accion'];

include ("CRUD.php");

$crud=  new CRUD();
switch ($accion)
{
    case 'leer':

        $conexion=$crud->conexion();
        $resultado=$crud->SQL($conexion,"SELECT * FROM prueba");
        $crud->conexion_cerrar($conexion);


        while($fila = mysqli_fetch_row($resultado) )
        {
            echo '<tr>';
            foreach ($fila as $i => $value)
            {
                echo "<td> ".$fila[$i].'  </td>';
            }
            echo '
                    <td>   
                    <input type="checkbox" class="eliminar" name="eliminar[]" value="'.$fila[0].'">
                  </td>
                  <td>
                  <button class="editar" id="'.$fila[0].'">'. 'Editar</button>
                         </td>
                    </tr>';
        }


        break;

    case 'borrar':

        $datos= $_POST['values'];

        $conexion=$crud->conexion();
        foreach($datos as $dato)
        {
            $sql="DELETE FROM `prueba` WHERE `id` =\"".$dato."\"";
            $resultado=$crud->SQL($conexion,$sql);
            echo $dato."<br/>";

        }
        $crud->conexion_cerrar($conexion);

        echo '
         Borrado
          ';

        break;

    case "insertar":
        $conexion=$crud->conexion();
        $campos="";
        $valores="";

        $total= count($_POST);
        $total-=1;
        $i=0;
        foreach ($_POST as $param_name => $param_val)
        {
            $i++;

            if($param_name!="accion")
            {


                if($i==$total)
                {
                    $campos.= $param_name;
                    $valores.="'".$param_val."'";
                }
                else
                {
                    $campos.=$param_name.",";
                    $valores.="'".$param_val."'".",";
                }

            }

                //array asociativo




        }

        $sql = "INSERT INTO prueba " ."(".$campos.") VALUES (".$valores.")";
        $resultado=$crud->SQL($conexion,$sql);
        $crud->conexion_cerrar($conexion);
        echo "Hecho";
        break;

    case "editar":
        $id=$_POST["id"];

        $sql="SELECT * from `prueba` WHERE `id` =\"".$id."\"";
        $conexion=$crud->conexion();
        $resultado=$crud->SQL($conexion,$sql);
        $crud->conexion_cerrar($conexion);



        while($fila = mysqli_fetch_row($resultado) )
        {
            echo '<table>
                    <tr>';

            echo '<td>  
                     
                     <form id="FormEditar" action="procesarDatos.php" method="post">
                        <input type="hidden" name="accion" value="editar2">
                        <input type="hidden" value="'.$fila[0].'">
                        Nombre <input type="text" value="'.$fila[1].'"><br>
                        Email<input type="text" value="'.$fila[2].'"><br>
                        <button type="submit" id="cambios">Guardar</button>
                    
                    </form>
                 <br>
                  
                         </td>
                    </tr></table';
        }

        break;

    case "editar2":
        echo "llego";
        break;
}
