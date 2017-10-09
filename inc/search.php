<?php

error_reporting ( E_ALL );

require dirname ( __FILE__ ) . '/db.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	$statement = SQL::P( "SELECT * FROM test_table WHERE phone = ?", [ filter_var ( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT ) ] );
	
	if ( $statement -> rowCount() > 0 )
	{
		[ $id, $phone, $url ] = $statement -> fetch( PDO::FETCH_ASSOC );
		
		printf ( 'ID: %s<br>Number: %s<br>Image: <br><img src="%s">', $id, $phone, $url );
	}
	else
	{
		echo 'Результат вернул 0 строк.';
	}
}
else
{
?>
<form action = "/inc/search.php" method = "POST" class = "AJAX">
	<p>
		<input type="text" name="phone" placeholder="Номер моб. телефона" />
	</p>
	<p>
		<input type="submit" value="найти" />
	</p>
</form>
<?
}
