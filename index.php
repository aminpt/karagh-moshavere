<?php
$names=json_decode(file_get_contents('people.json'),true);
if ($_POST["question"]!='') {
	$question = $_POST["question"];
	$en_name = $_POST["person"];
	$fa_name = $names[$en_name];
	$coded_msg = intval(hash('md5', $question . $fa_name)) % 16;
        $respond = file('messages.txt');
	$msg = $respond [$coded_msg];
}
else 
{  
	$question = '';
	$msg = 'سوال خود را بپرس!';
        $en_name = array_rand($names);
        $fa_name = $names[$en_name];
   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>
<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
    <div id="title">
    <span id="label"><?php 
    if ($question != NULL) echo "پرسش:"
    ?></span>
        <span id="question"><?php echo $question ?></span>
    </div>
    <div id="container">
        <div id="message">
            <p><?php echo $msg ?></p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
	    <select name="person">
            <?php
              $nm = array_keys($names);
              foreach ($nm as $key) { ?>
                        <option value=<?php echo $key;
               if ($key == $en_name) echo ' selected';
	       ?>> <?php echo $names[$key]; ?></option>
              <?php }
              ?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>
