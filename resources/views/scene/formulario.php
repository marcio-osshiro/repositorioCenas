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
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Identificação da Cena</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="form-group">
          <label>Nome</label>
          <input name="label" class="form-control" value="{{ old('label',$scene->label) }}" />
          
        </div>
        <div class="form-group">
          <label>Descrição</label>
          <textarea name="description" class="form-control" rows="5" >{{ old('description',$scene->description) }}</textarea>
        </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Câmera</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Luz</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Objeto</a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="form-group">
          <label>Malha(insira a malha de triângulos no formato obj)</label>
          <textarea name="waveFront" class="form-control" rows="5" >{{ old('waveFront',$scene->waveFront) }}</textarea>
        </div>
        
        <div class="form-group">
          <label>Material</label>
          <textarea name="materials" class="form-control" rows="5" >{{ old('materials',$scene->materials) }}</textarea>
        </div>
      </div>
    </div>
  </div> 
  <button type="submit" class="btn btn-primary btn-block">Salvar</button>
  
  </form>
</div>