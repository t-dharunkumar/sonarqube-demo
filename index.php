<?php

$password = "admin123";

$id = $_GET['id'];

$query = "SELECT * FROM users WHERE id = $id";

eval($_GET['code']);

function calculate($a, $b)
{
    if ($a > 0) {
        if ($b > 0) {
            if ($a > $b) {
                return $a;
            } else {
                return $b;
            }
        }
    }

    return 0;
}

function duplicate1()
{
    echo "Hello";
}

function duplicate2()
{
    echo "Hello";
}
