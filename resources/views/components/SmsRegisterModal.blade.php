<div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="loginPopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal">
            <div class="modal-header">
                <div></div>
                <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="display: flex; flex-direction: column">
                    <h2 class="modal-title">SMS арқылы алынған кодты енгізіңіз:</h2>
                    <h2 class="modal-phone" style="color: #03B113; font-size: 24px; font-weight: 800; text-align: center; font-family: 'Exo2-Bold'"></h2>
                </div>
                <form id="smsRegisterForm" class="modal-form" action="{{ route('ajax.checkSendSmsNewPhone') }}" method="POST">
                    @csrf
                    <div class="form-input-block">
                        <input name="code" class="modal-form-input smsCode smsCode1" maxlength="1" type="tel">
                        <input name="code" class="modal-form-input smsCode smsCode2" maxlength="1" type="tel">
                        <input name="code" class="modal-form-input smsCode smsCode3" maxlength="1" type="tel">
                        <input name="code" class="modal-form-input smsCode smsCode4" maxlength="1" type="tel">
                    </div>
                    <input type="tel" id="thisPhone" style="display:none;" name="thisPhone">
                    <span class="invalid text-center" role="alert" id="error-sms-modal"></span>

                    <div style="display: flex; justify-content: center">
                        <button class="modal-default-btn">Жіберу</button>
                    </div>
                    <div class="modal-info">SMS-ті 00:<span id="timer"></span> кейін қайта жіберуге болады</div>
                    <a type="submit" href="#" id="refreshConfirmPhone" class="modal-retry-btn">Қайта жіберу</a>
                </form>
            </div>

        </div>
    </div>
</div>
