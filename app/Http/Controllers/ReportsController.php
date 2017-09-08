<?php

namespace App\Http\Controllers;

/**
 * Traits
 */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * Helpers
 */
use Session;
use Redirect;
use PDF; 

/**
 * Database Model
 */
use App\UpdateModel;
use App\InsertModel;
use App\DisplayModel;
use App\DeleteModel;

class ReportsController extends Controller{
	
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
		$row = count($payslip);
		if($row < 1){
			return redirect()->back();		
		}

		$content = '
			<table cellpadding="4">
				<tr>
					<td style="border:2px solid #59cff4;" align="center" colspan="2"><img src="http://staffportal.optimizex.com/wp-content/uploads/2014/04/optimizex_logo3213.png" border="0" width="150" /></td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">Name : '.$payslip->fname.' '.$payslip->mname.' '.$payslip->lname.'</td>
					<td style="border:2px solid #59cff4;">
						Pay Period : <br/><br/>
						From : '.date('M d, Y',strtotime($payslip->from)).'<br/>
						To : '.date('M d, Y',strtotime($payslip->to)).'
					</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">Department : '.$payslip->department_name.'</td> 
					<td style="border:2px solid #59cff4;">Tax Status : '.$payslip->tax_status.' </td>
				</tr>
				
				<tr>
					<td style="color:#fff; background-color:#59cff4; border:2px solid #59cff4;" align="center" colspan="2"><strong>Payment Details</strong></td>
				</tr>

				<tr>
					<td style="border:2px solid #59cff4;">Basic Pay :</td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->basic_pay).' php</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">Night Diff :</td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->night_diff).' php</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">OT Pay :</td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->ot_pay).' php</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">Holiday Pay :</td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->holiday_pay).' php</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">DM :</td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->dm).' php</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">Cola :</td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->cola).' php</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">Other non-taxable amt./Bonus :  </td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->bonus).' php</td>
				</tr>				
				
				<tr>
					<td style="color:#fff; background-color:#59cff4; border:2px solid #59cff4;" align="center" colspan="2"><strong>Deductions</strong></td>
				</tr>
				
				<tr>
					<td style="border:2px solid #59cff4;">WTax :</td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->wtax).' php</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">SSS : </td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->sss).' php</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">Philhealth : </td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->philhealth).' php</td>
				</tr>
				<tr>
					<td style="border:2px solid #59cff4;">PAGIBIG :  </td> 
					<td style="border:2px solid #59cff4;">'.number_format($payslip->pagibig).' php</td>
				</tr>	
				
			</table>
		';
		
		// Add a page
		PDF::AddPage();
		
		//Write
		PDF::writeHTML($content);
		
		//Output PDF
		$data['file_name'] = strtolower($payslip->fname.'_'.$payslip->lname.'_'.$payslip->from.'_'.$payslip->to);
		ob_end_clean();
		PDF::Output($data['file_name'].'.pdf', 'I');
	}
	public function employeeReports(){
		$this->pdf_settings("Payslip","Payslip");
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
			<table border="1" cellpadding="4">
				<tr bgcolor="black" color="white">
					<td width="5%">#</td>
					<td width="75%">Name</td>
					<td width="20%">Employment status</td>
				</tr>
		';
				foreach($data['employees'] as $row){
		$content .= '
				<tr>
					<td>'.$ctr.'</td>
					<td>'.$row->fname.' '.$row->mname.' '.$row->lname.'</td>
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
		PDF::Output(date('m-d-Y').'_employees_report.pdf', 'I');
	}
}
