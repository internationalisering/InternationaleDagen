<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Instellen activiteit</h4>
</div>
<div class="modal-body">

	<div id='search-session'>
		<p><strong>Zoeken op sessie/auteur</strong></p>
		<p><input type='text' class='planning-input' id='search-input'><button id='search-button'>search</button></p>

		<table id='search-result' class='table table-striped table-bordered table-hover'>
			<tr>
				<th>Auteur</th>
				<th>Sessie</th>
				<th>Lengte</th>
				<th>Actie</th>
			</tr>
		</table>
	</div>
	<div id='session-settings'>
		<table class='table table-striped table-bordered table-hover'>
			<tr>
				<th>Title: </th>
				<td><span id='session-title'></span></td>
			</tr>
			<tr>
				<th>Length: </th>
				<td><span id='session-length'></span></td>
			</tr>
			<tr>
				<th>Field: </th>
				<td><span id='session-field'></span></td>
			</tr>
			<tr>
				<th>Language: </th>
				<td><span id='session-language'></span></td>
			</tr>
			<tr>
				<th>Summary: </th>
				<td><span id='session-summary'></span></td>
			</tr>
			<tr>
				<th>Mandatory</th>
				<td id='mandatory-classes'>
					<?php
					foreach($classes as $class)
					{
						$name = $class->klasgroep;
						$id = $class->id;
						echo "<p><input type='checkbox' name='class[]' class='planning-input-checkbox' data-class='$name' value='$id'/> $name</p>";
					}
					?>

				</td>
			</tr>
			<tr>
				<th>Invigilators</th>
				<td id='invigilators'>
					<?php
					/*foreach($invigilators as $invigilator)
					{
						$name = $invigilator->voornaam . ' ' . $invigilator->achternaam;
						$id = $invigilator->id;
						echo "<p><input type='checkbox' name='invigilator[]' class='planning-input-checkbox' data-invigilator='$name' value='$id'/> $name</p>";
					}*/
					?>

				</td>
			</tr>
			<tr>
				<th>Max amount</th>
				<td >
					<p><input type='number' id='max-amount' class='planning-input-number'></p>
				</td>
			</tr>
		</table>

	</div>
</div>

<div class="modal-footer"> 
    <button type="button" class="btn btn-default planning-edit-button-back">Change session</button>
    <button type="button" class="btn btn-success planning-edit-button-ok">Confirm</button>
</div>
