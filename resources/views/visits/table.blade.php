<table class="table table-hover" id="visit-table">
	<thead class="thead-light">
	<tr>
		<th>Date / Time</th>
		<th>Physician</th>
		<th>Room</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	
	</tbody>
</table>

@section('page-script')
	<script>
		$(document).ready(function () {
			$('#visit-table').DataTable({
				data: {!! $visits !!},
				columns: [
					{data: 'time'},
					{data: 'physician'},
					{data: 'room'},
					{data: 'status'},
					{
						data: null,
						render: function (data) {
							return '<a href="/visits/' + data["id"] + '/details" class="btn btn-round btn-info"' +
								'title="Visit Details" data-toggle="tooltip"><i class="fa ' +
								'fa-list-alt"></i></a>';
						}
					}
				
				],
				dom: 'Bfrtip',
				buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdfHtml5']
			});
			
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			});
		});
	</script>
@endsection
