@extends('include.main')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th> 
            <th>Description</th>
            <th>Image</th>
        </tr>
    </thead>

  <tr>
    
  </tr>
  @foreach ($data as $d)
    <tr>
      <td>{{ $d['name']}}</td>
      <td>{{ 'Rp' . number_format($d['price']) }}</td>
      <td>{{ $d['description']}}</td>
      <td>
        <a href="{{ $d['images'] }}">
          <img src="{{ $d['images']}}" width="100px">
        </a>
      </td>
    </tr>
  @endforeach
</table>
    </div>
  </div>
</div>
@endsection