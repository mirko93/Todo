<?php

    include_once './php/Database.php';
    include_once './php/Tasks.php';

    $db = new Database();
    $posts = new Tasks();

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];

        $posts->createNewPost($title);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $posts->deletePost($id);
        header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TODO - PHP</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">

    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="wrapper">
        <h2 class="title">Todo List App</h2>

        <div class="inputFields">
            <form action="index.php" method="post">
                <input type="text" name="title" placeholder="Add new task.">
                <button type="submit" name="submit" class="btn">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
        </div>

        <div class="content">
            <ul>
            <?php if($posts->getPost()): ?>
                <?php foreach ($posts->getPost() as $post): ?>
                    <li>
                        <span class="text"><?php echo $post->title ?></span>
                        <a href="index.php?id=<?php echo $post->id ?>" onclick="return confirm('Are you sure delete post?');">
                            <i class="icon fas fa-trash"></i>
                        </a>
                    </li>
                <?php endforeach; ?>

            <?php else: ?>
                <span>Create new todo lists</span>
            <?php endif; ?>

            </ul>
        </div>
    </div>


</body>
</html>