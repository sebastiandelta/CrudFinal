<!-- resources/views/items/show.blade.php -->
@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>{{ $item->nombre }}</h2>
            </div>
            <div class="card-body">
                <p><strong>Descripción:</strong></p>
                <p>{{ $item->descripcion }}</p>
                <p><strong>Precio:</strong> {{ number_format($item->precio, 0, ',', '.') }} COP</p>

                <div class="mb-3">
                    <strong>Imágenes:</strong>
                    @if($item->images->isEmpty())
                        <p>No hay imágenes disponibles.</p>
                    @else
                        @foreach($item->images as $image)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $item->nombre }}" class="img-thumbnail" style="width: 200px; height: auto;">
                                
                                <!-- Formulario para eliminar imagen -->
                                <form action="{{ route('images.destroy', $image->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0" style="margin-right: 60rem" title="Eliminar"> <!-- Usar ms-1 para margen a la izquierda -->
                                        <i class="fas fa-times" style="color: red;"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="mb-3">
                    <strong>Comentarios:</strong>
                    @foreach($item->comments as $comment)
                        <div class="border p-2 mb-2">
                            <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }} <br>
                            <small class="text-muted">{{ $comment->created_at->format('d-m-Y H:i') }}</small>
                        </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <strong>Historial de Cambios:</strong>
                    @if($item->history->isEmpty())
                        <p>No hay historial de cambios disponible.</p>
                    @else
                    @foreach($item->history as $change)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            {{ $change->descripcion }} - <small>{{ $change->created_at->format('d-m-Y H:i') }}</small>
                        </div>
                        <form action="{{ route('history.destroy', $change->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0" title="Eliminar">
                                <i class="fas fa-times" style="color: red;"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
                    @endif
                </div>
                

            </div>
            <div class="card-footer">
                <a href="{{ route('items.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left" style="color: #ffffff;" title="Volver"></i>
                    Volver
                </a>
                <a href="{{ route('items.edit', $item) }}" class="btn btn-warning">
                    <i class="fas fa-edit" style="color: #343a40;" title="Editar"></i>
                    Editar
                </a>
                
                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash" style="color: #ffffff;" title="Eliminar"></i>
                        Eliminar
                    </button>
                </form>
                <a href="{{ route('grafica.index') }}" class="btn btn-primary">Ver Estadísticas</a>
            </div>
        </div>
    </div>
@endsection
