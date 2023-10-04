<?php

namespace Model;

if (!isset($_SESSION['token'])) {
	header('location:/');
}
