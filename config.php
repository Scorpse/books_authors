<?php
error_reporting(E_ALL);

function __autoload($class_name) {
  require_once $class_name . '.php';
}