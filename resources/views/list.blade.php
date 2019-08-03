@extends('include.main')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1>URL List</h1>
      <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>URL</th>
            <th>Submitted At</th>
            <th>Detail</th> 
        </tr>
    </thead>

  <tr>
    
  </tr>
  @php
    $no = 0;
  @endphp
  @foreach ($data as $d)
    <tr>
      <th>{{ $no++ }}</th>
      <td>
        <a href="{{ $d->url }}" target="__blank">
          {{ $d->url }}
        </a>
      </td>
      <td>{{ $d->created_at }} </td>
      <td>
        <a href="{{ url('link/'. $d->id ) }}" class="btn btn-success btn-sm">Detail</a>
      </td>
    </tr>
  @endforeach
</table>
    </div>
  </div>
</div>
@endsection