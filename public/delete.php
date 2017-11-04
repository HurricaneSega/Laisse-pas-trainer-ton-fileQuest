<?php
unlink(implode($_POST));

header('Location: index.php');
