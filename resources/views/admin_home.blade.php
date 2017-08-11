@extends('baseviews.base')

@section('content')
    <section id="adminPageHeader">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">All users of {{config('app.name')}}</h1>
                </div>
            </div>
        </div>
    </section>
    <section id="users">
        <div class="container-fluid">
            @foreach($users as $user)
            <div class="row user">
                <div class="col-md-2">
                    <p>{{$user->first_name}} {{$user->last_name}}</p>
                </div>
                <div class="col-md-2">
                    <p>Quizzes: {{count($user->rightsFor)}}</p>
                </div>
                <div class="col-md-2">
                    @if($user->teacher == 1)
                        <p class="status-teacher">Status: Teacher</p>
                    @endif
                    @if($user->student == 1)
                        <p class="status">Status: Student</p>
                    @endif
                    @if($user->admin == 1)
                        <p class="status">Status: Admin</p>
                    @endif
                </div>
                <div class="col-md-4">
                    @if($user->student == 1)
                        <a href="/admin/grant-teacher/{{$user->id}}" class="btn btn-default grant-teacher">Teacher</a>
                        <a href="/admin/grant-admin/{{$user->id}}" class="btn btn-primary grant-admin">Admin</a>
                    @endif
                    @if($user->teacher == 1)
                        <a href="/admin/grant-admin/{{$user->id}}" class="btn btn-primary grant-admin">Admin</a>
                    @endif
                </div>
                <div class="col-md-2">
                    <a href="/admin/delete-user/{{$user->id}}" class="btn btn-danger delete-user">Delete</a>
                </div>
            </div>
            @endforeach

            {{$users->links()}}
        </div>
    </section>
@endsection

@section('footer')
    <script>

        $(document).ready(function () {

            $('.grant-teacher').on('click', function (e) {
                e.preventDefault();

                var link   = $(this);
                var parent = $(this).parents('.user');
                var status = parent.find('.status');
                var userId = $(this).attr('href').split('/').pop();

                $.ajax({
                    url : '/admin/grant-teacher/' + userId,
                    type : "GET",
                    success : function (data) {
                        if(!data.error) {
                            makeStudentATeacher(link, status);
                        }
                    },
                    error : function (data) {
                        console.log("Error", data);
                    }
                })
            });

            $('.grant-admin').on('click', function (e) {
                e.preventDefault();

                var link   = $(this);
                var parent = $(this).parents('.user');
                var status = parent.find('.status-teacher');
                var userId = $(this).attr('href').split('/').pop();

                $.ajax({
                    url : '/admin/grant-admin/' + userId,
                    type : "GET",
                    success : function (data) {
                        if(!data.error) {
                            makeTeacherAdmin(link, status);
                        }
                    },
                    error : function (data) {
                        console.log("Error", data);
                    }
                })
            });

            $('.delete-user').on('click', function (e) {
                e.preventDefault();

                var link   = $(this);
                var parent = $(this).parents('.user');
                var userId = $(this).attr('href').split('/').pop();

                $.ajax({
                    url : '/admin/delete-user/' + userId,
                    type : "GET",
                    success : function (data) {
                        if(!data.error) {
                            deleteUser(parent);
                        }
                    },
                    error : function (data) {
                        console.log("Error", data);
                    }
                })
            });


            function makeStudentATeacher(link, status) {
                link.remove();
                status.html('Status: Teacher');
            }

            function makeTeacherAdmin(link, status) {
                link.remove();
                status.html('Status: Admin');
            }

            function deleteUser(parent) {
                parent.remove();
            }
        })
    </script>
@endsection