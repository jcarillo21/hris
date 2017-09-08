/* Sidebar Menu*/
$(document).ready(function () {
  $('.nav > li > a').click(function(){
    if ($(this).attr('class') != 'active'){
      $('.nav li ul').slideUp();
      $(this).next().slideToggle();
      $('.nav li a').removeClass('active');
      $(this).addClass('active');
    }
  });
});

/* Top Stats Show Hide */
$(document).ready(function(){
    $("#topstats").click(function(){
        $(".topstats").slideToggle(100);
    });
});


/* Sidepanel Show-Hide */
$(document).ready(function(){
    $(".sidepanel-open-button").click(function(){
        $(".sidepanel").toggle(100);
    });
});



/* Sidebar Show-Hide On Mobile */
$(document).ready(function(){
    $(".sidebar-open-button-mobile").click(function(){
        $(".sidebar").toggle(150);
    });
});


/* Sidebar Show-Hide */
$(document).ready(function(){

    $('.sidebar-open-button').on('click', function(){
        if($('.sidebar').hasClass('hidden')){
            $('.sidebar').removeClass('hidden');
            $('.content').css({
                'marginLeft' : 250
            });  
        }else{
            $('.sidebar').addClass('hidden');
            $('.content').css({
                'marginLeft' : 0
            });    
        }
    });

});


/* ===========================================================
PANEL TOOLS
===========================================================*/
/* Minimize */
$(document).ready(function(){
	$(".panel-tools .minimise-tool").click(function(event){
	$(this).parents(".panel").find(".panel-body").slideToggle(100);
		return false;
	}); 
 }); 

/* Close */
$(document).ready(function(){
  $(".panel-tools .closed-tool").click(function(event){
  $(this).parents(".panel").fadeToggle(400);

  return false;
}); 

 }); 

 /* Search */
$(document).ready(function(){
  $(".panel-tools .search-tool").click(function(event){
  $(this).parents(".panel").find(".panel-search").toggle(100);

  return false;
}); 

 }); 




/* expand */
$(document).ready(function(){

    $('.panel-tools .expand-tool').on('click', function(){
        if($(this).parents(".panel").hasClass('panel-fullsize'))
        {
            $(this).parents(".panel").removeClass('panel-fullsize');
        }
        else
        {
            $(this).parents(".panel").addClass('panel-fullsize');
 
        }
    });

});


/* ===========================================================
Widget Tools
===========================================================*/


/* Close */
$(document).ready(function(){
  $(".widget-tools .closed-tool").click(function(event){
  $(this).parents(".widget").fadeToggle(400);

  return false;
}); 

 }); 


/* expand */
$(document).ready(function(){

    $('.widget-tools .expand-tool').on('click', function(){
        if($(this).parents(".widget").hasClass('widget-fullsize'))
        {
            $(this).parents(".widget").removeClass('widget-fullsize');
        }
        else
        {
            $(this).parents(".widget").addClass('widget-fullsize');
 
        }
    });

});

/* Kode Alerts */
/* Default */
$(document).ready(function(){
  $(".kode-alert .closed").click(function(event){
  $(this).parents(".kode-alert").fadeToggle(350);

  return false;
}); 

 }); 


/* Click to close */
$(document).ready(function(){
  $(".kode-alert-click").click(function(event){
  $(this).fadeToggle(350);

  return false;
}); 

 }); 



/* Tooltips */
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

/* Popover */
$(function () {
  $('[data-toggle="popover"]').popover()
})


/* Page Loading */
$(window).load(function() {
  $(".loading").fadeOut(750);
})


/* Update Fixed */
/* Version 1.2 */
$('.profilebox').on('click',function(){ $(".sidepanel").hide(); })

/**
 * Custom JS
 */
$(document).ready(function(){

	$(".dataTable").dataTable();
	settingsModal();
	checkAll();
	
	//submitUsingATag('.a_submit');
	sweetAlertInit('.delete');

	$("form.validate-admin").validate({
		rules: {
			username : {
				remote : {
					url: "/app/admin/check-username-availability",	
					type: "get",
				}
			},
			email : {
				remote : {
					url: "/app/admin/check-email-availability",	
					type: "get",
				}
			},
			confirm_password: {
				equalTo: "#password"
			}
		} 
	});

	$("form.validate-admin-edit").validate({
		rules: {
			username : {
				remote : {
					url: "/app/admin/check-edit-username-availability",	
					type: "get",
				}
			},
			email : {
				remote : {
					url: "/app/admin/check-edit-email-availability",	
					type: "get",
				}
			},
			confirm_password: {
				equalTo: "#password"
			}
		} 
	});	
	
	$("form.validate-user").validate({
		rules: {
			username : {
				remote : {
					url: "/app/user/check-username-availability",	
					type: "get",
				}
			},
			email : {
				remote : {
					url: "/app/user/check-email-availability",	
					type: "get",
				}
			},
			confirm_password: {
				equalTo: "#password"
			}
		}
	});
	
	// $("form.validate-user-edit").validate({
		// rules: {
			// username : {
				// remote : {
					// url: "/app/user/check-edit-username-availability",	
					// type: "get",
				// }
			// },
			// email : {
				// remote : {
					// url: "/app/user/check-edit-email-availability",	
					// type: "get",
				// }
			// },
			// confirm_password: {
				// equalTo: "#password"
			// }
		// }
	// });
	
	//Payslip auto add department
	$('#employee_id').change(function(){
		$('#department').val($(this).val());
	});
	
	//DZ
	dropZone();
	
	//Copy to clipboard
	$('.clip').click(function(e){
		new Clipboard('.clip');	
		alert('Link Copied!');
	});
	
	//App form fields
	addApplicationFormFields();
	
	//Confirmation box on files deletion
	$('.confirm-delete').click(function(e){
		var url = $(this).data('url');
		swal({
		  title: "Are you sure?",
		  text: "You will not be able to recover this file!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel please!",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm){
		  if (isConfirm) {
			window.location.href = url;
		  } else {
			swal("Cancelled", "Your file is safe", "error");
		  }
		});		
	});
});

