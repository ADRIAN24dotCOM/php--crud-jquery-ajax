<?php


class CRUD
{


    function conexion()
    {
        $bd_host='localhost';

        $bd_usuario='root';

        $bd_password='';

        $bd_base='imperiomarketingadews24';


        $conexion = new mysqli($bd_host, $bd_usuario, $bd_password, $bd_base);

        if ($conexion->connect_errno)
        {
            echo "No se pudo conectar a la BBDD: (". $conexion->connect_errno . ") " . $conexion->connect_error;

        }
        else
        {
            //  echo "conexion exitosa";
        }

        return $conexion;
    }


    function SQL($conexion,$sql)
    {

        $resultado =mysqli_query($conexion,$sql);
        return $resultado;

    }


    function conexion_cerrar($conexion)
    {
        mysqli_close($conexion);
        // echo "conexion cerrada";

    }

}
