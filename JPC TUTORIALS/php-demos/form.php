<form action="form.php" method="post">
    <input type="text" name="content">
    <button type="submit">Submit</button>
</form>

<br><br>

<?php
if (isset($_POST['content'])) {
    $content = $_POST['content'];
    echo "<p>The content you entered was $content</p>";
}

?>