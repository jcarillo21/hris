<table style="max-width:600px; font-family:Open Sans;" cellpadding="10" width="100%" >
	<tr style="color:#fff;  background-color:#399bff;">
		<td colspan=2>
			<h2  align="center">Welcome to CeciroHR, <?php echo $name; ?>!</h2>
			<p align="center">Please use the credentials below : </p>
		</td>
	</tr>
	<tr>
		<td width="40%" ><b>Website URL :</b></td>
		<td><?php echo $url; ?></td>
	</tr>
	<tr>
		<td><b>Email :</b></td>
		<td><?php echo $email; ?></td>
	</tr>
	<tr>
		<td><b>Username :</b></td>
		<td><?php echo $username; ?></td>
	</tr>
	<tr>
		<td><b>Password :</b></td>
		<td><?php echo $password; ?></td>
	</tr>
	<tr style="color:#fff;  background-color:#399bff;">
		<td colspan=2>
			<p align="center">All Rights Reserved <?php echo $company; ?> &copy; <?php echo date('Y'); ?></p>
		</td>
	</tr>
</table>