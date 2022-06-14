<div class="modal fade" id="editEmailPopup" tabindex="-1" role="dialog" aria-labelledby="editEmailPopup"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEmailForm" class="modal-form" action="{{ route('profile.ajax.updateEmail', auth()->user()) }}"
                      method="POST">
                    @csrf

                    <div class="modal-body-title">Cіздің қазіргі поштаңыз</div>
                    <div>n4msin@mail.ru</div>

                    <div class="modal-body-line"></div>

                    <div class="form-input-block">
                        <label class="modal-form-label" for="new-phone">Жаңа поштаңызды жазыңыз:</label>
                        <input id="email" name="email"
                               class="modal-form-input email" type="email"
                               placeholder="E-mail">
                        <span class="invalid error-email" role="alert" id="error-new-email"></span>
                    </div>

                    <button class="modal-default-btn">Сақтау</button>
                </form>
            </div>
        </div>
    </div>
</div>
