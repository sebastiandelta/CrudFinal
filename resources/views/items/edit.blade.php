@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Item: {{ $item->nombre }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $item->nombre) }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $item->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio', $item->precio) }}" required>
                        @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="currentImage" class="form-label">Imagen Actual</label>
                        @if ($item->images->isNotEmpty())
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $item->images->first()->path) }}" alt="{{ $item->nombre }}" class="img-thumbnail" style="width: 200px;">
                            </div>
                            {{-- <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="removeImage" name="remove_image">
                                <label for="removeImage" class="form-check-label">Eliminar imagen actual</label>
                            </div> --}}
                        @else
                            <p>No hay imagen disponible.</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="images" class="form-label">Nueva Imagen (opcional)</label>
                        <input type="file" class="form-control" id="images" name="images">
                        <small class="form-text text-muted">Selecciona una nueva imagen si deseas reemplazar la actual.</small>
                    </div>

                    <button type="submit" class="btn btn-warning" title="Actualizar">
                        <i class="fas fa-save" style="color: #ffffff;"></i> Actualizar Item
                    </button>
                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('items.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left" style="color: #ffffff;" title="Volver"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
