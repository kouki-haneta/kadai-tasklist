<header class="mb-4">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            {{-- トップページへのリンク --}}
            <a class="navbar-brand" href="/">TaskList</a>
                
            <button type="button" class="navbar-toggler" data-toggler="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
                
            <div class="collapse navbar-collapse" id="nav-bar">
                <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav">
                    @if (Auth::check()) 
                        {{-- 新規タスク投稿へのリンク --}}
                        <li class="nav-item">
                            {!! link_to_route('tasks.create','新規タスクの投稿', [], ['class' => 'nav-link']) !!}
                        </li>
                        {{-- ログアウトへのリンク --}}
                        <li class="nav-item">
                            {!! link_to_route('logout.get', 'Logout', [], ['class' => 'nav-link']) !!}
                        </li>
                    @else
                        {{-- ユーザ登録ページへのリンク --}}
                        <li class="nav-item">{!! link_to_route('signup.get', 'Signup', [], ['class' => 'nav-link']) !!}</li>
                        {{-- ログインページへのリンク --}}
                        <li class="nav-item">{!! link_to_route('login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                    @endif
                </ul>
            </div>
        </nav>
</header>