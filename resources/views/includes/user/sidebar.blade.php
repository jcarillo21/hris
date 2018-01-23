
    <div class="sidebar clearfix">
        <ul class="sidebar-panel nav">
            <li class="sidetitle">MAIN</li>
            <li><a <?php echo($page == 'Dashboard') ? 'class="active"' : '' ;?> href="<?php echo url('/'); ?>"><span class="icon color5"><i class="fa fa-home"></i></span>Dashboard</li>
			<li><a <?php echo($page == 'Profile') ? 'class="active"' : '' ;?> href="<?php echo url('user/profile'); ?>"><span class="icon color5"><i class="fa fa-user"></i></span>Profile</a></li>
			<li><a <?php echo($page == 'Payslip') ? 'class="active"' : '' ;?> href="<?php echo url('user/payslip'); ?>"><span class="icon color5"><i class="fa fa-dollar"></i></span>Payslip</a></li>
		   <li><a <?php echo($openable == 'Leaves') ? 'class="active"' : '' ;?>  href="#"><span class="icon color9"><i class="fa fa-plane"></i></span>Leaves<span class="caret"></span></a>
                <ul  <?php echo($openable == 'Leaves') ? 'style="display:block;"' : '' ;?>>
                    <li><a <?php echo($page == 'Leaves') ? 'class="active"' : '' ;?> href="<?php echo url('user/leaves'); ?>">View</a></li>
					<li><a <?php echo($page == 'Request Leave') ? 'class="active"' : '' ;?>href="<?php echo url('user/request-leave'); ?>">Request Leave</a></li>
                </ul>
            </li>
            <li><a <?php echo($openable == 'Overtime') ? 'class="active"' : '' ;?> href="#"><span class="icon color9"><i class="fa fa-clock-o"></i></span>Overtime<span class="caret"></span></a>
                <ul  <?php echo($openable == 'Overtime') ? 'style="display:block;"' : '' ;?>>
                    <li><a <?php echo($page == 'Overtime') ? 'class="active"' : '' ;?> href="<?php echo url('user/overtime'); ?>">View</a></li>
					<li><a href="<?php echo url('user/overtime-approval'); ?>">Request Overtime</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-panel nav">
            <li class="sidetitle">MORE</li>
			<li><a <?php echo($page == 'Files') ? 'class="active"' : '' ;?> href="<?php echo url('user/files'); ?>"><span class="icon color15"><i class="fa fa-file-o"></i></span>Files</a></li>
			<li><a href="<?php echo url('lock'); ?>"><span class="icon color7"><i class="fa fa-lock"></i></span>Lock Account</a></li>
		    <li><a href="<?php echo url('process/logout'); ?>"><span class="icon color7"><i class="fa fa-sign-out"></i></span>Logout</a></li>
        </ul>
    </div>
