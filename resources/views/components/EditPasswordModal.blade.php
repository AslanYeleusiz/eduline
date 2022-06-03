<div class="modal fade" id="loginPopup" tabindex="-1" role="dialog" aria-labelledby="loginPopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal">
            <div class="modal-header">
                <h2 class="modal-title">Құпия сөзді жаңарту</h2>
                <button type="button" class="close modal-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" class="modal-form" action="{{ route('ajax.edit.password') }}" method="POST">
                    @csrf
                    <div class="form-input-block">
                        <label class="modal-form-label" for="login-phone">@lang('validation.attributes.phone'):</label>
                        <input id="login-phone" name="phone"
                               class="modal-form-input phone" type="tel"
                               placeholder="+7 (7__) ___-__-__">
                        <span class="invalid error-phone" role="alert" id="error-login-phone"></span>
                    </div>

                    <div class="form-input-block">
                        <i class="form-input-icon icon-eye" onclick="iconEye(this)"></i>
                        <label class="modal-form-label" for="password">@lang('validation.attributes.password'):</label>
                        <input id="password" name="password" class="modal-form-input password-input"
                               type="password" placeholder="@lang('validation.attributes.password')" required>
                        <i class="form-input-icon icon-eye-off" onclick="iconEyeOff(this)"></i>
                        <span class="invalid" role="alert" id="error-login-password"></span>
                    </div>
                    <button class="modal-default-btn">Войти</button>
                </form>
            </div>

            <div class="modal-footer">
                <a onclick="openRegisterLink(this)" class="modal-default-btn modal-default-btn-outline">Тіркелу</a>
            </div>
        </div>
    </div>
</div>