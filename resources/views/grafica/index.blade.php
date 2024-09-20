@extends('layouts.app')

@section('content')
    <h2>Estadísticas de Items</h2>
    <canvas id="itemsChart" width="400" height="200"></canvas>

    <!-- Modal de Bootstrap para mostrar detalles del item (se eliminará ya que no lo usaremos) -->
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Detalles del Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> <span id="itemName"></span></p>
                    <p><strong>Descripción:</strong> <span id="itemDescription"></span></p>
                    <p><strong>Precio:</strong> <span id="itemPrice"></span> COP</p>
                    <img id="itemImage" src="" alt="Imagen del Item" class="img-fluid" style="display: none;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left" style="color: #ffffff;" title="Volver"></i>
        Volver
    </a>


<script>
    const ctx = document.getElementById('itemsChart').getContext('2d');
    const labels = {!! json_encode($labels) !!}; // Asegúrate de tener esta línea
    const itemIds = {!! json_encode($ids) !!}; // IDs como etiquetas
    const data = {!! json_encode($data) !!}; // Datos de precios

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Precios',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            onClick: function (event) {
                const activePoints = chart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false);
                if (activePoints.length) {
                    const index = activePoints[0].index;
                    const itemId = itemIds[index];

                    // Redirigir a la ruta del item
                    window.location.href = `/items/${itemId}`;
                }
            }
        }
    });
</script>
@endsection
