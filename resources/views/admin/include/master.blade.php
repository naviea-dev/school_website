  	@include('admin.include.app')
    @include('admin.include.header') 
        @yield('content') 
    @include('admin.include.footer')
	 <link href="{{ asset('assets/admin/datatables/datatables.css') }}" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	 
	 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="{{ asset('assets/admin/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/elephant.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/application.min.js') }}"></script>
	<!-- <script src="{{ asset('assets/admin/datatables/dataTables.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/admin/datatables/dataTables.bootstrap.js') }}"></script> -->
    <script src="https://unpkg.com/sweetalert2@7.3.0/dist/sweetalert2.all.js"></script>
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <!-- <script src="{{ asset('assets/admin/chartjs/chart.js') }}"></script> -->
    <script src="{{ asset('assets/admin/js/common_script.js') }}"></script>

	<style>
		body{
			font-size: 14px;
		}
	</style>
<script>
/* $(document).ready(function() {
	$('#responsive-datatable').DataTable({
		responsive: true
	});
}); */

checked = false;
function checkedAll() {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('form_check').elements.length; i++){
	  document.getElementById('form_check').elements[i].checked = checked;
	}
}


function permissions(tables,status,statuscol){
	var summeCode=document.getElementsByName("summe_code[]");
	var j=0;
	var dataval= new Array();
	
	for(var i=0; i < summeCode.length; i++){
		if(summeCode[i].checked)
		{
			dataval[j]=summeCode[i].value;
			j++;			
		}		
	}
	if(dataval=="")
	{
		alert("Please check one or more!");
		return false;
	}
	else{
			if(tables == 'customers'){
				var urls = "{{ url('administration/permissionsuser') }}";
			}
			else{
				var urls = "{{ url('administration/permissions') }}";
			}
			
			var hrefdata = urls+"?approve_val="+dataval+"&&tablename="+tables+"&&status="+status+"&&statuscol="+statuscol;
			window.location.href=hrefdata;
	}	
}

function deletedata(patch,tables)
{
		var summeCode=document.getElementsByName("summe_code[]");
		var j=0;
		var dataval= new Array();
		var furl = patch;
		var imagedel = false;
		for(var i=0; i < summeCode.length; i++){
			if(summeCode[i].checked)
			{
				dataval[j]=summeCode[i].value;
				j++;				
			}			
		}
		if(dataval=="")
		{
			swal({
			  title: "Unchecked credential!",
			  text: "Please check one or more!",
			  icon: "warning",
			});
			return false;
		}
		else{	

			swal({
			  title: 'Are you sure?',
			  //type: 'warning',
			  imageUrl: "{{ asset('assets/images/favicons/favicon.png') }}",
			  confirmButtonText: 'Ok, Delete It',
			  showCloseButton: true,
  			  showCancelButton: true,
			  text: "Do you want to Delete Selected Data !",
			 // input: 'checkbox',
			  //inputPlaceholder: ' Delete all Images for Selected Submission'
			}).then((result) => {
			  if (result.value) {
				//swal({type: 'success', text: 'You have a bike!'});
				imagedel = true;
				$.ajax({
					type: "GET",
					url: furl,
					data: {'id':dataval,'deletetype':'multiple','deleteimage':imagedel,'tablename':tables},
					cache: false,
					success: function(html) {
						swal({
						  title: "Successfully Delete!",
						  text: "All selected data are deleted",
						  type: "success",
						});
						 var len = html.length;
						for(i in html){
							 $("#tablerow" + html[i]).fadeOut('slow');
						}				
					 }					
				});	
			
			  } else {
				console.log('modal was dismissed by ${result.dismiss}')
			  }
			  
		});
	}
}

function deleteSingle(id,patch,tables){
		
		var furl = patch;
		//alert(tables);
		var imagedel = false;
		
			swal({
			  imageUrl: "{{ asset('assets/images/favicons/favicon.png') }}",
			  title: 'Are you sure?',			 
			  confirmButtonText: 'Ok, Delete It',
			  //type: 'warning',
			  showCloseButton: true,
  			  showCancelButton: true,
			  text: "Do you want to Delete Selected data !",
			  //input: 'checkbox',
			  //inputPlaceholder: ' Delete all Images for Selected data'
			}).then((result) => {
			  if (result.value) {
				//swal({type: 'success', text: 'You have a bike!'});
				imagedel = true;
				$.ajax({
					type: "GET",
					url: furl,
					data: {'id':id,'deletetype':'single','deleteimage':imagedel,'tablename':tables},
					cache: false,
					success: function(html) {
						swal({
						  title: "Successfully Delete!",
						  text: "All selected data are deleted",
						  type: "success",
						});
						$("#tablerow" + id).fadeOut('slow');
					 }					
				});	
			
			  } else if (result.value === 0) {
				//swal({type: 'error', text: "You don't have a bike :("});
				imagedel = false;
				$.ajax({
					type: "GET",
					url: furl,
					data: {'id':id,'deletetype':'single','deleteimage':imagedel,'tablename':tables},
					cache: false,
					success: function(html) {
						swal({
						  title: "Successfully Delete!",
						  text: "All selected Submission are deleted",
						  type: "success",
						});
						$("#tablerow" + id).fadeOut('slow');			
					 }					
				});	
			
			  } else {
				console.log('modal was dismissed by ${result.dismiss}')
			  }
			  
		});
	}

	/* let wordWiseData = () => {
      const dongout = document.getElementById('dongoutChart');
      new Chart(dongout, {
        type: 'doughnut',
        data: {
          labels: ["Success", "Failed", "Warning"],
          datasets: [{
            label: '# of Alerts',
            data: [50,60,78],
            backgroundColor: [
              'rgba(255, 99, 132, 0.5)',
              'rgba(54, 162, 235, 0.5)',
              'rgba(255, 206, 86, 0.5)',
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          cutout: 70,
          animationEasing: "easeOutBounce",
          animateRotate: true,
          animateScale: false,
          responsive: true,
          maintainAspectRatio: true,
          plugins: {
            legend: {
              display: false
            },
            centerText: {
              text: [160, 'Alerts']
            }
          }
        }
      }
      );
    }

    let holdingWiseData = () => {
      const bar = document.getElementById('barChart');
      new Chart(bar, {
        type: 'bar',
        data: {
          labels: ["Success", "Failed", "Warning"],
          datasets: [{
            axis: 'y',
            label: 'Holding Info',
            data: [45, 65, 89],
            fill: true,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            },
            gridLines: {
              color: "rgba(204, 204, 204,0.1)"
            }
          }],
          xAxes: [{
            gridLines: {
              color: "rgba(204, 204, 204,0.1)"
            }
          }]
        },
        legend: {
          display: false
        },
        elements: {
          line: {
            tension: 0.5,
          },
          point: {
            radius: 0
          }
        }
        }
      });
    }

    window.onload = () => {
      wordWiseData();
      holdingWiseData();
  }; */

</script>
  </body>
</html>