
<?php
require "db.php";
$data = $_POST;

if(isset($data['signup'])){
	$error = array();
	
	if(trim($data['loginn']) == ''){
		$error[] = 'Введите логин';
	}
	if(trim($data['password']) == ''){
		$error[] = 'Введите пароль';
	}
	if(trim($data['password_2']) == ''){
		$error[] = 'Повторите пароль';
	}
	if(R::count('users', 'loginn = ?', array($data['loginn'])) > 0){
		$error[] = 'Логин занят';
	}
	if(trim($data['password']) != trim($data['password_2'])){
		$error[] = 'Пароли не совпадают';
	}

	if(empty($error)){
		$user = R::dispense('users');
		$user->loginn = $data['loginn'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
		$user->ip = $_SERVER['REMOTE_ADDR'];
		$user->d_date_reg = date("d");
		$user->m_date_reg = date("m");
		$user->Y_date_reg = date("Y");
		$user->H_date_reg = date("H");
		$user->i_date_reg = date("i");
		R::store($user);
	}else{
		echo "<div>".array_shift($error)."</div>";
	}
}


if (isset($data['signin']))
{
	$user = R::findOne('users', 'loginn = ?', array($data['loginn']));
	if ($user)
	{
		if(password_verify($data['password'], $user->password))
		{
			$_SESSION['logged_user'] = $user;
		}

		else
		{
			echo "Неверный пароль";
		}
	}
	else
	{
		echo "Такого ользователя не существует";
	}

}

?>



<?php if(isset($_SESSION['logged_user'])) : ?>
	<meta http-equiv="refresh" content="0; URL = '/table.php'" />
<?php else : ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="str/style.css">
    <title>athorization</title>
</head>

<body>
    <div class="input">
        <p class="text">Авторизация</p>

        <div class="asd">
        </div>

        <form action="/" method="POST">
            <input type="text" placeholder="  Введите логин" id="login"  class="login"  name = "loginn">
            <input type="password" placeholder="  Введите пароль" required minlength="4" maxlength="8" class="pass" name = "password">
            <br>
            <button onclick="viewDiv()" value="Click" class="but">Регистрация</button>
            <button class="but" name = "signin">Войти</button>
        </form>

        </div>
        <div class="win" id="div1">
            <p class="text">Регистрация</p>
            <form action="/" method="POST">
                <input type="text" placeholder="Введите логин" id="login"  class="login" name = "loginn">
                <input type="password" placeholder="Введите пароль" required minlength="4" maxlength="8" class="pass" name = "password">
                <input type="password" placeholder="Подтвердите пароль" required minlength="4" maxlength="8" class="pass" name = "password_2">
                <button onclick="viewDiv()" value="Click" class="but" name = "signup">Зарегистрироваться</button>
            </form>

        </div>

        <script src="script.js"></script>
    </div>
</body>
</html>

<?php endif; ?>
