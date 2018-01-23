 <div id="top" class="clearfix">
        <div class="applogo">
            <a href="<?php echo url('/'); ?>" class="logo">{{$title}}</a>
        </div>
        <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
        <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
        <ul class="top-right">
            <li class="dropdown link">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle hdbutton">Jump to <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-list">
                    <li><a href="#"><i class="fa falist fa-users"></i>Employees</a></li>
					<li><a href="#"><i class="fa falist fa-user"></i>Applicants</a></li>
					<li><a href="#"><i class="fa falist fa-dollar"></i>Payroll</a></li>
                </ul>
            </li>
            <li class="dropdown link">
				<?php
					if($dp==null){
						$dp = 'default.png';
					}
				?>
                <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><img src="<?php echo url('img/'.$dp.''); ?>" alt="img"><b>{{$name}}</b><span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
					<li><a href="<?php echo url('admin/profile'); ?>"><i class="fa falist fa-user"></i>Profile</a></li>
                    <li><a href="<?php echo url('admin/files'); ?>"><i class="fa falist fa-file-o"></i>Files</a></li>
                    <li><a href="<?php echo url('admin/settings'); ?>"><i class="fa falist fa-wrench"></i>System Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo url('lock'); ?>"><i class="fa falist fa-lock"></i> Lockscreen</a></li>
                    <li><a href="<?php echo url('process/logout'); ?>"><i class="fa falist fa-power-off"></i> Logout</a></li>
                </ul>
            </li>

        </ul>
    </div>