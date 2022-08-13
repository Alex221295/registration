<?php
echo "
<form action='".$_GET['tableName'].".php'>
<input type='text' name='update' value='" . $_GET['name'] . "'>
<input type='hidden' name='category_id' value='" . $_GET['category_id'] . "'>
<input type='hidden' name='id' value='" . $_GET['id'] . "'>
<input type='submit' >
</form>
";
