<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen">
        <div
            x-data="{ isAnimating: false, isLiked: false }"
            x-on:click="isAnimating = !isAnimating; isLiked = !isLiked"
            x-bind:class="{
                'bg-right': isLiked,
                'animate-[burst_1s_steps(28)_1]': isAnimating
            }"
            class="heart cursor-pointer h-[100px] w-[100px] bg-left bg-no-repeat bg-[length:2900%] hover:bg-right"
            style="background-image: url('https://abs.twimg.com/a/1446542199/img/t1/web_heart_animation.png');"
        >
        </div>
    </div>
</body>
</html>