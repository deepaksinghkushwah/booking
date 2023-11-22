@extends('app')

@section('title','Bookings Listing')

@section('content')
<h1>Your Availability</h1>
<ul class="nav nav-tabs " id="myTab" role="tablist">
    @php ($c = 1)
    @foreach($slots as $date => $slotRows)

    <li class="nav-item" role="presentation">        
        <button class="nav-link nav-pill {{ $c == 1 ? 'active' : '' }}" id="_{{ $date }}" data-bs-toggle="tab" data-bs-target="#date_{{ $date }}" type="button" role="tab" aria-controls="n_{{ $date }}" aria-selected="true">
            {{ date('d M Y', strtotime($date)) }}
        </button>
    </li>
    @php ($c++)
    @endforeach
</ul>

<div class="tab-content" id="myTabContent">
    @php ($c = 1)
    @foreach($slots as $date1 => $slotRows1)
    <div class="tab-pane {{ $c == '1' ? 'show active' : '' }}" role="tabpanel" aria-labelledby="date_{{ $date1 }}" id="date_{{ $date1 }}" >
        <div class="row row-cols-6">
            @foreach($slotRows1 as $sr)
            <div class="col">
                <div class="card card-primary mt-1">
                    <div class="card-header">
                        <div class="card-text">
                            {{ $sr }} <span class="float-right"><a href="javascript:alert('In progress');" title="Remove slot"><i class="bi-trash"></i></a></span>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    @php ($c++)
    @endforeach


</div>

@endsection
