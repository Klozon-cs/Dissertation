@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col"></div>
        <div class="col">
            <div class="card border-secondary">
                <div class="card-body">
                    <h4 class="card-title">Create a Student</h4>
                    @if ($errors->any())
                        <div class="mb-3 mt-3">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <strong>Holy guacamole!</strong>

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         
                            <strong>Holy guacamole!</strong> 
                            <p>{{Session::get('success')}}</p>
                        </div>
                    @endif

                    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control @if($errors->has('name')) border border-danger @endif"
                                placeholder="Student Name" aria-describedby="helpId" value="{{old('name')}}" required>

                            @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @else
                                <small id="helpId" class="text-muted">The name of the student to be created.</small>
                            @endif

                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" name="birthday" id="birthday" class="form-control"
                                placeholder="Birthday" aria-describedby="helpId" maxlength="255" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="course_id" id="course_id" aria-label="Default select example" required>
                                @forEach($courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

@endsection
