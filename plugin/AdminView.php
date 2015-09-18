<div class="wrap">
	<h2>Marketo Pro</h2>
	<p>The ultimate plugin for integrating Marketo with WordPress</p>
	<hr>
	<form action="admin-post.php?action=marketo_pro_save_options" method="post">
		<table class="form-table">
			<tr>
				<th scope="row"><label for="client_id">Client ID</label></th>
				<td><input type="text" name="client_id" placeholder="Client ID" pattern="[0-9a-zA-Z]{8}-[0-9a-zA-Z]{4}-[0-9a-zA-Z]{4}-[0-9a-zA-Z]{4}-[0-9a-zA-Z]{12}"></td>
			</tr>
			<tr>
				<th scope="row"><label for="client_secret">Client Secret</label></th>
				<td><input type="password" name="client_secret" placeholder="Client Secret" pattern="[0-9a-zA-Z]{32}"></td>
			</tr>
			<tr>
				<th scope="row"><label for="munchkin_id">Munckin ID</label></th>
				<td>
					<input type="text" name="munchkin_id" placeholder="Munchkin ID" pattern="[0-9]{3}-[A-Z]{3}-[0-9]{3}">
				</td>
			</tr>
		</table>
		<input type="submit" value="Save Changes" class="button button-primary">
	</form>
</div>