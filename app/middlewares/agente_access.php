<?php

namespace Model;

if (!($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == 2)) {
	header('location:?r=' . $home);
}
