@extends('layouts.admin')

@section('content')
    <h2 class="fw-bold">Technologies</h2>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container-fluid mb-4">
        <form class="d-flex" action="{{ route('admin.technologies.store') }}" method="POST">
            @csrf
            <input class="form-control me-2" type="text" placeholder="New Technology" name="name">
            <button class="btn btn-success" type="submit">Submit</button>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Technologies</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
            <tr>
                <td>
                    <form action="{{ route('admin.technologies.update', $technology) }}" id="form-edit-{{ $technology->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" value="{{ $technology->name }}" name="name" class="form-control">
                    </form>
                </td>
                <td>
                    <button onclick="submitForm({{ $technology->id }})" class="btn btn-warning"><i class="fa-solid fa-pen-nib"></i></button>

                    <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this technology?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function submitForm(id) {
            const form = document.getElementById(`form-edit-${id}`);
            form.submit();
        }
    </script>
@endsection
