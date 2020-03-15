<!DOCTYPE html>
<meta charset="utf-8">
<style>
    #number, #account, #amount {display: none;}
    form {margin: auto; border: 1px dashed blue; padding: 20px; width:300px;}
</style>

<?php
session_start();
include ("account.php");

$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
mysqli_select_db($db, $project);

if (!isset($_SESSION["pinpass"]))
{
    echo "<br> Not authorized; please enter correct pin";
    header("refresh: 2; url=pin1.php");
    exit();
}
?>

<form action="service2.php" autocomplete="off">
    <input type=radio name="choice" id="List" value="List"> List <br>
    <input type=radio name="choice" id="Perform" value="Perform"> Perform <br>
    <input type=radio name="choice" id="Clear" value="Clear"> Clear <br>
    
    <input type=submit>
    <div id="number"><input type=text name="number"> Enter number <br></div>
    <div id="account"><input type=text name="account"> Enter account <br></div>
    <div id="amount"><input type=text name="amount"> Enter amount <br></div>
</form>

<script>
var actNumber = document.getElementById("number")
var actAccount = document.getElementById("account")
var actAmount = document.getElementById("amount")
var list = document.getElementById("List")
var perform = document.getElementById("Perform")
var clear = document.getElementById("Clear")

list.addEventListener("click", action)
perform.addEventListener("click", action)
clear.addEventListener("click", action)

function action()
{
    actNumber.style.display = "none"
    actAccount.style.display = "none"
    actAmount.style.display = "none"

    switch (this.value)
    {
        case "List":
            actNumber.style.display = "block"
            break
        case "Perform":
            actAccount.style.display = "block"
            actAmount.style.display = "block"
            break
        case "Clear":
            actAccount.style.display = "block"
            break
    }
}
</script>

