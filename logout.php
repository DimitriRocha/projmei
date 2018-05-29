<?php
  require_once '_class/conexao.php';
  session_start();
  session_destroy();
  header('Location: entrar.php');
  exit; 