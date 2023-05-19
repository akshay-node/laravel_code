<!doctype html>
<html lang="en">

<head>
    <title>reset password</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="width:50%;">
        <div class="row">
        <h3>reset password</h3>
    </div>
        <div class="row " style="margin:-8%;">
                <form class="px-5 py-5" action="{{ url('resert_password') }}" method="post">
                    @csrf
                    <div>
                        <input type="hidden" name="email" value="{{$data[0]['email'] }}">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">new_password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="inputEmail3"
                                placeholder="password">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="inputEmail3" class="col-sm-2 col-form-label">confirm_password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control mt-2" name="confirmpassword" id="inputEmail3"
                                placeholder="password-">
                            @error('confirmpassword')
                                {{ $message }}
                            @enderror
                            <div></div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">confirm</button>
                            </div>
                            @if (Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                        @if (Session::has('success'))
                            <p class="text-success">{{ Session::get('success') }}</p>
                        @endif
                

                </form>
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
