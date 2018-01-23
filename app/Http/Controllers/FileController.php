<?php

namespace App\Http\Controllers;

use Session;
use File;
use Redirect;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Database Model
 */
use App\UpdateModel;
use App\InsertModel;
use App\DisplayModel;
use App\DeleteModel;


class FileController extends Controller{
	
	public function fileUpload(Request $request){
		$files = $request->file('fileUpload');
		$uploader = Session::get('pid');
		$path = getcwd().'/files/user';
		
		File::makeDirectory($path.'/'.$uploader.'', 0775, true, true);
		$dir = $path.'/'.$uploader.'';
		
		for($x = 0; $x < count($files); $x++){
			
			$file_name = pathinfo($files[$x]->getClientOriginalName(), PATHINFO_FILENAME);
			$ext = pathinfo($files[$x]->getClientOriginalName(), PATHINFO_EXTENSION);
			$file_size = $files[$x]->getSize();
			
			if(!$this->searchForFile($dir.'/'.$file_name.'*.'.$ext)){
				$data['result'] = InsertModel::UploadFiles($file_name,$uploader,$file_size,$ext);
				$files[$x]->move($dir,$file_name.'.'.$ext);			
			}else{
				$data['result'] = InsertModel::UploadFiles($file_name.'('.count(glob($dir.'/'.$file_name.'*')).')',$uploader,$file_size,$ext);
				$files[$x]->move($dir,$file_name.'('.count(glob($dir.'/'.$file_name.'*')).')'.'.'.$ext);		
			}
			
		}
		return redirect()->back();

	}

	public function uploadLeaveFile($file,$uploader){
		$path = getcwd().'/files/user';
		File::makeDirectory($path.'/'.$uploader.'', 0775, true, true);
		$dir = $path.'/'.$uploader.'';
		
		//File Properties
		$file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
		$ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
		$file_size = $file->getSize();
			
		if(!$this->searchForFile($dir.'/'.$file_name.'*.'.$ext)){
			$data['result'] = InsertModel::UploadFiles($file_name,$uploader,$file_size,$ext);
			$file->move($dir,$file_name.'.'.$ext);			
		}else{
			$data['result'] = InsertModel::UploadFiles($file_name.'('.count(glob($dir.'/'.$file_name.'*')).')',$uploader,$file_size,$ext);
			$file->move($dir,$file_name.'('.count(glob($dir.'/'.$file_name.'*')).')'.'.'.$ext);		
		}
		return $data['result'] ? true : false;
	}	
	public function uploadCSV($file){
		$path = getcwd().'/files/csv';
		File::makeDirectory($path, 0775, true, true);
		$dir = $path;
		
		//File Properties
		$file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
		$ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
		$file_size = $file->getSize();
			
		if(!$this->searchForFile($dir.'/'.$file_name.'*.'.$ext)){
			$file->move($dir,$file_name.'.'.$ext);			
		}else{
			$file->move($dir,$file_name.'('.count(glob($dir.'/'.$file_name.'*')).')'.'.'.$ext);		
		}
		return true;
	}	
	public function searchForFile($fileToSearchFor){
        $numberOfFiles = count(glob($fileToSearchFor));
		return $numberOfFiles == 0 ? false : true ;
    }
	
	public function deleteFile($id){
		$data['file'] = DisplayModel::getFileViaID($id);
		$data['delete'] = DeleteModel::deleteFileViaID($id);
		$dir = getcwd().'/files/user/'.Session::get('pid').'/';
		
		File::delete($dir.$data['file']->file_name.'.'.$data['file']->extension);
		
		Session::flash('success', ''.$data['file']->file_name.'.'.$data['file']->extension.' Deleted successfully!');
		return redirect()->back();
	}
	public function deleteFileViaDir($file){
		File::delete($file);
		return true;
	}
	public function uploadResume($file){
		
		$path = getcwd().'/files/user';
		$pid = DisplayModel::getLastPersonalInfoID();
		$uploader = $pid->personal_info_id;
		File::makeDirectory($path.'/'.$uploader.'', 0775, true, true);
		$dir = $path.'/'.$uploader.'';
		
		$file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
		$ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
		$file_size = $file->getSize();
			
		if(!$this->searchForFile($dir.'/'.$file_name.'*.'.$ext)){
			$data['result'] = InsertModel::UploadFiles($file_name,$uploader,$file_size,$ext);
			$file->move($dir,$file_name.'.'.$ext);			
		}else{
			$data['result'] = InsertModel::UploadFiles($file_name.'('.count(glob($dir.'/'.$file_name.'*')).')',$uploader,$file_size,$ext);
			$file->move($dir,$file_name.'('.count(glob($dir.'/'.$file_name.'*')).')'.'.'.$ext);		
		}
		return $data['result'] ? true : false;
	}
	public function uploadPracticalExam($file){
		
		$path = getcwd().'/files/user';
		
		$pid = DisplayModel::getLastPersonalInfoID();
		$uploader = $pid->personal_info_id;
		File::makeDirectory($path.'/'.$uploader.'', 0775, true, true);
		$dir = $path.'/'.$uploader.'';
		
		$file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
		$ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
		$file_size = $file->getSize();
			
		if(!$this->searchForFile($dir.'/'.$file_name.'*.'.$ext)){
			$data['result'] = InsertModel::UploadFiles($file_name,$uploader,$file_size,$ext);
			$file->move($dir,$file_name.'.'.$ext);			
			$data['practical'] = updateModel::updatePracticalTestViaID($uploader,$file_name.'.'.$ext);
		}else{
			$data['result'] = InsertModel::UploadFiles($file_name.'('.count(glob($dir.'/'.$file_name.'*')).')',$uploader,$file_size,$ext);
			$file->move($dir,$file_name.'('.count(glob($dir.'/'.$file_name.'*')).')'.'.'.$ext);		
			$data['practical'] = updateModel::updatePracticalTestViaID($uploader,$file_name.'('.count(glob($dir.'/'.$file_name.'*')).')'.'.'.$ext);
		}
		return $data['result'] ? true : false;		
	}
}
 