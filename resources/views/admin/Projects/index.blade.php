@extends('layouts.admin')

@section('content')

<h1>My Project List</h1>

<table class="table w-100">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Project Url</th>
            <th scope="col">Image</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($projects as $project)
        <tr>
            <td>{{ $project->title }}</td>
            <td>{{ $project->description }}</td>
            <td><a href="{{ $project->project_url }}" target="_blank">{{ $project->project_url }}</a></td>
            <td><img src="{{ asset($project->image) }}" alt=""></td>
        </tr>
        @empty

        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $projects->links('pagination::bootstrap-5') }}
</div>
@endsection
