<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | 404 Error</title>

    <link href="<?= URLADM ?>app/adms/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URLADM ?>app/adms/assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= URLADM ?>app/adms/assets/css/animate.css" rel="stylesheet">
    <link href="<?= URLADM ?>app/adms/assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Pagina não encontrada</h3>

        <div class="error-desc">
            <?php
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
            ?>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?= URLADM ?>app/adms/assets/js/jquery-2.1.1.js"></script>
    <script src="<?= URLADM ?>app/adms/assets/js/bootstrap.min.js"></script>

</body>
</html>
