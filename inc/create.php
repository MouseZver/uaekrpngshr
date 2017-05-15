<?php

error_reporting ( E_ALL );

require dirname ( __FILE__ ) . '/db.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	$phone = filter_var ( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT );
	$url = filter_var ( $_POST['url'], FILTER_VALIDATE_URL );
	
	if ( !empty ( $phone ) && !empty ( $url ) )
	{
		if ( SQL::P( "SELECT id FROM test_table WHERE phone = ?", [ $phone ] ) -> fetchColumn() === FALSE )
		{
			SQL::P( "INSERT INTO test_table ( phone, url, time ) VALUE ( ?,?,? )", [ $phone, $url, $_SERVER['REQUEST_TIME'] ] );
			
			echo "Гуд - {$phone}";
		}
		else
		{
			echo 'Упс... такой телефон уже есть.';
		}
	}
	else
	{
		echo 'Проверьте введенные данные';
	}
}
else
{
?>
<form action = "/inc/create.php" method = "POST" class = "AJAX">
	<p>
		<input type="url" name="url" placeholder="Ссылка на изображение" />
	</p>
	<p>
		<input type="text" name="phone" placeholder="Номер моб. телефона" />
	</p>
	<p>
		<input type="submit" value="submit" />
	</p>
</form>
<?
}