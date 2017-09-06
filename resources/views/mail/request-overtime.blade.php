<table style="max-width:600px; font-family:Open Sans;" cellpadding="10" width="100%" >
	<tr style="color:#fff;  background-color:#399bff;">
		<td colspan=2>
			<h2  align="center">New Overtime Request</h2>
			<p align="center">Please read the details below : </p>
		</td>
	</tr>
	<tr>
		<td width="40%" ><b>Name : </b></td>
		<td><?php echo $name; ?></td>
	</tr>
	<tr>
		<td width="40%" ><b>Date Affected : </b></td>
		<td><?php echo $date; ?></td>
	</tr>
	<tr>
		<td><b>Hours :</b></td>
		<td><?php echo $hours; ?></td>
	</tr>
	<tr>
		<td><b>Client(s) Involved :</b></td>
		<td><?php echo $clients; ?></td>
	</tr>
	<tr>
		<td><b>Reasons :</b></td>
		<td><?php echo $reasons; ?></td>
	</tr>
	<tr style="color:#fff;  background-color:#399bff;">
		<td colspan=2>
			<p align="center">All Rights Reserved <?php echo $company; ?> &copy; <?php echo date('Y'); ?></p>
		</td>
	</tr>
</table>