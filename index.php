<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>SVG statistiques</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h1><span>Graph {{<sv>SVG</sv>,<aj>AJAX</aj>,<js>JSON</js>,<jq>JQUERY</jq>}}</span></h1>
            <div id="d" style="margin-top: 50px;"></div>
        </div>
        <footer>
            <h3>By<em> {Mostafa ASHARF}</em></h3>
        </footer>
    </div>
</body>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        //load data from the server every 5s :
        setInterval(function(){
            $.getJSON("data.php").then(function(data){
                var points = '"0,500 ';
                var allCircles = '';
                $.each(data, function(i, field){
                    var circleDebut = '<circle r="3" fill="#d500f9" stroke="#d500f9" stroke-width="2px" class="circle" ';
                    var circleFin = '></circle>';
                    if (i == data.length) {
                        points += '';
                    } else {
                        if (i % 2 == 0) {
                            points += data[i] + ',';
                        } else {
                            points += data[i] + ' ';
                            circleDebut += 'cx="' + data[i - 1] + '"'; //cx
                            circleDebut += ' cy="' + data[i] + '" title="' + data[i - 1] + ',' + data[i] + '"'; //cy + title
                            circleDebut += circleFin;//fermer la circle
                            allCircles += circleDebut; //ajouter la circle cree
                        }
                    }
                });
                points += ' 1000,500"';
                //create the svgObj :
                var svgObj = '<svg width="1000" height="350"><polyline points=' + points + ' style="fill: #b9f6ca; stroke: #40c4ff; stroke-width: 2px;"></polyline>' + allCircles + '</svg>';
                //add the svg element to our div :
                document.getElementById('d').innerHTML = svgObj;
                console.log(svgObj);
                //activate tooltips for svg circles :
                $('circle').tooltip({
                    'placement' : 'top',
                    'container' : 'body'
                });
            });
        }, 5000);
    });

    //create Xaxis and Yaxis with d3js :
</script>
</html>