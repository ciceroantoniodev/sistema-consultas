<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Logout</title>

    <!-- Bootstrap -->
    <link href="<?=URL?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .btn-w {
            width: 100px;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <?php
    if ($vLocation) {
        echo '<script>top.location.href="' . URL . '/Login";</script>';
        echo '<noscript><meta http-equiv="refresh" content="0;url=' . URL . '/Login"></noscript>';
        exit;
    }
    ?>

    <table style="width: 100%; height: 90vh; display: flex; justify-content: center; align-items: center; text-align: center;">
        <tr>
            <td>
                <h2>Realmente deseja sair do sistema?</h2>
                <div style="margin-top: 20px; font-size: 20px;">
                    <a href="<?=URL?>/office/logout&confirm=yes" class="btn btn-secondary btn-w">SIM</a>
                    <a href="<?=URL?>/office/inicio" class="btn btn-secondary btn-w">N&Atilde;O</a>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>