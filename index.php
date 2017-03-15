

<html>

<head>

    <title></title>
    <script language="javascript" src="js/jquery.js"></script>
</head>

<body>

<form id="FormDatos">

    <span> nombre</span> <input  type="text" name="nombre" required/>
    <span> email</span><input  type="email" name="email" required/>

<input name="accion" value="insertar" type="hidden"><br/>
    <button type="submit" id="insertar" name="insertar">Insertar </button>
</form>


<button  id="leer" name="leer">Leer </button>
<button   id ="borrar" name="borrar">Borrar </button>

<div id="respuesta">



</div>

<div id="mensaje">



</div>

</body>

</html>
<script >
    $(document).ready(function() {

        //insertar
        $("#FormDatos").on("submit" ,function(e) {

            e.preventDefault();

            var formData = new FormData(document.getElementById("FormDatos"));


            $.post("procesarDatos.php", $("#FormDatos").serialize(), function(data) {
                $("#respuesta").html(data);});



            /*
            $.ajax({
                url: "procesarDatos.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
                .done(function(res){

                    $("#respuesta").html(res);


                }); */

            });



        //ver datos a editar
        $(document).on("click",".editar",function() {
              id=  $(this).attr("id");
            accion="editar";
           $.post("procesarDatos.php",{id:id,accion:accion},function (data) {
               $("#respuesta").html(data);
           });
        });

//enviar datos nuevos
/*
  $(document).on("click","#cambios",function () {


      /*$.post("procesarDatos.php", $("#FormEditar").serialize(),function (data) {
            $("#respuesta").html(data);
            });
  });*/
//////////////////////////////77


        //leer
        $("#leer").click(function ()
        {

            //var nombre = $(".mandaraccion").attr("name");
            accion="leer";
            $.post("procesarDatos.php", {accion: accion}, function (data) {
                $("#respuesta").html(data);});

        });


        /*BORRAR*/
        function getchekboxes() {
            var values = $('input:checkbox:checked.eliminar').map(function () {
                return this.value;
            }).get();

            return values;
        }

        function BorrarDatos(values) {

            if (values.length > 0)
            {
                accion="borrar";

                $.post("procesarDatos.php", {accion:accion,values:values}, function(data)
                {
                    $("#respuesta").html(data);


                });

            }
        }

        $("#borrar").click(function ()
        {
            values=  getchekboxes();

            BorrarDatos(values);

        });
        /*BORRAR*/


    });
//http://stackoverflow.com/questions/17605296/document-onclick-not-working

</script>

