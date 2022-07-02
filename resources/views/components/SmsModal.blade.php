<div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="loginPopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal">
            <div class="modal-header">
                <div style="display: flex; flex-direction: column">
                    <h2 class="modal-title">SMS арқылы алынған кодты енгізіңіз:</h2>
                    <h2 class="modal-phone" style="color: #03B113; font-size: 24px; font-weight: 800; text-align: center; font-family: 'Exo2-Bold'"></h2>
                </div>
                <button type="button" class="close modal-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="smsForm" class="modal-form" action="{{ route('profile.ajax.updatePhone') }}" method="POST">
                    @csrf
                    <div class="form-input-block">
                        <input name="code" class="modal-form-input smsCode smsCode1" maxlength="1" type="tel">
                        <input name="code" class="modal-form-input smsCode smsCode2" maxlength="1" type="tel">
                        <input name="code" class="modal-form-input smsCode smsCode3" maxlength="1" type="tel">
                        <input name="code" class="modal-form-input smsCode smsCode4" maxlength="1" type="tel">
                    </div>
                    <span class="invalid text-center" role="alert" id="error-sms-modal"></span>

                    <div style="display: flex; justify-content: center">
                        <button class="modal-default-btn">Жіберу</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
