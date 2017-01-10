@extends('layout.principal')

@section('conteudo')
 @if($scenes->count()==0)
  <div class="alert alert-danger">
    Você não tem nenhuma cena cadastrada.
  </div>
  <a href="{{action('sceneController@novo')}}" class="glyphicon glyphicon-new-window btn btn-info" role="button">Novo</a>
 @else
  <h2>Listagem de Cenas
  <a href="{{action('sceneController@novo')}}" class="glyphicon glyphicon-new-window btn btn-info" role="button">Novo</a>

  </h2>
  <table class="table table-striped table-bordered table-hover">
    <tr>
        <th>ID</th>
        <th>Tag</th>
        <th>Descrição</th>
        <th></th>
        <th></th>
    </tr>    


    @foreach ($scenes as $scene)
    <tr class>
      <td> {{$scene->id}} </td>
      <td> {{$scene->label}} </td>
      <td> {{$scene->description}} </td>

      <td> 
        <a href="{{action('sceneController@edita', $scene->id)}}">
          <span class="glyphicon glyphicon-pencil"></span>
        </a>
      </td>
      <td> 
        <a href="{{action('sceneController@remove', $scene->id)}}"> 
          <span class="glyphicon glyphicon-trash"></span>
        </a>
      </td>      
    </tr>
    @endforeach
  </table>
 @endif
@stop