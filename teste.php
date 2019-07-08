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
        <button type="submit" class="btn btn-primary" id="download-xlsx">XLXB</button>
        
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
    height:"311px",
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