<div class="modal fade" id="editPasswordPopup" tabindex="-1" role="dialog" aria-labelledby="loginPopup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal">
            <div class="modal-header">
                <h2 class="modal-title">Құпия сөзді жаңарту</h2>
                <button type="button" class="close modal-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPasswordForm" class="modal-form" action="{{ route('profile.ajax.updatePassword', auth()->user()) }}" method="GET">
                    @csrf
                    <input type="hidden" name="current_password" id="current_password" value="{{ auth()->user()->password }}">

                    <div class="form-input-block">
                        <i class="form-input-icon icon-eye" onclick="iconEye(this)"></i>
                        <label class="modal-form-label" for="password">Жаңа құпия сөз:</label>
                        <input id="password" name="password" class="modal-form-input password-input"
                               type="password" placeholder="Құпия сөзді ойлап табыңыз" required>
                        <i class="form-input-icon icon-eye-off" onclick="iconEyeOff(this)"></i>
                        <span class="invalid" role="alert" id="error-login-password"></span>
                    </div>

                    <div class="form-input-block">
                        <i class="form-input-icon icon-eye" onclick="iconEye(this)"></i>
                        <label class="modal-form-label" for="password">Құпия сөзді қайта енгізіңіз:</label>
                        <input id="password_confirmation" name="password_confirmation" class="modal-form-input password-input"
                               type="password" placeholder="Құпия сөзді қайта енгізіңіз" required>
                        <i class="form-input-icon icon-eye-off" onclick="iconEyeOff(this)"></i>
                        <span class="invalid" role="alert" id="error-login-password"></span>
                    </div>
                    <button class="modal-default-btn">Кіру</button>
                </form>
            </div>
        </div>
    </div>
</div>
