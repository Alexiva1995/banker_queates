<div class="col-md-3">
    <div class="card p-2">
        <div class="avatar bg-light-primary avatar-md me-auto mb-1 custom-avatar-content"e="padding: 0.3rem;">
            <div class="avatar-content">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18 2.84211V4.73684H15.1579V7.57895H13.2632V4.73684H10.4211V2.84211H13.2632V0H15.1579V2.84211H18ZM15.1579 16.1053H1.89474V2.84211H7.57895V0.947368H1.89474C0.852632 0.947368 0 1.8 0 2.84211V16.1053C0 17.1474 0.852632 18 1.89474 18H15.1579C16.2 18 17.0526 17.1474 17.0526 16.1053V10.4211H15.1579V16.1053ZM11.3684 10.4211V14.2105H13.2632V10.4211H11.3684ZM7.57895 14.2105H9.47368V6.63158H7.57895V14.2105ZM5.68421 14.2105V8.52632H3.78947V14.2105H5.68421Z"
                        fill="#673DED" />
                </svg>
            </div>
        </div>
        <div class="texto">
            <h3 class="fw-700 mb-25">USD {{ number_format($user->getWalletComissionAmount(), 2, ',', '.') }}</h3>
            <p class="font-medium-2 mb-0">Comisiones</p>
        </div>
    </div>
</div>