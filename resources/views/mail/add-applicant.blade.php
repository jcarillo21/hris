<table style="max-width:600px; font-family:Open Sans;" cellpadding="10" width="100%" >
	<tr style="color:#fff;  background-color:#399bff;">
		<td colspan=2>
			<h2  align="center">New Applicant has been added!</h2>
			<p align="center">Please see the credentials below : </p>
		</td>
	</tr>
	<tr>
		<td width="40%" ><b>Name:</b></td>
		<td><?php echo $name; ?></td>
	</tr>
	<tr>
		<td><b>Email :</b></td>
		<td><?php echo $email; ?></td>
	</tr>
	<tr>
		<td><b>Contact # :</b></td>
		<td><?php echo $contact; ?></td>
	</tr>
	<tr>
		<td><b>Position :</b></td>
		<td><?php echo $position; ?></td>
	</tr>
	<tr>
		<td colspan=2><p>For more detailed information, please login to the HR App.</p></td>
	</tr>
	<tr style="color:#fff;  background-color:#399bff;">
		<td colspan=2>
			<p align="center">All Rights Reserved <?php echo $company; ?> &copy; <?php echo date('Y'); ?></p>
		</td>
	</tr>
</table>