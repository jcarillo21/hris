<table style="max-width:600px; font-family:Open Sans;" cellpadding="10" width="100%" >
	<tr style="color:#fff;  background-color:#399bff;">
		<td colspan=2>
			<h2  align="center">New Leave Request</h2>
			<p align="center">Please read the details below : </p>
		</td>
	</tr>
	<tr>
		<td width="40%" ><b>Name : </b></td>
		<td><?php echo $name; ?></td>
	</tr>
	<tr>
		<td width="40%" ><b>Dates Affected : </b></td>
		<td><?php echo $from.'-'.$to; ?></td>
	</tr>
	<tr>
		<td><b>Leave Type :</b></td>
		<td><?php echo $leave_type; ?></td>
	</tr>
	<tr>
		<td><b>Reasons :</b></td>
		<td><?php echo $reasons; ?></td>
	</tr>
	<tr>
		<td><b>File(s) Attached :</b></td>
		<td><?php echo $files_url; ?></td>
	</tr>
	<tr style="color:#fff;  background-color:#399bff;">
		<td colspan=2>
			<p align="center">All Rights Reserved <?php echo $company; ?> &copy; <?php echo date('Y'); ?></p>
		</td>
	</tr>
</table>