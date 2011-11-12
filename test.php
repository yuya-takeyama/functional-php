<?php
require_once './functional.php';

use functional\SinglyLinkedList as L;
use functional\Nil;

$l = new L(1, new L(2, new L(3, new L(4, new L(5, new Nil)))));

echo $l, PHP_EOL;

echo map(function ($n) {
    return $n * $n;
}, $l), PHP_EOL;

echo reduce(function ($a, $b) {
    return $a + $b;
}, 0, $l), PHP_EOL;

echo filter(function ($n) {
    return $n % 2 === 0;
}, $l), PHP_EOL;

function map($f, $l) {
    return $l->isNil() ?
        new Nil :
        new L($f($l->car()), map($f, $l->cdr()));
}

function reduce($f, $initial, $l) {
    return $l->isNil() ?
        $initial :
        reduce($f, $f($initial, $l->car()), $l->cdr());
}

function filter($f, $l) {
    return $l->isNil() ?
        new Nil :
        ($f($l->car()) ? new L($l->car(), filter($f, $l->cdr())) : filter($f, $l->cdr()));
}
