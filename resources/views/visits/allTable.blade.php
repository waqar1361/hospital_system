<table class="table table-hover" id="visit-table">
	<thead>
	<tr>
		<th>MRN</th>
		<th>Date/Time</th>
		<th>Patient Name</th>
		<th>Sex</th>
		<th>Room</th>
		<th>Status</th>
		<th>Physician Name</th>
		<th>Action</th>
	</tr>
	</thead>

</table>


@section('page-script')
	<script>
		$(document).ready(function () {
			$('#visit-table').DataTable({
				data: {!! $visits !!},
				columns: [
					{
						data: 'patient',
						render: function (data) {
							return data["mrn"];
						}
					},
					{data: 'time'},
					{
						data: 'patient',
						render: function (data) {
							return data['first_name']+" "+data["last_name"];
						}
					},
					{
						data: 'patient',
						render: function (data) {
							return data["sex"];
						}
					},
					{data: 'room'},
					{data: 'status'},
					{data: 'physician'},
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