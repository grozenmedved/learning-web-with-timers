<?php
		// Define parent array
	$exampleParent = [
		[
			"idRecipie" => 1,
			"name" => "Beli kruh",
		],[
			"idRecipie" => 2,
			"name" => "Štruca",
		],[
			"idRecipie" => 3,
			"name" => "Žemlja",
		],
	];
	// Define child array, referencing the parent
	$exampleChild = [
		[
			"idTimer" => 1,
			"idRecipie" => 1, // Links to the parent
			"name" => "Cold fermentation",
			"info" => 12345,
		],[
			"idTimer" => 2,
			"idRecipie" => 1, // Links to the parent
			"name" => "Final proof",
			"info" => 12345,
		],[
			"idTimer" => 2,
			"idRecipie" => 3, // Links to the parent
			"name" => "Child object",
			"info" => 12345,
		],
	];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Timing Saved</title>
		<link rel="stylesheet" href="style.css">
		<meta charset="utf-8">
	</head>
	<body>
		<!-- search bar -->
		<aside class="search_bar">
			<a><button class="button"> New </button></a>
			<a><button class="button"> Edit </button></a>
			<a><button class="button"> Remove </button></a>
		</aside>
		<main>
				<?php
					echo "<h2>Parent-Child Relationship</h2>";
					foreach ($exampleParent as $parent) {
						echo "<h3>{$parent['name']} (Recipe ID: {$parent['idRecipie']})</h3>";
						foreach ($exampleChild as $child) {
							if ($child["idRecipie"] === $parent["idRecipie"]) {
								echo "<details open>";
								// echo "<p> - Child: {$child['name']} (ID: {$child['idTimer']}), Info: {$child['info']}</p>";
								echo 
								"<table>
									<tr>
										<td></td>
										<td>Lid on</td>
										<td></td>
									</tr>									
									<tr>
										<td><button >&#9209;</button> </td>
										<td><button >&#9208;</button></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td>00:25:44</td>
										<td>min</td>
									</tr>
									<tr>
										<td>Done at:</td>
										<td><input type=\"time\" class=\"DoneAtTimeClass\" value=\"19:45\" readonly></td>
									</tr>
								</table>
										";
								"<p> - Child: {$child['name']} (ID: {$child['idTimer']}), Info: {$child['info']}</p>";
			
								
								echo "</details>";
							}
						}
					}				
				?>
		</main>
	</body>
</html>