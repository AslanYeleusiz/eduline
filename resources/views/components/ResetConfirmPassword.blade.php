<div class="modal fade" id="resetConfirmPopup" tabindex="-1" role="dialog" aria-labelledby="loginPopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal">
            <div class="modal-header">
                <div></div>
                <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="NewPasswordResetForm" class="modal-form" action="" method="POST">
                    @csrf
                    <h2 class="modal-title">@lang('site.Құпия сөзді жаңарту')</h2>

                    <div class="form-input-block mt-3">
                        <i class="form-input-icon icon-eye" onclick="iconEye(this)"></i>
                        <label class="modal-form-label" for="password">@lang('site.Жаңа құпия сөз'):</label>
                        <input id="password" name="password" class="modal-form-input password-input" type="password" placeholder="@lang('site.Құпия сөзді ойлап табыңыз')" required>
                        <i class="form-input-icon icon-eye-off" onclick="iconEyeOff(this)"></i>
                        <span class="invalid" role="alert" id="error-login-password"></span>
                    </div>

                    <div class="form-input-block mt-3">
                        <i class="form-input-icon icon-eye" onclick="iconEye(this)"></i>
                        <label class="modal-form-label" for="password">@lang('site.Құпия сөзді қайта енгізіңіз'):</label>
                        <input id="password_confirmation" name="password_confirmation" class="modal-form-input password-input" type="password" placeholder="@lang('site.Құпия сөзді қайта енгізіңіз')" required>
                        <i class="form-input-icon icon-eye-off" onclick="iconEyeOff(this)"></i>
                        <span class="invalid" role="alert" id="error-login-password"></span>
                    </div>
                    <button class="modal-default-btn mt-3">@lang('site.Өзгерту')</button>
                </form>
            </div>
        </div>
    </div>
</div>
