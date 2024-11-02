<!-- Write a PHP program to store page views count in SESSION, to increment the
count on each refresh, and to show the count on web page. -->

<!-- AIM: To display the session count using PHP programming -->
 
<html>
<head>
<title>Page Views </title>
</head>
<body bgcolor="#cCCFFCC" text="#003300">
<h1> Web Programming Lab</h1>
<p> Welcome to Web Programming Lab </p>
<hr />
<p style="color:blue; font-style: italic">
<?php
session_start();
// session_register("count");

if (!isset($_SESSION["count"]))
{
$_SESSION["count"] = 0;
echo "Counter initialized... <br />";
}
else { $_SESSION["count"]++; }
echo "Number of Page Views : <b>$_SESSION[count]</b></p>";
?>
<p>Reload this page to increment</p>
</body>
</html>