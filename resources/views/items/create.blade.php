<!-- resources/views/items/create.blade.php -->
@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Agregar Nuevo Item</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') }}" required>
                        @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Imágenes</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                        <small class="form-text text-muted">Selecciona una o mas imagenes</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Item</button>
                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('items.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left" style="color: #ffffff;" title="Volver"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>
@endsection
