@extends('include.main')

@section('content')
<style>
  /* CSS Test begin */
.comment-box {
    margin-top: 30px !important;
    width: 100%
}
/* CSS Test end */

.comment-box img {
    width: 50px;
    height: 50px;
}
.comment-box .media-left {
    padding-right: 10px;
    width: 65px;
}
.comment-box .media-body p {
    border: 1px solid #ddd;
    padding: 10px;
}
.comment-box .media-body .media p {
    margin-bottom: 0;
}
.comment-box .media-heading {
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    padding: 7px 10px;
    position: relative;
    margin-bottom: -1px;
}
.comment-box .media-heading:before {
    content: "";
    width: 12px;
    height: 12px;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-width: 1px 0 0 1px;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
    position: absolute;
    top: 10px;
    left: -6px;
}
</style>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1>Product Detail</h1>
      <table class="table table-bordered">
    <tbody>
      <tr>
        <td>URL</td>
        <td><a href="{{ $data->url}}" > {{ $data->url}}</a></td>
      </tr>
      <tr>
        <td>Product Name</td>
        <td>{{ $data->product_name }}</td>
      </tr>
      <tr>
        <td>Product Description</td>
        <td>{{ $data->product_desc }}</td>
      </tr>
      <tr>
        <td>Product Price</td>
        <td>Rp {{ number_format($data->product_price) }}</td>
      </tr>
      <tr>
        <td>Url Submitted At</td>
        <td>{{ $data->created_at }}</td>
      </tr>
    </tbody>
  </table>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <form action="{{ url('comment/create') }}" method="POST">
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Input Comment Here</label>
        @csrf
        <input type="hidden" name="link_id" value="{{ $data->id }}">
        <textarea class="form-control" id="" rows="3" name="comment"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>
  </div>
  @foreach ($comments as $comment)
  @php
    $like = app('db')->table('votes')->where('comment_id', $comment->id)->where('like', 1)->count();
    $dislike = app('db')->table('votes')->where('comment_id', $comment->id)->where('like', 0)->count();
  @endphp
  <div class="row">
    <div class="col-lg-12">
      <div class="media comment-box">
                  <div class="media-left">
                      <a href="#">
                          <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                      </a>
                  </div>
                  <div class="media-body">
                      <h4 class="media-heading">Anonymous 
                      <div class="votes pull-right">
                      {{ $like }} <a href="{{ url('vote/'. $comment->id . '/1') }}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                      {{ $dislike }} <a href="{{ url('vote/'. $comment->id) . '/0'}}"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                      </div>

                      </h4>
                      <p>
                        {{ $comment->comment}}
                        <br><br>
                        <small>{{ $comment->created_at }}</small>
                      </p>
                  </div>
    </div>
    </div>
  </div>
  @endforeach
</div>
@endsection