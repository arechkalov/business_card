 <?php
 /* Осуществляем проверку вводимых данных и их защиту от враждебных 
скриптов */
$your_name = htmlspecialchars($_POST["your_name"]);
$email = htmlspecialchars($_POST["email"]);
$message = htmlspecialchars($_POST["comment"]);
/* Устанавливаем e-mail адресата */
$myemail = "antony.rechkalov@gmail.com";
/* Проверяем заполнены ли обязательные поля ввода, используя check_input 
функцию */
$your_name = check_input($_POST["your_name"], "Enter your name!");
$email = check_input($_POST["email"], "Enter your e-mail!");
$message = check_input($_POST["comment"], "Enter your message!");
/* Проверяем правильно ли записан e-mail */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
show_error("<br /> Е-mail adress doesn't exist");
}
/* Создаем новую переменную, присвоив ей значение */
$message_to_myemail = "Hello! 
Your message was sent! 
Name: $your_name 
E-mail: $email 
Text: $message 
Thank you.";
/* Отправляем сообщение, используя mail() функцию */
$from  = "From: $your_name <$email> \r\n Reply-To: $email \r\n"; 
mail($myemail, $message_to_myemail, $from);
?>
<p>Your message was successfully sent!</p>
<p>Go <a href="index.php"> back>>></a></p>

<?php
$date = date('l jS \of F Y h:i:s A');
$ip = $ipaddress = getenv('REMOTE_ADDR');
 $a1="file.txt";
$a2=fopen($a1,"r"); // открываем для чтения
$text=fread($a2,filesize($a1)); //читаем
fclose($a2);
 
$what= "----------||----------\r\n Date:$date\r\n IP:$ip\r\n Name:$your_name\r\n E-mail:$email\r\n Messsage:$message\r\n "; // строка
$f=fopen("file.txt","w"); // открываем для записи
// пишем нашу строку и к ней добавляем раннее содержимое файла
fwrite($f,$what.$text);
fclose($f);
?>

<?php
/* Если при заполнении формы были допущены ошибки сработает 
следующий код: */
function check_input($data, $problem = "")
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
if ($problem && strlen($data) == 0)
{
show_error($problem);
}
return $data;
}
function show_error($myError)
{
?>
<html>
<body>
<p>Please correct your error:</p>
<?php echo $myError; ?>
</body>
</html>
<?php
exit();
} 
?> 