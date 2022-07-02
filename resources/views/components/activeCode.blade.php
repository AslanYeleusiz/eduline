<div class="modal fade" id="activeCodePopup" tabindex="-1" role="dialog" aria-labelledby="editEmailPopup"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal" style="min-height: 300px;">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="activeCodeForm" class="modal-form" action="{{ route('promocode') }}"
                      method="POST">
                    @csrf

                    <div class="modal-title text-center">Промокодты енгізіңіз</div>

                    <div class="form-input-block">
                        <input id="code" name="code"
                               class="modal-form-input code" type="text"
                               placeholder="Промо код">
                        <span class="invalid error-code" role="alert" id="error-new-email"></span>
                    </div>

                    <button class="modal-default-btn">Сақтау</button>
                </form>
            </div>
        </div>
    </div>
</div>
