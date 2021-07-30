@extends ('layout.plantilla')
@section ('contenido')
<form method="get" action="{{url('/reporte/consulta')}}">  
{{csrf_field()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
            <div class="form-group">
                <label for="fecha">Seleccione una fecha</label>
                <input type="date" name="fecha" class="form-control" value="{{old('fecha')}}" required>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="plazo_meses">Área</label>
                <select name="area" class="form-control selectpicker" data-size="5"  data-live-search="true" required>
                    <option value="">Seleccione una opción</option>
                    <option value="CAJA">Cajas</option>
                    <option value="ATEN-PLAT">Plataforma</option>
                    <option value="CREDITOS">Creditos</option>
                    <option value="GENERAL">Todo</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Generar reporte</button>
            </div>
        </div>      

    </div>
</form>
@include('sweetalert::alert')
@endsection