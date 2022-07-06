<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalogue</title>
    <style>
        table,
        td,
        th {
            border: 1px solid;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>ISBN</th>
                <th>Genre</th>
                <th>Quantity</th>
                <th>Last updated</th>
            </tr>
        </thead>
        <tbody>
            {{$count=1}}
            @foreach($books as $book)
            <tr>
                <td> {{$count++}} </td>
                <td>{{$book->bookTitle}}</td>
                <td>{{$book->isbn}}</td>
                <td>{{$book->genre}}</td>
                <td>{{$book->quantity}}</td>
                <td>{{$book->updated_at}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>