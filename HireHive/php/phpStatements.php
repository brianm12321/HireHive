<?php
	$content = file_get_contents('https://hirehive-testing-account.hirehive.com/api/v1/jobs');
	$arrayData = json_decode($content, true);
	$jobs = array();
	$x = 0;
	if (isset($arrayData['jobs']))
	{
		foreach ($arrayData['jobs'] as $data)
		{
			$jobs[$x][0] = $data['id'];
			$jobs[$x][1] = $data['title'];
			$jobs[$x][2] = $data['location'];
			$jobs[$x][3] = $data['stateCode'];
			$jobs[$x][4] = array_values($data['country']);
			$jobs[$x][5] = $data['salary'];
			$jobs[$x][6] = array_values($data['description']);			
			$jobs[$x][7] = $data['category'];
			$jobs[$x][8] = array_values($data['type']);
			$jobs[$x][9] = array_values($data['experience']);
			$jobs[$x][10] = array_values($data['language']);
			$jobs[$x][11] = $data['publishedDate'];
			$jobs[$x][12] = $data['createdDate'];
			$jobs[$x][13] = $data['hostedUrl'];
			$x++;
		}
	}
	
	$uniqueCategories = getUniqueCategories($jobs);
	function getUniqueCategories($array){
		$uniqueValues = array();
		for($x = 0; $x < count($array); $x++){
			if(in_array($array[$x][7], $uniqueValues) == False){
				$uniqueValues[] = $array[$x][7];
			}
		}
		return $uniqueValues;
	}
	//print_r($uniqueCategories);
	//id, title, location, stateCode, country(name, code), salary, description(html, text), category, type(type, full name), experience(type, full name), language(name, code)
	//publishedDate, createdDate, hostedURL
?>