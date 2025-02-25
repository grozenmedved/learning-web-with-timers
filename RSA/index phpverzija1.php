<?php
	$naslov = "Timer"; // . used to combine text and variable
					   // Can use " with text and variables to automatically use"
					   
					   
					   
					   
					   
					   
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $naslov; ?></title>
		<link rel="stylesheet" href="style.css">
		<meta charset="utf-8">
	</head>
	<body>
		<!-- search bar -->
		<aside class="search_bar">
			<label for="fname">Search</label>
			<input type="text" value=""> 	
			<a href="new.html"><button class="button"> New </button></a>
			<a href="settings.html"><button class="button"> Settings </button></a>
			<a href="edit.html"><button class="button"> Edit </button></a>
		</aside>
		<main>
				<!-- this is the highest group -->
				<details open>
					<summary>Baking</summary>
					
					<!-- <p>mid group …</p> -->
					<details open>
						<summary> Bread loaf </summary>
							<!-- this is the bottom group -->
							<details open>
								<summary class="groups_lower"> Dutch Oven </summary>
								<p>230&degC, Fan off</p>
								<ul>
									<li><!--	Lid on<br> 00:15:00 min<br>19:25 -->
									<!-- no idea why the  tables are bold -->	
										<table>
											<tr>
												<td></td>
												<td>Lid on</td>
												<td></td>
											</tr>									
											<tr>
												<td><button class="button button1">&#9209;</button> </td>
												<td><button class="button button1">&#9208;</button></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td>00:25:44</td>
												<td>min</td>
											</tr>
											<tr>
												<td>Done at:</td>
												<td><input type="time" class="DoneAtTimeClass" value="19:45" readonly></td>
											</tr>
										</table>
									</li>
									<li><!--Lid off <br> 00:15:00 min<br>-->
										<table>
											<tr>
												<td></td>
												<td>Lid Off</td>
												<td></td>
											</tr>									
											<tr>
												<td><button class="button button1">&#9209;</button> </td>
												<td><button class="button button1">&#9205; </button></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td>00:15:00</td>
												<td>min</td>
											</tr>
											<tr>
												<td></td>
												<td></td>
											</tr>
										</table>
									</li>
								</ul>
							</details>
					</details>
					<details>
						<summary class="example_id"> Brioche </summary>
								<p>150&degC, Fan on</p>
								<ul>
									<li><!--00:20:00 min<br></li> -->
										<table>
											<tr>
												<td><button class="button button1">&#9209;</button> </td>
												<td><button class="button button1">&#9205; </button></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td>00:20:00</td>
												<td>min</td>
											</tr>
											<tr>
												<td></td>
												<td></td>
											</tr>
										</table>
									<br> 
								</ul>
					</details>
				</details>
				<details open>
					<summary>Simmering</summary>
					<details>
						<summary class="example_id"> Rice </summary>
						<ul>
							<li><!--  <br> 00:15:00min<br></li>-->
								<table>
											<tr>
												<td><button class="button button1">&#9209;</button> </td>
												<td><button class="button button1">&#9205; </button></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td>00:15:00</td>
												<td>min</td>
											</tr>
											<tr>
												<td></td>
												<td></td>
											</tr>
								</table>
							</li>
						</ul>
					</details>
				</details>
		</main>

	</body>
</html>