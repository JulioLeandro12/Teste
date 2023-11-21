<?php 
$dadosValidos = true;
if ($_SERVER["REQUEST_METHOD"] == ["POST"]){
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    if (isset($email) && isset($senha)){
        $arquivoCSV = "csv/users.csv";
        $fpn = fopen($arquivoCSV, "r"); // fopen é usado para abrir arquivos e "r" é de "read"
        if ($fpn){
            while (($row = fgetcsv($fpn)) !== false) {
                if ($row[0] == $email && $row[1] == $senha){
                    session_start();
                    $_SESSION["user"] = $row[0];
                    $_SESSION["auth"] = true;
                    fclose($fpn);
                    header("location: /public/home.php", true, 302);
                    exit;
                }
            }
            fclose($fpn);
            $dadosValidos = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Make your Login</title>
</head>
<body>
<div>
    <h1 class="topPage">Welcome!</h1>
    <form action=<?php $_SERVER["PHP_SELF"]?> method="post" class="padrao01">
        <input type="email" placeholder="E-mail or number" name="email" required id="stylePlaceHolder">
        <input type="password" placeholder="Password" name="password" required id="stylePlaceHolder">
        <input type="submit" value="Login" id="stylePlaceHolder">
        <p class="p"><a href="public/cadastro.php">Create New Accont</a></p>
    </form>
    <?php if (!$dadosValidos):?>
    <p class="aviso">Information Incorrect!</p>
    <?php endif?>
</div>
</body>
</html>