<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Eshop Prices Helper</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <link href="css/cover.css?v=1" rel="stylesheet">
    <link href="css/signin.css?v=1" rel="stylesheet">
</head>
<body class="d-flex h-100 text-center text-white bg-dark">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
            <h3 class="float-md-start mb-0">Eshop Prices Helper</h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
                <a class="nav-link" aria-current="page" href="https://github.com/datcal/eshop-prices-helper">Github</a>
            </nav>
        </div>
    </header>
    <main class="form-signin">

        @error('mail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @error('url')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('status'))
            <div class="alert alert-{{ session('class') }}">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{route('add_new_request')}}" method="POST">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Eshop Price Tracker</h1>
            <div class="form-floating">
                <input value="{{$mail}}" type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com">
                <label for="mail">Email address</label>
            </div>
            <div class="form-floating">
                <input type="url" class="form-control" name="url" id="url" placeholder="https://eshop-prices.com/games/8263-6souls?currency=TRY">
                <label for="url">Eshop Prices Url</label>
            </div>

            <div class="form-floating">
                <select class="form-control" id="currency" name="currency">
                    @foreach($currencies as $currencyCode => $currency)
                        <option @if($selected_currency == $currencyCode)  selected @endif value="{{$currencyCode}}">{{$currency}}</option>
                    @endforeach
                </select>
                <label for="floatingInput">Currency</label>
            </div>

            <div class="form-floating">
                <input type="number" step="0.1" name="price" class="form-control" id="price" placeholder="50,25">
                <label for="price">Price</label>
            </div>
            <label for="price" style="margin-top: 10px;">Don't check these countries</label>
            <div class="form-floating">
                @foreach($countries as $key => $country)
                    <div class="form-check form-check-inline">

                        <input @if(in_array($country, $blocked)) checked @endif class="form-check-input" type="checkbox" value="{{$country}}" name="countries[]" id="country{{$key}}">
                        <label class="form-check-label" for="country{{$key}}">{{$country}}</label>
                    </div>
                @endforeach

            </div>





            <button class="w-100 btn btn-lg btn-primary" style="margin-top: 20px;" type="submit">Track for me <3</button>
        </form>
    </main>


    <footer class="mt-auto text-white-50">
        <p>2022</p>
    </footer>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>
</html>
