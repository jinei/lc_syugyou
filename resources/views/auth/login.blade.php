<!DOCTYPE html>
<html lang="ja">

<head>
    <title>勤務表アプリ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="{{ asset('login.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</head>

<body>

    <div class="text-center" style="padding:50px 0">
	    <div class="logo">LOGIN</div>
	    <div class="login-form-1">
        
            <form method="POST" action="{{ route('login') }}">
            @csrf
			    <div class="login-form-main-message"></div>
			    <div class="main-login-form">
				    <div class="login-group">
					    <div class="form-group">
						    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="lg_username" name="email" placeholder="EMAIL">
                        </div>
                        @error('email')
                            <span style="color:#980000;">{{$message}}</span>
                        @enderror

					    <div class="form-group">
						    <label for="lg_password" class="sr-only">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="lg_password" name="password" placeholder="PASSWORD">
                        </div>
                        @error('password')
                            <span style="color:#980000;">{{$message}}</span>
                        @enderror
                    
                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
			    </div>
            </form>

        </div>
    </div>
</body>

</html>