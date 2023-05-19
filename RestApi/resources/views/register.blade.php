<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container  " style="width:50%;">
        <div class="row">
            <div class="card">
                <h2>Register</h2>
            </div>
            <div class="col-12">
                <form action="{{url('registers')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">User_name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="user_name" id="inputEmail3"
                                placeholder="name">
                                @error('name')
                                  
                                            {{ $message }}
                                       
                                @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputEmail3"
                                placeholder="Email">
                        </div>
                    </div>
                    @error('email')
                        {{-- <span class="invalid-feedback" role="alert"> --}}
                            {{-- <strong> --}}
                                {{ $message }}
                       {{-- /     </strong> --}}
                        {{-- </span> --}}
                    @enderror
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="inputPassword3"
                                placeholder="Password">
                        </div>
                    </div>
                        {{-- <input type="bearer" name="token" value="bearer"> --}}
                    @error('password')
                        {{-- <span class="invalid-feedback" role="alert"> --}}
                            {{ $message }}
                    @enderror
                    <div class="form-group row">
                        <label  class="col-sm-2 mr-2 ">password_confirmation</label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirmation" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">register</button>
            </div>
        </div>

        </form>
    </div>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
