<ul>
    @foreach ($professors as $professor)
    <li>
        {{ $professor->firstName . ' ' . $professor->lastName }}
    </li>
    @endforeach
</ul>