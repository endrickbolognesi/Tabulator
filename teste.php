<?php
    require_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="node_modules/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="http://oss.sheetjs.com/js-xlsx/xlsx.full.min.js"></script>
        <script type="text/javascript" src="node_modules/tabulator-tables/dist/js/tabulator.min.js"></script>
    
    <title>Teste</title>
</head>
<body>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Pasta 23.201- 23.250</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Início <span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Baixar</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">PDF</a>
                        <a class="dropdown-item" href="#" id="download-xlsx">Excel/Xlsx</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Procurar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Procurar</button>
            </form>
        </div>
    </nav>

        <!-- <button type="submit" class="btn btn-primary" id="download-xlsx">XLXB</button> -->
        
        <div id="example-table"></div>
        
    </div>
    <script  type="text/javascript">
     
   var teste = [
    <?php
    // matricula_id, data_rascunho, newdate, area, proprietarios, cad_imobiliario, onus_vigente, data_conf, datanova, nome, atos_cadastrados, atos_existentes, duvidas 
    $sql = 'SELECT *
        FROM rascunho_cm
        ORDER BY matricula_id';
    $data = $conn->query($sql);
    $data->setFetchMode(PDO::FETCH_ASSOC);
    
    while ($r = $data->fetch()): 
    ?>

    {id:<?php echo $r['matricula_id'] ?>, 
    name:"<?php echo $r['nome']; ?>", 
    datarasc:"<?php echo $r['data_rascunho']; ?>", 
    dataconf:"<?php echo $r['data_conf']; ?>"
    
    },
    <?php endwhile; ?>
];

var dateEditor = function(cell, onRendered, success, cancel){

    var cellValue = moment(cell.getValue(), "DD/MM/YYYY").format("YYYY-MM-DD"),
    input = document.createElement("input");

    input.setAttribute("type", "date");

    input.style.padding = "4px";
    input.style.width = "100%";
    input.style.boxSizing = "border-box";

    input.value = cellValue;

    onRendered(function(){
        input.focus();
        input.style.height = "100%";
    });

    function onChange(){
        if(input.value != cellValue){
            success(moment(input.value, "YYYY-MM-DD").format("DD/MM/YYYY"));
        }else{
            cancel();
        }
    }

    input.addEventListener("blur", onChange);

    input.addEventListener("keydown", function(e){
        if(e.keyCode == 13){
            onChange();
        }

        if(e.keyCode == 27){
            cancel();
        }
    });

    return input;
};


    var table = new Tabulator("#example-table", {
    data:teste,
    height:"500px",
    columns:[
        {title:"Matricula", field:"id", width:200, editor:true},
        {title:"Nome", field:"name", width:100, editor:true},
        {title:"Data", field:"datarasc", editor:true},
        {title:"Data Conf", field:"dataconf", editor:true},
    ],
});

//trigger AJAX load on "Load Data via AJAX" button click
$("#file-load-trigger").click(function(){
    table.setDataFromLocalFile();
});

$("#download-xlsx").click(function(){
    table.download("xlsx", "data.xlsx", {sheetName:"teste"});
});


    </script>
    
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>