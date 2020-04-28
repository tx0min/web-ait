@if($disciplines=$user->disciplines())
    @foreach($disciplines as $disciplina)
        <a class="badge badge-dark" href="{{ route('socis',['disciplina'=>$disciplina->slug])}}">{{ $disciplina->name }}</a>
    @endforeach
@endif
