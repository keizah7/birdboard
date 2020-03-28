<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Birdboard</title>
</head>
<body>
    <form action="{{ route('projects.store') }}" method="post">
        @csrf
        <label for="">
            Title
            <input type="text" name="title" id="">
        </label>
        <label for="">
            Description
            <textarea name="description" id="" cols="30" rows="10"></textarea>
        </label>
        <button type="submit">Save</button>
    </form>
</body>
</html>
