@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-11">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <h1 class= "text-center">Use Ctrl+F for searching</h1>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Course</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($students as $item)
                            <tr class="">
                                <td scope="row">{{$item->name}}</td>
                                <td >{{$item->birthday}}</td>
                                <td>{{$courses[$item->course_id-1]->name}}</td>
                                <td>
                                    <form action="{{ route('students.restore', ['student' => $item]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-info">Restore</button>
                                    </form>                                    
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




    </div>
@endsection
