<!-- resources/views/items/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h3>Lista de Items</h3>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('items.create') }}" class="btn btn-success btn-lg d-flex align-items-center">
            <i class="fas fa-plus me-2"></i> Nuevo Item
        </a>
        <a href="{{ route('grafica.index') }}" class="btn btn-info btn-lg d-flex align-items-center">
            <i class="fas fa-chart-bar me-2"></i> Ver Estadísticas
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="items-table" class="table table-striped table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td>{{ number_format($item->precio, 0, ',', '.') }} COP</td> <!-- Precio formateado -->
                    <td>
                        <a href="{{ route('items.show', $item) }}" class="btn btn-info btn-sm" style="color: #ffffff" title="Ver"><i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('items.edit', $item) }}" class="btn btn-warning btn-sm" style="color: #343a40" title="Editar"><i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="color: #ffffff" title="Eliminar"><i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
<script>
    $(document).ready( function () {
        $('#items-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" // Traducción a español
            }
        });
    });
</script>
@endpush