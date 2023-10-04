<?php

namespace Model;

if (!($_SESSION['rol_id'] == 1)) {
	header('location:?r=' . $home);
}
