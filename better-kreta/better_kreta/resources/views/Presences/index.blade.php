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
                                <th scope="col">Satus</th>
                                <th scope="col">Student</th>
                                <th scope="col">Work day</th>
                                <th scope="col"></th>
                                @if (Auth::user()->role == 1)
                                    <th scope="col"></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presences as $pr)
                                <tr>
                                    <form id="update_{{ $pr->shoolday_id }}" action="{{ route('presences.update', $pr) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <td style="width: 20%;" scope="row">
                                            <select class="form-control form-select" name="state" id="state" aria-label="Default select example">
                                                @if( $pr->state == 1)
                                                <option value="{{$pr->state}}">Jelen</option>
                                                <option value="2">Hiány</option>
                                                <option value="3">Keresőképtelen</option>
                                                @elseif ($pr->state == 2)
                                                <option value="{{$pr->state}}">Hiány</option>
                                                <option value="1">Jelen</option>
                                                <option value="3">Keresőképtelen</option>
                                                @else
                                                <option value="{{$pr->state}}">Keresőképtelen</option>
                                                <option value="2">Hiány</option>
                                                <option value="1">Jelen</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td style="width: 30%;">
                                            <select class="form-control form-select" name="student_id" id="student_id" aria-label="Default select example">
                                                <option value="{{$pr->student_id}}" selected> {{$students->where("id", $pr->student_id)->first()->name}}</option>
                                                @forEach($students as $std)
                                                <option value="{{$std->id}}">{{$std->name}}</option>
                                                @endforeach
                                            </select>

                                        </td>
                                        <td>
                                            <select class="form-control form-select" name="course_id" id="course_id" aria-label="Default select example">
                                                <option value="{{$pr->schoolday_id}}" selected> {{$days->where("id", $pr->schoolday_id)->first()->title}}</option>
                                                @forEach($days as $day)
                                                <option value="{{$day->id}}">{{$day->title}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                            
                                        <td>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </td>
                                    </form>
                                    @if (Auth::user()->role == 1)
                                        <td>
                                            <form action="{{ route('presences.destroy', $pr) }}" method="POST">
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
