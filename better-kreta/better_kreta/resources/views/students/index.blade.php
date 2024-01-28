@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex flex-column"style="position: fixed; top:70px; left:20px;">
            <div class="form-check form-switch">    
                    <label class="form-check-label" for="flexSwitchCheckDefault">Lock Edit</label>
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onclick="x();">
            </div>
            {{-- <div class="form-check form-switch">    
                <label class="form-check-label" for="flexSwitchCheckDefault">Lock Edit</label>
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onclick="x();">
            </div> --}}

            @if( Auth::user()->role == 1)
            <a class="btn btn-warning mb-1" href="{{ route('students.show_deleted') }}">
                Deleted Students
            </a>
            <a class="btn btn-success mb-1" href="{{ route('students.create') }}">
                Create Students
            </a>
            @endif
        </div>
        

        <div class="row justify-content-center">

            <div class="col-11 text-center">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <h1>Use Ctrl+F for searching</h1>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Course</th>
                                <th scope="col"></th>
                                @if( Auth::user()->role == 1)
                                <th scope="col"></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <form id="update_{{$student->id}}" action="{{ route('students.update', $student) }}" method="POST">
                                        <input type="hidden" name="autoSave" id="autoSave" value="{{$student->id}}">
                                        @csrf
                                        @method('PUT')
                                        <td scope="row">
                                            <input type="text" name="name" id="name_{{$student->id}}"
                                                class="form-control @if ($errors->has('name')) border border-danger @endif"
                                                placeholder="Course Name" aria-describedby="helpId"
                                                value="{{  $student->name }}"
                                                >

                                            @if ($errors->has('name'))
                                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="text" name="birthday" id="birthday_{{$student->id}}"
                                                class="form-control @if ($errors->has('birthday')) border border-danger @endif"
                                                placeholder="Course Name" aria-describedby="helpId"
                                                value="{{ $student->birthday }}"
                                               
                                                >

                                            @if ($errors->has('birthday'))
                                                <small class="text-danger">{{ $errors->first('birthday') }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <select class="form-control form-select" name="course_id" id="course_id" aria-label="Default select example">
                                                <option value="{{$courses[$student->course_id-1]->id}}" selected> {{$courses[$student->course_id-1]->name}}</option>
                                                @forEach($courses as $course)
                                                <option value="{{$course->id}}">{{$course->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </td>
                                    </form>
                                    @if( Auth::user()->role == 1)
                                    <td>
                                        <form action="{{ route('students.destroy', $student) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




    </div>


    <script>
        let x = function() {
            let chxBox = document.getElementById("flexSwitchCheckDefault").checked;
            const y = document.querySelectorAll('.form-control');

            if (chxBox) {
                console.log("isChecked");
                y.forEach(element => {
                    element.disabled = true;
                });
            } else {
                y.forEach(element => {
                    element.disabled = false;
                });
                console.log("NOT");
            }
        }
    </script>
@endsection
