$(document).ready(function(){
				$('#submit').click(function(){
				toastr.options = {
				  'closeButton': true,
				  'debug': false,
				  'progressBar': true,
				  'preventDuplicates': false,
				  'positionClass': 'toast-top-right',
				  'onclick': null,
				  'showDuration': '300',
				  'hideDuration': '1000',
				  'timeOut': '4000',
				  'extendedTimeOut': '1000',
				  'showEasing': 'swing',
				  'hideEasing': 'linear',
				  'showMethod': 'fadeIn',
				  'hideMethod': 'fadeOut'
				}
				toastr[error]('Passwords do not match', 'Password Error');
				
				});
			});
			
			