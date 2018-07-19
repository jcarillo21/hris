<?php

namespace App\Http\Controllers;

/**
 * Traits
 */
use App\Http\Controllers\FileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Helpers
 */
use Session;
use Redirect;
use PDF; 
use DB; 
use Mail;
use Helper;

/**
 * Database Model
 */
use App\UpdateModel;
use App\InsertModel;
use App\DisplayModel;
use App\DeleteModel;

class ReportsController extends Controller{
	
	protected $pub;
	
	public function __construct(){
		
		$this->middleware(function ($request, $next){
			//Lockscreen
			if(Session::has('locked')){
				if(Session::get('locked')){	
					//redirect to lockscreen when user locked his / her account
					return Redirect::to('/lock');
				}				
			}
			//If not logged, redirect 
			if(!Session::has('role')){
				return Redirect::to('/');
			}
			
			$this->pub = array(
					'helper' =>  new Helper()
			);
			
			return $next($request);
		});
	}	
	
	public function pdf_settings($title,$subject){
		$data['user'] = DisplayModel::getUserViaID(Session::get('pid'));
		
		// set document information
		PDF::SetCreator($data['user']->fname.' '.$data['user']->lname);
		PDF::SetAuthor($data['user']->fname.' '.$data['user']->lname);
		PDF::SetTitle($title);
		PDF::SetSubject($subject);
		
		// remove default header/footer
		PDF::setPrintHeader(false);
		PDF::setPrintFooter(false);
		
		// set default monospaced font
		PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		// set margins
		PDF::SetMargins(10, 10, 10,10);
		
		// set auto page breaks
		PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);		
		
