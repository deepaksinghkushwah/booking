@extends('app')
@section('title','Booking List')
@section('content')
<h1>Bookings</h1>
@if(count($bookings)>0)
<table class="table table-striped">
    <thead>
        <tr class="bg-dark text-white">
            <th>Booking ID#</th>
            <th>Booked By</th>
            <th>Date</th>
            <th>Time</th>            
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->bookedBy->name }}</td>
            <td>{{ $item->booking_date }}</td>
            <td>{{ $item->booking_slot }}</td>
            <td>
                @if($item->status == 0)
                   Unpaid
                @elseif($item->status ==1)
                    Confirmed
                @else
                    Cancelled
                @endif
            </td>
            <td>
                @if($item->status == 1)
                    <a href="javascript:void(0);" onclick="cancelBooking('{{ @route("booking-cancel",["id" => $item->id]) }}')" title="Cancel Booking" class="cancelBooking"><i class="bi bi-x-octagon"></i></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
No booking history found
@endif
@endsection

@section('footer-js')
<script>
    function cancelBooking(url){

    Swal.fire({
    title: 'Are you sure want to cancel booking?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
    return fetch(`${url}`)
            .then(response => {
            if (!response.ok) {
            throw new Error(response.statusText)
            }
            return response.json()
            })
            .catch(error => {
            Swal.showValidationMessage(
                    `Request failed: ${error}`
                    )
            })
    },
            allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
    if (result.isConfirmed) {
    Swal.fire({
    title: `${result.value.msg}`,
    }).then(() => window.location.reload());
    }
    });
    };
</script>
@endsection