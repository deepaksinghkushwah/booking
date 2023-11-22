@extends('app')

@section('title','Bookings Slots')

@section('content')
<h1>Pick A Booking Slots For {{ $user->name }} </h1>
@if(count($slots) <= 0)
<p>Person not available for booking</p>
@else
<div class="vtabs">
    {{ Form::open(['url' => @route('razorpay.index'),'onSubmit' => 'return validate();']) }}
    {!! Form::hidden('user_id',$user->id)  !!}
    <div class="row">
        <div class="col-3">
            <ul class="nav nav-tabs nav-pills left-tabs" id="myTab" role="tablist">
                @php ($c = 1)
                @foreach($slots as $date => $slotRows)

                <li class="nav-item" role="presentation">                            
                    <div id="lorem-left-tab" class="nav-link tab-clickable {{ $c == 1 ? 'active' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#date_{{ $date }}" aria-controls="n_{{ $date }}" aria-selected="true">
                        {{ $date }}
                    </div>
                </li>
                @php ($c++)
                @endforeach
            </ul>
        </div>
        <div class="col-9">
            <div class="tab-content accordion" id="accordion-left-tabs">
                @php ($c = 1)
                @foreach($slots as $date1 => $slotRows1)
                <div class="tab-pane accordion-item {{ $c == '1' ? 'active' : '' }}" role="tabpanel" aria-labelledby="date_{{ $date1 }}" id="date_{{ $date1 }}" >
                    <div class="slotContainer">                        
                        @foreach($slotRows1 as $sr)                        
                            <div class="card card-primary mt-1">
                                <div class="card-header">
                                    <div class="card-text">
                                        {{ $sr }} 
                                        <span class="float-right">
                                            {!! Form::radio('slot',$date1.'|'.$sr, true)  !!}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @php ($c++)
                @endforeach


            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-primary mt-3" type="submit">Next</button>
        </div>

    </div>

    {{ Form::close() }}
</div>
@endif
@endsection

@section('footer-js')
<script>
    function validate() {
        let val = $('input[name="slot"]:checked').val().split("|");
        if(confirm("Are you sure to book for "+val[0]+" date and "+val[1]+" slot?")){
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection
