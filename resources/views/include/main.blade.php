<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Scrapp</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://use.fontawesome.com/acff9e449a.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-light justify-content-center">

  <ul class="navbar-nav">
        <li class="nav-item <?php (request()->is('/*'))? 'active' : '' ?>">
      <a class="nav-link" href="{{ url('/') }}">Submit Link</a>
    </li>
    <li class="nav-item <?php (request()->is('/link/*'))? 'active' : '' ?>">
      <a class="nav-link" href="{{ url('link') }}">Link List</a>
    </li>
  </ul>

</nav>
  @yield('content')
<!-- Latest compiled and minified JavaScript -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    $("#linkform").submit(function(e){
      e.preventDefault();
      let url = $("#url").val();
      alert(url);

      if(url === ''){
        alert('Link is empty');
        return false;
      }else{
        return true;
      }
    })
  });
</script>
</body>
</html>