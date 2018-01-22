<?php

	function returnJson($res = false, $datos = array()) {
		echo json_encode(array('res' => $res, 'dataObj' => $datos));
	}

?>