/**
 * Settings for Modal
 */
function settingsModal(){
	var trigger =  $('.modal-settings');
	trigger.click(function(){
		var id = $(this).data('id');
		var title = $(this).data('title');
		var value = $(this).data('value');
		var _status = $(this).data('status');
		
		$("#settings_id").val(id);
		$("#settings_value").val(value);
		$("#modal-settings .modal-title").html(title);
		
		if(_status == 1){
			$('#status').bootstrapToggle('on');
		}else{
			$('#status').bootstrapToggle('off');
		}
		
	});
}

/**
 * Check all checkbox
 */
 function checkAll(){
	 $('input#check_all').click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);	 
	 });
 }
 
 /**
  * Submit using a tag
  */
function sweetAlertInit(_selector){
	$(_selector).click(function(){
			var isChecked = false;
			var formID = $($(_selector).data('form'));
			formID.find('input').each(function(){
				if($(this).prop("checked")){
					isChecked = true;
				}		
			});
			
			if(isChecked == true){
				swal({
				  title: "Are you sure?",
				  text: "This can not be undone.",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes",
				  cancelButtonText: "No",
				  closeOnConfirm: false,
				  closeOnCancel: true
				},
				function(isConfirm){
				  if (isConfirm) {
					formID.submit();
				  } 
				});	
			}else{
				swal("Must select atleast 1(one) entry.")
			}
		});
}
function dropZone(){
    $('form.dropzone .file').change(function(file){
		var _form = $(this).closest("form");
		_form.submit();
	});
	
	$('form .dropzone.file').change(function(file){
		var label = $("span.text-rep");
		var file = $(this)[0].files[0];
		label.html(file.name);
	});
} 
function addApplicationFormFields(){
	$('a#btn-educ').click(function(e){
		e.preventDefault();
		var container = $(this).data('target');
		var dates;
		for(var x = 2017; x >= 1917; x--){
			dates+='<option>'+x+'</option>';
		}
		$(container).append('<div class="educ-append"><div class="form-group"><div class="row"><div class="col-sm-6"><label class="control-label form-label">School name</label><input placeholder="School name" type="text" class="form-control" id="school-name" name="school_name[]" required=""></div><div class="col-sm-3"><label class="control-label form-label">FROM</label><br/><select style="width:100%;" name="school_from" id="school_from" class="selectpicker" ><option selected disabled>--FROM--</option>'+dates+'</select></div><div class="col-sm-3"><label class="control-label form-label">TO</label><br/><select style="width:100%;" name="school_to" class="selectpicker" ><option selected disabled>--TO--</option>'+dates+'</select></div></div></div></div>');
	});
	
	$('a#btn-emp').click(function(e){
		e.preventDefault();
		var container = $(this).data('target');
		$(container).append('<hr/><div class="emp-append-container"><div class="form-group"><div class="row"><div class="col-sm-6"><label class="control-label form-label">Company Name</label><input placeholder="Company name" type="text" class="form-control" id="emp_company_name" name="emp_company_name[]" required=""></div><div class="col-sm-6"><label class="control-label form-label">Position</label><input placeholder="Position" type="text" class="form-control" id="emp_position" name="emp_position[]" required=""></div></div><div class="form-group"><div class="row"><div class="col-sm-6"><label class="control-label form-label">Start</label><input placeholder="Start" type="month" class="form-control" id="emp_start" name="emp_start[]" required=""></div><div class="col-sm-6"><label class="control-label form-label">End</label><input placeholder="End" type="month" class="form-control" id="emp_end" name="emp_end[]" required=""></div></div></div><div class="row"><div class="col-sm-12"><label class="control-label form-label">Reason of Leaving</label><textarea class="form-control" id="reason" name="reason[]"></textarea></div></div></div></div>');
	});
	
	$('a#btn-ref').click(function(e){
		e.preventDefault();
		var container = $(this).data('target');
		$(container).append('<hr/><div class="ref-append-container"><div class="form-group"><div class="row"><div class="col-sm-3"><label class="control-label form-label">Name of Reference</label><input placeholder="Reference Name" type="text" class="form-control" id="ref_reference_name" name="ref_reference_name[]" required=""></div><div class="col-sm-3"><label class="control-label form-label">Position</label><input placeholder="Position" type="text" class="form-control" id="ref_position" name="ref_position[]" required=""></div><div class="col-sm-3"><label class="control-label form-label">Company / Organization Name</label><input placeholder="Company Name / Organization Name" type="text" class="form-control" id="ref_company_name" name="ref_company_name[]" required=""></div><div class="col-sm-3"><label class="control-label form-label">Contact</label><input placeholder="Reference Contact #" type="text" class="form-control" id="ref_contact" name="ref_contact[]" required=""></div></div></div></div>');
	});
}