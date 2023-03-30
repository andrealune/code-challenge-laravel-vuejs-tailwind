<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
   
    <div class="container mt-5" >
        <a href="{{url('contacts')}}"><button type="submit" class="btn btn-primary mt-5">Back To List</button></a>
       <form action="{{url('contacts/update')}}" method="get">
        <div class="form-group">
            <input type="hidden" value="{{$objData->id}}" name="id">
          <label for="exampleInputEmail1">First Name</label>
          <input type="text" class="form-control" value="@if(isset($objData->first_name)) {{$objData->first_name}} @endif" id="exampleInputEmail1" name="first_name" aria-describedby="emailHelp" placeholder="First name" required>
 
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Last Name</label>
            <input type="text" class="form-control" value="@if(isset($objData->last_name)) {{$objData->last_name}} @endif"  name="last_name" aria-describedby="emailHelp" placeholder="Last name" required>

          </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Phone Number</label>
          <input type="text" class="form-control" id="exampleInputPassword1" value="@if(isset($objData->phone)) {{$objData->phone}} @endif" name="phone" placeholder="phone number">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="email" class="form-control" id="email" value="@if(isset($objData->email)) {{$objData->email}} @endif" name="email" placeholder="email">
          </div>
        <button type="submit" class="btn btn-primary mt-5">Submit</button>
      </form>
    </div>
</body>
</html>