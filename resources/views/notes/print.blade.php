<h5 class="text-center">Details</h5>
<table class="table table-sm">
    <tr>
        <th>Patient Name</th>
        <td>{{$patient->fullname}}</td>
    </tr>
    <tr>
        <th>Date of Birth</th>
        <td>{{$patient->date_birth->format('d-m-Y')}}</td>
    </tr>
    <tr>
        <th>Physician Name</th>
        <td>{{ auth()->user()->fullname }}</td>
    </tr>
    <tr>
        <th>Contact Number</th>
        <td>{{$patient->contact_number}}</td>
    </tr>
    <tr>
        <th>Medication Name</th>
        <td>{{ $medication->name }}</td>
    </tr>
    <tr>
        <th>SIG</th>
        <td>{{ $medication->sig }}</td>
    </tr>
    <tr>
        <th>Dispense</th>
        <td>{{ $medication->dispense }}</td>
    </tr>
    <tr>
        <th>Refill</th>
        <td>{{ $medication->refill }}</td>
    </tr>
</table>