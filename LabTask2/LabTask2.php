<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $dateofbirthErr = $degreeErr = $bloodgroupErr = "";
$name = $email = $gender = $dateofbirth = $degree = $bloodgroup = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["name"])) {
$nameErr = "Name is required";
} else {
$name = test_input($_POST["name"]);
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
$nameErr = "Only letters and white space allowed";
$name="";
}
if(str_word_count($name)>=2){
$name= test_input($_POST["name"]);
}
else{
$nameErr="Name must contain 2 words";
$name="";
}
}
if (empty($_POST["email"])) {
$emailErr = "Email is required";
} else {
$email = test_input($_POST["email"]);
// check if e-mail address is well-formed
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Invalid email format";
$email ="";
}
}
if (empty($_POST["dateofbirth"])) {
$dateofbirthErr = "Date of birth is required";
$dateofbirthErr="";
} else {
$dateofbirth = test_input($_POST["dateofbirth"]);
}
}
if (empty($_POST["gender"])) {
$genderErr = "Gender is required";
$genderErr= "";
} else {
$gender = test_input($_POST["gender"]);
}
if (empty($_POST["degree"])) {
$degreeErr = "Degree is required";
$degreeErr="";
} else {
$degree = test_input($_POST["degree"]);
}
if (empty($_POST["bloodgroup"])) {
$bloodgroupErr = "Blood group is required";
$bloodgroupErr= "";
} else {
$bloodgroup = test_input($_POST["bloodgroup"]);
}

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
<p><span class="error">*Required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
NAME: <input type="text" name="name" value="<?php echo $name;?>">
<span class="error">* <?php echo $nameErr;?></span>
<br><br>
EMAIL: <input type="text" name="email" value="<?php echo $email;?>">
<span class="error">* <?php echo $emailErr;?></span>
<br><br>
DATE OF BIRTH:<br> 
dd <input type="text" name="date"> /
mm <input type="text" name="month"> /
yyyy <input type="text" name="year">
<span class="error">* <?php echo $dateofbirthErr;?></span>
<br><br>
Gender:
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="Female">Female
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="Male">Male
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="Other">Other
<span class="error">* <?php echo $genderErr;?></span>
<br><br>
DEGREE:<input type="checkbox" id="degree" name="degree" value="SSC">
<label for="degree"> SSC </label>
<input type="checkbox" id="degree" name="degree" value="HSC">
<label for="degree"> HSC </label>
<input type="checkbox" id="degree" name="degree" value="Bsc">
<label for="degree"> Bsc </label>
<input type="checkbox" id="degree" name="degree" value="Msc">
<label for="degree"> Msc </label>
<span class="error">* <?php echo $degreeErr;?></span>
<br><br>
BLOOD GROUP: <label for="bloodgroup"></label>
<select id="bloodgroup" name="bloodgroup">
  <option value="A+">A+</option>
  <option value="B+">B+</option>
  <option value="AB+">AB+</option>
  <option value="O+">O+</option>
  <option value="A-">A-</option>
  <option value="B-">B-</option>
  <option value="AB-">AB-</option>
  <option value="O-">O-</option>
</select>
<span class="error">* <?php echo $bloodgroupErr;?></span>
<br><br>
<input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $dateofbirth;
echo "<br>";
echo $gender;
echo "<br>";
echo $degree;
echo "<br>";
echo $bloodgroup;
echo "<br>";
?>

</body>
</html>