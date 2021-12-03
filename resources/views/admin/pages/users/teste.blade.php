@extends('adminlte::page')
@section('title', 'Usuários')
@section('content_header')
    <div class="container-fluid">
        @include('admin.includes.alerts')
        <div class="row mb-2">
            <div class="col-sm-6">
            <h3>Listar</h3>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="{{ route('users.create') }}" class="btn btn-outline-success btn-sm">Cadastrar</a>
            </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">

                    </div>
                    <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Responsive Hover Table</h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <form action="{{ route('users.search') }}" method="POST" class="form form-inline">
                                        @csrf
                                        <input type="text" name="filter" class="form-control float-right" placeholder="Search" value="{{ $filters['filter'] ?? '' }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                              <table class="table table-hover text-nowrap">
                                <thead>
                                  <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Nível de Acesso</th>
                                    <th class="text-center">Ações</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role->name }} </td>
                                            <td class="text-center">
                                                <span class="d-none d-md-block">
                                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-primary btn-sm">Visualizar</a>
                                                    @can('user-edit')
                                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                                                    @endcan
                                                    @can('user-delete')
                                                        <form action="{{ route('users.destroy', $user->id) }}" style="display:inline" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja apagar o usuário ?')" >Apagar</button>
                                                        </form>
                                                    @endcan
                                                </span>
                                                <div class="dropdown d-block d-md-none">
                                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ações
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                                        <a href="{{ route('users.show', $user->id) }}" class="dropdown-item">Visualizar</a>
                                                        @can('user-edit')
                                                            <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item">Editar</a>
                                                        @endcan
                                                        @can('user-delete')
                                                            <button class="dropdown-item" onclick="return confirm('Deseja apagar o usuário ?')">Apagar</button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>
                      </div>
                    <div class="card-footer">
                        @if (isset($filters))
                            {!! $users->appends($filters)->links() !!}
                        @else
                            {!! $users->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
