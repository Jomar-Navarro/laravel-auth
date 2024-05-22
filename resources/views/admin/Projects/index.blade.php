@extends('layouts.admin')

@section('content')
    <h2>My Projects</h2>

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif


  <div class="container-fluid">
    <form class="d-flex" action="{{ route('admin.projects.store') }}" method="POST">
        @csrf
        <input class="form-control me-2" type="search" placeholder="New Project" name="title">
        <button class="btn btn-success" type="submit">Submit</button>
    </form>
  </div>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">Projects</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($projects as $project)
    <tr>
      <td>
        <input type="text" value="{{ $project->title }}">
      </td>
      <td>
        <button class="btn btn-warning"><i class="fa-solid fa-pen-nib"></i></button>
        <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
