<div class="modal fade" id="editPhonePopup" tabindex="-1" role="dialog" aria-labelledby="editPhonePopup"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPhoneForm" class="modal-form" action="{{ route('profile.ajax.checkSendSmsPhone') }}"
                      method="POST">
                    @csrf

                    <div class="modal-body-title">Cіздің расталған номеріңіз</div>
                    <div class="modal-body-subtitle">{{ $phone }}</div>

                    <div class="modal-body-line"></div>

                    <div class="form-input-block">
                        <label class="modal-form-label" for="new-phone">Жаңа номеріңізді жазыңыз:</label>
                        <input id="new-phone" name="phone"
                               class="modal-form-input phone phone_mask" type="tel"
                               placeholder="+7 (7__) ___-__-__">
                        <span class="invalid error-phone" role="alert" id="error-new-phone"></span>
                    </div>

                    <button class="modal-default-btn">Сақтау</button>
                </form>
            </div>
        </div>
    </div>
</div>
