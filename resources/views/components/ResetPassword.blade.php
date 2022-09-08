<div class="modal fade" id="resetLoginPopup" tabindex="-1" role="dialog" aria-labelledby="loginPopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal">
            <div class="modal-header">
                <div></div>
                <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="resetPassForm" class="modal-form" action="" method="POST">
                    @csrf
                    <h2 class="modal-title">@lang('site.Құпиясөзді қалпына келтіру')</h2>
                    <div class="form-input-block">
                        <label class="modal-form-label" for="login-phone">@lang('validation.attributes.phone'):</label>
                        <input id="reset-login-phone" name="phone" class="modal-form-input phone phone_mask" type="tel" placeholder="+7 (___) ___-__-__">
                        <span class="invalid error-phone" role="alert" id="error-register-invalid"></span>
                    </div>
                    <button class="modal-default-btn">@lang('site.Енгізу')</button>
                </form>
            </div>
        </div>
    </div>
</div>
