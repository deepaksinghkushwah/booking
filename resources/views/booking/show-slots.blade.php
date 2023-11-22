@extends('app')

@section('title','Set Your Availability')

@section('content')
<h1>Set Your Availability</h1>
{{ Form::open(array('url' => @route("save-slots"))) }}
{!! Form::hidden('dates', null) !!}
<table class="table table-light table-striped table-condensed">
    <thead>
        <tr>
            <th width="30%">Select Date (Multiple Select Available)</th>
            <th width="50%">Pick Slots</th>
            <th width="20%">
                <button type="submit" class="btn btn-primary">Save</button>&nbsp;
                <a class="btn btn-primary" href="{{ @route('booking-list-date-slots') }}">Show Slots</a>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>

            <td valign="top">
            {!! Form::text('dates', null,['class' =>'form-control date']) !!}
            </td>


            <td colspan="2">
                <div class="slotContainer">
                    @foreach($timeArray as $time)
                    <div>
                        {!! Form::checkbox('slots[]', $time, true) !!} <label for="roles">{{$time}}</label>
                    </div>
                    @endforeach
                </div>

            </td>
        </tr>
    </tbody>
</table>

{{ Form::close() }}
@endsection

@section('header-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
@endsection
@section('footer-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">

$('.date').datepicker({
    format: 'yyyy-mm-dd',
    orientation: 'down',
    autoclose: false,
    todayBtn: true,
    todayHighlight: false,
    multidate: true,
    multidateSeparator: ",",
   startDate: '<?=date('Y-m-d', strtotime('+1 day'))?>'
});
$('.date').on('changeDate', function() {
    $('#dates').val(
        $('#datepicker').datepicker('getFormattedDate')
    );
});

</script>
@endsection