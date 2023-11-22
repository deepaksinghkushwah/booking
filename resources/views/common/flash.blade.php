@if ($message = Session::get('success'))

<div class="alert alert-success alert-block mt-2 alert-dismissible fade show">

    <button type="button" class="close" data-bs-dismiss="alert">×</button>    

    <strong>{{ $message }}</strong>

</div>

@endif

  

@if ($message = Session::get('error'))

<div class="alert alert-danger alert-block mt-2 alert-dismissible fade show">

    <button type="button" class="close" data-bs-dismiss="alert">×</button>    

    <strong>{{ $message }}</strong>

</div>

@endif

   

@if ($message = Session::get('warning'))

<div class="alert alert-warning alert-block mt-2 alert-dismissible fade show">

    <button type="button" class="close" data-bs-dismiss="alert">×</button>    

    <strong>{{ $message }}</strong>

</div>

@endif

   

@if ($message = Session::get('info'))

<div class="alert alert-info alert-block mt-2 alert-dismissible fade show">

    <button type="button" class="close" data-bs-dismiss="alert">×</button>    

    <strong>{{ $message }}</strong>

</div>

@endif

  

@if ($errors->any())

<div class="alert alert-danger mt-2 alert-dismissible fade show">

    <button type="button" class="close" data--bsdismiss="alert">×</button>    

    Please check the form below for errors

</div>

@endif