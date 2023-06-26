<?php 
namespace App;

if (!($_SESSION['rol_id']==1 || $_SESSION['rol_id']==3)) {
	header('location:?r='.$home);
}