@extends('includes.user-template')
	@section('content')
		@include('includes/breadcrumbs')
			@include('includes/flash-message')
				<form method="POST" class="dropzone" action="<?php echo url('process/file-upload'); ?>" enctype="multipart/form-data">
					{{ csrf_field() }}
					<label class="btn btn-default btn-file">
						CLICK HERE TO SELECT MULTIPLE FILES <span class="fa fa-cloud-upload"></span>
						<input class="file" type="file" name="fileUpload[]" multiple />
					</label>
					
					<h6>(Hold CTRL to select multiple files)</h6>
				</form>
				<div id="files" class="files"></div>
				<div class="container-widget">
					<div class="panel panel-widget">
							<div class="panel-title">
							  My Files <span class="label label-danger"><?php echo $count;?></span>
							  <ul class="panel-tools">
								<li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
							  </ul>
							</div>
							<div class="panel-body table-responsive">

							<table class="dataTable table table-dic table-hover ">
								<thead>
									<tr>
										<th>File name</th>
										<th>File Type</th>
										<th>File Size</th>
										<th class="text-r">Date Uploaded</th>
										<th class="text-r">Action</th>
									</tr>
								</thead>
								<tbody>
										<?php
											foreach($files as $file){
												$ext = 'File';
												$ico = 'fa-file-o';
												$type = $file->extension;
												if($type == 'png'){ $ext = 'Image'; $ico = 'fa-file-image-o'; }
												if($type == 'jpg'){ $ext = 'Image'; $ico = 'fa-file-image-o'; }
												if($type == 'gif'){ $ext = 'Image'; $ico = 'fa-file-image-o'; }
												if($type == 'pdf'){ $ext = 'PDF';   $ico = 'fa-file-pdf-o'; }
												if($type == 'zip'){ $ext ='WinZip Archieve'; $ico = 'fa-file-zip-o'; }
												if($type == 'rar'){ $ext = 'WinRar Archieve'; $ico = 'fa-file-zip-o'; }
												if($type == 'txt'){ $ext = 'Text'; $ico = 'fa-file-text'; }
												if($type == 'css'){ $ext = 'CSS'; $ico = 'fa-file-code-o'; }
												if($type == 'exe'){ $ext = 'exe'; }
												echo '
												  <tr>
													<td><a target="_blank" href="/files/user/'.Session::get('pid').'/'.$file->file_name.'.'.$file->extension.'"><i class="fa '.$ico.'"></i>'.$file->file_name.'</a></td>
													<td>'.$ext.'</td>
													<td>'.round($file->file_size / 1024).' KB</td>
													<td class="text-r">'.date('m/d/y',strtotime($file->created_at)).'</td>
													<td class="text-r">
														<a data-url="'.url("process/delete-file/").''.$file->file_id.'" href="#" class="confirm-delete btn btn-xs btn-danger"><i style="color:#fff; font-size:12px;" class="fa fa-trash-o"></i> Delete</a>
														<a title="Copied!" data-clipboard-text="'.url("files/user").'/'.Session::get('pid').'/'.$file->file_name.'.'.$file->extension.'" href="#" class="clip btn btn-xs btn-primary"><i style="color:#fff; font-size:12px;" class="fa fa-copy"></i> Copy Link</a>
													</td>
												  </tr>											
												';
											}
											
										?>
								</tbody>
							</table>          
						</div>
					</div>
				</div>
		@stop
		 