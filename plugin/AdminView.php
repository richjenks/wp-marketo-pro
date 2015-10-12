<div class="wrap">
	<h2>Marketo Pro</h2>
	<p>Marketo ID is the unique part of the URL you use when logged into Marketo, e.g. <code>app-<b><u>lon03</u></b>.marketo.com</code> and Munchkin ID can be found at Marketo > Admin > Integration > Munchkin, e.g. <code>123-ABC-456</code>.</p>
	<p>To get a Client ID and Secret, follow <a target="_blank" href="http://developers.marketo.com/blog/quick-start-guide-for-marketo-rest-api/">Marketo's API Quick Start Guide</a>. You don't have to do any coding in the last section, just keep going until you have a Client ID and Secret and enter them below.</p>
	<p>If you cannot change the options below, there's probably a config file on the server &mdash; <a href="mailto:<?php echo get_option('admin_email'); ?>">contact your webmaster</a>.</p>
	<form action="admin-post.php?action=marketo_pro_save_options" method="post">
		<table class="form-table">
			<tr>
				<th scope="row"><label for="marketo_id">Marketo ID</label></th>
				<td><input type="text" name="marketo_id" id="marketo_id" placeholder="Marketo ID" value="<?= $data['marketo_id']; ?>"<?php if ( $data['readonly'] ) echo ' readonly'; ?>></td>
			</tr>
			<tr>
				<th scope="row"><label for="munchkin_id">Munckin ID</label></th>
				<td><input type="text" name="munchkin_id" id="munchkin_id" placeholder="Munchkin ID" value="<?= $data['munchkin_id']; ?>"<?php if ( $data['readonly'] ) echo ' readonly'; ?>></td>
			</tr>
			<tr>
				<th scope="row"><label for="client_id">Client ID</label></th>
				<td><input type="text" name="client_id" id="client_id" placeholder="Client ID" value="<?= $data['client_id']; ?>"<?php if ( $data['readonly'] ) echo ' readonly'; ?>></td>
			</tr>
			<tr>
				<th scope="row"><label for="client_secret">Client Secret</label></th>
				<td><input type="password" name="client_secret" id="client_secret" placeholder="Client Secret" value="<?= $data['client_secret']; ?>"<?php if ( $data['readonly'] ) echo ' readonly'; ?>></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Save Changes" class="button button-primary">
	</form>
</div>