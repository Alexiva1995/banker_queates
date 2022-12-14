<div class="col-sm-3 mb-2">
    <div class="card-d p-2 mb-2">
        <div class="avatar bg-light-primary avatar-md me-auto mb-1 custom-avatar-content" >
            <div class="avatar-content">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18 18H1C0.447715 18 0 17.5523 0 17V0H2V16H18V18ZM5.373 13L4 11.656L8.856 6.9C9.23827 6.52848 9.84673 6.52848 10.229 6.9L12.456 9.081L16.627 5L18 6.344L13.144 11.1C12.7617 11.4715 12.1533 11.4715 11.771 11.1L9.543 8.918L5.374 13H5.373Z"
                        fill="#04D99D" />
                </svg>
            </div>
        </div>
        <div class="texto">
            <!-- wallets_commissions tipo 5 -->
            <h3 class="fw-700 mb-25 texto">USDT {{ number_format($user->rendimientoAvailable(), 2, ',', '.') }}</h3>
            <p class="font-medium-2 mb-0  " >Balance PAMM</p>
        </div>
    </div>
</div>