<div class="modal fade" id="subscriptionPayPopup" tabindex="-1" role="dialog" aria-labelledby="subscriptionPayPopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content min-height-auto modal-content-second">
            <button type="button" class="close modal-close modal-close-second" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <img src="{{asset('images/Fx.svg')}}" alt="">
            </button>
            <div class="modal-header modal-header-auth-padding">
                <h2 class="modal-title modal-title-second">@lang('site.Төлем жасау әдісін таңдаңыз')</h2>
            </div>
            <div class="modal-body-second">
                <div class="pay-variants">
                    <a href="https://api.whatsapp.com/send?phone=77712345599&text=Сәлеметсізбе! Онлайн платформа бойынша жазып тұрмын" class="pay-variant-item">
                        <span class="pay-variant-image kaspi-icon"></span>
                        @lang('site.Kaspi.kz арқылы')
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=77712345599&text=Сәлеметсізбе! Онлайн платформа бойынша жазып тұрмын" class="pay-variant-item">
                        <span class="pay-variant-image credit-card-icon"></span>
                        @lang('site.Картамен төлеу')
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=77712345599&text=Сәлеметсізбе! Онлайн платформа бойынша жазып тұрмын" class="pay-variant-item">
                        <span class="pay-variant-image whatsapp-icon"></span>
                        @lang('site.WhatsApp-қа жазу')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>




<!--
<div class="modal-header modal-header-auth-padding">
                <h2 class="modal-title modal-title-second">@lang('site.Төлем жасау әдісін таңдаңыз')</h2>
                <button type="button" class="close modal-close modal-close-second" data-dismiss="modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-second">
                <div class="pay-variants">
                    <a href="https://api.whatsapp.com/send?phone=77712345599&text=Сәлеметсізбе! Онлайн платформа бойынша жазып тұрмын"
                       class="pay-variant-item">
                        <span class="pay-variant-image kaspi-icon"></span>
                        @lang('site.Kaspi.kz арқылы')
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=77712345599&text=Сәлеметсізбе! Онлайн платформа бойынша жазып тұрмын"
                       class="pay-variant-item">
                        <span class="pay-variant-image credit-card-icon"></span>
                        @lang('site.Картамен төлеу')
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=77712345599&text=Сәлеметсізбе! Онлайн платформа бойынша жазып тұрмын"
                       class="pay-variant-item">
                        <span class="pay-variant-image whatsapp-icon"></span>
                        @lang('site.WhatsApp-қа жазу')
                    </a>
                </div>
            </div>
-->
