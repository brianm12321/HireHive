<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Recruiting software to help you grow your team | HireHive</title>
		<meta name="description" content="HireHive is recruiting software that helps you find and hire the best candidates. HireHive makes it easy for you to manage your recruitment in one place."/>
		<link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" /> 
		<link rel="stylesheet" href="css/hirehive.css" type="text/css" />
		<?php require 'php/phpStatements.php';?>
	</head>
	<body>
		<div id="blackContainer">
			<div id="searchBarContainer">
				<div class="input-icons"> 
					<i class="fa fa-search fa-lg icon"></i>
					<input type="text" id="searchBar" onkeyup="searchFunction('search')" placeholder="Search by keyword, technology or job title"/>
				</div>
				<?php
					for($x = 0; $x < count($uniqueCategories); $x++){
						echo '<button class="button" onclick="setTag(\'#'.$uniqueCategories[$x].'\')" ><b>#'.$uniqueCategories[$x].'</b></button>';
					}
				?>
			</div>
		</div>
		<table id="jobTable">
			<tr>
				<th>POSITION</th>
				<th>CATEGORY</th>
				<th>LOCATION</th>
				<th></th>
			</tr>
			<?php
				for($x = 0; $x < count($jobs); $x++){
					echo'
						<tr id="'.$x.'" data-href="'.$jobs[$x][13].'">
							<td>'.$jobs[$x][1].'</td>
							<td>'.$jobs[$x][7].'</td>
							<td>'.$jobs[$x][2].'</td>
							<td><i class="fa fa-angle-right"></i></td>
						</tr>';
				}
			?>
		</table>
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="javascripts/all.js" type="text/javascript"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('*[data-href]').on('click', function() {
					window.open($(this).data("href"), '_blank');
				});
			});
		</script>
		<script>
			function searchFunction(type){
			  // Declare variables
			    var input, filter, table, tr, td, i, txtValue;
			    input = document.getElementById("searchBar");
			    table = document.getElementById("jobTable");
			    tr = table.getElementsByTagName("tr");
				if(type == 'search'){
					if(input.value.length > 0){
						filter = input.value.toUpperCase();
						for (i = 0; i < tr.length; i++) {
							td = tr[i].getElementsByTagName("td")[0];
							if (td){
								td = td.innerText;
								//Checks if input length is greater than 2 characters
								if(input.value.length > 2){
									//Retrieves each jobs description
									var descriptionArray = <?php echo json_encode($jobs); ?>;
									var x = i - 1;
									//Joins Job Description to Job Title
									td = td + ' ' + descriptionArray[x][6][1];
								}
								if (td.toUpperCase().indexOf(filter) > -1){
									tr[i].style.display = "";
								} 
								else{
									tr[i].style.display = "none";
								}
							}
						}
					}
					else{
						//Restores Job Listings if no text is entered
						for (i = 0; i < tr.length; i++) {
							tr[i].style.display = "";
						}
					}
				}
				else{
					//Searchs for job listing by catagory from tag
					input = input.value.substr(1);
					filter = input.toUpperCase();
					for (i = 0; i < tr.length; i++) {
						td = tr[i].getElementsByTagName("td")[1];
						if (td) {
							txtValue = td.textContent || td.innerText;
							if (txtValue.toUpperCase().indexOf(filter) > -1) {
								tr[i].style.display = "";
							} 
							else{
								tr[i].style.display = "none";
							}
						}
					}
				}
			}
		</script>
		<script>
			function setTag(tag){
				document.getElementById("searchBar").value = tag;
				searchFunction('tag');
			}
		</script>
	</body>
</html>
