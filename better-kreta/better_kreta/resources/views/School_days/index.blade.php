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
            <a class="btn btn-warning mb-1" href="{{ route('schooldays.show_deleted') }}">
                Deleted School days
            </a>
            <a class="btn btn-success mb-1" href="{{ route('schooldays.create') }}">
                Create School day
            </a>
            @endif
        </div>
        

        <div class="row justify-content-center">

            <div class="col-10 text-center">
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
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Course</th>
                                <th scope="col"></th>
                                @if( Auth::user()->role == 1)
                                <th scope="col"></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($days as $day)
                                <tr>
                                    <form id="update_{{$day->id}}" action="{{ route('schooldays.update', $day) }}" method="POST">
                                        <input type="hidden" name="autoSave" id="autoSave" value="{{$day->id}}">
                                        @csrf
                                        @method('PUT')
                                        <td scope="row">
                                            <input type="text" name="title" id="title"
                                                class="form-control @if ($errors->has('title')) border border-danger @endif"
                                                placeholder="Course Name" aria-describedby="helpId"
                                                value="{{  $day->title }}"
                                                >

                                            @if ($errors->has('title'))
                                                <small class="text-danger">{{ $errors->first('title') }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="date" name="date" id="date"
                                                class="form-control @if ($errors->has('birthday')) border border-danger @endif"
                                                placeholder="Course Name" aria-describedby="helpId"
                                                value="{{ $day->date }}"
                                               
                                                >

                                            @if ($errors->has('date'))
                                                <small class="text-danger">{{ $errors->first('date') }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <select class="form-control form-select" name="course_id" id="course_id" aria-label="Default select example">
                                                <option value="{{$day->course_id}}}}" selected> {{$courses->where("id", $day->course_id)->first()->name}}</option>
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
                                        <form action="{{ route('schooldays.destroy', $day) }}" method="POST">
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
