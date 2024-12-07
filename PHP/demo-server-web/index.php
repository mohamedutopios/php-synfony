<?php
session_start();
?>
<h1>Hello from php server <?= $_SESSION["firstname"] ?? "" ?> </h1>
<form method="post" enctype="multipart/form-data">
    <div>
        <input type="file" name="image" placeholder="firstname" />
    </div>
    

    <div>
        <input type="text" name="firstname" placeholder="firstname" />
    </div>
    <div>
        <input type="text" name="lastname" placeholder="lastname" />
    </div>
    <div>
        <button type="submit">Valider</button>
    </div>
</form>
<pre>
<?php 
$_SESSION["firstname"] = $_SESSION["firstname"] ?? $_POST["firstname"];
var_dump($_POST);
var_dump($_FILES);
move_uploaded_file($_FILES["image"]["tmp_name"], "image.png");
?>
</pre>