		PDF::SetFont('helvetica', 'N', 10);
	}
	
	public function generatePayslip($id){
		$this->pdf_settings("Payslip","Payslip");
		
		$payslip = DisplayModel::getPayslipViaID($id);
		
		//Restrict payslip for each user
		if(Session::get('role') == 'user'){
			if($payslip->personal_info_id != Session::get('pid')){
				return Redirect::to('/');
			}
		}
		 
		$row = count($payslip);
		if($row < 1){
			return redirect()->back();		
		}

		$total_deduct = $payslip->wtax + $payslip->sss_cont + $payslip->philhealth_cont + $payslip->pagibig_cont;
		$gross_income = $payslip->basic_pay + $payslip->night_diff + $payslip->ot_pay + $payslip->holiday_pay + $payslip->dm + $payslip->cola + $payslip->bonus;
		
		$content = '
			<table width="350px" cellpadding="4">
				<tr>
					<td style="border:2px solid #59cff4;" align="center" colspan="2"><img src="http://staffportal.optimizex.com/wp-content/uploads/2014/04/optimizex_logo3213.png" border="0" width="150" /></td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>Name :</b> '.$payslip->fname.' '.$payslip->mname.' '.$payslip->lname.'</td>
					<td style="border:2px solid #59cff4;">
						<b>Pay Period :</b> <br/><br/>
						<b>From :</b> '.date('M d, Y',strtotime($payslip->from)).'<br/>
						<b>To :</b> '.date('M d, Y',strtotime($payslip->to)).'
					</td>
				</tr> 
				<tr>
					<td style="border:2px solid #59cff4;"><b>Department :</b> '.$payslip->department_name.'</td> 
					<td style="border:2px solid #59cff4;"><b>Tax Status :</b> '.$payslip->tax_status.' </td>
				</tr>
				
				<tr>
					<td style="color:#fff; background-color:#59cff4; border:2px solid #59cff4;" align="center" colspan="2"><strong>Payment Details</strong></td>
				</tr>

				<tr> 
					<td style="border:2px solid #59cff4;"><b>Basic Pay :</b></td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->basic_pay,2).'</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>Night Diff :</b></td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->night_diff,2).'</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>OT Pay :</b></td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->ot_pay,2).'</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>Holiday Pay :</b></td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->holiday_pay,2).'</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>DM :</b></td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->dm,2).'</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>Cola :</b></td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->cola,2).'</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>Other non-taxable amt./Bonus :</b>  </td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->bonus,2).'</td>
				</tr>				
				<tr>
					<td style="border:2px solid #59cff4;"><b>Gross Income :</b></td> 
					<td style="border:2px solid #59cff4;"> PHP '.number_format($gross_income,2).'</td> 
				</tr>				
				<tr>
					<td style="color:#fff; background-color:#59cff4; border:2px solid #59cff4;" align="center" colspan="2"><strong>Deductions</strong></td>
				</tr>
				
				<tr>
					<td style="border:2px solid #59cff4;"><b>WTax :</b></td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->wtax,2).'</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>SSS :</b> </td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->sss_cont,2).'</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>Philhealth :</b> </td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->philhealth_cont,2).'</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>PAGIBIG :</b>  </td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($payslip->pagibig_cont,2).'</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;"><b>Total Deductions :</b>  </td> 
					<td style="border:2px solid #59cff4;">PHP '.number_format($total_deduct,2).'</td>
				</tr>	 
				<tr>
					<td style="color:#000; background-color:#fff; border:2px solid #59cff4;" align="center" colspan="2">
						<strong>Net Pay : </strong>PHP '.number_format($gross_income - $total_deduct,2).'
					</td>
				</tr>				
				<tr>
					<td style="color:#fff; background-color:#59cff4; border:2px solid #59cff4;" align="center" colspan="2">
						<p style="margin-bottom:20px;"><b>This payslip was printed as requested by employee, for whatever purpose it may serve.</b></p>
						<br/><br/><br/><br/>
						<p style="color:#fff; margin:0px!important; line-height:1; text-decoration:underline;">Ma. Vernita R. Santos</p>
						<em style="margin:0px; line-height:1; color:#fff;">Managing Director</em>
					</td>
				</tr>
			</table> 
		';
		
		// Add a page
		PDF::AddPage();
		
		//Write
		PDF::writeHTML($content);
		
		//Output PDF
		$data['file_name'] = strtolower($payslip->fname.'_'.$payslip->lname.'_'.$payslip->from.'_'.$payslip->to);
		
		if (ob_get_contents()) ob_end_clean();
		PDF::Output($data['file_name'].'.pdf', 'I');
	}
	public function employeeListReports(){
		$this->pdf_settings("Employee Reports","Employee Reports");
		$data['employees'] = DisplayModel::getAllEmployees();
		$data['company'] = DisplayModel::getSettingsViaMeta('company_name');
		if(count($data['employees']) < 1){
			return redirect()->back();		
		}		
		$content = '';
		$ctr = 1;
		$content .= '
			<h2 style="text-align:center;">'.$data['company']->value.' Employee Report</h2>
			<p style="text-align:center;">as of '.date('M d, Y').'</p>
			<p><p/>
			<table width="100%" border="1" cellpadding="4">
				<tr bgcolor="black" color="white">
					<td>#</td>
					<td>Name</td>
					<td>Job Title</td>
					<td>Department</td>
					<td>Employment status</td>
				</tr>
		';
				foreach($data['employees'] as $row){
		$content .= '
				<tr>
					<td>'.$ctr.'</td>
					<td >'.$row->fname.' '.$row->mname.' '.$row->lname.'</td>
					<td>'.$row->job_title.'</td>
					<td>'.$row->department_name.'</td>
					<td>'.$row->employment_status.'</td>
				</tr>					
			';
			$ctr++; 
				}
$content .= '</table>
		';
		
		// Add a page
		PDF::AddPage();
		
		//Write
		PDF::writeHTML($content);
		
		//Output PDF
		if (ob_get_contents()) ob_end_clean();
		PDF::Output(date('m-d-Y').'_employees_report.pdf', 'I');
	}
	public function applicantReportViaID(){
		extract($_POST);
		$data = $this->pub;
		$helper = $data['helper'];
		$this->pdf_settings("Applicant Reports","Applicant Reports");
		
		$applicant = DisplayModel::getUserViaID($applicant_id);
		$educ_bg = DisplayModel::getEducationalBackgroundViaID($applicant_id);
		$emp_back = DisplayModel::getEmploymentBackgroundViaID($applicant_id);
		$references = DisplayModel::getReferenceViaID($applicant_id);
		$job = DisplayModel::getJobViaID($applicant->job_id);
		$tests  = DisplayModel::getTestsViaID($applicant_id);
		$data['company'] = DisplayModel::getSettingsViaMeta('company_name');
		
		if(count($applicant) < 1){
			return redirect()->back();		
		}		

		$ctr = 1;
		$name = $applicant->fname.' '.$applicant->mname.' '.$applicant->lname;
		
		$content = '
			<img src="http://staffportal.optimizex.com/wp-content/uploads/2014/04/optimizex_logo3213.png" border="0" width="100" />
			<h1 style="margin-bottom:0px; text-align:center;">'.$name.'</h1>
			<p style="text-align:center;">'.$job->job_title.'</p>
			<h3>I. Personal Information</h3>
			
			<table style="width:100%;" cellpadding="5" rules="all" border="1">
				<tr>
					<td style="background-color:#000; color:#fff;"  width="20%">Name</td>
					<td  width="80%">'.$name.'</td>
				</tr>
				<tr>
					<td style="background-color:#000; color:#fff;">Position</td>
					<td>'.$job->job_title.'</td>
				</tr>
				<tr>
					<td style="background-color:#000; color:#fff;" >Asking Salary</td>
					<td>'.$applicant->salary	.'</td>
				</tr>
				<tr>
					<td style="background-color:#000; color:#fff;">Contact #</td>
					<td>'.$applicant->contact_number.'</td>
				</tr>
				<tr>
					<td style="background-color:#000; color:#fff;">Email Address</td>
					<td>'.$applicant->email_address.'</td>
				</tr>
				<tr>
					<td style="background-color:#000; color:#fff;">Address</td>
					<td>'.$applicant->address.'</td>
				</tr>	
				<tr>
					<td style="background-color:#000; color:#fff;">Gender</td>
					<td>'.$applicant->gender.'</td>
				</tr>		
				<tr>
					<td style="background-color:#000; color:#fff;" width="20%">Birthday</td>
					<td>'.date('M d, Y',strtotime($applicant->birthday)).'</td>
				</tr>					
			</table>
			
			<h3>II. Educational Background</h3>
			<table style="width:100%;" cellpadding="5" rules="all" border="1">
			<tr>
				<td style="background-color:#000; color:#fff;">School</td>
				<td style="background-color:#000; color:#fff;">From</td>
				<td style="background-color:#000; color:#fff;">To</td>
			</tr>';
				foreach($educ_bg as $edu){
					$content .= '
						<tr>
							<td>'.$edu->school_name.'</td>
							<td>'.$edu->from.'</td>
							<td>'.$edu->to.'</td>
						</tr>
					';
				}
			$content .='</table>'; 

			$content .='<h3>II. Employment Background</h3>
			<table style="width:100%;" cellpadding="5" rules="all" border="1">
			<tr>
				<td style="background-color:#000; color:#fff;">Company</td>
				<td style="background-color:#000; color:#fff;">Position</td>
				<td style="background-color:#000; color:#fff;">From</td>
				<td style="background-color:#000; color:#fff;">To</td>
				<td style="background-color:#000; color:#fff;">Reason of leaving</td>
			</tr>';
				foreach($emp_back as $emp){
					$content .= '
						<tr>
							<td>'.$emp->company_name.'</td>
							<td>'.$emp->position.'</td>
							<td>'.$emp->from.'</td>
							<td>'.$emp->to.'</td>
							<td>'.$emp->reason_of_leaving.'</td>
						</tr>
					';
				}
			$content .='</table>'; 		
			
			$content .='<h3>III. References</h3>
			<table style="width:100%;" cellpadding="5" rules="all" border="1">
			<tr>
				<td style="background-color:#000; color:#fff;">Reference Name</td>
				<td style="background-color:#000; color:#fff;">Position</td>
				<td style="background-color:#000; color:#fff;">Company</td>
				<td style="background-color:#000; color:#fff;">Contact Number</td>
			</tr>';
				foreach($references as $reference){
					$content .= '
						<tr>
							<td>'.$reference->name_of_reference.'</td>
							<td>'.$reference->position.'</td>
							<td>'.$reference->company_name.'</td>
							<td>'.$reference->contact_number.'</td>
						</tr>
					';
				}
			$content .='</table>'; 	

			$content .='<h3>IV. Test Results</h3>
			<table style="width:100%;" cellpadding="5" rules="all" border="1">
			<tr>
				<td style="background-color:#000; color:#fff;">Typing Test</td>
				<td style="background-color:#000; color:#fff;">Grammar Test</td>
				<td style="background-color:#000; color:#fff;">Listening Test</td>
				<td style="background-color:#000; color:#fff;">Personality Test</td>
				<td style="background-color:#000; color:#fff;">IQ TEST</td>
				<td style="background-color:#000; color:#fff;">EQ TEST</td>
				<td style="background-color:#000; color:#fff;">Practical Test</td>
			</tr>';
				foreach($tests as $test){
					$content .= '
						<tr>
							<td>'.$test->typing_test.'</td>
							<td>'.$test->grammar_test.'</td>
							<td>'.$test->listening_test.'</td>
							<td>'.$test->personality_test.'</td>
							<td>'.$test->iq_test.'</td>
							<td>'.$test->eq_test.'</td>
							<td>'.$test->practical_test.'</td>
						</tr>
					';
				}
			$content .='</table>'; 	
			$content .='
				<br/><br/><br/><br/>
				<h3>V. Feedback / Remarks / Comments</h3>
				<table style="width:100%;" cellpadding="5" rules="all" border="1">
					<tr>
						<td width="20%" style="background-color:#000; color:#fff;">Feedback</td>
						<td width="80%" >'.$applicant->feedback.'</td>
					</tr>
				</table>
				<br/><br/>
				<p style="text-align:center;"><b>--NOTHING FOLLOWS--</b></p>
			';
			
		// Add a page
		PDF::AddPage();
		
		//Write
		PDF::writeHTML($content);
		
		//Output PDF
		if (ob_get_contents()) ob_end_clean();
		PDF::Output(date('m-d-Y').'_'.$applicant->fname.' '.$applicant->lname.'.pdf', 'I');
	}	
	public function employeeReportViaID(){
		extract($_POST);
		$data = $this->pub;
		$helper = $data['helper'];
		$this->pdf_settings("Employee Reports","Employee Reports");
		
		$employee = DisplayModel::getUserViaID($personal_info_id);
		$educ_bg = DisplayModel::getEducationalBackgroundViaID($personal_info_id);
		$emp_back = DisplayModel::getEmploymentBackgroundViaID($personal_info_id);
		$references = DisplayModel::getReferenceViaID($personal_info_id);
		$job = DisplayModel::getJobViaID($employee->job_id);
		$tests  = DisplayModel::getTestsViaID($personal_info_id);
		$data['company'] = DisplayModel::getSettingsViaMeta('company_name');
		
		if(count($employee) < 1){
			return redirect()->back();		
		}		

		$ctr = 1;
		$name = $employee->fname.' '.$employee->mname.' '.$employee->lname;
		
		$content = '
			<img src="http://staffportal.optimizex.com/wp-content/uploads/2014/04/optimizex_logo3213.png" border="0" width="100" />
			<h1 style="margin-bottom:0px; text-align:center;">'.$name.'</h1>
			<p style="text-align:center;">'.$job->job_title.'</p>
			<h3>I. Personal Information</h3>
			
			<table style="width:100%;" cellpadding="5" rules="all" border="1">
				<tr>
					<td style="background-color:#000; color:#fff;"  width="20%">Name</td>
					<td  width="80%">'.$name.'</td>
				</tr>
				<tr>
					<td style="background-color:#000; color:#fff;">Position</td>
					<td>'.$job->job_title.'</td>
				</tr>
				<tr>
					<td style="background-color:#000; color:#fff;" >Salary</td>
					<td>'.$employee->salary	.'</td>
				</tr>
				<tr>
					<td style="background-color:#000; color:#fff;">Contact #</td>
					<td>'.$employee->contact_number.'</td>
				</tr>
				<tr>
					<td style="background-color:#000; color:#fff;">Email Address</td>
					<td>'.$employee->email_address.'</td>
				</tr>
				<tr>
					<td style="background-color:#000; color:#fff;">Address</td>
					<td>'.$employee->address.'</td>
				</tr>	
				<tr>
					<td style="background-color:#000; color:#fff;">Gender</td>
					<td>'.$employee->gender.'</td>
				</tr>		
				<tr>
					<td style="background-color:#000; color:#fff;" width="20%">Birthday</td>
					<td>'.date('M d, Y',strtotime($employee->birthday)).'</td>
				</tr>					
			</table>
			
			<h3>II. Educational Background</h3>
			<table style="width:100%;" cellpadding="5" rules="all" border="1">
			<tr>
				<td style="background-color:#000; color:#fff;">School</td>
				<td style="background-color:#000; color:#fff;">From</td>
				<td style="background-color:#000; color:#fff;">To</td>
			</tr>';
				foreach($educ_bg as $edu){
					$content .= '
						<tr>
							<td>'.$edu->school_name.'</td>
							<td>'.$edu->from.'</td>
							<td>'.$edu->to.'</td>
						</tr>
					';
				}
			$content .='</table>'; 

			$content .='<h3>II. Employment Background</h3>
			<table style="width:100%;" cellpadding="5" rules="all" border="1">
			<tr>
				<td style="background-color:#000; color:#fff;">Company</td>
				<td style="background-color:#000; color:#fff;">Position</td>
				<td style="background-color:#000; color:#fff;">From</td>
				<td style="background-color:#000; color:#fff;">To</td>
				<td style="background-color:#000; color:#fff;">Reason of leaving</td>
			</tr>';
				foreach($emp_back as $emp){
					$content .= '
						<tr>
							<td>'.$emp->company_name.'</td>
							<td>'.$emp->position.'</td>
							<td>'.$emp->from.'</td>
							<td>'.$emp->to.'</td>
							<td>'.$emp->reason_of_leaving.'</td>
						</tr>
					';
				}
			$content .='</table>'; 		
			
			$content .='<h3>III. References</h3>
			<table style="width:100%;" cellpadding="5" rules="all" border="1">
			<tr>
				<td style="background-color:#000; color:#fff;">Reference Name</td>
				<td style="background-color:#000; color:#fff;">Position</td>
				<td style="background-color:#000; color:#fff;">Company</td>
				<td style="background-color:#000; color:#fff;">Contact Number</td>
			</tr>';
				foreach($references as $reference){
					$content .= '
						<tr>
							<td>'.$reference->name_of_reference.'</td>
							<td>'.$reference->position.'</td>
							<td>'.$reference->company_name.'</td>
							<td>'.$reference->contact_number.'</td>
						</tr>
					';
				}
			$content .='</table>'; 	

			$content .='<h3>IV. Test Results</h3>
			<table style="width:100%;" cellpadding="5" rules="all" border="1">
			<tr>
				<td style="background-color:#000; color:#fff;">Typing Test</td>
				<td style="background-color:#000; color:#fff;">Grammar Test</td>
				<td style="background-color:#000; color:#fff;">Listening Test</td>
				<td style="background-color:#000; color:#fff;">Personality Test</td>
				<td style="background-color:#000; color:#fff;">IQ TEST</td>
				<td style="background-color:#000; color:#fff;">EQ TEST</td>
				<td style="background-color:#000; color:#fff;">Practical Test</td>
			</tr>';
				foreach($tests as $test){
					$content .= '
						<tr>
							<td>'.$test->typing_test.'</td>
							<td>'.$test->grammar_test.'</td>
							<td>'.$test->listening_test.'</td>
							<td>'.$test->personality_test.'</td>
							<td>'.$test->iq_test.'</td>
							<td>'.$test->eq_test.'</td>
							<td>'.$test->practical_test.'</td>
						</tr>
					';
				}
			$content .='</table>'; 	
			$content .='
				<br/><br/><br/><br/>
				<h3>V. Feedback / Remarks / Comments</h3>
				<table style="width:100%;" cellpadding="5" rules="all" border="1">
					<tr>
						<td width="20%" style="background-color:#000; color:#fff;">Feedback</td>
						<td width="80%" >'.$employee->feedback.'</td>
					</tr>
				</table>
				<br/><br/>
				<p style="text-align:center;"><b>--NOTHING FOLLOWS--</b></p>
			';
			
		// Add a page
		PDF::AddPage();
		
		//Write
		PDF::writeHTML($content);
		
		//Output PDF
		if (ob_get_contents()) ob_end_clean();
		PDF::Output(date('m-d-Y').'_'.$employee->fname.' '.$employee->lname.'.pdf', 'I');
	}		
}
