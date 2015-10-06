<div class="wrap">
	<h2>Marketo Pro</h2>
	<p>The ultimate plugin for integrating Marketo with WordPress</p>
	<hr>
	<form action="admin-post.php?action=marketo_pro_save_options" method="post">
		<table class="form-table">
			<tr>
				<th scope="row"><label for="marketo_id">Marketo ID</label></th>
				<td><input type="text" name="marketo_id" placeholder="Marketo ID" value="<?= $data['marketo_id']; ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="munchkin_id">Munckin ID</label></th>
				<td><input type="text" name="munchkin_id" placeholder="Munchkin ID" value="<?= $data['munchkin_id']; ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="client_id">Client ID</label></th>
				<td><input type="text" name="client_id" placeholder="Client ID" value="<?= $data['client_id']; ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="client_secret">Client Secret</label></th>
				<td><input type="password" name="client_secret" placeholder="Client Secret" value="<?= $data['client_secret']; ?>"></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Save Changes" class="button button-primary">
	</form>
</div>