<!-- Modal -->
<div class="modal fade show shadow" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-modal="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body rounded mb-0">
                <div class="text-center my-2">
                    <i data-feather='alert-circle' style="height: 7rem; width: 7rem; color: #ffc107;"></i>
                    <h3 class="mt-1">Atención</h3>
                    <p>Usted tiene un pago pendiente por ${{ $order->amount }}</p>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center mb-1">
                <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Volver al Dashboard</a>
            </div>
        </div>
    </div>
</div>