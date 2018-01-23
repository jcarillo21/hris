<table style="max-width:600px; font-family:Open Sans;" cellpadding="10" width="100%" >
	<tr style="color:#fff;  background-color:#399bff;">
		<td colspan=2>
			<h2  align="center">Your overtime request has been reviewed!</h2>
			<p align="center">Please read the details below : </p>
		</td>
	</tr>
	<tr>
		<td width="40%" ><b>Name : </b></td>
		<td><?php echo $name; ?></td>
	</tr>
	<tr>
		<td width="40%" ><b>Date requested : </b></td>
		<td><?php echo $date; ?></td>
	</tr>
	<tr>
		<td width="40%" ><b>Hours : </b></td>
		<td><?php echo $hours; ?></td>
	</tr>
	<tr>
		<td><b>Client :</b></td>
		<td><?php echo $client; ?></td>
	</tr>
	<tr>
		<td><b>Reasons :</b></td>
		<td><?php echo $reasons; ?></td>
	</tr>
	<tr>
		<td><b>Status :</b></td>
		<td><?php echo $status; ?></td>
	</tr>
	<tr style="color:#fff;  background-color:#399bff;">
		<td colspan=2>
			<p align="center">All Rights Reserved <?php echo $company; ?> &copy; <?php echo date('Y'); ?></p>
		</td>
	</tr>
</table>