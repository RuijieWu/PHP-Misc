<?php
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";
 
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
       $nameErr = "Name is required";
       } else {
          $name = test_input($_POST["name"]);
          // 检测名字是否只包含字母跟空格
          if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
          $nameErr = "只允许字母和空格"; 
          }
      }
    
    if (empty($_POST["email"])) {
       $emailErr = "Email is required";
    } else {
       $email = test_input($_POST["email"]);
       // 检测邮箱是否合法
       if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
          $emailErr = "非法邮箱格式"; 
       }
    }
      
    if (empty($_POST["website"])) {
       $website = "";
    } else {
       $website = test_input($_POST["website"]);
       // 检测 URL 地址是否合法
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
          $websiteErr = "非法的 URL 的地址"; 
       }
    }
 
    if (empty($_POST["comment"])) {
       $comment = "";
    } else {
       $comment = test_input($_POST["comment"]);
    }
 
    if (empty($_POST["gender"])) {
       $genderErr = "性别是必需的";
    } else {
       $gender = test_input($_POST["gender"]);
    }
 }
?>

<h3>*为必填字段</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"> 
   名字: <input type="text" name="name">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   E-mail: <input type="text" name="email">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   网址: <input type="text" name="website">
   <span class="error"><?php echo $websiteErr;?></span>
   <br><br>
   备注: <textarea name="comment" rows="5" cols="40"></textarea>
   <br><br>
   性别:
   <input type="radio" name="gender" value="female">女
   <input type="radio" name="gender" value="male">男
   <span class="error">* <?php echo $genderErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>
<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
echo "<h2>你输入的内容为:</h2>";
echo "<h3>名字:$name</h3>";
echo "<h3>E-mail:$email</h3>";
echo "<h3>网址:$website</h3>";
echo "<h3>备注:$comment</h3>";
echo "<h3>性别:$gender</h3>";
}
?>
