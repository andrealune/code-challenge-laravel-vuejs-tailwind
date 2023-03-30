<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>CRUD</title>

    <link href="index.css" rel="stylesheet">
  </head>
  <body>
    
    <nav class="navbar navbar-dark bg-mynav">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">My App</a>
      </div>
    </nav>

    <div class="container">
      <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight"><h2>Contact List</div>
        <div class="p-2 bd-highlight">
          <a href="{{url('contacts/create')}}"><button type="button" class="btn btn-secondary">Create</button></a>
        </div>
      </div>
      
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">FIRST NAME</th>
              <th scope="col">LAST NAME</th>
              <th scope="col">PHONE NUMBER</th>
              <th scope="col">EMAIL</th>
              <th scope="col">ACTION</th>
            </tr>
          </thead>
          <tbody id="mytable">
            @foreach($contacts as $values)
            <tr>
              <th scope="row">{{$values->id}}</th>
              <th scope="row">{{$values->first_name}}</th>
              <th scope="row">{{$values->last_name}}</th>
              <th scope="row">{{$values->phone}}</th>
              <th scope="row">{{$values->email}}</th>
              <th scope="row"><a href="{{url('contacts/info/'.$values->id)}}"><button>Edit</button></a><a href="{{url('contacts/delete/'.$values->id)}}"><button>Delete</button></a></th>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>