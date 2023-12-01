<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = "stylesheet" type = "text/css" href= "styles.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <script type = "text/javascript">
            window.onload = function () {
                // Gráfica 1
                var data1 = [];
                var chart1 = new CanvasJS.Chart("g1", {
                    title: {
                        text: "Hours vs Humidity Soil"
                    },
                    axisX: {
                        title: "Hours",
                        interval: 1,
                        labelFontSize: 8,
                        minimum: 0,
                        maximum: 24,
                    },
                    axisY: {
                        title: "Humidity Soil",
                        labelFontSize: 8,
                        interval: 8,
                        minimum: 0,
                        maximum: 100,
                    },
                    data: [{ type: "area", dataPoints: data1 }],
                });

                // Obtener datos para Gráfica 1
                $.getJSON("graphOne.php", function (result) {
                    var dataLength = result.length;
                    for (var i = 0; i < dataLength; i++) {
                        data1.push({
                            x: parseInt(result[i].valorX),
                            y: parseInt(result[i].valorY)
                        });
                    }
                    chart1.render();
                });

                // Gráfica 2
                var data2 = [];
                var chart2 = new CanvasJS.Chart("g2", {
                    title: {
                        text: "Hours vs Humidity Air"
                    },
                    axisX: {
                        title: "Hours",
                        interval: 1,
                        labelFontSize: 8,
                        minimum: 0,
                        maximum: 24,
                    },
                    axisY: {
                        title: "Humidity Air",
                        labelFontSize: 8,
                        interval: 8,
                        minimum: 0,
                        maximum: 100,
                    },
                    data: [{ type: "area", dataPoints: data2 }],
                });

                // Obtener datos para Gráfica 2
                $.getJSON("graphTwo.php", function (result) {
                    var dataLength = result.length;
                    for (var i = 0; i < dataLength; i++) {
                        data2.push({
                            x: parseInt(result[i].valorX),
                            y: parseInt(result[i].valorY)
                        });
                    }
                    chart2.render();
                });

                // Gráfica 3
                var data3 = [];
                var chart3 = new CanvasJS.Chart("g3", {
                    title: {
                        text: "Hours vs Temperature"
                    },
                    axisX: {
                        title: "Hours",
                        interval: 1,
                        labelFontSize: 8,
                        minimum: 0,
                        maximum: 24,
                    },
                    axisY: {
                        title: "Temperature",
                        labelFontSize: 8,
                        interval: 4,
                        minimum: 0,
                        maximum: 45,
                    },
                    data: [{ type: "area", dataPoints: data3 }],
                });

                // Obtener datos para Gráfica 3
                $.getJSON("graphThree.php", function (result) {
                    var dataLength = result.length;
                    for (var i = 0; i < dataLength; i++) {
                        data3.push({
                            x: parseInt(result[i].valorX),
                            y: parseInt(result[i].valorY)
                        });
                    }
                    chart3.render();
                });

                // Gráfica 4
                var data4 = [];
                var chart4 = new CanvasJS.Chart("g4", {
                    title: {
                        text: "Humidity Soil vs Humidity Air"
                    },
                    axisX: {
                        title: "Humidity Soil",
                        interval: 8,
                        labelFontSize: 8,
                        minimum: 0,
                        maximum: 100,
                    },
                    axisY: {
                        title: "Humidity Air",
                        labelFontSize: 8,
                        interval: 8,
                        minimum: 0,
                        maximum: 100,
                    },
                    data: [{ type: "scatter", dataPoints: data4 }],
                });

                // Obtener datos para Gráfica 4
                $.getJSON("graphFour.php", function (result) {
                    var dataLength = result.length;
                    for (var i = 0; i < dataLength; i++) {
                        data4.push({
                            x: parseInt(result[i].valorX),
                            y: parseInt(result[i].valorY)
                        });
                    }
                    chart4.render();
                });

                // Definir la función para actualizar la página
                function actualizarPagina() {
                    location.reload(true); 
                }

                // Llamar a la función de actualización cada 15 segundos
                setInterval(actualizarPagina, 15000);
            }
        </script>
        <title> PROYECT IoT </title>
    </head>
   
    <body>
        <header id = "main_header">
            <p> ¡BIENVENIDO A ESTA EXPERIENCIA! </p>
        </header>

        <div id = "main_content">
            <div class = "box" id = "g1"></div>
            <div class = "box" id = "g2"></div>
            <div class = "box" id = "g3"></div>
            <div class = "box" id = "g4"></div>
        </div>

        <button id = "boton_barra" class = "btn"> VER INFORMACIÓN DESGLOSADA </button>

        <div class = "sidebar">
            <?php   
                //Conexion con base de datos
                $conexion = mysqli_connect("localhost","root","","iot");
                mysqli_set_charset($conexion, 'utf8');

                //Consulta
                $consulta = "SELECT * FROM information";
                $resultado = mysqli_query($conexion, $consulta);
            ?>
            <h1> Datos obtenidos </h1>
            <table class = "tabla1">
                <thead>
                    <tr>	
                    <th> Fecha </th>
                    <th> Humedad Tierra </th>
                    <th> Humedad Aire </th>
                    <th> Temperatura C°</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($registros = $resultado -> fetch_assoc() ) {?>
                    <tr>
                        <td> <?php echo $registros['date']; ?> </td>
                        <td> <?php echo $registros['humiditySoil']; ?> </td>
                        <td> <?php echo $registros['humidityAir']; ?> </td>
                        <td> <?php echo $registros['temperature']; ?> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <script>
			document.addEventListener("DOMContentLoaded", function () {
                const boton = document.getElementById('boton_barra');
                const sidebar = document.querySelector(".sidebar");
                const mainContent = document.getElementById('main_content');

                boton.addEventListener("click", function () {
                    sidebar.classList.toggle("active");
                    if (sidebar.classList.contains("active")) {
                        mainContent.style.marginLeft = '35%';
                        boton.style.marginLeft = '35%';
                    } else {
                        mainContent.style.marginLeft = '0';
                        boton.style.marginLeft = '0';
                    }
                });
            });
		</script>

        <footer id = "main_footer">
            <p> By Laisha Riestra 20310028 & Rafael Magaña 20310029 </p>
        </footer>
    </body>
</html>