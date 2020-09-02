@extends('layouts.app')

@section('content')

    @if (Auth::check() )
        <div class="row">
            <div class="col-sm-4">
                
                {{ Auth::user()->name }}
                
            </div>
            <div class="col-sm-8">
                
                {{-- 投稿一覧 --}}
                @include('tasks.tasks')
                
                {!! link_to_route('tasks.create', '新規タスクの投稿', [],['class' => 'btn btn-primary']) !!}
            </div>
            
        </div>
                
          
        
    @else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Task List</h1>
            
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            
        </div>
    </div>
    
    @endif
    
@endsection
