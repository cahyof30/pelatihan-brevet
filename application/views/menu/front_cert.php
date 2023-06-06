<html>

<head>
    <style>
        /* Gaya sertifikat */
        .sertifikat {
            width: 800px;
            height: 600px;
            border: 2px solid black;
            padding: 20px;
            text-align: center;
        }

        .nama {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .tanggal {
            font-size: 18px;
        }

        .no-cert {
            font-size: 12px;
            margin-top: 187px;
            margin-left: 370px;
        }

        .name-cert {
            font-size: 40px;
            margin-top: 80px;
            text-align: center;
            margin-right: 370px;

        }
    </style>
</head>

<body>
    <?php
    $no = 1;
    foreach ($alumni as $alm) {
    ?>
        <div>
            <img src="file:///assets/images/sertifikat.jpg" alt="Background Image" />
            <p class="no-cert"><strong><?= $alm->id; ?></strong></p>
            <p class="name-cert"><?= $alm->name; ?></p>
        </div>
    <?php } ?>
</body>

</html>