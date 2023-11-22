@extends('app')

@section('title','Bookings Settings')

@section('content')
<h1>Settings</h1>
{{ Form::open(array('url' => @route("booking-save-settings"))) }}
<table class="table table-light table-striped table-condensed">
    <tbody>
        <tr>
            <td>Start Time</td>
            <td>
                {!! Form::text('start_time', $model->start_time, ['class' => 'form-control']) !!}
                <p class="text-secondary">24 hour time format i.e. 13:40</p>
            </td>
            <td>End Time</td>
            <td>
                {!! Form::text('end_time', $model->end_time, ['class' => 'form-control']) !!}
                <p class="text-secondary">24 hour time format i.e. 13:40</p>

            </td>
        </tr>
        <tr>
            <td>Time Step</td>
            <td>
                {!! Form::text('time_step', $model->time_step, ['class' => 'form-control']) !!}
                <p class="text-secondary">Time increment i.e 15 = 15 min</p>
            </td>
            <td>Price Per Slot</td>
            <td>
                <div class="input-group">
                <span class="input-group-text">{{env('PRICE_SYMBOL')}}</span>
                {!! Form::text('price_per_slot', $model->price_per_slot, ['class' => 'form-control']) !!}                
                </div>
                <p class="text-secondary">Price per time slot</p>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" align="right"><button type="submit"  class="btn btn-primary">Save</button></td>
        </tr>
    </tfoot>
</table>

{{ Form::close() }}

@endsection
