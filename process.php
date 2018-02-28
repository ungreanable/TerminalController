<?php
$command = $_GET['command'];
$my_file = 'settings/settings.txt';
if(isset($_GET['key'])) {
	$key = $_GET['key'];
	if($key == "") {
		if($command == "startTerminal") {
			$result['output'] = shell_exec("bin\start terminal.bat");
		} else if($command == "killTerminal") {
			$result['output'] = shell_exec("bin\kill terminal.bat");
		} else if($command == "toggleEA") {
			$result['output'] = shell_exec("bin\Terminal Controller.exe");
		} else if($command == "freezeAfterTP") {
			if(isset($_GET['setValue'])) {
				$handle = fopen($my_file, 'w');
				fwrite($handle, $_GET['setValue']);
				$result['output'] = $_GET['setValue'];
				fclose($handle);
			}
		}
	} else $result['output'] = "R U OK ?";
} else if($command == "freezeAfterTP" && !isset($_GET['setValue'])) {
	$handle = fopen($my_file, 'r');
	$data = fread($handle,filesize($my_file));
	echo $data;
	fclose($handle);
}
if($command != "freezeAfterTP" || isset($_GET['setValue'])) echo json_encode($result);
?>