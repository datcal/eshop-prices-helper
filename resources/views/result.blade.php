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



    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">
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
    <main class="px-3">
        <h1>Eshop Price Tracker</h1>
        <p class="lead">
            The request has been successful. If you want to cancel this request, you can use this link <a href="{{config('app.url')}}/delete/{{$track['token']}}/{{$track['mail']}}">{{config('app.url')}}/delete/{{$track['token']}}/{{$track['mail']}}</a> or you can click "Cancel Tracking Request" button.
            We will cancel your request, and we will delete your data. We don't share your data with anybody.
        </p>
        <p class="lead">
            <a href="{{config('app.url')}}/delete/{{$track['token']}}/{{$track['mail']}}" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Cancel Tracking Request</a>
        </p>
    </main>

    <footer class="mt-auto text-white-50">
        <p>2022</p>
    </footer>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>
</html>
