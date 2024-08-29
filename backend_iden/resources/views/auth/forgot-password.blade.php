<x-guest-layout>
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forgot Password</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    </head>

    <body style="background-color: #ECECEC;">
        <div class="container mt-5 ">
            <div class="row justify-content-center ">
                <div class="col-md-6 w-75 bg-green ">
                    <div class="card shadow-lg overflow-hidden">
                        <div class="card-body bg-white-100">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <h1 class="font-bold text-3xl mb-20 text-center">Forgot Password</h1>

                                <div class="form-group">
                                    <label for="email">Your Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required autofocus>
                                </div>

                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="w-5px mt-5 bg-red-500 text-red font-bold py-2 px-4 hover:bg-red-400 focus:outline-none focus:bg-red-700 transition-colors" style=" border-radius: 5px"><a href="/" style="text-decoration: none; color: white;">Back</a></button>
                                    <button type="submit" class="w-5px mt-5 bg-blue-500 text-white font-bold py-2 px-4 hover:bg-yellow-400 focus:outline-none focus:bg-blue-700 transition-colors" style=" border-radius: 5px">Next</button>

                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>

    </html>

</x-guest-layout>