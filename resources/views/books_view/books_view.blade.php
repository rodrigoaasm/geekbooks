@include('../templates/headerbase')

        <div class='container'>
            <ul>
                @foreach($books as $book)
                <li>
                  
                        {{$book["title"]}}
                   
                </li>
                @endforeach
            </ul>
        </div>

    </body>
</html>
