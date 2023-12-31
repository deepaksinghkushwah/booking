@extends('app')

@section('title', 'Payment Status')
@section('content')
<h1>Click on pay now button to beging payment process</h1>
{{ Form::open(['url' => @route('razorpay.verify')]) }}

<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key'] ?>"
    data-amount="<?php echo $data['amount'] ?>"
    data-currency="INR"
    data-name="<?php echo $data['name'] ?>"
    data-image="<?php echo $data['image'] ?>"
    data-description="<?php echo $data['description'] ?>"
    data-prefill.name="<?php echo $data['prefill']['name'] ?>"
    data-prefill.email="<?php echo $data['prefill']['email'] ?>"
    data-prefill.contact="<?php echo $data['prefill']['contact'] ?>"
    data-notes.shopping_order_id="3456"
    data-order_id="<?php echo $data['order_id'] ?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>
    >
</script>
<!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
<input type="hidden" name="shopping_order_id" value="<?php echo $data['order_id']?>">
{{ Form::close() }}
@endsection