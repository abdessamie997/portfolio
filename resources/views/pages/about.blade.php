

@extends('layout.master')

@section('title', 'about')

@section('about')

<script>
    location.assign('#about');
</script>

@php

    use App\Users;
    use App\Experiences;
    use App\Skills;

    $users = Users::all();
    $experiences = Experiences::all();
    $skills = Skills::all();

@endphp

<div class="aboutContainer">

<ul>

    <li>
        <h3>Description:</h3>
        @foreach ($users as $user)
        <p>
            {{ $user->description }}
        </p>
        @endforeach
    </li>

    <li>
        <h3>Experiences:</h3>
        <ul>
            @foreach ($experiences as $experience)
            <li>
                <h5><span>{{ $experience->title }}</span></h5>
                {{ $experience->description }}
            </li>
            @endforeach
        </ul>
    </li>

    <li>

        <h3>Skills:</h3>

        @foreach ($skills as $skill)

        <ul class="skills">

            <li> {{ $skill->skill }}:
                <div class="progress">
                    <div class="progress-bar" style="width:{{ $skill->degree }}%" role="progressbar" aria-valuemax="100" aria-valuemin="0" aria-valuenow="{{ $skill->degree }}" >
                        {{ $skill->degree }} %
                    </div>
                </div>
            </li>

        </ul>

        @endforeach

    </li>

</ul>

</div>


@endsection
