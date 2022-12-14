<div class="col-sm-3 mb-2">
    <div class="card-d p-2">
        <div class="avatar bg-light-primary avatar-md me-auto mb-1 custom-avatar-content">
            <div class="avatar-content">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M16 18H2C0.89543 18 0 17.1046 0 16V2C0 0.89543 0.89543 0 2 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18ZM2 2V16H16V2H2ZM14 14H12V7H14V14ZM10 14H8V4H10V14ZM6 14H4V9H6V14Z"
                        fill="#04D99D" />
                </svg>
            </div>
        </div>
        <div class="texto">
            <!-- wallets_commissions tipo 2 -->
            <h3 class="fw-700 mb-25 texto">USDT {{number_format($user->cartera(), 2, ',', '.')}}</h3>
            <p class="font-medium-2 mb-0  " >Bono por Licencias</p>
        </div>
    </div>
</div>