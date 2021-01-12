<?php
  $array = array("firstname" => "", "name" => "", "email" => "", "phone" => "", "message" => "", "firstnameError" => "", "nameError" => "", "emailError" => "", "phoneError" => "", "messageError" => "", "isSuccess" => false);

  $emailTo = "kintymoustapha@gmail.com";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // code...
    $array["firstname"] = verifyInput($_POST["firstname"]);
    $array["name"] = verifyInput($_POST["name"]);
    $array["email"] = verifyInput($_POST["email"]);
    $array["phone"] = verifyInput($_POST["phone"]);
    $array["message"] = verifyInput($_POST["message"]);
    $array["isSuccess"] = true;
    $emailText = "";

    if (empty($array["firstname"])) {
      // code...
      $array["firstnameError"] = "Je veux connaitre ton prénom !";
      $array["isSuccess"] = false;
    } else {
      // code...
      $emailText .= "FirstName: {$array["firstname"]}\n";
    }
    if (empty($array["name"])) {
      // code...
      $array["nameError"] = "Et oui je veux tout savoir. Même ton nom !";
      $array["isSuccess"] = false;
    } else {
      // code...
      $emailText .= "Name: {$array["name"]}\n";
    }
    if (!isEmail($array["email"])) {
      // code...
       $array["emailError"] = "Ton email n'est pas bon !";
       $array["isSuccess"] = false;
    } else {
      // code...
      $emailText .= "Email: {$array["email"]}\n";
    }
    if (!isPhone($array["phone"])) {
      // code...
      $array["phoneError"] = "Que des chiffres et des espaces, stp...";
      $array["isSuccess"] = false;
    } else {
      // code...
      $emailText .= "Phone: {$array["phone"]}\n";
    }
    if (empty($array["message"])) {
      // code...
      $array["messageError"] = "Qu'est ce que tu veux me   dire ?";
      $array["isSuccess"] = false;
    } else {
      // code...
      $emailText .= "Message: {$array["message"]}\n";
    }
    if ($array["isSuccess"]) {
      // code...
      $headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
      mail($emailTo, "Un message de votre site", $emailText, $headers);
    }

    echo json_encode($array);

  }

function isPhone($var)
{
  // code...
  return preg_match("/^[0-9 ]*$/", $var);
}

function isEmail($var)
{
  // code...
  return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function verifyInput($var)
{
  // code...
  $var = trim($var);
  $var = stripslashes($var);
  $var = htmlspecialchars($var);
  return $var;
}

 ?>
