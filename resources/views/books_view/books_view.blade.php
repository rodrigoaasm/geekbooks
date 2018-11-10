@include('../templates/headerbase')

        <div class='container'>
            <ul>
                @foreach($books as $book)
                <li>
                    @if($catID == null) <!-- Verifica a forma que os dados foi agrupado-->
                        {{$book["title"]}}
                    @else
                        {{$book->title}}
                    @endif
                </li>
                @endforeach
            </ul>
        </div>

    </body>
</html>
