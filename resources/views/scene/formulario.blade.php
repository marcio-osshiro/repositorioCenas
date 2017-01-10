@extends('layout.principal')

@section('conteudo')

@if ( count($errors)>0 )
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach  
    </ul>
  </div>
@endif


<div class="container">
  <form action="/scene/adiciona" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

  <div class="form-group" style="visibility: hidden">
    <input name="id" class="form-control" value="{{$scene->id}}" />
  </div>

  <h2>Cena</h2>
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Identificação da Cena</a>
        </h2>
        <div id="collapse1" class="panel-collapse collapse">
          <div class="form-group">
            <label>Nome</label>
            <input name="label" class="form-control" value="{{ old('label',$scene->label) }}" />
            
          </div>
          <div class="form-group">
            <label>Descrição</label>
            <textarea name="description" class="form-control" rows="5" >{{ old('description',$scene->description) }}</textarea>
          </div>
        </div>
      </div>
    </div>    

    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Câmera</a>
        </h2>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body row">
            <div class="container col-xs-6 col-sm-3">
              <h3>Posição</h3>
              <div class="form-group">
                <label>x:</label>
                <input name="camera_position_x" class="form-control" value="{{ old('camera_position_x',$scene->camera_position_x) }}" />                
              </div>
              <div class="form-group">
                <label>y:</label>
                <input name="camera_position_y" class="form-control" value="{{ old('camera_position_y',$scene->camera_position_y) }}" />                
              </div>
              <div class="form-group">
                <label>z:</label>
                <input name="camera_position_z" class="form-control" value="{{ old('camera_position_z',$scene->camera_position_z) }}" />                
              </div>
            </div>  
            <div class="container col-xs-6 col-sm-3">
              <h3>Direção de Projeção</h3>
              <div class="form-group">
                <label>x:</label>
                <input name="camera_dop_x" class="form-control" value="{{ old('camera_dop_x',$scene->camera_dop_x) }}" />                
              </div>
              <div class="form-group">
                <label>y:</label>
                <input name="camera_dop_y" class="form-control" value="{{ old('camera_dop_y',$scene->camera_dop_y) }}" />                
              </div>
              <div class="form-group">
                <label>z:</label>
                <input name="camera_dop_z" class="form-control" value="{{ old('camera_dop_z',$scene->camera_dop_z) }}" />                
              </div>
            </div>  
            <div class="container col-xs-6 col-sm-3">
              <h3>View Up</h3>
              <div class="form-group">
                <label>x:</label>
                <input name="camera_vup_x" class="form-control" value="{{ old('camera_vup_x',$scene->camera_vup_x) }}" />                
              </div>
              <div class="form-group">
                <label>y:</label>
                <input name="camera_vup_y" class="form-control" value="{{ old('camera_vup_y',$scene->camera_vup_y) }}" />                
              </div>
              <div class="form-group">
                <label>z:</label>
                <input name="camera_vup_z" class="form-control" value="{{ old('camera_vup_z',$scene->camera_vup_z) }}" />                
              </div>
            </div>  
            <div class="container col-xs-6 col-sm-3">
              <h3>Angulo de Vista Vertical:</h3>  
              <div class="form-group">
                <label>Valor:</label>
                <input name="camera_angle_view" class="form-control" value="{{ old('camera_angle_view',$scene->camera_angle_view) }}" />                
              </div>
            </div>  
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Luz</a>
        </h2>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
          <div class="row panel-body">
            <div class="container col-xs-6 col-sm-3">
              <h3>Posição</h3>
              <div class="form-group">
                <label>x:</label>
                <input name="light_position_x" class="form-control" value="{{ old('light_position_x',$scene->light_position_x) }}" />                
              </div>
              <div class="form-group">
                <label>y:</label>
                <input name="light_position_y" class="form-control" value="{{ old('light_position_y',$scene->light_position_y) }}" />                
              </div>
              <div class="form-group">
                <label>z:</label>
                <input name="light_position_z" class="form-control" value="{{ old('light_position_z',$scene->light_position_z) }}" />                
              </div>
            </div>  
            <div class="container col-xs-6 col-sm-3">
              <h3>Cor</h3>
              <div class="form-group">
                <label>r:</label>
                <input name="light_color_r" class="form-control" value="{{ old('light_color_r',$scene->light_color_r) }}" />                
              </div>
              <div class="form-group">
                <label>g:</label>
                <input name="light_color_g" class="form-control" value="{{ old('light_color_g',$scene->light_color_g) }}" />                
              </div>
              <div class="form-group">
                <label>b:</label>
                <input name="light_color_b" class="form-control" value="{{ old('light_color_b',$scene->light_color_b) }}" />                
              </div>
              <div class="form-group">
                <label>a:</label>
                <input name="light_color_a" class="form-control" value="{{ old('light_color_a',$scene->light_color_a) }}" />                
              </div>
            </div>  
          </div>
      </div>
    </div>


    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Objeto</a>
        </h2>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="form-group">
          <label>Malha(insira a malha de triângulos no formato obj)</label>
          <textarea name="waveFront" class="form-control" rows="5" >{{ old('waveFront',$scene->waveFront) }}</textarea>
        </div>
        
        <div class="form-group">
          <label>Material(insira o material no formato mtl, apenas sentença de cor e iluminação)</label>
          <textarea name="materials" class="form-control" rows="5" >{{ old('materials',$scene->materials) }}</textarea>
        </div>
      </div>
      </div>
    </div>
  </div> 
  <button type="submit" class="btn btn-primary btn-block">Salvar</button>
  
  </form>
</div>


@stop