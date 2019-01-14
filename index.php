
<head>

    <script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
    <script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script>

    <style>

        table{
            font-size: 20px;
            margin-left: 18%;
        }

        td, th {
            background: slategrey;
            color: whitesmoke;
            border:solid black 2px;
            border-radius: 5px;
            margin-right: 10%;
            margin-left: 10%;
            padding-top: 30px;
            padding-bottom: 30px;
            padding-right: 100px;
            padding-left: 100px;
        }

        th {
            background: black;
            color: white;
        }

        #myChart {
            margin-left: 10%;
            height:80%;
            width:80%;
            min-height:250px;
        }
        .zc-ref {
            display:none;
        }

    </style>


</head>


<?php
/**
 * Created by PhpStorm.
 * User: sstienface
 * Date: 04/12/2018
 * Time: 11:25
 */

// Premiere ligne

include "log.php";

function affichage ()
{

    GLOBAL $conn;

    $sql = "SELECT  eleves.nom as nom,eleves.prenom as prenom, eleves_informations.age as age,eleves_informations.ville as ville  FROM eleves, eleves_informations WHERE eleves.id = eleves_informations.eleves_id";

    $result = $conn->query($sql);
    ?>

    <body>
        <table>
            <th> Nom </th>
            <th> Prenom </th>
            <th> Age </th>
            <th> Ville </th>

            <?php

    while ($row = $result->fetch_assoc()) {

    ?>


        <tr>
            <td> <?= $row['nom'] ?> </td>
            <td> <?= $row['prenom'] ?> </td>
            <td> <?= $row['age'] ?> </td>
            <td> <?= $row['ville']; ?> </td>
        </tr>

    <?php
    }
    ?>
</table>
        <div id='myChart'><a class="zc-ref" href="https://www.zingchart.com/">Powered by ZingChart</a></div>

    </body>

<?php
}

affichage();


    GLOBAL $conn;

    $sql = "SELECT niveau_ae,niveau,competences_id  from eleves_competences WHERE eleves_id = 1";

    $result = $conn->query($sql);

    $competences = array();

   $sbl = "SELECT id, titre from competences";

    $result1 = $conn->query($sbl);

    $competences1 = array();

while ($row = $result->fetch_assoc()) {

    $i = $row['competences_id'];

    $competences[$i] = array("niveau"=>$row['niveau'],"niveau_ae"=>$row['niveau_ae']);

    $i++;

    ?>

        <script>

    var myConfig = {
        type : 'radar',
        plot : {
            aspect : 'area',
            animation: {
                effect:3,
                sequence:1,
                speed:700
            }
        },
        scaleV : {
            values: "0:20:1"
        },
        scaleK : {
            values : '0:3:1',

            <?php

            while ($row1 = $result1->fetch_assoc()) {

            $j = $row1['id'];

            $competences1[$j] = array("titre" => $row1['titre']);

            $j++;

            ?>

            labels : [<?= $competences1[1]['titre'] ?>,<?= $competences1[2]['titre'] ?>,<?= $competences1[3]['titre'] ?>,<?= $competences1[4]['titre'] ?>],

            <?php

            }

            ?>

            item : {
                fontColor : '#607D8B',
                backgroundColor : "white",
                borderColor : "#aeaeae",
                borderWidth : 1,
                padding : '5 10',
                borderRadius : 10
            },
            refLine : {
                lineColor : '#c10000'
            },
            tick : {
                lineColor : '#59869c',
                lineWidth : 2,
                lineStyle : 'dotted',
                size : 20
            },
            guide : {
                lineColor : "#607D8B",
                lineStyle : 'solid',
                alpha : 0.3,
                backgroundColor : "#c5c5c5 #718eb4"
            }
        },
        series : [
            {
                values : [<?= $competences[1]['niveau'] ?>,<?= $competences[2]['niveau'] ?>, <?= $competences[3]['niveau'] ?>, <?= $competences[4]['niveau'] ?>],
                text:'farm'
            },
            {
                values : [<?= $competences[1]['niveau_ae'] ?>, <?= $competences[2]['niveau_ae'] ?>, <?= $competences[3]['niveau_ae'] ?>, <?= $competences[4]['niveau_ae'] ?>],
                lineColor : '#53a534',
                backgroundColor : '#689F38'
            }
        ]
    };

    zingchart.render({
        id : 'myChart',
        data : myConfig,
        height: '100%',
        width: '100%'
    });

</script>
<?php
}








