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
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Course</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($schooldays as $item)
                            <tr class="">
                                <td scope="row">{{$item->title}}</td>
                                <td >{{$item->date}}</td>
                                <td>{{$courses->where("id", $item->course_id)->first()->name}}</td>
                                <td>
                                    <form action="{{ route('schooldays.restore', ['schoolday' => $item]) }}" method="POST">
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
