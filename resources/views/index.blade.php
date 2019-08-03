@extends('include.main')

@section('content')
<div class="container">
	<div class="col-lg-12">
		<form method="POST" action="{{ url('process') }}" id="linkform">
			@csrf
		  <div class="form-group">
		    <label for="link">Link</label>
		    <input type="text" class="form-control" name="url" placeholder="URL" id="url">
		  </div>
		  <button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>
</div>
@endsection