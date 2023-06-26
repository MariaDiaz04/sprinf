<?php

namespace App;

if (isset($_SESSION['token'])) {
	header('location:/home');
}
