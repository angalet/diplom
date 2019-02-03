<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            
            .menu-hiper{
                display:block;
                width:50%;
                margin:auto;
            }

            header{
                text-align:center;
                background-color: green;
                color:white;
                padding:100px 0;
                font-size:3em;
            }
            .full-height {
                padding:0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                display:block;
                color: #636b6f;
                color: red;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links{
                max-width:40%;
                display:inline-block;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            aside{
                display:inline-block;
                max-width:30%;
                background-color: grey;
                padding:20px;
            }

            .aside-a{
                display:block;
                text-decoration: none;
                background-color: darkgrey;
                margin:10px 0;
            }

            .aside-a:hover{
                background-color: grey;
            }
        </style>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    <div class="jumbotron text-center">
        <h1>ЧАВО</h1>
        <p></p> 
    </div>
    <?php //echo "test<br><pre>";
        //print_r($tasks);
        echo "</pre>";
    ?>
    <div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма новой задачи action="{{ url('task') }}" -->
    {{ url('/') }}
    <form action="{{ url('/') }}"  method="POST" class="form-horizontal">
      {{ csrf_field() }}

      <!-- Имя задачи -->
    <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Вопрос</label>
            <div class="col-sm-4">
                <input type="text" name="name" id="task-name" class="form-control">
            </div>
    </div>

    <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Выбрать категорию</label>
            <div class="col-sm-4">
                <input type="text" name="category" id="task-name" class="form-control">
            </div>
    </div>

        <!-- Кнопка добавления задачи -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить вопрос
                    </button>
                </div>
            </div>
        </form>
    </div>
@foreach ($tasks as $task)
                <!-- Имя задачи -->
                <?php $taskCategorys[$task->category] = $task->category ?>
                <?php $taskQuestions[$task->category][$task->name] = $task->question ?>
@endforeach
<?php //echo "<pre>";print_r($taskQuestions);echo "</pre>"; ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3 style="text-align:center;">Группы вопросов</h3>
                    <?php $cat_num=0;?>
                    @foreach ($taskCategorys as $taskCategory)
                        <?php $cat_num++?>
                        <a class="menu-hiper btn btn-primary" href="#cat<?php echo "$cat_num"?>">{{ $taskCategory }}</a>
                    @endforeach
                </div>
                <div class="col-sm-8">
                <?php $i=0;?>
                <?php $cat_num=0;?>
                @foreach ($taskQuestions as $key => $taskQuestion)
                    <?php $cat_num++?>
                    <h3 id="cat<?php echo "$cat_num"?>">{{ $key }}</h3>        
                    <div class="panel-group" id="accordion">
                    @foreach ($taskQuestion as $keyInner => $Quest)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <?php $i++?>
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo "$i"?> ">
                                {{ $keyInner }}</a>
                                </h4>
                            </div>
                            <div id="collapse<?php echo "$i"?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        {{ $Quest }}
                                    </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                 @endforeach
                </div>   
            </div>
        </div>
    </body>
</html>
